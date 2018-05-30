<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffEnquiry;
use common\models\StaffEnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use common\models\Branch;
use common\models\ContactDirectory;
use common\models\StaffInfo;
use common\models\StaffInfoSearch;
use common\models\StaffOtherInfo;
use common\models\StaffPerviousEmployer;
use common\models\StaffInfoUploads;
use common\models\StaffInfoEducation;
use common\models\StaffEnquiryInterviewFirst;
use common\models\StaffEnquiryInterviewSecond;
use common\models\StaffEnquiryInterviewThird;

/**
 * StaffEnquiryController implements the CRUD actions for StaffEnquiry model.
 */
class StaffEnquiryController extends Controller {

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

        public function actionAdd() {

                $staff_enquiry = StaffEnquiryInterviewFirst::find()->all();
                foreach ($staff_enquiry as $value) {

                        $staff_salary = new \common\models\StaffSalary();
                        $staff_salary->staff_id = $value->staff_id;
                        $staff_salary->save(false);
                }
        }

        /**
         * Lists all StaffEnquiry models.
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

                $searchModel = new StaffEnquirySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                // $dataProvider->query->andWhere(['<>', 'proceed', 1]);
                $dataProvider->pagination = ['pagesize' => 50];
                $dataProvider->pagination->pageSize = $pagesize;

                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (!empty(Yii::$app->request->queryParams['StaffEnquirySearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['StaffEnquirySearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 2]);
                }


                
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        /**
         * Displays a single StaffEnquiry model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {

                $staff_edu = StaffInfoEducation::findOne(['enquiry_id' => $id]);
                $other_info = StaffOtherInfo::findOne(['enquiry_id' => $id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['enquiry_id' => $id]);
                $staff_family_details = \common\models\StaffEnquiryFamilyDetails::findAll(['enquiry_id' => $id]);
                return $this->render('view', [
                            'model' => $this->findModel($id),
                            'staff_edu' => $staff_edu,
                            'staff_other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                            'staff_family_details' => $staff_family_details
                ]);
        }

        /**
         * Creates a new StaffEnquiry model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {


                $staff_enquiry = new StaffEnquiry();
                $staff_edu = new StaffInfoEducation();
                $other_info = new StaffOtherInfo();
                $staff_interview_first = new StaffEnquiryInterviewFirst();
                $staff_interview_second = new StaffEnquiryInterviewSecond();
                $staff_interview_third = new StaffEnquiryInterviewThird();
                $before_update = '';
                $staff_previous_employer = '';
                $staff_family = '';

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry) && $other_info->load(Yii::$app->request->post()) && $staff_interview_first->load(Yii::$app->request->post()) && $staff_interview_second->load(Yii::$app->request->post()) && $staff_interview_third->load(Yii::$app->request->post())) {
$staff_edu->load(Yii::$app->request->post());
                        $other_info->current_from = date('Y-m-d', strtotime($other_info->current_from));
                        $other_info->current_to = date('Y-m-d', strtotime($other_info->current_to));
                        $staff_interview_second->contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->contact_verified_date));
                        $staff_interview_second->alt_contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->alt_contact_verified_date));
                        $staff_interview_second->verified_date_1 = date('Y-m-d', strtotime($staff_interview_second->verified_date_1));
                        $staff_interview_second->verified_date_2 = date('Y-m-d', strtotime($staff_interview_second->verified_date_2));
                        $staff_interview_second->verified_date_3 = date('Y-m-d', strtotime($staff_interview_second->verified_date_3));
                        $staff_interview_third->expected_date_of_joining = date('Y-m-d', strtotime($staff_interview_third->expected_date_of_joining));
                        $staff_interview_third->interviewed_date = date('Y-m-d', strtotime($staff_interview_third->interviewed_date));

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($staff_enquiry);
                        }

                        if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                $staff_edu->timing = implode(',', $staff_edu->timing);
                        }

                       if (isset($staff_enquiry->area_interested) && $staff_enquiry->area_interested != '') {
                                $staff_enquiry->area_interested = implode(',', $staff_enquiry->area_interested);
                        }

                        if ($staff_enquiry->validate() && $other_info->validate() && $staff_interview_first->validate() && $staff_interview_second->validate() && $staff_interview_third->validate() && $staff_enquiry->save() && $staff_edu->save() && $other_info->save() && $staff_interview_first->save() && $staff_interview_second->save() && $staff_interview_third->save()) {
                                $this->AddData($staff_enquiry, $other_info, $staff_edu, $staff_interview_first, $staff_interview_second, $staff_interview_third);
                                $this->AddLanguage($staff_interview_first, $staff_interview_third);
                                $this->AddFamily($staff_enquiry);
                                $this->AddContactDirectory($staff_enquiry);
                                $this->AddOtherInfo($staff_enquiry, Yii::$app->request->post(), $other_info);
                                $this->Imageupload($staff_enquiry);
                                Yii::$app->getSession()->setFlash('success', 'Data Added Successfully');
                                return $this->redirect(array('index'));
                        }
                }
                return $this->render('_staff_form', [
                            'staff_edu' => $staff_edu,
                            'staff_previous_employer' => $staff_previous_employer,
                            'other_info' => $other_info,
                            'staff_interview_first' => $staff_interview_first,
                            'staff_interview_second' => $staff_interview_second,
                            'staff_interview_third' => $staff_interview_third,
                            'staff_enquiry' => $staff_enquiry,
                            'staff_family' => $staff_family
                ]);
        }

        /**
         * Updates an existing StaffEnquiry model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {

                // die('ff');
                $staff_enquiry = $this->findModel($id);
                $other_info = StaffOtherInfo::findOne(['enquiry_id' => $staff_enquiry->id]);
                $staff_edu = StaffInfoEducation::findOne(['enquiry_id' => $staff_enquiry->id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['enquiry_id' => $staff_enquiry->id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['enquiry_id' => $staff_enquiry->id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['enquiry_id' => $staff_enquiry->id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['enquiry_id' => $staff_enquiry->id]);
                $staff_family = \common\models\StaffEnquiryFamilyDetails::findAll(['enquiry_id' => $staff_enquiry->id]);

                if ($staff_enquiry->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($staff_enquiry) && $other_info->load(Yii::$app->request->post()) && $staff_interview_first->load(Yii::$app->request->post()) && $staff_interview_second->load(Yii::$app->request->post()) && $staff_interview_third->load(Yii::$app->request->post())) {
$staff_edu->load(Yii::$app->request->post());
                        if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                $staff_edu->timing = implode(',', $staff_edu->timing);
                        }
                         if (isset($staff_enquiry->area_interested) && $staff_enquiry->area_interested != '') {
                                $staff_enquiry->area_interested = implode(',', $staff_enquiry->area_interested);
                        }

                        $other_info->current_from = date('Y-m-d', strtotime($other_info->current_from));
                        $other_info->current_to = date('Y-m-d', strtotime($other_info->current_to));
                        $staff_interview_second->contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->contact_verified_date));
                        $staff_interview_second->alt_contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->alt_contact_verified_date));
                        $staff_interview_second->verified_date_1 = date('Y-m-d', strtotime($staff_interview_second->verified_date_1));
                        $staff_interview_second->verified_date_2 = date('Y-m-d', strtotime($staff_interview_second->verified_date_2));
                        $staff_interview_second->verified_date_3 = date('Y-m-d', strtotime($staff_interview_second->verified_date_3));
                        $staff_interview_third->expected_date_of_joining = date('Y-m-d', strtotime($staff_interview_third->expected_date_of_joining));
                        $staff_interview_third->interviewed_date = date('Y-m-d', strtotime($staff_interview_third->interviewed_date));
                        if ($staff_enquiry->validate() && $other_info->validate() && $staff_interview_first->validate() && $staff_interview_second->validate() && $staff_interview_third->validate() && $staff_enquiry->save() && $staff_edu->save() && $other_info->save() && $staff_interview_first->save() && $staff_interview_second->save() && $staff_interview_third->save()) {

                                $this->AddLanguage($staff_interview_first, $staff_interview_third);
                                $this->AddOtherInfo($staff_enquiry, Yii::$app->request->post(), $other_info);
                                $this->AddFamily($staff_enquiry);
                                $this->Imageupload($staff_enquiry);


                                if (isset($_POST['proceed'])) {
                                        return $this->redirect(['staff-info/procced/', 'id' => $staff_enquiry->id]);
                                } else {
                                        Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }
                }

                return $this->render('_staff_form', [
                            'staff_edu' => $staff_edu,
                            'staff_previous_employer' => $staff_previous_employer,
                            'other_info' => $other_info,
                            'staff_interview_first' => $staff_interview_first,
                            'staff_interview_second' => $staff_interview_second,
                            'staff_interview_third' => $staff_interview_third,
                            'staff_enquiry' => $staff_enquiry,
                            'staff_family' => $staff_family
                ]);
        }

        /*
         * to add other informations
         *  */

        public function AddOtherInfo($staff_enquiry, $data, $other_info) {



                /*
                 * to create additional previous employer
                 */

                if (isset($_POST['create']) && $_POST['create'] != '') {

                        $arr = [];
                        $i = 0;

                        foreach ($_POST['create']['hospitaladdress'] as $val) {
                                $arr[$i]['hospitaladdress'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['designation'] as $val) {
                                $arr[$i]['designation'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['length'] as $val) {
                                $arr[$i]['length'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['from'] as $val) {
                                $arr[$i]['from'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['to'] as $val) {
                                $arr[$i]['to'] = $val;
                                $i++;
                        }
                        $i = 0;
                        foreach ($_POST['create']['salary'] as $val) {
                                $arr[$i]['salary'] = $val;
                                $i++;
                        }

                        foreach ($arr as $val) {
                                $add_previous = new StaffPerviousEmployer;
                                $add_previous->enquiry_id = $staff_enquiry->id;
                                $add_previous->hospital_address = $val['hospitaladdress'];
                                $add_previous->designation = $val['designation'];
                                $add_previous->length_of_service = $val['length'];
                                $add_previous->service_from = date('Y-m-d', strtotime($val['from']));
                                $add_previous->service_to = date('Y-m-d', strtotime($val['to']));
                                $add_previous->salary = $val['salary'];
                                if (!empty($add_previous->hospital_address))
                                        $add_previous->save();
                        }
                }

                /*
                 * to update additional previous employer
                 */

                if (isset($_POST['updatee']) && $_POST['updatee'] != '') {

                        $arr = [];
                        $i = 0;
                        foreach ($_POST['updatee'] as $key => $val) {

                                $arr[$key]['hospitaladdress'] = $val['hospitaladdress'][0];
                                $arr[$key]['designation'] = $val['designation'][0];
                                $arr[$key]['length'] = $val['length'][0];
                                $arr[$key]['from'] = $val['from'][0];
                                $arr[$key]['to'] = $val['to'][0];
                                $arr[$key]['salary'] = $val['salary'][0];
                                $i++;
                        }

                        foreach ($arr as $key => $value) {
                                $add_previous = StaffPerviousEmployer::findOne($key);
 if (!empty($add_previous)) {
                                $add_previous->hospital_address = $value['hospitaladdress'];
                                $add_previous->designation = $value['designation'];
                                $add_previous->length_of_service = $value['length'];
                                $add_previous->service_from = date('Y-m-d', strtotime($value['from']));
                                $add_previous->service_to = date('Y-m-d', strtotime($value['to']));
                                $add_previous->salary = $value['salary'];
                                $add_previous->update();
}
                        }
                }

                /*
                 * to delete additional previous employer
                 */

                if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {

                        $vals = rtrim($_POST['delete_port_vals'], ',');
                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {

                                StaffPerviousEmployer::findOne($val)->delete();
                        }
                }
        }

        /*
         * Add staffid as foreign key to all related tables
         */

        public function AddData($staff_enquiry, $other_info, $staff_edu, $staff_interview_first, $staff_interview_second, $staff_interview_third) {

                $other_info->enquiry_id = $staff_enquiry->id;
                $staff_edu->enquiry_id = $staff_enquiry->id;
                $staff_interview_first->enquiry_id = $staff_enquiry->id;

                $staff_interview_second->enquiry_id = $staff_enquiry->id;
                $staff_interview_third->enquiry_id = $staff_enquiry->id;
                $staff_edu->save(false);
                $other_info->update();
                $staff_interview_first->update();
                $staff_interview_second->update();
                $staff_interview_third->update();


                $branch = Branch::findOne($staff_enquiry->branch_id);
                $code = $branch->branch_code . 'SE';
                $staff_enquiry->enquiry_id = $code . '-' . date('d') . date('m') . date('y') . '-' . $staff_enquiry->id;
                $staff_enquiry->proceed = 0;
                $staff_enquiry->update();
        }

        /*
         * Add staff languages known
         */

        public function AddLanguage($staff_interview_first, $staff_interview_third) {

                if (isset($_POST['StaffEnquiryInterviewThird']['staff_experience']) && $_POST['StaffEnquiryInterviewThird']['staff_experience'] != '')
                        $staff_interview_third->staff_experience = implode(",", $_POST['StaffEnquiryInterviewThird']['staff_experience']);
                $staff_interview_third->update();

                for ($i = 1; $i <= 4; $i++) {
                        $language = '';
                        $field = 'language_' . $i;
                        if (isset($staff_interview_first->$field) && $staff_interview_first->$field != '') {
                                $language .= $staff_interview_first->$field . ",";
                                for ($j = 1; $j <= 3; $j++) {
                                        $fields = 'language_' . $i . '_' . $j;
                                        if ($_POST[$fields] == 'on')
                                                $language .= '1,';
                                        else
                                                $language .= '0,';
                                }
                                $staff_interview_first->$field = $language;
                                $staff_interview_first->update();
                        }
                }
        }

        /*
         * Add family details
         */

        public function Addfamily($staff_enquiry) {

                /*
                 * to add multiple family details
                 */

                if (isset($_POST['createfamily']) && $_POST['createfamily'] != '') {


                        $arrf = [];
                        $k = 0;

                        foreach ($_POST['createfamily']['name'] as $val) {
                                $arrf[$k]['name'] = $val;
                                $k++;
                        }
                        $k = 0;
                        foreach ($_POST['createfamily']['relationship'] as $val) {
                                $arrf[$k]['relationship'] = $val;
                                $k++;
                        }
                        $k = 0;
                        foreach ($_POST['createfamily']['job'] as $val) {
                                $arrf[$k]['job'] = $val;
                                $k++;
                        }
                        $k = 0;
                        foreach ($_POST['createfamily']['mobile_no'] as $val) {
                                $arrf[$k]['mobile_no'] = $val;
                                $k++;
                        }


                        foreach ($arrf as $val) {
                                $add_Family = new \common\models\StaffEnquiryFamilyDetails;
                                $add_Family->enquiry_id = $staff_enquiry->id;
                                $add_Family->name = $val['name'];
                                $add_Family->relationship = $val['relationship'];
                                $add_Family->job = $val['job'];
                                $add_Family->mobile_no = $val['mobile_no'];

                                if (!empty($add_Family->name))
                                        $add_Family->save();
                        }
                }

                /*
                 * to update family details
                 */

                if (isset($_POST['updatefamily']) && $_POST['updatefamily'] != '') {

                        $arrfu = [];
                        $l = 0;
                        foreach ($_POST['updatefamily'] as $key => $val) {

                                $arrfu[$key]['name'] = $val['name'][0];
                                $arrfu[$key]['relationship'] = $val['relationship'][0];
                                $arrfu[$key]['job'] = $val['job'][0];
                                $arrfu[$key]['mobile_no'] = $val['mobile_no'][0];
                                $l++;
                        }

                        foreach ($arrfu as $key => $value) {
                                $add_family = \common\models\StaffEnquiryFamilyDetails::findOne($key);
  if (!empty($add_family)) {
                                $add_family->name = $value['name'];
                                $add_family->relationship = $value['relationship'];
                                $add_family->job = $value['job'];
                                $add_family->mobile_no = $value['mobile_no'];
                                $add_family->update();
}
                        }
                }

                /*
                 * to delete additional previous employer
                 */

                if (isset($_POST['delete_port_vals_family']) && $_POST['delete_port_vals_family'] != '') {

                        $vals = rtrim($_POST['delete_port_vals_family'], ',');
                        $vals = explode(',', $vals);
                        foreach ($vals as $val) {
                                \common\models\StaffEnquiryFamilyDetails::findOne($val)->delete();
                        }
                }
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
                $paths = ['staff-enquiry', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $id . "/";
                if (empty($filename))
                        $filename = 'attachment' . rand();
                move_uploaded_file($Tmpfilename, $target_dir . $filename . "." . $extension);
        }

        /*
         * to add patient genquiry details to contact directory for future use
         * $info_first ->patient_enquiry_general_first table
         * $info_first ->atient_enquiry_general_second table
         */

        public function AddContactDirectory($staff_info) {
                $model = new ContactDirectory();
                $model->category_type = 2; /* staff enquiry */
                $model->name = $staff_info->name;
                $model->email_1 = $staff_info->email;
                $model->phone_1 = $staff_info->phone_number;
                $model->designation = $staff_info->designation;

                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        /**
         * Deletes an existing StaffEnquiry model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $staff_enquiry = $this->findModel($id);
                $other_info = StaffOtherInfo::findOne(['enquiry_id' => $id]);
                $staff_edu = StaffInfoEducation::findOne(['enquiry_id' => $id]);

                $staff_previous_employer = StaffPerviousEmployer::findAll(['enquiry_id' => $id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['enquiry_id' => $id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['enquiry_id' => $id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['enquiry_id' => $id]);

                // ...other DB operations...

                $transaction = StaffEnquiry::getDb()->beginTransaction();
                try {
                        if (!empty($staff_interview_third)) {
                                $staff_interview_third->delete();
                        }
                        if (!empty($staff_interview_second)) {
                                $staff_interview_second->delete();
                        }
                        if (!empty($staff_interview_first)) {
                                $staff_interview_first->delete();
                        }
                        if (!empty($staff_edu)) {
                                $staff_edu->delete();
                        }
                        if (!empty($staff_previous_employer)) {
                                $staff_previous_employer->delete();
                        }

                        if (!empty($other_info)) {
                                $other_info->delete();
                        }


                        if (!empty($staff_enquiry)) {
                                $staff_enquiry->delete();
                        }
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $id;
                        if (file_exists($paths)) {
                                $files = Yii::$app->UploadFile->RemoveFiles($paths);
                        }
                        // ...other DB operations...
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
         * Finds the StaffEnquiry model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffEnquiry the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffEnquiry::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionRemove($id, $name) {

                $root_path = Yii::$app->basePath . '/../uploads/staff-enquiry';
                $path = $root_path . '/' . $id . '/' . $name;
                if (file_exists($path)) {
                        unlink($path);
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

}
