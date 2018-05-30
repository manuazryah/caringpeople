<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\AdminPosts;
use common\models\AdminUsers;
use common\models\ForgotPasswordTokens;
use common\models\Enquiry;
use common\models\EnquiryOtherInfo;
use common\models\StaffInfo;
use common\models\NotificationViewStatus;
use common\models\Followups;
use common\models\PendingFollowups;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                                [
                                'actions' => ['login', 'error', 'index', 'home', 'forgot', 'new-password', 'staff-login', 'staff-home', 'notifications', 'pending-followups','report'],
                                'allow' => true,
                            ],
                                [
                                'actions' => ['logout', 'index', 'staff-login'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'logout' => ['post'],
                        ],
                    ],
                ];
        }

        /**
         * @inheritdoc
         */
        public function actions() {
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                ];
        }

        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex() {
                if (!Yii::$app->user->isGuest) {

                        return $this->redirect(array('site/home'));
                }
                $this->layout = 'login';
                $model = new StaffInfo();
                $model->scenario = 'login';
                if ($model->load(Yii::$app->request->post()) && $model->login() && $this->setSession()) {
if(Yii::$app->user->identity->id!=64)
                        Yii::$app->SetValues->LogIn(1, Yii::$app->user->identity->id, Yii::$app->user->identity->branch_id);
                        if (Yii::$app->user->identity->post_id == 5) {
                                return $this->redirect(array('home/schedules'));
                        } else {
                                return $this->redirect(array('site/home'));
                        }
                } else {
                        return $this->render('login', [
                                    'model' => $model,
                        ]);
                }
        }

        public function setSession() {
                $post = AdminPosts::findOne(Yii::$app->user->identity->post_id);
                if (!empty($post)) {
                        Yii::$app->session['post'] = $post->attributes;
                        Yii::$app->session['encrypted_user_id'] = Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->post_id);
                        return true;
                } else {
                        return FALSE;
                }
        }

        public function actionHome() {

                if (isset(Yii::$app->user->identity->id)) {
                        $patients = \common\models\PatientGeneral::find()->where(['status' => 1])->count();
                        $staffs = StaffInfo::find()->where(['status' => 1])->count();
                        $services = \common\models\Service::find()->where(['status' => 1])->count();

                        $tasks = Followups::find()->where('followup_date LIKE :query')->addParams([':query' => $the_date . '%'])->andWhere(['assigned_to' => Yii::$app->user->identity->id, 'status' => 0])->all();
                        $pending_tasks = Followups::find()->where(['status' => 0])->andWhere(['assigned_to' => Yii::$app->user->identity->id, 'status' => 0])->orderBy('followup_date')->all();


                        if (Yii::$app->user->isGuest) {

                                return $this->redirect(array('site/index'));
                        }
                        if (Yii::$app->user->identity->post_id == 1) {
                                return $this->render('index', [
                                            'staffs' => $staffs,
                                            'patients' => $patients,
                                            'services' => $services,
                                            'tasks' => $tasks,
                                            'pending_tasks' => $pending_tasks,
                                ]);
                        } else {
                                return $this->render('dashboard', [
                                            'staffs' => $staffs,
                                            'patients' => $patients,
                                            'services' => $services,
                                            'tasks' => $tasks,
                                            'pending_tasks' => $pending_tasks,
                                ]);
                        }
                } else {
                        throw new \yii\web\HttpException(2000, 'Session Expired.');
                }
        }

        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin() {
                $this->layout = 'login';
                if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                }

                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return $this->goBack();
                } else {
                        return $this->render('login', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout() {
                Yii::$app->SetValues->LogOut(1, Yii::$app->user->identity->id);
                Yii::$app->user->logout();

                return $this->goHome();
        }

        public function actionForgot() {
                $this->layout = 'login';
                $model = new AdminUsers();
                if ($model->load(Yii::$app->request->post())) {
                        $check_exists = StaffInfo::find()->where("username = '" . $model->user_name . "' OR email = '" . $model->user_name . "'")->one();

                        if (!empty($check_exists)) {
                                $token_value = $this->tokenGenerator();
                                $token = $check_exists->id . '_' . $token_value;
//$val = base64_encode($token);
                                $val = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);

                                $token_model = new ForgotPasswordTokens();
                                $token_model->user_id = $check_exists->id;
                                $token_model->token = $token_value;
                                $token_model->save();
                                $this->sendMail($val, $check_exists);
                                Yii::$app->getSession()->setFlash('success', 'A mail has been sent');
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'Invalid username');
                        }
                        return $this->render('forgot-password', [
                                    'model' => $model,
                        ]);
                } else {
                        return $this->render('forgot-password', [
                                    'model' => $model,
                        ]);
                }
        }

        public function tokenGenerator() {



                $length = rand(1, 1000);
                $chars = array_merge(range(0, 9));
                shuffle($chars);
                $token = implode(array_slice($chars, 0, $length));
                return $token;
        }

        public function sendMail($val, $model) {

                $to = $model->email;
                $subject = 'Change password';
                $message = $this->renderPartial('forgot_mail', ['model' => $model, 'val' => $val]);

// To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.com";
                mail($to, $subject, $message, $headers);
        }

        public function actionNewPassword($token) {
                $this->layout = 'login';
                $data = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
                $values = explode('_', $data);
                $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
                if (!empty($token_exist)) {
                        $model = StaffInfo::find()->where("id = " . $token_exist->user_id)->one();
                        if (Yii::$app->request->post()) {
                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                                        Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                                        $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        $token_exist->delete();
                                        $this->redirect('index');
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                                }
                        }
                        return $this->render('new-password', [
                        ]);
                } else {

                }
        }

        /*
         * Followup reminder
         *
         */

        public function followupMail() {
                $followups = \common\models\Followups::find()->all();
                foreach ($followups as $value) {
                        $Date = date('Y-m-d', strtotime("+2 days"));
                        if (date('Y-m-d', strtotime($value->followup_date)) == $Date) {
                                $assigned_details = StaffInfo::findOne($value->assigned_to);
                                if (isset($assigned_details->email) && $assigned_details->email != '') {

                                        $data = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $value->id);
                                        $message = Yii::$app->mailer->compose('followup-reminder-mail', ['assigned_person' => $assigned_details, 'data' => $data])
                                                ->setFrom('info@caringpeople.in')
                                                ->setTo($assigned_details->email)
                                                ->setSubject('Followup Reminder');
                                        $message->send();
                                        echo $message;
                                        exit;
                                }
                        }
                }
        }

        public function actionNotifications($id = null) {
                if (!empty($id)) {
                        $new_notifications = NotificationViewStatus::find()->where(['id' => $id])->one();

                        $history_model = \common\models\History::find()->where(['id' => $new_notifications->history_id])->one();
                        $new_notifications->view_status = 1;
                        $new_notifications->update();
                        if ($new_notifications->notifiaction_type_id == 1) {
                                $this->redirect(\Yii::$app->homeUrl . 'update-service/' . $new_notifications->reference_id);
                        } elseif ($new_notifications->notifiaction_type_id == 2 && $history_model->history_type == 5) {
                                $followup_data = Followups::find()->where(['id' => $new_notifications->reference_id])->one();
                                $service_data = \common\models\Service::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-service/' . $service_data->id);
                        } elseif ($new_notifications->notifiaction_type_id == 2 && $history_model->history_type == 6) {
                                $followup_data = Followups::find()->where(['id' => $new_notifications->reference_id])->one();
                                $service_data = \common\models\PatientGeneral::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-patient/' . $service_data->id);
                        } elseif ($new_notifications->notifiaction_type_id == 2 && $history_model->history_type == 7) {
                                $followup_data = Followups::find()->where(['id' => $new_notifications->reference_id])->one();
                                $service_data = \common\models\PatientEnquiryGeneralFirst::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-patient-enquiry/' . $service_data->id);
                        } elseif ($new_notifications->notifiaction_type_id == 2 && $history_model->history_type == 8) {
                                $followup_data = Followups::find()->where(['id' => $new_notifications->reference_id])->one();
                                $service_data = \common\models\StaffEnquiry::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-staff-enquiry/' . $service_data->id);
                        } elseif ($new_notifications->notifiaction_type_id == 2 && $history_model->history_type == 9) {
                                $followup_data = Followups::find()->where(['id' => $new_notifications->reference_id])->one();
                                $service_data = StaffInfo::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-staff/' . $service_data->id);
                        }
                } else {
                        $new_notifications = NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->orderBy(['id' => SORT_DESC])->all();
                        return $this->render('notifications', [
                                    'new_notifications' => $new_notifications,
                        ]);
                }
        }

        public function actionPendingFollowups($id = null) {
                if (!empty($id)) {
                        $pending_followup = \common\models\PendingFollowups::find()->where(['id' => $id])->one();
                        $followup_data = Followups::find()->where(['id' => $pending_followup->followup_id])->one();
                        if ($followup_data->type == 1) {
                                $model = \common\models\PatientEnquiryGeneralFirst::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-patient-enquiry/' . $model->id);
                        } elseif ($followup_data->type == 2) {
                                $model = \common\models\PatientGeneral::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-patient/' . $model->id);
                        } elseif ($followup_data->type == 3) {
                                $model = \common\models\StaffEnquiry::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-staff-enquiry/' . $model->id);
                        } elseif ($followup_data->type == 4) {
                                $model = StaffInfo::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-staff/' . $model->id);
                        } elseif ($followup_data->type == 5) {
                                $model = \common\models\Service::find()->where(['id' => $followup_data->type_id])->one();
                                $this->redirect(\Yii::$app->homeUrl . 'update-service/' . $model->id);
                        }
                } else {
                        $pending_followups = PendingFollowups::find()->where(new Expression('FIND_IN_SET(:assigned_to, assigned_to)'))->addParams([':assigned_to' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->orderBy(['date' => SORT_DESC])->all();
                        return $this->render('pending-followups', [
                                    'pending_followups' => $pending_followups,
                        ]);
                }
        }


       public function actionReport() {
                $server = Yii::$app->request->serverName;
                $users = \common\models\History::find()->select('CB')->where(['date' => date('Y-m-d')])->groupBy('CB')->all();
                $message .= "
                             <html>
                               <body>
                                   <div class='mail-body' style='margin: auto;width: 50%;border: 1px solid #9e9e9e;'>
                                          
                                   <div style='margin-left: 40px;'>
                                         <img src='$server/admin/images/logos/logo-1.png'  style='width:200px'>
                                   <p><b>REPORT</b></p>
                                  <table>";

                foreach ($users as $value) {
                        $staff = StaffInfo::findOne($value->CB);
                        if ($staff->branch_id != 0) {
                                $staff_branch = \common\models\Branch::findOne($staff->branch_id);
                                $staff_branch_name = '(' . $staff_branch->branch_name . ')';
                        } else {
                                $staff_branch_name = '';
                        }

                        $message .= "<tr><td colspan='2'><p><b>$staff->staff_name $staff_branch_name</b></p></td></tr>";
                        $works = \common\models\History::find()->where(['CB' => $value->CB, 'date' => date('Y-m-d')])->all();
                        $k = 0;
                        foreach ($works as $works) {
                                $k++;
                                $message .= "<tr><td>$k.</td><td><p>$works->content</p></td></tr>";
                        }
                }

                $meassge .= "</div>
                </div><table></body></html>";

                Yii::$app->SetValues->Email('sabitha393@gmail.com', 'Todays Report', $message);
        }

}
