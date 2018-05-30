<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\models\StaffInfo;
use common\models\PatientGeneral;
use common\models\Service;

class Followups extends Component {
	/*
	 * Add followups to table Followups
	 */

	public function StoreData($followup, $val) {

		if ($val['type'] != 'NULL') {
			$followup->type = $val['type'];
		} else {
			$followup->type = $val['typed'];
		}
		$followup->type_id = $val['type_id'];
		$followup->sub_type = $val['sub_type'];
		$followup->followup_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val['followup_date'])));
		$followup->assigned_to = $val['assigned_to'];
		$followup->assigned_to_type = $val['assigned_to_type'];
		$followup->followup_notes = $val['followup_notes'];
		$followup->assigned_from = Yii::$app->user->identity->id;
		$followup->related_staffs = $val['related_staffs'];
		if ($val['related-patient'] == '1') {
			$service_patient = Service::findOne($followup->type_id);
			$patient_id = $service_patient->patient_id;
		} else {
			$patient_id = '';
		}
		$followup->releated_notification_patient = $patient_id;
		$followup->attachments = $val['name'];
		$followup->DOC = date('Y-m-d');
		$followup->CB = Yii::$app->user->identity->id;
		if (!empty($followup->assigned_to))
			$followup->save(false);
		return $followup;
	}

	public function Addcronfollowup($followup, $val) {

		$followup->attributes = $val->attributes;
		$followup->followup_date = date('Y-m-d H:i:s');
		$followup->save(false);
		$this->HistoryAndNotifications($followup, $followup->assigned_to);
		return $followup;
	}

	public function sendMail($add_followp, $assigned) {

		if ($assigned == '1') {
			$email_to = \common\models\PatientGeneral::findOne($add_followp->assigned_to);
		} else {
			$email_to = \common\models\StaffInfo::findOne($add_followp->assigned_to);
		}
		if (isset($email_to->email) && $email_to->email != '') {
			$message = Yii::$app->mailer->compose('followup-assigned-mail', ['assigned_to' => $add_followp->assigned_to, 'type' => $add_followp->assigned_to_type]) // a view rendering result becomes the message body here
				->setFrom('info@caringpeople.in')
				->setTo($email_to->email)
				->setSubject('New Followup');
			$message->send();
			return TRUE;
		}
	}

	/*
	 * Followups-> assigned to dropdown
	 */

	public function Assigned($service) {

		$data = [];
		$patient = PatientGeneral::findOne($service->patient_id);
		if ($service->staff_manager != '') {
			$manager = StaffInfo::findOne($service->staff_manager);
			$data2 = [$manager->id => $manager->staff_name . ' ( Staff Manager )'];
		} else {
			$data2 = [];
		}
		$super_admins = StaffInfo::find()->where(['post_id' => 1, 'status' => 1])->all();
		$data2 = ArrayHelper::map($super_admins, 'id', 'fullname');

		if ($service->staff_manager != '') {
			$manager = StaffInfo::findOne($service->staff_manager);
			$data3 = [$manager->id => $manager->staff_name . ' ( Staff Manager )'];
		} else {
			$data3 = [];
		}
		$service_staffs = \common\models\ServiceSchedule::find()->select('staff')->where(['service_id' => $service->id])->andWhere(['<>', 'status', '2'])->distinct()->all();
		if (!empty($service_staffs)) {
			foreach ($service_staffs as $staffs) {
				$staff_name = StaffInfo::findOne($staffs->staff);
				$da[$staffs->staff] .= $staff_name->staff_name;
			}
		} else {
			$da = [];
		}





		$datas = $data + $data3 + $data2 + $da;
		return $datas;
	}

	/*
	 * related staff options
	 */

	public function Relatedstaffs($type, $type_id) {

		$related_staff = StaffInfo::find()->where(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();
		$related_staff_data = ArrayHelper::map($related_staff, 'id', 'namepost');
		return $related_staff_data;
	}

	public function Selectedstaffs($type, $type_id) {
		/* Super admins */
		$admins = StaffInfo::find()->where(['post_id' => 1])->all();
		$selected_staff = ArrayHelper::map($admins, 'id', 'id');
		/* service related staff and patient */
		$service = Service::findOne($type_id);
//                $day_staff = StaffInfo::findOne($service->day_staff);
//                $night_staff = StaffInfo::findOne($service->night_staff);
//                $selected_staff[$service->day_staff] = $service->day_staff;
//                $selected_staff[$service->night_staff] = $service->night_staff;

		return $selected_staff;
	}

	/*
	 * repeated followups Days listing
	 */

	public function Days() {
		$days = [];
		$days['sunday'] = 'Sunday';
		$days['monday'] = 'Monday';
		$days['tuesday'] = 'Tuesday';
		$days['wednesday'] = 'Wednesday';
		$days['thursday'] = 'Thursday';
		$days['friday'] = 'Friday';
		$days['saturday'] = 'Saturday';
		return $days;
	}

	/*
	 * Repeated followups Dates listing
	 */

	public function Dates() {
		$dates = [];
		for ($i = 1; $i <= 31; $i++) {
			$dates[$i] = $i;
		}
		return $dates;
	}

	public function HistoryAndNotifications($followup, $staff) {
		if ($followup->type == 5) {
			$history_id = Yii::$app->SetValues->ServiceHistory($followup, 5); /* 5 implies masterservice history type id 5 for  followup for service */
			Yii::$app->SetValues->Notifications($history_id, $followup->id, $followup, 2, $staff); /* 2 => notification_type_id in case of followup , old staff id is for send notification */
			return true;
		} elseif ($followup->type == 2) {
			$history_id = Yii::$app->SetValues->ServiceHistory($followup, 6); /* 6 implies masterservice history type id 6 for  patient  followup */
			Yii::$app->SetValues->Notifications($history_id, $followup->id, $followup, 2, $staff); /* 2 => notification_type_id in case of followup , old staff id is for send notification */
			return true;
		} elseif ($followup->type == 1) {
			$history_id = Yii::$app->SetValues->ServiceHistory($followup, 7); /* 7 implies masterservice history type id 7 for  patient enquiry followup */
			Yii::$app->SetValues->Notifications($history_id, $followup->id, $followup, 2, $staff); /* 2 => notification_type_id in case of followup , old staff id is for send notification */
			return true;
		} elseif ($followup->type == 3) {
			$history_id = Yii::$app->SetValues->ServiceHistory($followup, 8); /* 8 implies masterservice history type id 7 for  staff enquiry followup */
			Yii::$app->SetValues->Notifications($history_id, $followup->id, $followup, 2, $staff); /* 2 => notification_type_id in case of followup , old staff id is for send notification */
			return true;
		} elseif ($followup->type == 4) {
			$history_id = Yii::$app->SetValues->ServiceHistory($followup, 9); /* 9 implies masterservice history type id 9 for  staff  followup */
			Yii::$app->SetValues->Notifications($history_id, $followup->id, $followup, 2, $staff); /* 2 => notification_type_id in case of followup , old staff id is for send notification */
			return true;
		}
	}

	public function PendingFollowups() {

		$pending_followups = \common\models\Followups::find()->where(['<=', 'followup_date', date('Y-m-d')])->andWhere(['status' => 0])->all();

		foreach ($pending_followups as $pending_followup) {
			if ($pending_followup->type == 1) {
				$data_model = \common\models\PatientEnquiryGeneralFirst::find()->where(['id' => $pending_followup->type_id])->one();
				$superadmins = StaffInfo::find()->where(['branch_id' => $data_model->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
				foreach ($superadmins as $superadmin) {
					$x .= $superadmin->id . ',';
				}
				$content = "A followup is pending for patient enquiry " . $data_model->enquiry_number;
			} elseif ($pending_followup->type == 2) {


				$data_model2 = PatientGeneral::find()->where(['id' => $pending_followup->type_id])->one();

				$superadmins = StaffInfo::find()->where(['branch_id' => $data_model2->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();

				foreach ($superadmins as $superadmin) {
					$x .= $superadmin->id . ',';
				}
				$content = "A followup is pending for patient " . $data_model2->patient_id;
			} elseif ($pending_followup->type == 3) {
				$data_model3 = \common\models\StaffEnquiry::find()->where(['id' => $pending_followup->type_id])->one();
				$superadmins = StaffInfo::find()->where(['branch_id' => $data_model3->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
				foreach ($superadmins as $superadmin) {
					$x .= $superadmin->id . ',';
				}
				$content = "A followup is pending for staff enquiry " . $data_model3->enquiry_id;
			} elseif ($pending_followup->type == 4) {
				$data_model4 = StaffInfo::find()->where(['id' => $pending_followup->type_id])->one();
				$superadmins = StaffInfo::find()->where(['branch_id' => $data_model4->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
				foreach ($superadmins as $superadmin) {
					$x .= $superadmin->id . ',';
				}
				$content = "A followup is pending for staff " . $data_model4->staff_id;
			} elseif ($pending_followup->type == 5) {
				$data_model5 = Service::find()->where(['id' => $pending_followup->type_id])->one();
				$superadmins = StaffInfo::find()->where(['branch_id' => $data_model5->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
				foreach ($superadmins as $superadmin) {
					$x .= $superadmin->id . ',';
				}
				$x .= $data_model5->staff_manager . ',';
				$content = "A followup is pending for service " . $data_model5->service_id;
			}
			$x .= $pending_followup->assigned_to;
			$this->AddDataToPendingFollowups($pending_followup->id, $x, $content);
			$x = '';
		}
	}

	public function AddDataToPendingFollowups($followup_id, $assigne_to, $content) {
		$exist = \common\models\PendingFollowups::find()->where(['followup_id' => $followup_id])->one();
		if (empty($exist)) {
			$model = new \common\models\PendingFollowups();
			$model->followup_id = $followup_id;
			$model->assigned_to = $assigne_to;
			$model->content = $content;
			$model->status = 0;
			$model->save();
			return TRUE;
		} else {
			return true;
		}
	}

}
