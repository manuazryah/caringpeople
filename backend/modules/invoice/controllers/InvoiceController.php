<?php

namespace backend\modules\invoice\controllers;

use Yii;
use common\models\Invoice;
use common\models\InvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Service;
use yii\base\UserException;
use kartik\mpdf\Pdf;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller {

        public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
        }

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Invoice models.
         * @return mixed
         */
        public function actionIndex($id = null) {

                $check_exists = explode('?', Yii::$app->request->url);
                if (empty($check_exists[1]))
                        Yii::$app->session->remove('new_size');

                if (isset($_POST['size'])) {
                        $pagesize = $_POST['size'];
                        \Yii::$app->session->set('new_size', $pagesize);
                } else {
                        $pagesize = Yii::$app->session->get('new_size');
                }

                $searchModel = new InvoiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination->pageSize = $pagesize;

                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }

                if (!empty($id)) {
                        $dataProvider->query->andWhere(['service_id' => $id]);
                }
                if (!empty(Yii::$app->request->queryParams['InvoiceSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['InvoiceSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['status' => 1]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        public function actionInvoice() {

                $model = new Invoice;
                $services = '';
                $model->scenario = 'invoice';
                if ($model->load(Yii::$app->request->post())) {
                        $services = Service::find()->where(['patient_id' => $model->patient_id])->andWhere(['>', 'due_amount', 0])->all();
                }
                return $this->render('invoice', [
                            'model' => $model,
                            'services' => $services
                ]);
        }

        public function actionServiceInvoiceView($branch, $patient) {
                $model = new Invoice;
                $model->branch_id = $branch;
                $model->patient_id = $patient;
                $services = Service::find()->where(['patient_id' => $patient])->andWhere(['>', 'due_amount', 0])->all();
                return $this->render('invoice', [
                            'model' => $model,
                            'services' => $services
                ]);
        }

        public function actionPayment() {
                if (isset($_POST['patient'])) {
                        $services = Service::find()->where(['patient_id' => $_POST['patient']])->andWhere(['>', 'due_amount', 0])->all();
                        $k = 0;
                        foreach ($services as $values) {
                                $k++;
                                $model = new Invoice();
                                if (isset($_POST['amount_paid_' . $values->id]) && $_POST['amount_paid_' . $values->id] > 0) {
                                        $model->load(\Yii::$app->request->post());
                                        $model->patient_id = $_POST['patient'];
                                        $model->branch_id = $_POST['branch_id'];
                                        $model->service_id = $values->id;
                                        $model->total_amount = $_POST['total_amount_' . $values->id];
                                        $model->amount = $_POST['amount_paid_' . $values->id];
                                        $model->due_amount = $model->total_amount - $model->amount;
                                        $model->CB = Yii::$app->user->identity->id;
                                        $model->payment_type = $model->payment_type;
                                        $model->reference_no = $model->reference_no;
                                        $model->DOC = date('Y-m-d');
                                        if ($model->save()) {
                                                $service = Service::findOne($model->service_id);
                                                $service->due_amount = $service->due_amount - $model->amount;
                                                $service->update();
                                                Yii::$app->SetValues->Accounts($model->branch_id, 3, $model->id, 2, 'Patient Invoice', $model->payment_type, $model->amount, $model->DOC);
                                                Yii::$app->getSession()->setFlash('success', 'Amount paided successfully');
                                        }
                                }
                        }
                        return $this->redirect(['index']);
                } else {
                        throw new UserException('Error Code:  1003');
                }
        }

        public function actionInvoicebill($id) {
                $model = $this->findModel($id);
                echo $this->renderPartial('invoice_bill', [
                    'model' => $model,
                ]);
        }

        public function actionPrint($id = null) {
                $model = $this->findModel($id);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                    'content' => $this->renderPartial('invoice_bill_print', [
                        'model' => $model,
                    ]),
                    'cssInline' => '.table{margin-top:20px;font-family: sans-serif;} ',
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/other.css',
                ]);
                return $pdf->render();
        }

       public function actionRefund($id = null) {
                $refund = $this->findModel($id);
                $model = new Invoice;
                $model->attributes = $refund->attributes;
                $refund_entry = new \common\models\RefundAmount();
                if ($model->load(Yii::$app->request->post())) {
                        if ($model->refund_amount <= $model->amount) {

                                $refund->refund_amount = $refund->refund_amount + $model->refund_amount;
                                $refund->amount = $refund->amount - $model->refund_amount;
                                $refund->save();
                                $refund_entry->invoice_id = $refund->id;
                                $refund_entry->service_id = $refund->service_id;
                                $refund_entry->refund_amount = $model->refund_amount;
                                $refund_entry->save();
                                $service = Service::findOne($refund->service_id);
                                $service->due_amount = $service->due_amount + $model->refund_amount;
                                $service->save();
                                Yii::$app->SetValues->Accounts($refund->branch_id, 4, $refund->id, 1, 'Patient Invoice Refund', $refund->payment_type, $model->refund_amount, date('Y-m-d'));
                                $this->redirect('index');
                        } else {
                                $model->addError('refund_amount', 'Refund amount should be less than or equal to amount paid');
                                return $this->render('refund', [
                                            'model' => $model,
                                ]);
                        }
                }

                return $this->render('refund', [
                            'model' => $model,
                ]);
        }

        /**
         * Creates a new Invoice model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Invoice();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Invoice model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Invoice model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Invoice model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Invoice the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Invoice::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionEstimatedProformas() {

                $check_exists = explode('?', Yii::$app->request->url);
                if (empty($check_exists[1]))
                        Yii::$app->session->remove('new_size');

                if (isset($_POST['size'])) {
                        $pagesize = $_POST['size'];
                        \Yii::$app->session->set('new_size', $pagesize);
                } else {
                        $pagesize = Yii::$app->session->get('new_size');
                }

                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination->pageSize = $pagesize;
                return $this->render('estimated-proformas', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        public function actionPrintInvoice() {

                $model = new Invoice;
                $services = '';
                if ($model->load(Yii::$app->request->post())) {
                        $service = Service::find()->where(['patient_id' => $model->patient_id])->select(['id'])->all();

                        $services = array();
                        foreach ($service as $value) {
                                $invoice = Invoice::find()->where(['service_id' => $value->id])->one();

                                if (isset($invoice) && $invoice->amount > 0) {

                                        $services[] = $value->id;
                                }
                        }
                }
                return $this->render('print-invoice', [
                            'model' => $model,
                            'services' => $services,
                ]);
        }

        public function actionPrintBill() {
                $checked_services = $_POST['checked'];
                foreach ($checked_services as $value) {
                        $check_service .= $value . ',';
                }
                $check_service = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $check_service);
                $patient_id = $_POST['serv_patient_id'];
                return $this->renderPartial('print-bill', [
                            'services' => $checked_services,
                            'patient_id' => $patient_id,
                            'check_service' => $check_service,
                ]);
        }

        public function actionPrints($checked_services = null, $patient_id = null) {
                $checked_services = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $checked_services);
                $checked_services = explode(',', $checked_services);

           
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                    'content' => $this->renderPartial('print-bill', [
                        'services' => $checked_services,
                        'patient_id' => $patient_id,
                    ]),
                    'cssInline' => '.table{margin-top:20px;font-family: sans-serif;} ',
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/other.css',
                ]);
                return $pdf->render();
        }

}
