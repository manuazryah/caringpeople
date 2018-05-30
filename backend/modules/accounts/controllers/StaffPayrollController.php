<?php

namespace backend\modules\accounts\controllers;

use Yii;
use common\models\StaffPayroll;
use common\models\StaffPayrollSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ServiceSchedule;
use common\models\Service;

/**
 * StaffPayrollController implements the CRUD actions for StaffPayroll model.
 */
class StaffPayrollController extends Controller {


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
         * Lists all StaffPayroll models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffPayrollSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StaffPayroll model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffPayroll model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {

                $model = new StaffPayroll();
                $model->scenario = 'payment';
                $service_schedule_amount = '';
                $paid_amount = '';
                $paided_details = '';
                $prev_date = '';
                $current_date = '';

                if (isset($_POST['get_amount'])) {
                        $model->load(Yii::$app->request->post());
                        $model->date_from = date('Y-m-d', strtotime($model->date_from));
                        $model->date_to = date('Y-m-d', strtotime($model->date_to));
                        $service_schedule_amount = ServiceSchedule::find()->where(['staff' => $model->staff_id])->andWhere(['>=', 'date', $model->date_from])->andWhere(['<=', 'date', $model->date_to])->sum('rate');
                        $paid_amount = StaffPayroll::find()->where(['staff_id' => $model->staff_id, 'date_from' => $model->date_from])->sum('amount');
                        $paided_details = StaffPayroll::find()->where(['staff_id' => $model->staff_id, 'date_from' => $model->date_from])->all();
                        $model->scenario = 'cash-payment';
                } else if (isset($_POST['submit_amount'])) {

                        $model->load(Yii::$app->request->post());
                        $model->date_from = date('Y-m-d', strtotime($model->date_from));
                        $model->date_to = date('Y-m-d', strtotime($model->date_to));
                        Yii::$app->SetValues->Attributes($model);
                        if (isset($model->month)) {
                                $month_year = explode('-', $model->month);
                                $model->selected_month = $month_year[0];
                                $model->year = $month_year[1];
                        }
                        if (!empty($model->payment_date))
                                $model->payment_date = date('Y-m-d', strtotime($model->payment_date));
                        $model->save(FALSE);
                        if ($model->type == 1)
                                $type = 'Salary Advance';
                        else
                                $type = 'Salary Payment';
                        Yii::$app->SetValues->Accounts($model->branch_id, 1, $model->id, 1, $type, $model->bank, $model->amount, $model->payment_date);
                        $model = new StaffPayroll();
                        Yii::$app->getSession()->setFlash('success', 'Payment added Successfully');
                }
                return $this->render('create', [
                            'model' => $model,
                            'service_schedule_amount' => $service_schedule_amount,
                            'paid_amount' => $paid_amount,
                            'paided_details' => $paided_details,
                            'prev_date' => $prev_date,
                            'current_date' => $current_date
                ]);
        }

        /**
         * Updates an existing StaffPayroll model.
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
         * Deletes an existing StaffPayroll model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StaffPayroll model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffPayroll the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffPayroll::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionStaffs() {

                $branch = $_POST['branch'];
                $date_from = date('Y-m-d', strtotime($_POST['date_from']));
                $date_to = date('Y-m-d', strtotime($_POST['date_to']));
                $service_staffs = ServiceSchedule::find()->where('1=1')->andWhere(['>=', 'date', $date_from])->andWhere(['<=', 'date', $date_to])->groupBy('staff')->all();
                $staffs = array();
                $options = '<option value="">--Select--</option>';
                foreach ($service_staffs as $value) {
                        if (isset($value->staff))
                                $staff_detail = \common\models\StaffInfo::findOne($value->staff);
                        if ($staff_detail->branch_id == $branch)
                                $options .= "<option value='" . $staff_detail->id . "'>" . $staff_detail->staff_name . "</option>";
                }
                echo $options;
        }

}
