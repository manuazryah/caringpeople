<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Enquiry;
use common\models\Followups;
use common\models\Hospital;
use common\models\StaffInfoUploads;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\PatientGuardianDetails;
use common\models\PatientGeneral;
use common\models\UploadCategory;
use yii\db\Expression;

class AjaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select Countries based on the continent_id
         * return result to the view
         */

        public function actionState() {

                if (Yii::$app->request->isAjax) {
                        $country_id = $_POST['country_id'];
                        if ($country_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $state_datas = \common\models\State::find()->where(['country_id' => $country_id])->all();
                                if (empty($state_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select State-</option>';
                                        foreach ($state_datas as $state_data) {
                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->state_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select City based on the district_id
         * return result to the view
         */

        public function actionCity() {
                if (Yii::$app->request->isAjax) {
                        $state_id = $_POST['state_id'];
                        if ($state_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $city_datas = \common\models\City::find()->where(['state_id' => $state_id])->all();
                                if (empty($city_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select City-</option>';
                                        foreach ($city_datas as $city_data) {
                                                $options .= "<option value='" . $city_data->id . "'>" . $city_data->city_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionReligion() {

                if (Yii::$app->request->isAjax) {
                        $religion = $_POST['religion'];
                        if ($religion == '') {
                                echo '0';
                                exit;
                        } else {
                                $caste_datas = \common\models\Caste::find()->where(['r_id' => $religion])->orderBy(['caste' => SORT_ASC])->all();
                                if (empty($caste_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($caste_datas as $caste_data) {
                                                $options .= "<option value='" . $caste_data->id . "'>" . $caste_data->caste . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function is for check email duplication
         *
         */

        public function actionEmail() {
                if (Yii::$app->request->isAjax) {
                        $email = $_POST['email'];
                        $exists = Enquiry::find()->where(['email' => $email])->exists();
                        if ($exists == 1) {
                                $user = Enquiry::find()->where(['email' => $email])->all();
                                if (count($user) > 1) {
                                        return 1;
                                } else {
                                        foreach ($user as $value) {
                                                return $value->id;
                                        }
                                }
                        } else {
                                return $data = 0;
                        }
                }
        }

        /*
         * This function is for update followup notes
         *
         */

        public function actionFollowup() {

                if (Yii::$app->request->isAjax) {
                        $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $followup = Followups::find()->where(['id' => $followup_id])->one();
                        $followup->followup_notes = $_POST['notes'];
                        $followup->DOU = date('Y-m-d H:i');
                        $followup->save();
                }
        }

        /*
         * This function is for update followup status
         *
         */

        public function actionFollowupstatus() {

                if (Yii::$app->request->isAjax) {
                        $followup_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $_POST['followup_id']);
                        $followup = Followups::find()->where(['id' => $followup_id])->one();
                        $followup->status = 1;
                        $followup->update();
                }
        }

        /*
         * This function is for update followup status
         */

        public function actionPatienthospitaldetails() {
                if (Yii::$app->request->isAjax) {
                        $rand = rand();
                        $branch = $_POST['branch'];
                        $count = $_POST['count'];
                        if (isset($branch) && $branch != '') {
                                if ($branch == 1) {
                                        $category = 5;
                                } else if ($branch == 2) {
                                        $category = 17;
                                }
                                $hospital_name = \common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();

                                $options = Html::dropDownList('addhospital[hospital_name][]', null, ArrayHelper::map($hospital_name, 'id', 'sub_category'), ['class' => 'form-control hospital', 'prompt' => '--Select--', 'id' => 'hospital_' . $count]);

                                $data = "<span>
<hr style='border-top: 1px solid #979898 !important;'>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_name'>
                                        <label class='control-label'>Hospital Name</label>
                                        $options
                                                   <a class='add-option-dropdown add-new' id='hospital_$count-1' style='margin-top:0px;'> + Add New</a>
                                </div>

                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-consultant_doctor'>
                                        <label class='control-label' for=''>Consultant Doctor</label>
                                         <select name='addhospital[consultant_doctor][]' class='form-control' id='doctor_$count'></select>
                                                 <a class='add-option-dropdown add-new' id='doctor_$count-1' style='margin-top:0px;'> + Add New</a>
                                </div>
                        </div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-department'>
                                        <label class='control-label'>Department</label>
                                        <input type='text' class='form-control' name='addhospital[department][]' id='department_$count'>
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-patientenquiryhospitaldetails-hospital_room_no'>
                                        <label class='control-label' >Hospital Room No</label>
                                        <input type='text' class='form-control' name='addhospital[hospital_room_no][]'>
                                </div>
                        </div>

                        <a id='remScnt' class='btn btn-icon btn-red remScnt' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                        <div style='clear:both'></div>
                </span>";
                                echo $data;
                        } else {
                                echo '1';
                        }
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionContactcategory() {

                if (Yii::$app->request->isAjax) {
                        $category = $_POST['category'];
                        if ($category == '') {
                                echo '0';
                                exit;
                        } else {
                                $sub_cat_datas = \common\models\ContactSubcategory::find()->where(['category_id' => $category])->all();
                                if (empty($sub_cat_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($sub_cat_datas as $sub_cat_data) {
                                                $options .= "<option value='" . $sub_cat_data->id . "'>" . $sub_cat_data->sub_category . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * to remove images of staff (uploaded images in staff)
         */

        public function actionRemove() {

                $id = $_POST['id'];
                $name = $_POST['name'];
                $type = $_POST['type'];

                $root_path = Yii::$app->basePath . '/../uploads/staff';
                $path = $root_path . '/' . $id . '/' . $name;

                $staff_uploads = StaffInfoUploads::find()->where(['staff_id' => $id])->one();
                if (file_exists($path)) {

                        if (unlink($path)) {
                                $staff_uploads->$type = '';
                                $staff_uploads->update();
                        }
                }
        }

        /*
         * to remove images of staff-enquiry (uploaded images in staff-enquiry)
         */

        public function actionStaffenqremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::$app->basePath . '/../uploads/staff';
                $path = $root_path . '/' . $id . '/' . $name;


                if (file_exists($path)) {

                        if (unlink($path)) {

                        }
                }
        }

        public function actionStaffenquiryremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::$app->basePath . '/../uploads/staff-enquiry';
                $path = $root_path . '/' . $id . '/' . $name;


                if (file_exists($path)) {

                        if (unlink($path)) {

                        }
                }
        }

        public function actionPatientenquiryremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::$app->basePath . '/../uploads/patient-enquiry';
                $path = $root_path . '/' . $id . '/' . $name;


                if (file_exists($path)) {

                        if (unlink($path)) {

                        }
                }
        }

        /*
         * to remove images of patient (uploaded images in patient)
         */

        public function actionPatientremove() {

                $id = $_POST['id'];
                $name = $_POST['name'];

                $root_path = Yii::$app->basePath . '/../uploads/patient';
                $path = $root_path . '/' . $id . '/' . $name;


                if (file_exists($path)) {

                        if (unlink($path)) {

                        }
                }
        }

        /*
         * This function select Caste based on the religion
         * return result to the view
         */

        public function actionStaffs() {

                if (Yii::$app->request->isAjax) {
                        $staff_type = $_POST['staff_type'];
                        $branch = $_POST['branch'];

                        if ($branch == '') {
                                echo '1';
                                exit;
                        } elseif ($staff_type == '') {
                                echo '2';
                        } else {
                                $staff_type_datas = \common\models\StaffInfo::find()->where(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $staff_type])->andWhere(['branch_id' => $branch])->andWhere(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();


                                if (empty($staff_type_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($staff_type_datas as $staff_type_data) {
                                                $options .= "<option value='" . $staff_type_data->id . "'>" . $staff_type_data->staff_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * popup content in terms and conditions
         */

        public function actionContent() {
                $data = $this->renderPartial('terms', ['id' => $_POST['id']]);
                echo $data;
        }

        /*
         * show patients based on branch in service form
         */

        public function actionPatients() {
                $branch = $_POST['branch'];
                $patients = PatientGeneral::find()->where(['branch_id' => $branch, 'status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
                $options = '<option value="">-Select-</option>';
                foreach ($patients as $patient) {
                        $options .= "<option value='" . $patient->id . "'>" . $patient->first_name . "</option>";
                }
                echo $options;
        }

        /*
         * show nurse manager based on branch in service form
         */

        public function actionStaffmanager() {
                $branch = $_POST['branch'];
                $patient = $_POST['patient'];
                $patient_manager = PatientGeneral::findOne($patient);

                $mangers = \common\models\StaffInfo::find()->where(['branch_id' => $branch, 'status' => 1, 'post_id' => 6])->orWhere(['post_id' => 1])->orWhere(['post_id' => 13])->orderBy(['staff_name' => SORT_ASC])->all();

                $options = '<option value="">-Select-</option>';
                foreach ($mangers as $mangers) {
                        $options .= "<option value='" . $mangers->id . "'>" . $mangers->staff_name . "</option>";
                }
                echo $options;
        }

        public function actionAttachment() {
                $rand = rand();
                $type = $_POST['type'];
                $uploads_type = UploadCategory::find()->where(['status' => 1, 'type' => $type])->all();
                $option = Html::dropDownList('creates[file_name][]', null, ArrayHelper::map($uploads_type, 'id', 'sub_category'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'atachment_' . $rand]);
                $vers = "<span>
                        <div class='row' style='margin:0'>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-staffperviousemployer-hospital_address'>
                                <label class='control-label'>Attachment</label>
                                <input type='file'  name='creates[file][]'>
                                </div>
                                </div>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class='form-group field-staffperviousemployer-salary'>
                                <label class='control-label' >Attachment Name</label>
                              $option
                                 <div class='div-add-new'> <a class='add-option-dropdown add-new' id='atachment_$rand-5' style='margin-top:0px;' type=$type> + Add New</a></div>
                                </div>
                                </div>
                                <a id='remAttach' class='btn btn-icon btn-red remAttach' style='margin-top: 15px;'><i class='fa-remove'></i></a>
                                <div style='claer:both'></div><br/>
                        </div>
                                </span><br/>";
                echo $vers;
        }

        public function actionDoctors() {
                if (Yii::$app->request->isAjax) {
                        $hospital = $_POST['hospital'];
                        if ($hospital == '') {
                                echo '0';
                                exit;
                        } else {
                                $doctors = \common\models\ContactDirectory::find()->where(['subcategory_type' => $hospital, 'designation' => 13])->all();

                                if (empty($doctors)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Select-</option>';
                                        foreach ($doctors as $doctors) {
                                                $options .= "<option value='" . $doctors->id . "'>" . $doctors->name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        public function actionDepartment() {
                if (Yii::$app->request->isAjax) {
                        $doctor = $_POST['doctor'];
                        if ($doctor == '') {
                                echo '0';
                                exit;
                        } else {
                                $doctors = \common\models\Doctors::findOne($doctor);
                                if (empty($doctors)) {

                                } else {
                                        echo $doctors->department;
                                }
                        }

                        //echo $options;
                }
        }

        public function actionHospitals() {
                if (Yii::$app->request->isAjax) {
                        $options = '';
                        $branch = $_POST['branch'];
                        if ($branch == 1) {
                                $category = 5;
                        } else if ($branch == 2) {
                                $category = 17;
                        }
                        $hosp = \common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();
                        if (!empty($hosp)) {
                                $options = '<option value="">-Select-</option>';
                                foreach ($hosp as $value) {
                                        $options .= "<option value='" . $value->id . "'>" . $value->sub_category . "</option>";
                                }
                        }
                        echo $options;
                }
        }

        public function actionFamily() {
                if (Yii::$app->request->isAjax) {
                        $k = $_POST['count'];
                        $relations = \common\models\MasterRelationships::find()->where(['status' => 1])->all();
                        $options = Html::dropDownList('createfamily[relationship][]', null, ArrayHelper::map($relations, 'id', 'title'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'family_relationships_' . $k]);

                        $options = $family = '<span>
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">
                                     <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="createfamily[name][]">
                                     </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 left_padd">
                                     <div class="form-group field-staffenquiryinterviewfirst-relation">
                                        <label class="control-label">Relationship</label>
                                        ' . $options . '
                                                 <div class="div-add-new"><a class="add-option-dropdown add-new" id="family_relationships_' . $k . '-10" style="margin-top:0px;"> + Add New</a></div>
                        </div>
                        </div>
                        <div class = "col-md-3 col-sm-6 col-xs-12 left_padd">
                        <div class = "form-group field-staffenquiryinterviewfirst-job">
                        <label class = "control-label">Job</label>
                        <input type = "text" class = "form-control" name = "createfamily[job][]">
                        </div>
                        </div>
                        <div class = "col-md-2 col-sm-6 col-xs-12 left_padd">
                        <div class = "form-group field-staffenquiryinterviewfirst-mobile_no">
                        <label class = "control-label">Mobile No</label>
                        <input type = "text" class = "form-control" name = "createfamily[mobile_no][]">
                        </div>
                        </div>
                        <div class = "col-md-1 col-sm-6 col-xs-12 left_padd">
                        <a id = "remFamily" class = "btn btn-icon btn-red remFamily" style = "margin-top: 15px;"><i class = "fa-remove"></i></a>
                        </div>
                        <div style = "claer:both"></div><br/>
                        </span><br/>';
                        echo $family;
                }
        }

        public function actionPatientid() {
                $id = PatientGeneral::find()->max('id');
                $id = $id + 1;
                if ($_POST['branch'] == 1) {
                        $branch = 'CPCU';
                        $val = \common\models\Settings::findOne(1);
                        $id = $val->auto_number;
                } else {
                        $branch = 'CPBU';
                        $val = \common\models\Settings::findOne(2);
                        $id = $val->auto_number;
                }

                echo $patient_id = $branch . '-' . date('d') . date('m') . date('y') . '-' . $id;
        }

        public function actionStaffid() {

                if ($_POST['branch'] == 1) {
                        $branch = 'CPCS';
                        $val = \common\models\Settings::findOne(3);
                        $id = $val->auto_number;
                } else {
                        $branch = 'CPBS';
                        $val = \common\models\Settings::findOne(4);
                        $id = $val->auto_number;
                }

                echo $patient_id = $branch . '-' . date('d') . date('m') . date('y') . '-' . $id;
        }

        /*
         * Missing fields checking
         */

        public function actionChecking() {
                if (Yii::$app->request->isAjax) {
                        $type = $_POST['type'];
                        $id = $_POST['id'];
                        $uploaded = array();
                        $not_uploaded = array();
                        if ($type == 1) { /* patient */
                                $model = PatientGeneral::findOne($id);
                                $patient_guardian = PatientGuardianDetails::find()->where(['patient_id' => $model->id])->one();
                                $files = array("patient_id-1" => "Patient Id", "first_name-2" => "Guardian Name", "email-1" => "Email", "contact_number-1" => "Contact Number", "police_station_name-2" => "Police Station Name", 'police_station_email-2' => 'Police Station Email', 'panchayath_name-2' => 'Panchayth Name', 'ward_no-2' => 'Ward No', 'contact_person_name-2' => 'Contact Person Name', 'contact_person_mobile_no-2' => 'Contact Person Mobile no');
                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $model->id;
                                $patient_uploads = array('Patient Image', 'Guardian Image', 'Diagnosis Report', 'Patient ID Proof', 'Guardian ID Proof');
                        } else if ($type == 2) { /* staff */
                                $staff = \common\models\StaffInfo::findOne($id);
                                $staff_details_first = \common\models\StaffEnquiryInterviewFirst::find()->where(['staff_id' => $staff->id])->one();
                                $staff_details_second = \common\models\StaffEnquiryInterviewThird::find()->where(['staff_id' => $staff->id])->one();
                                $staff_other_info = \common\models\StaffOtherInfo::find()->where(['staff_id' => $staff->id])->one();
                                $staff_family = \common\models\StaffEnquiryFamilyDetails::find()->where(['staff_id' => $staff->id])->all();
                                $files = array("present_contact_no-3" => "Staff Contact Number", "alternate_number_1-4" => "Staff Alternate Number 1", "alternate_number_2-4" => "Staff Alternate Number 2", "permanent_address-3" => "Permanent Address", "present_address-3" => "Present Address", 'emergency_contact_name-5' => 'Emeregency Contact Name', 'phone-5' => 'Emeregency Contact Phone', 'mobile-5' => 'Emeregency Contact Mobile', 'alt_emergency_contact_name-5' => 'Alternate Emeregency Contact Name', 'alt_phone-5' => 'Alternate Emeregency Contact Phone', 'alt_mobile-5' => 'Alternate Emeregency Contact Mobile', "police_station_name-4" => "Police Station Name", "panchayat-4" => "Panchayat", "bank_ac_no-6" => "Bank A/c Details");
                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $staff->id;
                                $patient_uploads = array('Profile Image', 'Voter ID', 'Aadhar Card');
                        }


                        /*
                         * checking fields
                         */
                        foreach ($files as $x => $x_value) {
                                if (!empty($x)) {
                                        $values = explode('-', $x);
                                        $field = $values[0];
                                        $table = $values[1];
                                        if ($table == 1) {
                                                $check = $model;
                                        } else if ($table == 2) {
                                                $check = $patient_guardian;
                                        } else if ($table == 3) {
                                                $check = $staff;
                                        } else if ($table == 4) {
                                                $check = $staff_details_first;
                                        } else if ($table == 5) {
                                                $check = $staff_other_info;
                                        } else if ($table == 6) {
                                                $check = $staff_details_second;
                                        }

                                        if (isset($check->$field) && $check->$field != '') {

                                                $uploaded[] = $x_value;
                                        } else {

                                                $not_uploaded[] = $x_value;
                                        }
                                }
                        }

                        if ($type == 2) {
                                if (count($staff_family) == 0)
                                        $not_uploaded[] = 'Family Details';
                        }

                        $not_uploaded = $this->FileCheck($patient_uploads, $path, $not_uploaded, $uploaded);
                        $view = $this->renderPartial('checking', ['not_uploaded' => $not_uploaded, 'type' => $type]);
                        echo $view;
                }
        }

        /*
         * checking files
         */

        public function FileCheck($patient_uploads, $path, $not_uploaded, $uploaded) {
                $s = 0;
                foreach ($patient_uploads as $patient_uploads) {
                        $s++;
                        $h = 0;
                        if (count(glob("{$path}/*")) > 0) {
                                foreach (glob("{$path}/*") as $file) {
                                        $h++;
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nam = explode('.', $img_nmee);

                                        if ($img_nam[0] != $patient_uploads) {

                                                if (!in_array($patient_uploads, $not_uploaded)) {
                                                        if (!in_array($patient_uploads, $uploaded)) {
                                                                $not_uploaded[] = $patient_uploads;
                                                        }
                                                }
                                        } else {

                                                $uploaded[] = $patient_uploads;
                                                if (($key = array_search($patient_uploads, $not_uploaded)) !== false) {
                                                        unset($not_uploaded[$key]);
                                                }
                                        }
                                }
                        } else {
                                $not_uploaded[] = $patient_uploads;
                        }
                }
                return $not_uploaded;
        }

}
