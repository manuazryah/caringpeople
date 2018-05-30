<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class DashboardController extends Controller {

        public $layout = '@app/views/layouts/dashboard';

        public function actionIndex() {

                $services = \common\models\Service::find()->where(['patient_id' => Yii::$app->session['patient_id']])->count();
                $live_services = \common\models\Service::find()->where(['patient_id' => Yii::$app->session['patient_id'], 'status' => 1])->count();
                $closed_services = \common\models\Service::find()->where(['patient_id' => Yii::$app->session['patient_id'], 'status' => 2])->count();
                $due_amount = \common\models\Service::find()->where(['patient_id' => Yii::$app->session['patient_id']])->sum('due_amount');
                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['status' => 1]);
                return $this->render('home', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'title' => $title,
                            'services' => $services,
                            'live_services' => $live_services,
                            'closed_services' => $closed_services,
                            'due_amount' => $due_amount,
                ]);
        }

        public function actionServices() {
                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['status' => 1]);
                $title = 'Services';
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'title' => $title,
                ]);
        }

        public function actionViewSchedules($id) {
                $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $searchModel = new \common\models\ServiceScheduleSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['service_id' => $id]);
                return $this->render('view-schedules', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'service' => $id,
                ]);
        }

        public function actionView($id) {
                $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $model = \common\models\Service::findOne($id);
                echo $this->renderPartial('estimated_bill', [
                    'model' => $model,
                ]);
        }

        public function actionChangePassword() {

                $id = Yii::$app->user->identity->id;

                $model = \common\models\User::findOne($id);
                if (Yii::$app->request->post()) {
                        if (Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('old-password'), $model->password_hash)) {
                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {

                                        Yii::$app->getSession()->setFlash('success', 'Password changed successfully');
                                        $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        return $this->redirect(Yii::$app->request->referrer);
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'Password mismatch');
                                }
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'Old password is wrong !');
                        }
                }
                return $this->render('change-password', [
                            'model' => $model,
                ]);
        }

        public function actionInvoices($id = null) {


                $searchModel = new \common\models\InvoiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['<>', 'status', 3]);
                if (!empty($id)) {
                        if ($id == 1) {
                                $last_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -10  days'));
                                $dataProvider->query->andWhere(['>=', 'DOC', $last_date]);
                        } else if ($id == 2) {
                                $dataProvider->query->andWhere(['status' => 2]);
                        }
                }

                return $this->render('invoices', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionInvoicebill($id) {
                $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $model = \common\models\Invoice::findOne($id);
                $model->view = 1;
                $model->save();
                echo $this->renderPartial('invoice_bill', [
                    'model' => $model,
                ]);
        }

        public function actionInvoicebillview($id) {
                //  $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
                $invoice = \common\models\Invoice::findOne($id);
                $invoice->view = 1;
                $invoice->save();
                $model = \common\models\Invoice::findOne($id);
                echo $this->renderPartial('invoice_bill', [
                    'model' => $model,
                ]);
        }

        public function actionRemarks() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['schedule_id'];
                        $form = $this->renderPartial('remarks', ['schedule_id' => $schedule_id]);
                        echo $form;
                }
        }

        public function actionAddRemarks() {
                if (Yii::$app->request->isAjax) {
                        $schedule_id = $_POST['scheduleid'];
                        $schedule = \common\models\ServiceSchedule::findOne($schedule_id);
                        $schedule->remarks_from_patient = $_POST['remarks_patient'];
                        $schedule->save();
                }
        }

        public function actionClosedServices() {
                $searchModel = new \common\models\ServiceSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['patient_id' => Yii::$app->session['patient_id']]);
                $dataProvider->query->andWhere(['status' => 2]);
                $title = 'Closed Services';
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'title' => $title,
                ]);
        }

        public function actionEditProfile() {

                $model = \common\models\PatientGeneral::findOne(Yii::$app->session['patient_id']);
                $before_update_patient_details = \common\models\PatientGeneral::findOne(Yii::$app->session['patient_id']);
                if ($model->load(Yii::$app->request->post())) {
                        $model->dob = date('Y-m-d', strtotime($_POST['PatientGeneral']['dob']));
                        $model->weight = $_POST['PatientGeneral']['weight'];
                        $model->save();
                        $patient_datas = array('patient_image');
                        $this->Imageupload($model, $before_update_patient_details, $patient_datas, $model->id);
                        Yii::$app->getSession()->setFlash('success', 'Profile updated successfully');
                }
                return $this->render('edit-profile', ['model' => $model]
                );
        }

        public function Imageupload($model, $data = null, $images, $id) {

                foreach ($images as $value) {
                        $image = UploadedFile:: getInstance($model, $value);
                        $this->image($model, $data, $image, $value, $id);
                }
        }

        /* to save extension in database */

        public function image($model, $data = null, $image, $type, $id) {

                if (!empty($image)) {

                        $model->$type = $image->extension;
                        if (!empty($data)) {
                                $this->upload($model, $image, $type, $model->$type, $id, $data->$type);
                        } else {
                                $this->upload($model, $image, $type, $model->$type, $id);
                        }
                } else {
                        if (!empty($data))
                                $model->$type = $data->$type;
                }
                $model->update();
        }

        public function Upload($model, $image, $type, $extension, $id, $exists_type = null) {
                $paths = ['patient', $id];
                $file = Yii::getAlias(Yii::$app->params ['uploadPath']) . '/patient/' . $id . '/' . $type . '.' . $exists_type;
                if (file_exists($file))
                        unlink($file);
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $image->saveAs($paths . '/' . $type . '.' . $extension);
        }

        public function actionNotifications() {


                return $this->render('notifications');
        }

        public function actionUpdateNotification() {
                if (Yii::$app->request->isAjax) {
                        $id = $_POST['id'];
                        $notification = \common\models\Invoice::findOne(['id' => $id]);
                        $notification->view = 2;
                        $notification->save();
                        $last_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -20  days'));
                        $notifications = \common\models\Invoice::find()->where(['>=', 'due_date', $last_date])->andWhere(['<=', 'due_date', date('Y-m-d')])->andWhere(['status' => 2, 'patient_id' => Yii::$app->session['patient_id'], 'view' => 0])->orderBy(['id' => SORT_DESC])->limit(10)->all();
                        $count = count($notifications);

                        $i = 0;
                        if ($count >= 1) {
                                foreach ($notifications as $value) {
                                        $i++;
                                        if ($i == $count) {
                                                $arr_variable = array('id' => $value->id, 'amount' => $value->amount, 'date' => date('d-m-Y', strtotime($value->due_date)));
                                                $data['result'] = $arr_variable;
                                                echo json_encode($data);
                                        }
                                }
                        } else {
                                echo 1;
                                exit;
                        }
                }
        }

        public function actionUpdateTask() {
                if (Yii::$app->request->isAjax) {
                        $id = $_POST['id'];
                        $task = \common\models\Followups::findOne(['id' => $id]);
                        $task->view = 2;
                        $task->save();
                        $services = \common\models\Service::find()->where(['status' => 1, 'patient_id' => Yii::$app->session['patient_id']])->all();
                        $service = array();
                        foreach ($services as $services) {
                                $service[] = $services->id;
                        }
                        $last_date_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -20  days'));
                        $tasks = \common\models\Followups::find()->where(['>=', 'followup_date', $last_date_time])->andWhere(['<=', 'followup_date', date('Y-m-d H:i:s')])->andWhere(['status' => 0, 'view' => 0, 'releated_notification_patient' => 1])->andWhere(['IN', 'type_id', $service])->orderBy(['id' => SORT_DESC])->limit(10)->all();
                        $count = count($tasks);
                        $i = 0;
                        if ($count >= 10) {
                                foreach ($tasks as $value) {
                                        $i++;
                                        if ($i == $count) {
                                                $arr_variable = array('id' => $value->id, 'content' => $value->followup_notes, 'date' => $value->followup_date);
                                                $data['result'] = $arr_variable;
                                                echo json_encode($data);
                                        }
                                }
                        } else {
                                echo 1;
                                exit;
                        }
                }
        }

        public function actionTasks($id = null) {

                return $this->render('tasks');
        }

}
