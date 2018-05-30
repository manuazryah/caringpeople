<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\MasterHistoryType;
use common\models\History;
use common\models\Service;
use common\models\NotificationViewStatus;
use common\models\StaffInfo;
use common\models\PatientGeneral;
use common\models\Remarks;
use common\models\ServiceSchedule;
use common\models\Followups;
use common\models\PatientEnquiryGeneralFirst;
use common\models\StaffEnquiry;


class SetValues extends Component {

        public function Attributes($model) {

                if (isset($model) && !Yii::$app->user->isGuest) {
                        if ($model->isNewRecord) {
                                $model->CB = Yii::$app->user->identity->id;
                                $model->DOC = date('Y-m-d');
                        } else {
                                $model->UB = Yii::$app->user->identity->id;
                        }



                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function currentBranch($model) {
                if ($model->isNewRecord) {
                        $model->branch_id = Yii::$app->user->identity->branch_id;
                }
                return true;
        }

        public function Selected($value) {
                $options = array();
                if (is_array($value)) {
                        $array = $value;
                } else {
                        $array = explode(',', $value);
                }

                foreach ($array as $valuee):
                        $options[$valuee] = ['selected' => true];
                endforeach;
                return $options;
        }

        public function ChangeFormate($date) {
                if ($date == Null || $date == '0000-00-00 00:00:00') {
                        return '(Not Set)';
                } else {
                        return date("d-M-Y h:i:s", strtotime($date));
                }
        }

        public function DateFormate($date) {
                $old = strtotime('1999-01-01 00:00:00');
                if ($date == Null || $date == '0000-00-00 00:00:00') {
                        return;
                } else {
                        $f = 'd-M-Y' . (date('H:i:s', strtotime($date)) != '00:00:00' ? ' H:i' : '');
                        return str_replace(' 00:00:00', '', date($f, strtotime($date)));
                }
        }

        public function NumberFormat($grandtotal) {
                $s = explode('.', $grandtotal);
                $amount = $s[0];
                $decimal = $s[1];
                if ($amount != '') {
                        $total = $english_format_number = number_format($amount);
                        if ($decimal != 0) {
                                $grandtotal = $total . '.' . $decimal;
                        } else {
                                $grandtotal = $total . '.00';
                        }
                        return $grandtotal;
                } else {
                        return;
                }
        }

        public function ServiceHistory($service, $master_history_type, $schedule_days = null, $schedule_id = null, $old_staff = null) {

                $master_history_type_model = MasterHistoryType::findOne($master_history_type);
                if ($master_history_type == 5 || $master_history_type == 6 || $master_history_type == 7 || $master_history_type == 8) {
                        $followup_data = Followups::find()->where(['id' => $service->id])->one();
                        $service_data = $this->GetData($master_history_type, $followup_data); /* to get data from corresponding table based on the master history type */
                } else {
                        $service_data = Service::find()->where(['id' => $service])->one();
                }

                $model = new History();
                $model->reference_id = $service->id;
                $model->history_type = $master_history_type;
                $model->content = $this->GetContent($master_history_type, $master_history_type_model, $service_data, $schedule_days, $schedule_id, $old_staff); /* to get content of history based on the activity */
                $model->date = date('Y-m-d');
                $model->CB = Yii::$app->user->identity->id;
                if ($model->save())
                        return $model->id;
                else
                        return FALSE;
        }

        public function Notifications($history_id, $service_id, $datas, $notification_type_id, $staff = null, $old_staff = null) {

                $history_model = History::find()->where(['id' => $history_id])->one();
                if ($notification_type_id == 1) {
                        $service_model = Service::find()->where(['id' => $service_id])->one();
                } else {
                        $followup_model = Followups::find()->where(['id' => $service_id])->one();
                        $service_model = $this->GetData($history_model->history_type, $followup_model); /* to get data from corresponding table based on the master history type */
                }
                $superadmins = StaffInfo::find()->where(['branch_id' => $service_model->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
                if (!empty($superadmins)) {
                        $this->NotificationsForSuperadmins($superadmins, $service_id, $history_id, $notification_type_id, $history_model); /* to add notifications for all superamins */
                }
                if ($notification_type_id == 1) {
                        $exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $datas->staff_manager, 'history_id' => $history_id])->one();
                        if (!empty($datas->staff_manager) && empty($exist_notification)) {
                                $this->AddDataToNotification($service_id, $history_id, $notification_type_id, 6, $datas->staff_manager, $history_model, $service_model); /* 6=>staff_manager */
                        }
                } elseif (($notification_type_id == 2) && ($history_model->history_type == 5)) {
                        $exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $service_model->staff_manager, 'history_id' => $history_id])->one();
                        if (!empty($service_model->staff_manager) && empty($exist_notification)) {
                                $this->AddDataToNotification($service_id, $history_id, $notification_type_id, 6, $service_model->staff_manager, $history_model, $service_model); /* 6=>staff_manager */
                        }
                }
                if (!empty($staff)) {
                        $exist_notification = NotificationViewStatus::find()->where(['staff_id_' => $staff, 'history_id' => $history_id])->one();
                        if (empty($exist_notification))
                                $this->AddDataToNotification($service_id, $history_id, $notification_type_id, 5, $staff, $history_model, $service_model); /* 5=>staff */
                        if (!empty($old_staff)) {

                                $this->AddDataToNotification($service_id, $history_id, $notification_type_id, 5, $old_staff, $history_model, $service_model); /* 5=>staff */
                        }
                }
        }

        public function AddDataToNotification($service_id, $history_id, $notification_type_id, $staff_type, $staff_id, $history_model, $service_model) {
                $model = new NotificationViewStatus();
                $model->reference_id = $service_id;
                $model->history_id = $history_id;
                $model->notifiaction_type_id = $notification_type_id;
                $model->staff_type = $staff_type;
                $model->staff_id_ = $staff_id;
                $model->content = $history_model->content;
                $model->date = date('Y-m-d', strtotime($service_model->DOU));
                $model->view_status = 0;
                $model->save();
        }

        public function StaffChangeContent($master_history_type_model, $schedule_id, $oldstaff) {
                $schedule_data = ServiceSchedule::find()->where(['id' => $schedule_id])->one();
                $new_staff_info = StaffInfo::find()->where(['id' => $schedule_data->staff])->one();
                $old_staff_info = StaffInfo::find()->where(['id' => $oldstaff])->one();
                $content = $master_history_type_model->content . ' from ' . $old_staff_info->staff_id . ' to' . $new_staff_info->staff_id;
                return $content;
        }

        /*
         * Rating calculation based on remarks
         */

        public function Rating($id, $type) {

                $schedule_remarks = 0;
                $schedule_remarks_count = 0;
                if ($type == '2') {

                        $person = \common\models\PatientGeneral::findOne($id);
                } else {

                        $person = \common\models\StaffInfo::findOne($id);
                        $schedule_remarks = ServiceSchedule::find()->where(['staff' => $id])->sum('rating');
                        if (!isset($schedule_remarks)) {
                                $schedule_remarks = 0;
                        }
                        $schedule_remarks_count = ServiceSchedule::find()->where(['staff' => $id])->andWhere(['not', ['rating' => null]])->count();
                }
                $remarks_point = Remarks::find()->where(['type_id' => $id])->sum('point');
                $remarks_count = Remarks::find()->where(['type_id' => $id])->count();

                $total_remarks_point = $schedule_remarks + $remarks_point;
                $total_remarks = ($schedule_remarks_count + $remarks_count) * 9;
                if ($total_remarks_point > 0) {

                        $rating = ($total_remarks_point / $total_remarks) * 100;
                        $rating = round($rating);
                        $person->average_point = $rating;
                        $person->update(FALSE);
                }
        }

        public function Rating1($id, $type) {

                $remarks = \common\models\Remarks::find()->where(['type_id' => $id])->andWhere(['not', ['remark_type' => null]])->all();
                $count = count($remarks);
                $good_count = 0;
                $bad_count = 0;
                foreach ($remarks as $value) {

                        if ($value->remark_type == '1') {
                                $good_count = $good_count + 1;
                        } else if ($value->remark_type == '0') {
                                $bad_count = $bad_count + 1;
                        }
                }
                $remark_notes = 'Remarks :' . count($remarks) . ' Good Remarks: ' . $good_count . ' Bad Remarks: ' . $bad_count;
                $rating = $good_count * 100 / $count;
                $ratings = round($rating);
                if ($type == '1') {
                        $patient = PatientGeneral::findOne($id);
                        $patient->count_of_remarks = $remark_notes;
                        $patient->average_point = $ratings;
                        $patient->update(false);
                } else if ($type == '2') {
                        $staff = StaffInfo::findOne($id);
                        $staff->count_of_remarks = $remark_notes;
                        $staff->average_point = $ratings;
                        $staff->update(false);
                }
        }

        /*
         * staff availabiltity
         */

        public function StaffAvailabilty($model, $before_updtate = null) {

                if ($model->day_staff != '' && $model->status == 1) { /* when add daystaff and the service status is opened */
                        $staff = StaffInfo::findOne($model->day_staff);
                        $staff->status = 3;
                        $staff->update();
                }
                if ($model->night_staff != '' && $model->status == 1) { /* when add nightstaff and the service status is opened */
                        $staff = StaffInfo::findOne($model->night_staff);
                        $staff->status = 3;
                        $staff->update();
                }

                /*
                 * for update case
                 */
                if (isset($before_updtate)) {
                        if ($model->status == 2) { /** when that service is closed * */
                                $day_staff = StaffInfo::findOne($before_updtate->day_staff);
                                $day_staff->status = 1;
                                $day_staff->update();

                                $night_staff = StaffInfo::findOne($model->night_staff);
                                $night_staff->status = 1;
                                $night_staff->update();
                        }
                        if ($model->day_staff != $before_updtate->day_staff) { /** when changing the day staff * */
                                $day_staff = StaffInfo::findOne($before_updtate->day_staff);
                                $day_staff->status = 1;
                                $day_staff->update();
                        }

                        if ($model->night_staff != $before_updtate->night_staff) { /** when changing the night staff * */
                                $night_staff = StaffInfo::findOne($before_updtate->night_staff);
                                $night_staff->status = 1;
                                $night_staff->update();
                        }
                }
        }

        /*
         * Service form duty type options
         */

        public function Dutytype($model) {

                $option1 = [];
                $option2 = [];
                $option3 = [];
                $option4 = [];
                $option5 = [];
                if (isset($model->rate_per_hour) && $model->rate_per_hour != '') {
                        $option1 = ['1' => 'Hourly'];
                } if (isset($model->rate_per_visit) && $model->rate_per_visit != '') {
                        $option2 = ['2' => 'Visit'];
                }if (isset($model->rate_per_day) && $model->rate_per_day != '') {
                        $option3 = ['3' => 'Day'];
                } if (isset($model->rate_per_night) && $model->rate_per_night != '') {
                        $option4 = ['4' => 'Night'];
                } if (isset($model->rate_per_day_night) && $model->rate_per_day_night != '') {
                        $option5 = ['5' => 'Day & Night'];
                }

                return $option1 + $option2 + $option3 + $option4 + $option5;
        }

        public function Experience() {
                $exp = [];
                $exp['5'] = '0-5 yrs';
                $exp['10'] = '5-10 yrs';
                $exp['15'] = '10-15 yrs';


                return $exp;
        }

        public function CalculateAvg($item_id) {

                $in_stocks = \common\models\StockRegister::find()->where(['item_id' => $item_id])->all();
                $qty_tot = 0;
                $price_tot = 0;
                foreach ($in_stocks as $stock) {
                        $qty_tot += $stock->balance_qty;
                        $amount = $stock->balance_qty * $stock->item_cost;
                        $price_tot += $amount;
                }
                $avg_price = $price_tot / $qty_tot;
                $item_data = \common\models\ItemMaster::findOne(['id' => $item_id]);
                $item_data->item_cost = $avg_price;
                $item_data->save();
                return $avg_price;
        }

        public function StockDeduction($item_id, $qty) {
                $stocks = \common\models\StockRegister::find()->where(['item_id' => $item_id])->andWhere(['>', 'balance_qty', 0])->all();
                $k = $qty;
                foreach ($stocks as $stock) {
                        $existing_stock = \common\models\StockRegister::findOne(['id' => $stock->id]);
                        if ($k <= $existing_stock->balance_qty) {
                                $existing_stock->balance_qty = $existing_stock->balance_qty - $k;
                                $existing_stock->save();
                                break;
                        } else {
                                $existing_stock->balance_qty = 0;
                                $existing_stock->save();
                                $k = $k - $existing_stock->balance_qty;
                                continue;
                        }
                }
                return;
        }

        public function Accounts($branch_id, $reference_type, $invoice_id, $type, $purpose, $payment_type, $amount, $payment_date) {
                $model = new \common\models\Accounts;
                $model->branch_id = $branch_id;
                $model->reference_type = $reference_type;
                $model->invoice_id = $invoice_id;
                $model->type = $type;
                $model->purpose = $purpose;
                $model->payment_type = $payment_type;
                $model->amount = $amount;
                $model->payment_date = $payment_date;
                $model->CB = Yii::$app->user->identity->id;
                $model->DOC = date('Y-m-d');
                $model->save();
        }

        public function GetData($master_history_type, $followup_data) {
                if ($master_history_type == 6) {
                        $service_data = PatientGeneral::find()->where(['id' => $followup_data->type_id])->one();
                } elseif ($master_history_type == 7) {
                        $service_data = PatientEnquiryGeneralFirst::find()->where(['id' => $followup_data->type_id])->one();
                } elseif ($master_history_type == 8) {
                        $service_data = StaffEnquiry::find()->where(['id' => $followup_data->type_id])->one();
                } elseif ($master_history_type == 9) {
                        $service_data = StaffInfo::find()->where(['id' => $followup_data->type_id])->one();
                } else {
                        $service_data = Service::find()->where(['id' => $followup_data->type_id])->one();
                }
                return $service_data;
        }

        public function GetContent($master_history_type, $master_history_type_model, $service_data, $schedule_days, $schedule_id, $old_staff) {
                if ($master_history_type == 1){

                        $model_content = $master_history_type_model->content . ' for patient ' . $service_data->patient->first_name;
                }elseif (!empty($schedule_days)) {
                        $model_content = $schedule_days . ' more ' . $master_history_type_model->content . ' ' . $service_data->service_id;
                } elseif (!empty($schedule_id)) {
                        $content = $this->StaffChangeContent($master_history_type_model, $schedule_id, $old_staff);
                        $model_content = $content . ' for ' . $service_data->service_id;
                } elseif ($master_history_type == 6) {
                        $model_content = $master_history_type_model->content . ' ' . $service_data->patient_id;
                } elseif ($master_history_type == 7) {
                        $model_content = $master_history_type_model->content . ' ' . $service_data->enquiry_number;
                } elseif ($master_history_type == 8) {
                        $model_content = $master_history_type_model->content . ' ' . $service_data->enquiry_id;
                } elseif ($master_history_type == 9) {
                        $model_content = $master_history_type_model->content . ' ' . $service_data->staff_id;
                } else {
                        $model_content = $master_history_type_model->content . ' ' . $service_data->service_id;
                }
                return $model_content;
        }

        public function NotificationsForSuperadmins($superadmins, $service_id, $history_id, $notification_type_id, $history_model) {
                foreach ($superadmins as $superadmin) {
                        $model = new NotificationViewStatus();
                        $model->reference_id = $service_id;
                        $model->history_id = $history_id;
                        $model->notifiaction_type_id = $notification_type_id;
                        $model->staff_type = 1;
                        $model->staff_id_ = $superadmin->id;
                        $model->content = $history_model->content;
                        $model->date = date('Y-m-d');
                        $model->view_status = 0;
                        $model->save();
                }
        }

        public function ServiceScheduleHistory($service_id, $type, $schedules, $price) {
                $history = new \common\models\ServiceScheduleHistory();
                $history->service_id = $service_id;
                $history->type = $type;
                $history->schedules = $schedules;
                $history->price = $price;
                $history->date = date('Y-m-d');
                $history->save();
        }
    public function Email($to, $subject, $message) {

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                        "From: info@caringpeople.in";
                mail($to, $subject, $message, $headers);

        }

     public function History($id, $content) {

                $history = new History();
                $history->reference_id = $id;
                $history->content = $content;
                $history->date = date('Y-m-d');
                $history->CB = Yii::$app->user->identity->id;
                $history->save();
        }


     public function Check($id, $type) {
                $uploaded = array();
                $not_uploaded = array();
                if ($type == 1) {
                        $model = PatientGeneral::findOne($id);
                        $patient_guardian = \common\models\PatientGuardianDetails::find()->where(['patient_id' => $model->id])->one();
                        $files = array("patient_id-1" => "Patient Id", "first_name-2" => "Guardian Name", "email-1" => "Email", "contact_number-1" => "Contact Number", "police_station_name-2" => "Police Station Name", 'police_station_email-2' => 'Police Station Email', 'panchayath_name-2' => 'Panchayth Name', 'ward_no-2' => 'Ward No', 'contact_person_name-2' => 'Contact Person Name', 'contact_person_mobile_no-2' => 'Contact Person Mobile no');
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $model->id;
                        $patient_uploads = array('Patient Image', 'Guardian Image', 'Diagnosis Report', 'Patient ID Proof', 'Guardian ID Proof');
                } else if ($type == 2) {
                        $staff = StaffInfo::findOne($id);
                        $staff_details_first = \common\models\StaffEnquiryInterviewFirst::find()->where(['staff_id' => $staff->id])->one();
                        $staff_details_second = \common\models\StaffEnquiryInterviewThird::find()->where(['staff_id' => $staff->id])->one();
                        $staff_other_info = \common\models\StaffOtherInfo::find()->where(['staff_id' => $staff->id])->one();
                        $staff_family = \common\models\StaffEnquiryFamilyDetails::find()->where(['staff_id' => $staff->id])->all();
                        $files = array("present_contact_no-3" => "Staff Contact Number", "alternate_number_1-4" => "Staff Alternate Number 1", "alternate_number_2-4" => "Staff Alternate Number 2", "permanent_address-3" => "Permanent Address", "present_address-3" => "Present Address", 'emergency_contact_name-5' => 'Emeregency Contact Name', 'phone-5' => 'Emeregency Contact Phone', 'mobile-5' => 'Emeregency Contact Mobile', 'alt_emergency_contact_name-5' => 'Alternate Emeregency Contact Name', 'alt_phone-5' => 'Alternate Emeregency Contact Phone', 'alt_mobile-5' => 'Alternate Emeregency Contact Mobile', "police_station_name-4" => "Police Station Name", "muncipality_corporation-4" => "Panchayat", "bank_ac_no-6" => "Bank A/c Details");
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $staff->id;
                        $patient_uploads = array('Profile Image', 'Voter ID', 'Aadhar Card');
                }
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
                $not_uploaded = SetValues::FileCheck($patient_uploads, $path, $not_uploaded, $uploaded);
                return $not_uploaded;
        }

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
        public function LogIn($type_id, $user_id, $branch_id) {

                $log_history = new \common\models\LoginHistory;
                $log_history->type = $type_id;
                if ($type_id == 1)
                        $log_history->staff_id = $user_id;
                else
                        $log_history->patient_id = $user_id;
                $log_history->logged_in = date('Y-m-d H:i:s');
                $log_history->branch_id = $branch_id;
                $log_history->save();
        }

        public function LogOut($type_id, $user_id) {
                if ($type_id == 1)
                        $log_history = \common\models\LoginHistory::find()->where(['staff_id' => $user_id])->orderBy('id DESC')->limit(1)->one();
                else
                        $log_history = \common\models\LoginHistory::find()->where(['patient_id' => $user_id])->orderBy('id DESC')->limit(1)->one();
                if (!empty($log_history)) {
                        $log_history->logged_out = date('Y-m-d H:i:s');
                        $log_history->save();
                }
        }

}
