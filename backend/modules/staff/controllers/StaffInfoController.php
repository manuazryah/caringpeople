<?php

namespace backend\modules\staff\controllers;

use Yii;
use common\models\StaffInfo;
use common\models\StaffInfoSearch;
use common\models\StaffOtherInfo;
use common\models\StaffPerviousEmployer;
use common\models\Followups;
use common\models\FollowupsSearch;
use common\models\StaffInfoEducation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ContactDirectory;
use common\models\AdminUsers;
use common\models\StaffEnquiryInterviewFirst;
use common\models\StaffEnquiryInterviewSecond;
use common\models\StaffEnquiryInterviewThird;
use common\models\RemarksSearch;
use common\models\StaffSalary;
use yii\db\Expression;

/**
 * StaffInfoController implements the CRUD actions for StaffInfo model.
 */
class StaffInfoController extends Controller {


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
         * $2y$13$n6k/SkumJoaMkMcrq/eGFeJ23xjUXyTQKrkXjm9ZBOx6PbwpJVwpK
         * Lists all StaffInfo models.
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
 
                $searchModel = new StaffInfoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination = ['pagesize' => 50];
                $dataProvider->pagination->pageSize = $pagesize;

                
                if (Yii::$app->user->identity->branch_id != '0') {
                        $dataProvider->query->andWhere(['branch_id' => Yii::$app->user->identity->branch_id]);
                }
                if (!empty(Yii::$app->request->queryParams['StaffInfoSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['StaffInfoSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['status' => 1]);
                }
             
                
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        public function actionChoose($branch = null, $gender = null, $service = null, $type = null, $schedule = null, $replace = null) {
                $searchModel = new StaffInfoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['branch_id' => $branch]);
                $dataProvider->query->andWhere(['post_id' => 5]);

                if ($gender == 0 && $gender != '') {
                        $dataProvider->query->andWhere(['gender' => 0]);
                } else
                if ($gender == 1 && $gender != '') {
                        $dataProvider->query->andWhere(['gender' => 1]);
                } else {

                }

                if (!empty(Yii::$app->request->queryParams['StaffInfoSearch']['working_status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['StaffInfoSearch']['working_status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'working_status', 1]);
                }


                return $this->render('choose', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'service' => $service,
                            'type' => $type,
                            'schedule' => $schedule,
                            'replace_or_new' => $replace,
                ]);
        }

        /**
         * Displays a single StaffInfo model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {


                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $id]);
                $other_info = StaffOtherInfo::findOne(['staff_id' => $id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $id]);
                $staff_family_details = \common\models\StaffEnquiryFamilyDetails::findAll(['staff_id' => $id]);
                return $this->render('view', [
                            'model' => $this->findModel($id),
                            'staff_edu' => $staff_edu,
                            'staff_other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                            'staff_family_details' => $staff_family_details
                ]);
        }

        /*
         * proceed to staff from staff enquiry
         */

        public function actionProcced($id) {

                $staff_info = new StaffInfo();
                $other_info = StaffOtherInfo::findOne(['enquiry_id' => $id]);
                $staff_education = StaffInfoEducation::findOne(['enquiry_id' => $id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['enquiry_id' => $id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['enquiry_id' => $id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['enquiry_id' => $id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['enquiry_id' => $id]);
                $staff_family = \common\models\StaffEnquiryFamilyDetails::findAll(['enquiry_id' => $id]);
                $staff_salary = new StaffSalary();
                $model = \common\models\StaffEnquiry::findOne($id);

                if ($model->branch_id == 1) {
                        $branch = 'CPCS';
                        $settings = \common\models\Settings::findOne(3);
                        $code = $settings->auto_number;
                } else {
                        $branch = 'CPBS';
                        $settings = \common\models\Settings::findOne(4);
                        $code = $settings->auto_number;
                }
                $codes = $branch . '-' . date('d') . date('m') . date('y') . '-' . $code;
                $settings->auto_number = $settings->auto_number + 1;
                $settings->save(FALSE);

                $staff_info->staff_enquiry_id = $id;
                $staff_info->staff_id = $codes;
                $staff_info->staff_name = $model->name;
                $staff_info->gender = $model->gender;
                $staff_info->contact_no = $model->phone_number;
                $staff_info->email = $model->email;
                $staff_info->permanent_address = $model->address;
                $staff_info->place = $model->place;
                $staff_info->designation = $model->designation;
                $staff_info->staff_experience = $staff_interview_third->staff_experience;
                $staff_info->area_interested = $model->area_interested;
                $staff_info->branch_id = $model->branch_id;
                $staff_info->status = 1;
                $staff_info->working_status = 0;

                $transaction = StaffInfo::getDb()->beginTransaction();
                try {
                        if ($staff_info->save()) {
                                $model->status = 2; /* 2=>status closed */
                                $model->proceed = 1;
                                $model->update();
                        }

                        if (!empty($staff_education)) {
                                $staff_education->staff_id = $staff_info->id;
                                $staff_education->save();
                        }
                        if (!empty($other_info)) {
                                $other_info->staff_id = $staff_info->id;
                                $other_info->save();
                        }

                        if (!empty($staff_interview_first)) {
                                $staff_interview_first->staff_id = $staff_info->id;
                                $staff_interview_first->save();
                        }
                        if (!empty($staff_interview_second)) {
                                $staff_interview_second->staff_id = $staff_info->id;
                                $staff_interview_second->save();
                        }
                        if (!empty($staff_interview_third)) {
                                $staff_interview_third->staff_id = $staff_info->id;
                                $staff_interview_third->save();
                        }
                        if (!empty($staff_salary)) {
                                $staff_salary->staff_id = $staff_info->id;
                                $staff_salary->save();
                        }

                        if (!empty($staff_previous_employer)) {
                                foreach ($staff_previous_employer as $value) {
                                        $value->staff_id = $staff_info->id;
                                        $value->save();
                                }
                        }
                        if (!empty($staff_family)) {
                                foreach ($staff_family as $val) {
                                        $val->staff_id = $staff_info->id;
                                        $val->save();
                                }
                        }
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $model->id;
                        if (file_exists($paths)) {
                                $file = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $model->id;
                                $newfile = ['staff', $staff_info->id];
                                Yii::$app->UploadFile->CheckPath($newfile);
                                $newfile = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $staff_info->id;
                                $img = Yii::$app->UploadFile->RecurseCopy($file, $newfile);
                        }


                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                return $this->redirect(['update', 'id' => $staff_info->id]);
        }

        /**
         * Creates a new StaffInfo model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {


                $model = new StaffInfo();
                $model->setScenario('create');
                $staff_edu = new StaffInfoEducation();
                $other_info = new StaffOtherInfo();
                $staff_interview_first = new StaffEnquiryInterviewFirst();
                $staff_interview_second = new StaffEnquiryInterviewSecond();
                $staff_interview_third = new StaffEnquiryInterviewThird();
                $staff_family = '';
                $staff_previous_employer = '';
                $staff_salary = new StaffSalary();



                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $other_info->load(Yii::$app->request->post()) && $staff_edu->load(Yii::$app->request->post()) && $staff_interview_first->load(Yii::$app->request->post()) && $staff_interview_second->load(Yii::$app->request->post()) && $staff_interview_third->load(Yii::$app->request->post()) && $staff_salary->load(Yii::$app->request->post())) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        $other_info->current_from = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_from']));
                        $other_info->current_to = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_to']));
                        $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                        $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['StaffInfo']['password']);
                        $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
                        $staff_interview_second->contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->contact_verified_date));
                        $staff_interview_second->alt_contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->alt_contact_verified_date));
                        $staff_interview_second->verified_date_1 = date('Y-m-d', strtotime($staff_interview_second->verified_date_1));
                        $staff_interview_second->verified_date_2 = date('Y-m-d', strtotime($staff_interview_second->verified_date_2));
                        $staff_interview_second->verified_date_3 = date('Y-m-d', strtotime($staff_interview_second->verified_date_3));
                        $staff_interview_third->expected_date_of_joining = date('Y-m-d', strtotime($staff_interview_third->expected_date_of_joining));
                        $staff_interview_third->interviewed_date = date('Y-m-d', strtotime($staff_interview_third->interviewed_date));
                        $staff_salary->date_of_salary = date('Y-m-d', strtotime($staff_salary->date_of_salary));
                        $model->working_status = 0;

                        if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                $staff_edu->timing = implode(',', $staff_edu->timing);
                        }

                        if (isset($model->area_interested) && $model->area_interested != '') {
                                        $model->area_interested = implode(',', $model->area_interested);
                        }

                        if (!empty(Yii::$app->request->post()['StaffInfo']['designation']))
                                $model->designation = implode(",", Yii::$app->request->post()['StaffInfo']['designation']);

                        if (Yii::$app->user->identity->branch_id != '0') {
                                Yii::$app->SetValues->currentBranch($model);
                        }
                        if ($model->validate() && $other_info->validate() && $staff_interview_first->validate() && $staff_interview_second->validate() && $staff_interview_third->validate() && $staff_edu->validate() && $staff_salary->validate() && $staff_edu->save() && $model->save() && $other_info->save() && $staff_interview_first->save() && $staff_interview_second->save() && $staff_interview_third->save() && $staff_salary->save()) {
                                $other_info->staff_id = $model->id;
                                $staff_edu->staff_id = $model->id;
                                $staff_edu->save(false);
                                $other_info->update();
                                $this->AddContactDirectory($model);
                                $this->AddData($model, $other_info, $staff_edu, $staff_interview_first, $staff_interview_second, $staff_interview_third, $staff_salary);
                                $this->AddLanguage($model, $staff_interview_first, $staff_interview_third);
                                $this->AddFamily($model);
                                $this->Imageupload($model);
                                Yii::$app->SetValues->History($model->id, 'New Staff ' . $model->staff_name . ' is added');
                                $this->AutoNumber($model);
                                $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                $this->sendMail($model);
                                Yii::$app->getSession()->setFlash('success', 'General Information Added Successfully');
                                return $this->redirect(array('index'));
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'staff_edu' => $staff_edu,
                            'staff_previous_employer' => $staff_previous_employer,
                            'other_info' => $other_info,
                            'staff_interview_first' => $staff_interview_first,
                            'staff_interview_second' => $staff_interview_second,
                            'staff_interview_third' => $staff_interview_third,
                            'staff_family' => $staff_family,
                            'staff_salary' => $staff_salary
                ]);
        }


      public function AutoNumber($model) {
                if ($model->branch_id == 1) {
                        $val = \common\models\Settings::findOne(3);
                } else {
                        $val = \common\models\Settings::findOne(4);
                }
                $val->auto_number = $val->auto_number + 1;
                $val->save(FALSE);
        }

        /*
         * to add staff  details to contact directory for future use
         * $model ->staff info table
         */

        public function AddContactDirectory($staff_info) {
                $model = new ContactDirectory();
                $model->category_type = 4; /* staff enquiry */
                $model->name = $staff_info->staff_name;
                $model->email_1 = $staff_info->email;
                $model->phone_1 = $staff_info->present_contact_no;
                $model->designation = $staff_info->designation;

                Yii::$app->SetValues->Attributes($model);
                if ($model->validate() && $model->save())
                        return TRUE;
                else
                        return FALSE;
        }

        public function AddToUsers($username, $password, $model) {
                $admin_users = new AdminUsers();
                $admin_users->setScenario('create');
                $admin_users->post_id = 5;
                $admin_users->user_name = $username;
                $admin_users->password = $password;
                $admin_users->name = $model->staff_name;
                $admin_users->email = $model->present_email;
                $admin_users->phone_number = $model->present_contact_no;
                $admin_users->staff_info_id = $model->id;
                if (Yii::$app->user->identity->branch_id != '0') {
                        $admin_users->branch_id = Yii::$app->user->identity->branch_id;
                }

                $admin_users->status = 1;

                if ($admin_users->validate() && Yii::$app->SetValues->Attributes($admin_users)) {
                        $admin_users->save(FALSE);
                        return true;
                } else {
                        Yii::$app->getSession()->setFlash('error', 'Username  already exist please use another');
                        return FALSE;
                }
        }

        /*
         * Add staffid as foreign key to all related tables
         */

        public function AddData($model, $other_info, $staff_edu, $staff_interview_first, $staff_interview_second, $staff_interview_third, $staff_salary) {

                $other_info->staff_id = $model->id;
                $staff_edu->staff_id = $model->id;
                $staff_interview_first->staff_id = $model->id;
                $staff_salary->staff_id = $model->id;
                $staff_interview_second->staff_id = $model->id;
                $staff_interview_third->staff_id = $model->id;
                $staff_edu->save(false);
                $other_info->update();
                $staff_interview_first->update();
                $staff_interview_second->update();
                $staff_interview_third->update();
                $staff_salary->update();
        }

        /*
         * Add staff languages known
         */

        public function AddLanguage($model, $staff_interview_first, $staff_interview_third) {

                if (isset($_POST['StaffInfo']['staff_experience']) && $_POST['StaffInfo']['staff_experience'] != '')
                        $model->staff_experience = implode(",", $_POST['StaffInfo']['staff_experience']);
                $model->update(false);

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
                                $add_Family->staff_id = $staff_enquiry->id;
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

        /**
         * Updates an existing StaffInfo model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id = null, $data = null) {
                if (!empty($data)) {
                        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $data);
                }

                $model = $this->findModel($id);

                $model->setScenario('update');
                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $model->id]);
                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $model->id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['staff_id' => $model->id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['staff_id' => $model->id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['staff_id' => $model->id]);
                $staff_family = \common\models\StaffEnquiryFamilyDetails::findAll(['staff_id' => $model->id]);
                $staff_salary = StaffSalary::findOne(['staff_id' => $model->id]);
                if (!empty($model) && !empty($other_info) && !empty($staff_edu) && !empty($staff_interview_first) && !empty($staff_interview_second) && !empty($staff_interview_third) && !empty($staff_salary)) {
                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $other_info->load(Yii::$app->request->post()) && $staff_edu->load(Yii::$app->request->post()) && $staff_interview_first->load(Yii::$app->request->post()) && $staff_interview_second->load(Yii::$app->request->post()) && $staff_interview_third->load(Yii::$app->request->post()) && $staff_salary->load(Yii::$app->request->post())) {
                                $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                                $other_info->load(Yii::$app->request->post());
                                $other_info->current_from = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_from']));
                                $other_info->current_to = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffOtherInfo']['current_to']));
                                $staff_interview_second->contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->contact_verified_date));
                                $staff_interview_second->alt_contact_verified_date = date('Y-m-d', strtotime($staff_interview_second->alt_contact_verified_date));
                                $staff_interview_second->verified_date_1 = date('Y-m-d', strtotime($staff_interview_second->verified_date_1));
                                $staff_interview_second->verified_date_2 = date('Y-m-d', strtotime($staff_interview_second->verified_date_2));
                                $staff_interview_second->verified_date_3 = date('Y-m-d', strtotime($staff_interview_second->verified_date_3));
                                $staff_interview_third->expected_date_of_joining = date('Y-m-d', strtotime($staff_interview_third->expected_date_of_joining));
                                $staff_interview_third->interviewed_date = date('Y-m-d', strtotime($staff_interview_third->interviewed_date));
                                $staff_salary->date_of_salary = date('Y-m-d', strtotime($staff_salary->date_of_salary));

                                if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                        $staff_edu->timing = implode(',', $staff_edu->timing);
                                }


                                if (isset($model->area_interested) && $model->area_interested != '') {
                                        $model->area_interested = implode(',', $model->area_interested);
                                }

                                if (!empty(Yii::$app->request->post()['StaffInfo']['designation']))
                                        $model->designation = implode(",", Yii::$app->request->post()['StaffInfo']['designation']);

                                if ($model->validate() && $other_info->validate() && $staff_interview_first->validate() && $staff_interview_second->validate() && $staff_interview_third->validate() && $staff_edu->validate() && $staff_salary->validate() && $staff_edu->save() && $model->save() && $other_info->save() && $staff_interview_first->save() && $staff_interview_second->save() && $staff_interview_third->save() && $staff_salary->save()) {
                                        $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                                        $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
                                        $model->save();
                                        $this->AddLanguage($model, $staff_interview_first, $staff_interview_third);
                                        $this->Imageupload($model);
                                        $this->AddFamily($model);
                                        $this->AddOtherInfo($model, Yii::$app->request->post(), $other_info);
                                        Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                        return $this->redirect(array('index'));
                                }
                        }

                        return $this->render('_staff_form', [
                                    'model' => $model,
                                    'staff_edu' => $staff_edu,
                                    'other_info' => $other_info,
                                    'staff_previous_employer' => $staff_previous_employer,
                                    'staff_interview_first' => $staff_interview_first,
                                    'staff_interview_second' => $staff_interview_second,
                                    'staff_interview_third' => $staff_interview_third,
                                    'staff_family' => $staff_family,
                                    'staff_salary' => $staff_salary
                        ]);
                } else {
                        throw new \yii\web\HttpException(400, 'Error code:1002', 405);
                }
        }

        /*
         * edit user profile limit fields
         */

        public function actionEditprofile($id = null, $data = null) {
                if (!empty($data)) {
                        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $data);
                }
                $model = $this->findModel($id);

                $other_info = StaffOtherInfo::findOne(['staff_id' => $model->id]);
                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $model->id]);

                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $model->id]);
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $staff_edu->load(Yii::$app->request->post())) {
                        $model->dob = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post()['StaffInfo']['dob']));
                        if ($model->validate() && $other_info->validate() && $staff_edu->validate() && $model->save() && $other_info->save() && $staff_edu->save()) {

                                $model->username = Yii::$app->request->post()['StaffInfo']['username'];
                                $model->post_id = Yii::$app->request->post()['StaffInfo']['post_id'];
                                $model->save();
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                                $datas = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                return $this->redirect(array('editprofile', 'data' => $datas));
                        }
                }
                return $this->render('_staff_form', [
                            'model' => $model,
                            'staff_edu' => $staff_edu,
                            'other_info' => $other_info,
                            'staff_previous_employer' => $staff_previous_employer,
                ]);
        }

        /**
         * Deletes an existing StaffInfo model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $staff_info = $this->findModel($id);
                $other_info = StaffOtherInfo::find()->where(['staff_id' => $id])->one();

                $staff_edu = StaffInfoEducation::findOne(['staff_id' => $id]);
                $staff_interview_first = StaffEnquiryInterviewFirst::findOne(['staff_id' => $id]);
                $staff_interview_second = StaffEnquiryInterviewSecond::findOne(['staff_id' => $id]);
                $staff_interview_third = StaffEnquiryInterviewThird::findOne(['staff_id' => $id]);
                $staff_salary = StaffSalary::findOne(['staff_id' => $id]);

                $staff_previous_employer = StaffPerviousEmployer::findAll(['staff_id' => $id]);
                // ...other DB operations...

                $transaction = StaffInfo::getDb()->beginTransaction();
                try {

                        if (!empty($staff_edu)) {
                                $staff_edu->delete();
                        }
                        if (!empty($staff_interview_third)) {
                                $staff_interview_third->delete();
                        }
                        if (!empty($staff_interview_second)) {
                                $staff_interview_second->delete();
                        }
                        if (!empty($staff_interview_first)) {
                                $staff_interview_first->delete();
                        }
                        if (!empty($staff_salary)) {
                                $staff_salary->delete();
                        }
                        if (!empty($staff_previous_employer)) {
                                foreach ($staff_previous_employer as $value) {

                                        $value->delete();
                                }
                        }

                        if (!empty($other_info)) {
                                $other_info->delete();
                        }

                        if (!empty($staff_info)) {
                                $staff_info->delete();
                        }
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $id;
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

        /*
         * to add other informations
         *  */

        public function AddOtherInfo($model, $data, $other_info) {



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
                                $add_previous->staff_id = $model->id;
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
                $paths = ['staff', $id];
                $paths = Yii::$app->UploadFile->CheckPath($paths);
                $target_dir = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $id . "/";
                if (empty($filename))
                        $filename = 'attachment' . rand();
                move_uploaded_file($Tmpfilename, $target_dir . $filename . "." . $extension);
        }

        /*
         * to send email
         */

        public function sendMail($model) {
                if (isset($model->email) && $model->email != '') {

                        $message = Yii::$app->mailer->compose('staff-mail', ['model' => $model]) // a view rendering result becomes the message body here
                                ->setFrom('info@caringpeople.in')
                                ->setTo($model->email)
                                ->setSubject('Welcome to Caringpeople');
                        $message->send();
                        return TRUE;
                }
        }

        /**
         * Finds the StaffInfo model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffInfo the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffInfo::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionResetPassword() {
                if (Yii::$app->request->isAjax) {
                        $id = $_POST['id'];
                        $data = $this->findModel($id);
                        if (!empty($data)) {
                                $data->password = Yii::$app->security->generatePasswordHash($_POST['password']);
                                $data->update();
                                Yii::$app->getSession()->setFlash('success', 'Password changed successfully');
                                return true;
                        } else {
                                return false;
                        }
                }
        }

        public function actionAdds() {
                $staffs = StaffInfo::find()->all();
                foreach ($staffs as $value) {
                        $exists = StaffEnquiryInterviewFirst::find()->where(['staff_id' => $value->id])->exists();
                        if ($exists != 1) {
                                $staff_first = new StaffEnquiryInterviewFirst();
                                $staff_first->staff_id = $value->id;
                                $staff_first->save();
                        }
                        $exists_2 = StaffEnquiryInterviewSecond::find()->where(['staff_id' => $value->id])->exists();
                        if ($exists_2 != 1) {
                                $staff_second = new StaffEnquiryInterviewSecond();
                                $staff_second->staff_id = $value->id;
                                $staff_second->save();
                        }
                        $exists_3 = StaffEnquiryInterviewThird::find()->where(['staff_id' => $value->id])->exists();
                        if ($exists_3 != 1) {
                                $staff_third = new StaffEnquiryInterviewThird();
                                $staff_third->staff_id = $value->id;
                                $staff_third->save();
                        }
                }
        }

   public function actionLeave($id) {
                $staff_previous_leaves = \common\models\StaffLeave::find()->where(['status' => 2, 'employee_id' => $id])->andWhere(['<=', 'commencing_date', date('Y-m-d')])->all();
                $upcoming_leaves = \common\models\StaffLeave::find()->where(['employee_id' => $id])->andWhere(['>=', 'commencing_date', date('Y-m-d')])->all();
                $today = \common\models\StaffLeave::find()->where(['status' => 2, 'employee_id' => $id])->andWhere(['=', 'commencing_date', date('Y-m-d')])->exists();
                return $this->render('staff_leave', [
                            'staff_previous_leaves' => $staff_previous_leaves,
                            'upcoming_leaves' => $upcoming_leaves,
                            'today' => $today,
                            'staff' => $id,
                ]);
        }



}
