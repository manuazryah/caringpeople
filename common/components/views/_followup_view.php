<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\FollowupType;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use common\models\PatientEnquiryGeneralFirst;
use common\models\PatientGeneral;
use common\models\StaffEnquiry;
use common\models\Service;

if ($data->status == '0') {
        $color = 'blockquote-info'; //status-open
        $status = 'Open';
} else if ($data->status == '1') {
        $color = 'blockquote-success'; //status-closed
        $status = 'Closed';
} else if ($data->status == '2') {
        $color = 'blockquote-warning'; //status-void
        $status = 'Void';
} else if ($data->status == '3') {
        $color = 'blockquote-red'; //status-pending
        $status = 'Pending';
}

$assigned_to = StaffInfo::findOne($data->assigned_to);
$assigned_to = $assigned_to->staff_name;
$assigned_from = StaffInfo::findOne($data->assigned_from);
$assigned_from = $assigned_from->staff_name;
$encrypt_followup_id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $data->id);

$type = FollowupType::findOne($data->type);
if ($data->type == 1) {
        $patient_enquiry = PatientEnquiryGeneralFirst::findOne($data->type_id);
        $required_person = $patient_enquiry->caller_name;
} else if ($data->type == 2) {
        $patient = PatientGeneral::findOne($data->type_id);
        $required_person = $patient->first_name;
} else if ($data->type == 3) {
        $staff_enquiry = StaffEnquiry::findOne($data->type_id);
        $required_person = $staff_enquiry->name;
} else if ($data->type == 4) {
        $staffs = StaffInfo::findOne($data->type_id);
        $required_person = $staffs->staff_name;
} else if ($data->type == 5) {
        $service = Service::findOne($data->type_id);
        $patient = PatientGeneral::findOne($service->patient_id);
        $required_person = $patient->first_name;
}


if (isset($data->repeated_type)) {
        $repeated = 'repeated';
} else {
        $repeated = '';
}
?>


<div class="col-sm-6 col-md-6 <?= $data->id ?>">
        <blockquote class="blockquote <?= $color; ?>">

                <p>
                        <i class="linecons-note"></i> <strong><?= $data->followup_date ?></strong>
                        <span style="float: right;color: #7c38bc;font-size: 12px;">
                                Assigned To: <?= $assigned_to; ?>
                                <?php if ($data->status != 1) { ?>      <a href="<?= Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $data->type_id . '&type=' . $data->type . '&id=' . $data->id . '&repeated=' . $repeated; ?>" title="Edit"> <i class="fa-edit" style="color:#000;margin-left: 10px;font-size: 20px;"></i></a><?php } ?>
                        </span>
                </p>

                <p style="text-align:right;font-size: 12px;margin-top: 3px;">
                        <span>Status: <?= $status; ?></span>
                </p>

                <p style="font-size: 12px;">
                        <?= $type->type; ?> (<?= $required_person; ?>)
                </p>

                <p>
                        <textarea rows="5" cols="100" class="follow_notes" id="<?= $encrypt_followup_id ?>"> <?= $data->followup_notes; ?></textarea>
                </p>

                <p>
                        <span style="font-size: 12px;">
                                Assigned by: <?= $assigned_from; ?> <br>
                                <?= date('d-m-Y', strtotime($data->DOC)); ?>
                        </span>
                        <span>
                                <?php if ($data->status != 1) { ?>        <input type="checkbox" value="<?= $data->id ?>" id='<?= $repeated; ?>' class="iswitch iswitch-secondary followup_closed " title="Mrak it if this task is closed" style="float:right;"> <?php } ?>
                        </span>
                </p>

                <?php if ($data->attachments != '') { ?>
                        <div id="attach_<?= $data->id ?>">
                                <p><a href="<?= Yii::$app->homeUrl . '../uploads/followups/' . $data->id . '/' . $data->attachments; ?>" target="_blank" style="font-size: 10px;color: #0d0da5;">View Attachament</a>
                                        <a title="Delete"><i class="fa fa-remove followup-attach-remove" style="margin-left: 5px;left: 220px;top: 5px;cursor: pointer;font-size: 12px;" id="<?= $data->id . "-" . $data->attachments; ?>"></i></a>
                                </p>
                        </div>
                <?php } ?>
        </blockquote>
</div>


<style>
        textarea{
                display: block;
                font-size: 80%;
                line-height: 1.42857143;
                color: #777;
                border: none;
        }
</style>