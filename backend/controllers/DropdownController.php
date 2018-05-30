<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\db\Expression;
use common\models\Hospital;
use common\models\Remarks;
use common\components\SetValues;

class DropdownController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * dropdown add new popup content
         */

        public function actionShowform() {
                $type = $_POST['type'];

                if ($type == '1') { /* add hospital */
                        $form = $this->renderPartial('_hospital', ['type' => $type, 'field_id' => $_POST['field_id'], 'category' => $_POST['category']]);
                } else if ($type == 2) { /* add remarks category */
                        $form = $this->renderPartial('_remark_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'cat_type' => $_POST['cat_type']]);
                } else if ($type == 3) { /* add followups category */
                        $form = $this->renderPartial('_followup_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'cat_type' => $_POST['cat_type']]);
                } else if ($type == 4) { /* add staff skills */
                        $form = $this->renderPartial('_skills', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 5) { /* add upload category */
                        $form = $this->renderPartial('_upload_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'cat_type' => $_POST['cat_type']]);
                } else if ($type == 6) { /* add contact directory category */
                        $form = $this->renderPartial('_contact_category', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 7) { /* add contact directory sub category */
                        $form = $this->renderPartial('_contact_sub_category', ['type' => $type, 'field_id' => $_POST['field_id'], 'category' => $_POST['category']]);
                } else if ($type == 8) { /* add contact directory designation */
                        $form = $this->renderPartial('_contact_designations', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 9) { /* add contact directory  */
                        $form = $this->renderPartial('_contact_directory', ['type' => $type, 'field_id' => $_POST['field_id'], 'category' => $_POST['category']]);
                } else if ($type == 10) { /* add relationships  */
                        $form = $this->renderPartial('_relationships', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 11) { /* add referral source  */
                        $form = $this->renderPartial('_refferal_source', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 12) { /* add referral source  */
                        $form = $this->renderPartial('designation', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 13) { /* add referral source  */
                        $form = $this->renderPartial('designation', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } else if ($type == 14) { /* add referral source  */
                        $form = $this->renderPartial('timing', ['type' => $type, 'field_id' => $_POST['field_id']]);
                } 

                echo $form;
        }

        /*
         * dropdown add new popup content submit
         */

        public function actionAdd() {

                if (Yii::$app->request->isAjax) {
                        $type = $_POST['type'];
                        if ($type == 1) {
                                $model = new \common\models\ContactSubcategory();
                        } else if ($type == 2) {
                                $model = new \common\models\RemarksCategory();
                        } else if ($type == 3) {
                                $model = new \common\models\FollowupSubType();
                        } else if ($type == 4) {
                                $model = new \common\models\StaffExperienceList();
                        } else if ($type == 5) {
                                $model = new \common\models\UploadCategory();
                        } else if ($type == 6) {
                                $model = new \common\models\ContactCategoryTypes();
                        } else if ($type == 7) {
                                $model = new \common\models\ContactSubcategory();
                        } else if ($type == 8) {
                                $model = new \common\models\ContactDirectoryDesignation();
                        } else if ($type == 9) {
                                $model = new \common\models\ContactDirectory();
                        } else if ($type == 10) {
                                $model = new \common\models\MasterRelationships();
                        } else if ($type == 11) {
                                $model = new \common\models\ReferralSource();
                        } else if ($type == 12) {
                                $model = new \common\models\MasterDesignations();
                        } else if ($type == 13) {
                                $model = new \common\models\MasterDesignations();
                        } else if ($type == 14) {
                                $model = new \common\models\Timing();
                        }
                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                                $model->status = 1;
                                if ($model->save(false)) {

                                        if ($type == 1) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->sub_category, 'field_id' => $_POST['field_id'], 'type' => '2');
                                        } else if ($type == 2) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->category, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 3) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->sub_type, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 4) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 5) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->sub_category, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 6) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->category_name, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 7) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->sub_category, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 8) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->designation, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 9) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->name, 'field_id' => $_POST['field_id'], 'type' => '2');
                                        } else if ($type == 10) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 11) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 12) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '1');
                                        } else if ($type == 13) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->title, 'field_id' => $_POST['field_id'], 'type' => '2');
                                        } else if ($type == 14) {
                                                $arr_variable = array('id' => $model->id, 'name' => $model->timing, 'field_id' => $_POST['field_id'], 'type' => '2');
                                        }
                                        $data['result'] = $arr_variable;
                                        echo json_encode($data);
                                }
                        }
                }
        }

        /*
         * add remarks
         */

        public function actionAddremarks() {

                if (Yii::$app->request->isAjax) {
                        $remarks = new Remarks();
                        $remarks->status = 1;

                        if ($remarks->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($remarks) && $remarks->validate()) {
                                $remarks->date = date('Y-m-d', strtotime($remarks->date));
                                $remarks->save();
                                if ($remarks->type == '2' || $remarks->type == '4')
                                        $rates = SetValues::Rating($remarks->type_id, $remarks->type);

                                if ($remarks->type == 5) {  /*if remark is added from copy then add a copy to the staff and patient in that service*/
                                        $service_staff = \common\models\ServiceSchedule::find()->select('staff')->distinct()->where(['service_id' => $remarks->type_id])->all();
                                        $patient = \common\models\Service::findOne($remarks->type_id);

                                        if (!empty($service_staff)) {
                                                foreach ($service_staff as $value) {
                                                        $remark = new Remarks();
                                                        $remark->attributes = $remarks->attributes;
                                                        $remark->type = 4;
                                                        $remark->type_id = $value->staff;
                                                        $remark->status = 1;
                                                        $remark->save();
                                                }
                                        }
                                        $patient_remark = new Remarks();
                                        $patient_remark->attributes = $remarks->attributes;
                                        $patient_remark->type = 2;
                                        $patient_remark->type_id = $patient->patient_id;
                                        $patient_remark->status = 1;
                                        $patient_remark->save();
                                }
                                $this->AddHistory($remarks);

                                $count = Remarks::find()->where(['type' => $remarks->type, 'type_id' => $remarks->type_id, 'status' => 1])->count();
                                $category = \common\models\RemarksCategory::findOne($remarks->category);

                                $remarks->category = $category->category;
                                $remarks->UB = $count;
                                return \yii\helpers\Json::encode($remarks);
                        }
                }
        }




        public function AddHistory($remarks) {
                if ($remarks->type == 1) {
                        $patient_enquiry = \common\models\PatientEnquiryHospitalFirst::find()->where(['enquiry_id' => $remarks->type_id])->one();
                        $name = $patient_enquiry->required_person_name . ' (Patient Enquiry)';
                } else if ($remarks->type == 2) {
                        $patient = \common\models\PatientGeneral::findOne($remarks->type_id);
                        $name = $patient->first_name . ' (Patient)';
                } else if ($remarks->type == 3) {
                        $staff_enquiry = \common\models\StaffEnquiry::findOne($remarks->type_id);
                        $name = $staff_enquiry->name . ' (Staff Enquiry)';
                } else if ($remarks->type == 4) {
                        $staff = \common\models\StaffInfo::findOne($remarks->type_id);
                        $name = $staff->staff_name . ' (Staff)';
                } else if ($remarks->type == 5) {
                        $service = \common\models\Service::findOne($remarks->type_id);
                        $name = $service->service_id . ' (Service ID)';
                }

                SetValues::History($remarks->id, 'A Remark is added to ' . $name);
        }

        /*
         * change remark status
         */

        public function actionChangeremarkstatus() {
                $remark = Remarks::findOne($_POST['remark_id']);
                $remark->status = 2;
                if ($remark->update()) {
                        echo '1';
                } else {
                        echo '0';
                }
        }

        /*
         * calculate rating
         */

        public function Rating($id, $type) {

                if ($type == '4') {
                        $person = \common\models\StaffInfo::findOne($id);
                }
                if ($type == '2') {
                        $person = \common\models\PatientGeneral::findOne($id);
                }
                $total_remarks_point = Remarks::find()->where(['type_id' => $id])->sum('point');
                $total_remarks = Remarks::find()->where(['type_id' => $id])->count();
                $rating = $total_remarks_point / $total_remarks * 9;
                $person->average_point = $rating;
                $person->save();
        }

        /*
         *  add rate card popup form in service
         */

        public function actionRatecard() {
                $form = $this->renderPartial('_ratecard', ['branch' => $_POST['branch'], 'service' => $_POST['service'], 'type' => '1', 'sub_service' => $_POST['sub_service']]);
                echo $form;
        }

        /*
         *  add rate card popup form in service to db
         */

        public function actionAddratecard() {
                if (Yii::$app->request->isAjax) {
                        $model = new \common\models\RateCard();
                        $model->status = 1;

                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
                                if ($model->save()) {
                                        $options = '<option value="">-Select-</option>';
                                        $i = 0;
                                        if (isset($model->rate_per_hour) && $model->rate_per_hour != '') {
                                                $options .= "<option value='1'>Hourly</option>";
                                                $i++;
                                        } if (isset($model->rate_per_visit) && $model->rate_per_visit != '') {
                                                $options .= "<option value='2'>Visit</option>";
                                                $i++;
                                        } if (isset($model->rate_per_day) && $model->rate_per_day != '') {
                                                $options .= "<option value='3'>Day</option>";
                                                $i++;
                                        } if (isset($model->rate_per_night) && $model->rate_per_night != '') {
                                                $options .= "<option value='4'>Night</option>";
                                                $i++;
                                        } if (isset($model->rate_per_day_night) && $model->rate_per_day_night != '') {
                                                $options .= "<option value='5'>Day & Night</option>";
                                                $i++;
                                        }
                                        echo $options;
                                }
                        }
                }
        }

        /*
         *  update rate card popup form in service
         */

        public function actionRatecardupdate() {
                $form = $this->renderPartial('_ratecard', ['branch' => $_POST['branch'], 'service' => $_POST['service'], 'type' => 2, 'sub_service' => $_POST['sub_service']]);
                echo $form;
        }

        /*
         *  update rate card popup form in service to db
         */

        public function actionUpdateratecard() {
                if (Yii::$app->request->isAjax) {
                        $service = $_POST['service'];
                        $branch = $_POST['branch'];
                        $model = \common\models\RateCard::find()->where(['service_id' => $service, 'branch_id' => $branch, 'status' => 1])->one();
                        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                                $options = '<option value="">-Select-</option>';
                                $i = 0;
                                if (isset($model->rate_per_hour) && $model->rate_per_hour != '') {
                                        $options .= "<option value='1'>Hourly</option>";
                                        $i++;
                                } if (isset($model->rate_per_visit) && $model->rate_per_visit != '') {
                                        $options .= "<option value='2'>Visit</option>";
                                        $i++;
                                } if (isset($model->rate_per_day) && $model->rate_per_day != '') {
                                        $options .= "<option value='3'>Day</option>";
                                        $i++;
                                } if (isset($model->rate_per_night) && $model->rate_per_night != '') {
                                        $options .= "<option value='4'>Night</option>";
                                        $i++;
                                } if (isset($model->rate_per_day_night) && $model->rate_per_day_night != '') {
                                        $options .= "<option value='5'>Day & Night</option>";
                                        $i++;
                                }
                                echo $options;
                        }
                }
        }

}
