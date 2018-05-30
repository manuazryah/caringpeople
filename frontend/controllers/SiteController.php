<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\ContactUs;
use common\models\PatientGeneral;
use common\models\User;
use yii\base\UserException;

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
                        'only' => ['logout', 'signup'],
                        'rules' => [
                                [
                                'actions' => ['signup', 'login', 'sign-up', 'verification', 'register', 'forgot', 'new-password',],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                                [
                                'actions' => ['logout'],
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
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
                    'captcha' => [
                        'class' => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    ],
                ];
        }

        /**
         * Displays homepage.
         *
         * @return mixed
         */
        public function actionIndex() {

                return $this->render('index');
        }

        /**
         * Logs in a user.
         *
         * @return mixed
         */
        public function actionLogin() {



                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post())) {
                        if ($model->login()) {
                                $user = User::find()->where(['username' => $model->username])->one();
                                $patient = PatientGeneral::find()->where(['patient_id' => $user->patient_id])->one();
                                Yii::$app->session['patient_id'] = $patient->id;
                                Yii::$app->SetValues->LogIn(2, $patient->id, Yii::$app->user->identity->branch_id);
                                return $this->redirect('../dashboard/index');
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'Invalid Username or Password');
                        }
                }
                return $this->render('login', [
                            'model' => $model,
                ]);
        }

        /**
         * Logs out the current user.
         *
         * @return mixed
         */
        public function actionLogout() {
                Yii::$app->SetValues->LogOut(2, Yii::$app->session['patient_id']);
                Yii::$app->user->logout();

                return $this->goHome();
        }

        /**
         * Displays contact page.
         * Accept contact message from user and send mail to administrator
         *
         * @return mixed
         */
        public function actionContact() {
                if (isset($_POST['contact-send'])) {
                        $model = new ContactUs();
                        $model->first_name = $fname = $_POST['first-name'];
                        $model->last_name = $lname = $_POST['last-name'];
                        $model->email = $email = $_POST['email'];
                        $model->phone = $phone = $_POST['phone'];
                        $model->message = $message = $_POST['message'];
                        $model->date = date('Y-m-d');
                        if ($model->save()) {
                                $this->sendContactMail($model);
                                $this->sendResponseMail($model);
                        }
                }
                return $this->render('contact');
        }

        /**
         * Accept messages from contact page in footer.
         * send mail to the administrator
         *
         * @return mixed
         */
        public function actionContactform() {
                if (isset($_POST['contact-sends'])) {

                        $model = new ContactUs();
                        $model->first_name = $fname = $_POST['first-name'];
                        $model->email = $email = $_POST['email'];
                        $model->message = $message = $_POST['message'];
                        $model->date = date('Y-m-d');
                        if ($model->save()) {
                                $this->sendContactMail($model);
                                $this->sendResponseMail($model);
                        }
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

        public function actionContacts() {
                if (isset($_POST['contact-send'])) {

                        $model = new ContactUs();
                        $model->first_name = $fname = $_POST['first-name'];

                        $model->email = $email = $_POST['email'];
                        $model->phone = $email = $_POST['phone'];
                        $model->message = $message = $_POST['message'];
                        $model->location = $location = $_POST['Location'];
                        $model->Service = $_POST['services'];


                        if ($_POST['allow_contact'] == 'on') {
                                $model->allow_contact = 1;
                        } else {
                                $model->allow_contact = 0;
                        }
                        $model->date = date('Y-m-d');
                        if ($model->save()) {

                                $this->sendContactMail($model);
                                $this->sendResponseMail($model);
                        }
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

        /**
         * Response Mail function
         *
         * @return mixed
         */
        public function sendResponseMail($model) {
                $path = 'http://' . Yii::$app->request->serverName . '/images/caring_peopl.jpg';
// echo $path;exit;
                $message = Yii::$app->mailer->compose('response-mail') // a view rendering result becomes the message body here
                        ->setFrom('info@caringpeople.in')
                        ->setTo($model->email)
                        ->setSubject('Welcome to Caringpeople');

                $message->attach($path);
                $message->send();
                return TRUE;
        }

        /**
         * Mail function
         * Send  contact messages from user to the administrator
         *
         * @return mixed
         */
        public function sendContactMail($model) {
                if ($model->allow_contact == 1) {
                        $allow_contact = 'Yes';
                } else {
                        $allow_contact = 'No';
                }

                $to = 'info@caringpeople.in,shintomaradikunnel@gmail.com';
//   $to = 'surumiabin@gmail.com,manuko27@gmail.com';
// subject
                $subject = 'Enquiry From Website';

// message
                $message = "
<html>
<head>

</head>
<body>
<p><b>Enquiry Received From Website</b></p>
<table>
<tr>
<th>Firstname</th>
<th>:-</th>

<td>" . $model->first_name . "</td>
    </tr>

    <tr>
<tr>
<th>Lastname</th>
<th>:-</th>

<td>" . $model->last_name . "</td>
    </tr>

<tr>
<th>Services</th>
<th>:-</th>

<td>" . $model->Service . "</td>
    </tr>

    <tr>

<th>Email</th>
<th>:-</th>
<td>" . $model->email . "</td>
         </tr>
    <tr>

<th>Phone Number</th>
<th>:-</th>
<td>" . $model->phone . "</td>
         </tr>
         <tr>

<th>Location</th>
<th>:-</th>
<td>" . $model->location . "</td>
         </tr>
                 <tr>

<th>Message</th>
<th>:-</th>
<td>" . $model->message . "</td>

</tr>
<tr>
<th>Allow Contact</th>
<th>:-</th>
<td>" . $allow_contact . "</td>

</tr>


</table>
</body>
</html>
";

// To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: 'no-reply@caringpeople.com";
                mail($to, $subject, $message, $headers);


                return true;
        }

        /**
         * Displays about page.
         *
         * @return mixed
         */
        public function actionAbout() {
                return $this->render('about');
        }

        /**
         * Displays testimonial page.
         *
         * @return mixed
         */
        public function actionTestimonial() {
                return $this->render('testimonial');
        }

        /**
         * Displays feedback page.
         *
         * @return mixed
         */
        public function actionFeedback() {
                return $this->render('feedback');
        }

        /**
         * Displays gallery page.
         *
         * @return mixed
         */
        public function actionGallery() {
                return $this->render('gallery');
        }

        /**
         * Signs user up.
         *
         * @return mixed
         */
        public function actionSignUp() {

                if (isset($_POST['sign_up'])) {

                        $patient_id = $_POST['patient_id'];
                        $patient_registered = User::find()->where(['patient_id' => $patient_id, 'status' => 1])->exists();

                        if ($patient_registered != 1) {

                                $check = PatientGeneral::find()->where(['patient_id' => $patient_id, 'status' => 1])->exists();
                            
   if ($check == 1) {
                                        $patient_details = PatientGeneral::find()->where(['contact_number' => $_POST['contact_no']])->orWhere(['email' => $_POST['contact_no']])->andWhere(['patient_id' => $patient_id])->exists();
                                        if ($patient_details == 1) {
                                                $verify_sent = User::find()->where(['patient_id' => $patient_id, 'status' => 0])->one();
                                                if (!empty($verify_sent)) {
                                                        $model = $verify_sent;
                                                } else {
                                                        $model = new \common\models\User();
                                                }
                                                $model->patient_id = $patient_id;
                                                $model->status = 0;
                                                $patient_details = PatientGeneral::find()->where(['patient_id' => $patient_id])->one();
                                                $model->email = $patient_details->email;
                                                $model->branch_id = $patient_details->branch_id;
                                                $model->email_verification = 0;
                                                $model->verification_link = date('Y-m-d H:i:s');
                                                $model->save();
                                                $val = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                                $message = $this->renderPartial('email-verify-mail', ['id' => $val]);
                                                
                                                Yii::$app->SetValues->Email($patient_details->email, 'Email Verification', $message);
                                                Yii::$app->getSession()->setFlash('success', 'Thank you for registering with us.. A mail has been sent to your email id !!');
                                                return $this->render('signup', [
                                                ]);
                                        }
                                }
                        }
                        if ($patient_registered == 1) {
                                Yii::$app->getSession()->setFlash('error', 'This Patient is already registered');
                        } else {

                                Yii::$app->getSession()->setFlash('error', 'Invalid Patient ID or Contact Number/Email');
                        }
                        return $this->render('signup', [
                        ]);
                }
        }

        public function actionVerification($token) {
                if (isset($token)) {
                        $val = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
                        $val_detail = User::findOne($val);
                        $link_sent_time = $val_detail->verification_link;
                        $current_time = date('Y-m-d H:i:s');
                        $time_differnce = round((strtotime($current_time) - strtotime($link_sent_time)) / (60 * 60));
                        if ($time_differnce < 4) {
                                if ($val_detail->email_verification == 0) {
                                        return $this->render('register', ['patient_id' => $val
                                        ]);
                                }
                        }
                        Yii::$app->getSession()->setFlash('error', 'Your verification time is expired. Please signup again!');
                        return $this->render('signup', [
                        ]);
                } else {
                        throw new UserException('Error Code:  2001');
                }
        }

         public function actionRegister() {
                if (isset($_POST['register'])) {
                        $user = User::findOne($_POST['patient_id']);
                        $user_name_Exists = User::find()->where(['username' => $_POST['uname']])->exists();
                        if ($user_name_Exists != 1) {
                                $user->username = $_POST['uname'];
                                $user->password_hash = Yii::$app->security->generatePasswordHash($_POST['password']);
                                $user->email_verification = 1;
                                $user->status = 1;
                                $user->save();
                                if (Yii::$app->getUser()->login($user)) {
                                        return $this->redirect('../dashboard/index');
                                }
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'This username already exists!');
                                return $this->render('register', ['patient_id' => $_POST['patient_id']
                                ]);
                        }
                }
        }

        public function actionForgot() {

                $model = new User();
                if ($model->load(Yii::$app->request->post())) {
                        $username = $_POST['User']['username'];
                        $check_exists = User::find()->where("username = '" . $username . "' OR email = '" . $username . "'")->one();

                        if (!empty($check_exists)) {
                                $token_value = $this->tokenGenerator();
                                $token = $check_exists->id . '_' . $token_value;
                                $val = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);
                                $token_model = new \common\models\ForgotPasswordTokens();
                                $token_model->user_id = $check_exists->id;
                                $token_model->token = $token_value;
                                $token_model->save();
                                $message= $this->renderPartial('forgot-mail', ['model' => $check_exists, 'val' => $val]);
                               
                                Yii::$app->SetValues->Email($check_exists->email, 'Password Reset', $message);
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

        public function actionNewPassword($token) {
                $data = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
                $values = explode('_', $data);
                $token_exist = \common\models\ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
                if (!empty($token_exist)) {
                        $model = User::find()->where("id = " . $token_exist->user_id)->one();
                        if (Yii::$app->request->post()) {
                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                                        Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                                        $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        $token_exist->delete();
                                        return $this->redirect('login');
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                                }
                        }
                        return $this->render('new-password', [
                        ]);
                } else {
                        return $this->redirect('login');
                }
        }

        /**
         * Requests password reset.
         *
         * @return mixed
         */
        public function actionRequestPasswordReset() {
                $model = new PasswordResetRequestForm();
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                        if ($model->sendEmail()) {
                                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                                return $this->goHome();
                        } else {
                                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
                        }
                }

                return $this->render('requestPasswordResetToken', [
                            'model' => $model,
                ]);
        }

        /**
         * Resets password.
         *
         * @param string $token
         * @return mixed
         * @throws BadRequestHttpException
         */
        public function actionResetPassword($token) {
                try {
                        $model = new ResetPasswordForm($token);
                } catch (InvalidParamException $e) {
                        throw new BadRequestHttpException($e->getMessage());
                }

                if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                        Yii::$app->session->setFlash('success', 'New password saved.');

                        return $this->goHome();
                }

                return $this->render('resetPassword', [
                            'model' => $model,
                ]);
        }

        public function actionError() {

                return $this->render('error');
        }

}
