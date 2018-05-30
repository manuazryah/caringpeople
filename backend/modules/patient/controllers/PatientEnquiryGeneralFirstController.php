<?php

namespace backend\modules\patient\controllers;

use Yii;
use common\models\PatientEnquiryGeneralFirst;
use common\models\PatientEnquiryGeneralFirstSearch;
use common\models\PatientEnquiryGeneralSecond;
use common\models\PatientEnquiryHospitalFirst;
use common\models\PatientEnquiryHospitalSecond;
use common\models\Followups;
use common\models\FollowupsSearch;
use common\models\PatientEnquiryHospitalDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EnquiryHospital;
use common\models\EnquiryOtherInfo;
use common\models\Branch;
use common\models\ContactDirectory;
use common\models\Remarks;
use common\models\RemarksSearch;
use common\models\PatientAssessment;
use yii\web\UploadedFile;
use common\models\PatientMedicalAssessment;

/**
 * PatientEnquiryGeneralFirstController implements the CRUD actions for PatientEnquiryGeneralFirst model.
 */
class PatientEnquiryGeneralFirstController extends Controller {

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
         * Lists all PatientEnquiryGeneralFirst models.
         * @return mixed
         */
        public function actionIndex() {

                $check_exists = explode('?', Yii::$app->request->url);
                if (empty($check_exists[1]))
                        Yii::$app->session->remove('new_size');

                if (isset($_POST['size'])) {
                        $pagesize = $_POST['size'];
                        \Yii::$app->session->set('new_size', $pagesize);
                } else {
                        $pagesize = Yii::$app->session->get('new_size');
                        if (!isset($pagesize))
                                $pagesize = 50;
                }

                $searchModel = new PatientEnquiryGeneralFirstSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination = ['pagesize' => 50];
                $dataProvider->pagination->pageSize = $pagesize;
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (!empty(Yii::$app->request->queryParams['PatientEnquiryGeneralFirstSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['PatientEnquiryGeneralFirstSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 3]);
                }

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        /**
         * Displays a single PatientEnquiryGeneralFirst model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_setails = PatientEnquiryHospitalDetails::findAll(['enquiry_id' => $id]);
                return $this->render('view', [
                            'model' => $this->findModel($id),
                            'patient_info_second' => $patient_info_second,
                            'patient_hospital' => $patient_hospital,
                            'patient_hospital_second' => $patient_hospital_second,
                            'patient_hospital_setails' => $patient_hospital_setails,
                ]);
        }

        /**
         * Creates a new PatientEnquiryGeneralFirst model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {

                $patient_info = new PatientEnquiryGeneralFirst();
                $patient_info_second = new PatientEnquiryGeneralSecond();
                $patient_hospital = new PatientEnquiryHospitalFirst();
                $patient_hospital_second = new PatientEnquiryHospitalSecond();
                $patient_assessment = new PatientAssessment();
                $patient_info->scenario = 'create';
                $hospital_details = '';
                $medical_assessment = new PatientMedicalAssessment();
                if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post()) && $patient_assessment->load(Yii::$app->request->post())) {
                        $medical_assessment->load(Yii::$app->request->post());
                        $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                        $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($patient_info);
                        }
                        $patient_hospital->patient_dob = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryHospitalFirst']['patient_dob']));
                        $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                        if (!empty(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']))
                                $patient_info_second->required_service = implode(",", Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']);

                        if ($patient_info->validate() && $patient_info_second->validate() && $patient_hospital->validate() && $patient_hospital_second->validate()) {

                                if ($patient_info->save() && $patient_info_second->save() && $patient_hospital->save() && $patient_hospital_second->save()) {
                                        $branch = Branch::findOne($patient_info->branch_id);
                                        $code = $branch->branch_code . 'UE';
                                        $patient_info->enquiry_number = $code . '-' . date('d') . date('m') . date('y') . '-' . $patient_info->id;
                                        $patient_info->update();
                                        $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                        $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                        $this->AddHospitalDetails($patient_info, Yii::$app->request->post());
                                        $this->AddPatientAssessment($patient_assessment, $patient_info, $medical_assessment);
                                        $this->Imageupload($patient_info);
                                        $this->AddContactDirectory($patient_info, $patient_info_second);
                                        $this->sendMail($patient_info, $patient_info_second);
                                        Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }
                }

                return $this->render('_enquiry_form', [
                            'patient_info' => $patient_info,
                            'patient_info_second' => $patient_info_second,
                            'patient_hospital' => $patient_hospital,
                            'patient_hospital_second' => $patient_hospital_second,
                            'hospital_details' => $hospital_details,
                            'patient_assessment' => $patient_assessment,
                            'medical_assessment' => $medical_assessment,
                ]);
        }

        /**
         * Updates an existing PatientEnquiryGeneralFirst model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $patient_info->id])->one();
                $patient_assessment = PatientAssessment::find()->where(['patient_enquiry_id' => $patient_info->id])->one();
                $medical_assessment = PatientMedicalAssessment::find()->where(['patient_enquiry_id' => $patient_info->id])->one();
                $hospital_details = PatientEnquiryHospitalDetails::findAll(['enquiry_id' => $patient_info->id]);
                if (empty($patient_assessment)) {
                        $patient_assessment = new PatientAssessment();
                        $patient_assessment->patient_enquiry_id = $id;
                        $patient_assessment->save();
                }

                if (empty($medical_assessment)) {
                        $medical_assessment = new PatientMedicalAssessment();
                        $medical_assessment->patient_enquiry_id = $id;
                        $medical_assessment->save();
                }


                if (!empty($patient_info) && !empty($patient_info_second) && !empty($patient_hospital) && !empty($patient_hospital_second)) {
                        if ($patient_info->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($patient_info) && $patient_hospital->load(Yii::$app->request->post()) && $patient_info_second->load(Yii::$app->request->post()) && $patient_hospital_second->load(Yii::$app->request->post()) && $patient_assessment->load(Yii::$app->request->post())) {
                                $medical_assessment->load(Yii::$app->request->post());
                                $patient_info->contacted_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['contacted_date']));
                                $patient_info->outgoing_call_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralFirst']['outgoing_call_date']));
                                $patient_hospital->patient_dob = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryHospitalFirst']['patient_dob']));

                                $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                                if (!empty(Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']))
                                        $patient_info_second->required_service = implode(",", Yii::$app->request->post()['PatientEnquiryGeneralSecond']['required_service']);

                                if ($patient_info->validate() && $patient_info_second->validate() && $patient_hospital->validate() && $patient_hospital_second->validate()) {

                                        if ($patient_info->save() && $patient_info_second->save() && $patient_hospital->save() && $patient_hospital_second->save()) {
                                                $this->AddGeneralInfo($patient_info, Yii::$app->request->post(), $patient_info_second);
                                                $this->AddHospitalInfo($patient_info, Yii::$app->request->post(), $patient_hospital, $patient_hospital_second);
                                                $this->AddHospitalDetails($patient_info, Yii::$app->request->post());
                                                $this->AddPatientAssessment($patient_assessment, $patient_info, $medical_assessment);
                                                $this->Imageupload($patient_info);



                                                if (isset($_POST['patinet_info'])) {
                                                        return $this->redirect(['patient-information/procced/', 'id' => $id]);
                                                } else {
                                                        Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                                        return $this->redirect(array('index'));
                                                }
                                        }
                                }
                        }
                        return $this->render('_enquiry_form', [
                                    'patient_info' => $patient_info,
                                    'patient_info_second' => $patient_info_second,
                                    'patient_hospital' => $patient_hospital,
                                    'patient_hospital_second' => $patient_hospital_second,
                                    'hospital_details' => $hospital_details,
                                    'patient_assessment' => $patient_assessment,
                                    'medical_assessment' => $medical_assessment,
                        ]);
                } else {
                        throw new \yii\base\UserException("Error Code : 2000");
                }
        }

        /*
         * to add general second informations
         *  */

        public function AddGeneralInfo($patient_info, $data, $patient_info_second) {
                $patient_info->id;
                $patient_info_second->enquiry_id = $patient_info->id;
                $patient_info_second->load($data);
                $patient_info_second->expected_date_of_service = date('Y-m-d', strtotime($data['PatientEnquiryGeneralSecond']['expected_date_of_service']));
                if (!empty($data['PatientEnquiryGeneralSecond']['required_service']))
                        $patient_info_second->required_service = implode(",", $data['PatientEnquiryGeneralSecond']['required_service']);
                if ($patient_info_second->save(false)) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add hospital informations
         *  */

        public function AddHospitalInfo($patient_info, $data, $patient_hospital, $patient_hospital_second) {

                $patient_hospital->enquiry_id = $patient_info->id;
                $patient_hospital_second->enquiry_id = $patient_info->id;
                $patient_hospital->load($data);
                $patient_hospital_second->load($data);

                if ($patient_hospital->save() && $patient_hospital_second->save()) {
                        return true;
                } else {
                        return FALSE;
                }
        }

        /*
         * to add hospital details
         *  */

        public function AddHospitalDetails($patient_info, $data) {
                /*
                 * to create hospital details
                 */

                if (isset($_POST['addhospital']) && $_POST['addhospital'] != '') {

                        $arr = [];
                        $i = 0;

                        foreach ($_POST['addhospital']['hospital_name'] as $val) {
                                $arr[$i]['hospital_name'] = $val;
                                $i++;
                        }
                        $i = 0;
                        if (isset($_POST['addhospital']['consultant_doctor']) && $_POST['addhospital']['consultant_doctor'] != '') {
                                foreach ($_POST['addhospital']['consultant_doctor'] as $val) {
                                        $arr[$i]['consultant_doctor'] = $val;
                                        $i++;
                                }
                        } else {
                                $arr[$i]['consultant_doctor'] = '';
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['addhospital']['department'] as $val) {
                                $arr[$i]['department'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['addhospital']['hospital_room_no'] as $val) {
                                $arr[$i]['hospital_room_no'] = $val;
                                $i++;
                        }


                        foreach ($arr as $val) {
                                $add_previous = new PatientEnquiryHospitalDetails;
                                $add_previous->enquiry_id = $patient_info->id;
                                $add_previous->hospital_name = $val['hospital_name'];
                                $add_previous->consultant_doctor = $val['consultant_doctor'];
                                $add_previous->department = $val['department'];
                                $add_previous->hospital_room_no = $val['hospital_room_no'];

                                if (!empty($add_previous->hospital_name))
                                        $add_previous->save();
                        }
                }
                /*
                 * to update hospital details
                 */

                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {

                        $arr = [];
                        $i = 0;
                        foreach ($_POST['updatee'] as $key => $val) {


                                $arr[$key]['hospital_name'] = $val['hospital_name'][0];
                                $arr[$key]['consultant_doctor'] = $val['consultant_doctor'][0];
                                $arr[$key]['department'] = $val['department'][0];
                                $arr[$key]['hospital_room_no'] = $val['hospital_room_no'][0];

                                $i++;
                        }

                        foreach ($arr as $key => $value) {
                                $add_previous = PatientEnquiryHospitalDetails::findOne($key);
                                $add_previous->hospital_name = $value['hospital_name'];
                                $add_previous->consultant_doctor = $value['consultant_doctor'];
                                $add_previous->department = $value['department'];
                                $add_previous->hospital_room_no = $value['hospital_room_no'];
                                $add_previous->update();
                        }
                }

                /*
                 * to delete hospital details
                 */

                if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {

                        $vals = rtrim($_POST['delete_port_vals'], ',');
                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {

                                PatientEnquiryHospitalDetails::findOne($val)->delete();
                        }
                }
        }

        public function AddPatientAssessment($patient_assessment, $model, $medical_assessment) {
                $patient_assessment->patient_enquiry_id = $model->id;
                $medical_assessment->patient_enquiry_id = $model->id;
                if (isset($_POST['patient_medical_procedures']) && $_POST['patient_medical_procedures'] != '') {
                        $patient_assessment->patient_medical_procedures = implode(',', $_POST['patient_medical_procedures']);
                }
                if (isset($_POST['suggested_professional']) && $_POST['suggested_professional'] != '') {
                        $patient_assessment->suggested_professional = implode(',', $_POST['suggested_professional']);
                }
                $patient_assessment->save();
                $medical_assessment->save();
        }

        /*
         * to upload image
         *  */

        public function Imageupload($model) {

                if (isset($_POST['creates']) && $_POST['creates'] != '') {

                        $arrs = [];
                        $i = 0;

                        foreach ($_FILES['creates'] ['name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $arrs[$i]['name'] = $value;
                                        $i++;
                                }
                        }
                        $i = 0;
                        foreach ($_FILES['creates'] ['tmp_name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $arrs[$i]['tmp_name'] = $value;
                                        $i++;
                                }
                        }
                        $i = 0;

                        foreach ($_FILES['creates'] ['name'] as $row => $innerArray) {
                                $i = 0;
                                foreach ($innerArray as $innerRow => $value) {
                                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                                        $arrs[$i]['extension'] = $ext;
                                        $i++;
                                }
                        }
                        $i = 0;
                        foreach ($_POST['creates']['file_name'] as $val) {
                                $file_name = \common\models\UploadCategory::findOne($val);
                                $arrs[$i]['file_name'] = $file_name->sub_category;
                                $i++;
                        }

                        foreach ($arrs as $val) {
                                $this->Upload($model->id, $val['name'], $val['tmp_name'], $val['file_name'], $val['extension']);
                        }
                }
        }

        /*
         * to save the image in folder
         * if
         */

        public function Upload($id, $name, $Tmpfilename, $filename, $extension) {
                $paths = ['patient-enquiry', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient-enquiry/' . $id . "/";
                if (empty($filename))
                        $filename = 'attachment' . rand();
                move_uploaded_file($Tmpfilename, $target_dir . $filename . "." . $extension);
        }

        /*
         * to send email
         */

        public function sendMail($patient_info, $model) {

                if (isset($model->email) && $model->email != '') {
                        $path = 'http://' . Yii::$app->request->serverName . '/images/caring_peopl.jpg';
                        $message = Yii::$app->mailer->compose('response-mail', ['touser' => $patient_info->caller_name]) // a view rendering result becomes the message body here
                                ->setFrom('info@caringpeople.in')
                                ->setTo($model->email)
                                ->setSubject('Welcome to Caringpeople');
                        $message->attach($path);
                        $message->send();
                        return TRUE;
                }
        }

        /*
         * To add Pateint Information $id is Enquiry data id
         *  */

        public function AddPatientInformation($id) {

                $model = PatientEnquiryGeneralFirst::find()->where(['id' => $id])->one();
                $model->status = 3;
                $model->update();
                if (!empty($model)) {
                        return $this->redirect(['patient-information/create', 'id' => $model->id]);
                } else {
                        return $this->redirect(['site/error']);
                }
        }

        /*
         * to add patient genquiry details to contact directory for future use
         * $info_first ->patient_enquiry_general_first table
         * $info_first ->atient_enquiry_general_second table
         */

        public function AddContactDirectory($info_first, $info_second) {
                $model = new ContactDirectory();
                $model->category_type = 1; /* patient enquiry */
                $model->name = $info_first->caller_name;
                $model->email_1 = $info_second->email;
                $model->email_2 = $info_second->email1;
                $model->phone_1 = $info_first->mobile_number;
                $model->phone_2 = $info_first->mobile_number_2;
                if ($info_first->referral_source != 5)
                        $model->references = $info_first->referral_source;
                else
                        $model->references = $info_first->referral_source_others;
                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        /**
         * Deletes an existing PatientEnquiryGeneralFirst model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {

                $patient_info = $this->findModel($id);
                $patient_info_second = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital = PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $id])->one();
                $patient_hospital_second = PatientEnquiryHospitalSecond::find()->where(['enquiry_id' => $id])->one();


                $transaction = PatientEnquiryGeneralFirst::getDb()->beginTransaction();
                try {
                        if (!empty($patient_hospital_second)) {
                                $patient_hospital_second->delete();
                        }
                        if (!empty($patient_hospital)) {
                                $patient_hospital->delete();
                        }
                        if (!empty($patient_info_second)) {
                                $patient_info_second->delete();
                        }
                        if (!empty($patient_info)) {
                                $patient_info->delete();
                        }

                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
                return $this->redirect(['index']);
        }

        /**
         * Finds the PatientEnquiryGeneralFirst model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PatientEnquiryGeneralFirst the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PatientEnquiryGeneralFirst::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
