<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Staff Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry </span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body">
                                        <div class="patient-enquiry-general-first-view">



                                                <div id="pdf">
                                                        <style>
                                                                .print{
                                                                        text-align: center;
                                                                        margin-top: 18px;
                                                                }
                                                                .appoint{
                                                                        width: 100%;
                                                                        /*     background-color: #eeeeee;*/
                                                                }
                                                                .value{
                                                                        font-weight: bold;
                                                                        text-align: left;
                                                                }
                                                                .appoint .labell{
                                                                        text-align: left;
                                                                }
                                                                .appoint .colen{

                                                                }
                                                                .appoint td{
                                                                        padding: 10px;
                                                                }
                                                                table th{
                                                                        color:black;
                                                                }
                                                                table td{
                                                                        color:black;
                                                                }
                                                                .sales-master{
                                                                        margin-bottom: 40px;
                                                                }
                                                                .sales-details{
                                                                        margin-bottom: 40px;
                                                                }
                                                                h4{
                                                                        color: #2196F3;
                                                                }
                                                                .label-class{
                                                                        font-weight: bold;
                                                                }
                                                        </style>


                                                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Staff Basic Details</label>
                                                                        </td>


                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('name'); ?> <td class="value"> <?= $model->name; ?></td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('gender'); ?></td><td class="value"><?php
                                                                                if (isset($model->gender)) {
                                                                                        if ($model->gender == '0') {
                                                                                                echo 'Male';
                                                                                        } else if ($model->gender == '1') {
                                                                                                echo 'Female';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>


                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('dob'); ?></td><td class="value"><?php
                                                                                if (isset($model->dob)) {
                                                                                        echo $model->dob;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('age'); ?></td><td class="value"><?php
                                                                                if (isset($model->age)) {
                                                                                        echo $model->age;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.height'); ?></td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->height)) {
                                                                                        echo $model->interviewfirst->height;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.weight'); ?></td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->weight)) {
                                                                                        echo $model->interviewfirst->weight;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('address'); ?></td><td class="value"><?php
                                                                                if (isset($model->address) && $model->address != '') {
                                                                                        echo $model->address;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('phone_number'); ?></td><td class="value"><?php
                                                                                if (isset($model->phone_number) && $model->phone_number != '') {
                                                                                        echo $model->phone_number;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('place'); ?></td><td class="value"><?php
                                                                                if (isset($model->place) && $model->place != '') {
                                                                                        echo $model->place;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('email'); ?></td><td class="value"><?php
                                                                                if (isset($model->email) && $model->email != '') {
                                                                                        echo $model->email;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('designation'); ?></td><td class="value"><?php
                                                                                if (isset($model->designation) && $model->designation != '') {
                                                                                        $desig = app\models\MasterDesignations::findOne($model->designation);
                                                                                        echo $desig->title;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>










                                                                <?php
                                                                if (!empty($staff_previous_employer)) {
                                                                        foreach ($staff_previous_employer as $staff_previous_employer) {
                                                                                ?>
                                                                                <tr>
                                                                                        <td colspan="5">
                                                                                                <label class="label-class">Previous Employer Details</label>
                                                                                        </td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Hospital Address </td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->hospital_address) && $staff_previous_employer->hospital_address != '') {
                                                                                                        echo $staff_previous_employer->hospital_address;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                        <td class="labell">Designation </td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->designation) && $staff_previous_employer->designation != '') {
                                                                                                        echo $staff_previous_employer->designation;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Length Of Service </td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->length_of_service) && $staff_previous_employer->length_of_service != '') {
                                                                                                        echo $staff_previous_employer->length_of_service;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                        <td class="labell">Service From </td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->service_from) && $staff_previous_employer->service_from != '') {
                                                                                                        echo $staff_previous_employer->service_from;
                                                                                                }
                                                                                                ?>
                                                                                        </td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Service To</td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->service_to) && $staff_previous_employer->service_to != '') {
                                                                                                        echo $staff_previous_employer->service_to;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                        <td class="labell">Salary</td><td class="value"><?php
                                                                                                if (isset($staff_previous_employer->salary) && $staff_previous_employer->salary != '') {
                                                                                                        echo $staff_previous_employer->salary;
                                                                                                }
                                                                                                ?>
                                                                                        </td>
                                                                                </tr>

                                                                                <?php
                                                                        }
                                                                }
                                                                ?>


                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Emergency Contact</label>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.emergency_contact_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->emergency_contact_name) && $model->staffOtherinfo->emergency_contact_name != '') {
                                                                                        echo $model->staffOtherinfo->emergency_contact_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.relationship'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->relationship) && $model->staffOtherinfo->relationship != '') {
                                                                                        echo $model->staffOtherinfo->relationship;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.phone'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->phone) && $model->staffOtherinfo->phone != '') {
                                                                                        echo $model->staffOtherinfo->phone;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.mobile'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->mobile) && $model->staffOtherinfo->mobile != '') {
                                                                                        echo $model->staffOtherinfo->mobile;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_emergency_contact_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_emergency_contact_name) && $model->staffOtherinfo->alt_emergency_contact_name != '') {
                                                                                        echo $model->staffOtherinfo->alt_emergency_contact_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_relationship'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_relationship) && $model->staffOtherinfo->alt_relationship != '') {
                                                                                        echo $model->staffOtherinfo->alt_relationship;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_phone'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_phone) && $model->staffOtherinfo->alt_phone != '') {
                                                                                        echo $model->staffOtherinfo->alt_phone;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_mobile'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_mobile) && $model->staffOtherinfo->alt_mobile != '') {
                                                                                        echo $model->staffOtherinfo->alt_mobile;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>


                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.guardian_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->guardian_name) && $model->staffOtherinfo->guardian_name != '') {
                                                                                        echo $model->staffOtherinfo->guardian_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.guardian_phone'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->guardian_phone) && $model->staffOtherinfo->guardian_phone != '') {
                                                                                        echo $model->staffOtherinfo->guardian_phone;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>


                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.guardian_email'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->guardian_email) && $model->staffOtherinfo->guardian_email != '') {
                                                                                        echo $model->staffOtherinfo->guardian_email;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_guardian_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_guardian_name) && $model->staffOtherinfo->alt_guardian_name != '') {
                                                                                        echo $model->staffOtherinfo->alt_guardian_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>


                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_guardian_phone'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_guardian_phone) && $model->staffOtherinfo->alt_guardian_phone != '') {
                                                                                        echo $model->staffOtherinfo->alt_guardian_phone;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('staffOtherinfo.alt_guardian_email'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staffOtherinfo->alt_guardian_email) && $model->staffOtherinfo->alt_guardian_email != '') {
                                                                                        echo $model->staffOtherinfo->alt_guardian_email;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <?php
                                                                if (!empty($staff_family_details)) {
                                                                        foreach ($staff_family_details as $staff_family_details) {
                                                                                ?>
                                                                                <tr>
                                                                                        <td colspan="5">
                                                                                                <label class="label-class">Family Details</label>
                                                                                        </td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Name </td><td class="value"><?php
                                                                                                if (isset($staff_family_details->name) && $staff_family_details->name != '') {
                                                                                                        echo $staff_family_details->name;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                        <td class="labell">Relationship </td><td class="value"><?php
                                                                                                if (isset($staff_family_details->relationship) && $staff_family_details->relationship != '') {
                                                                                                        echo $staff_family_details->relationship;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Job </td><td class="value"><?php
                                                                                                if (isset($staff_family_details->job) && $staff_family_details->job != '') {
                                                                                                        echo $staff_family_details->job;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                        <td class="labell">Mobile no </td><td class="value"><?php
                                                                                                if (isset($staff_family_details->mobile_no) && $staff_family_details->mobile_no != '') {
                                                                                                        echo $staff_family_details->mobile_no;
                                                                                                }
                                                                                                ?>
                                                                                        </td>

                                                                                </tr>
                                                                                <?php
                                                                        }
                                                                }
                                                                ?>

                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Interview Information</label>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.police_station_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->police_station_name) && $model->interviewfirst->police_station_name != '') {
                                                                                        echo $model->interviewfirst->police_station_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewsecond.verified_name_1'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewsecond->verified_name_1) && $model->interviewsecond->verified_name_1 != '') {
                                                                                        echo $model->interviewsecond->verified_name_1;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.muncipality_corporation'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->muncipality_corporation) && $model->interviewfirst->muncipality_corporation != '') {
                                                                                        echo $model->interviewfirst->muncipality_corporation;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewsecond.verified_name_2'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewsecond->verified_name_2) && $model->interviewsecond->verified_name_2 != '') {
                                                                                        echo $model->interviewsecond->verified_name_2;
                                                                                }
                                                                                ?>
                                                                        </td>


                                                                </tr>

                                                                <tr>
                                                                        <td class="labell" ><?= $model->getAttributeLabel('staff_experience'); ?> </td><td class="value"><?php
                                                                                if (isset($model->staff_experience) && $model->staff_experience != '') {
                                                                                        $skill = explode(',', $model->staff_experience);
                                                                                        $skills = '';
                                                                                        $i = 0;
                                                                                        if (!empty($skill)) {
                                                                                                foreach ($skill as $des) {

                                                                                                        if ($i != 0) {
                                                                                                                $skills .= ',';
                                                                                                        }
                                                                                                        $skill_name = \common\models\StaffExperienceList::findOne($des);
                                                                                                        $skills .= $skill_name->title;
                                                                                                        $i++;
                                                                                                }
                                                                                        }
                                                                                        echo $skills;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.mentioned_per_day_salary'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->mentioned_per_day_salary) && $model->interviewfirst->mentioned_per_day_salary != '') {
                                                                                        echo $model->interviewfirst->mentioned_per_day_salary;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewfirst.smoke_or_drink'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->smoke_or_drink) && $model->interviewfirst->smoke_or_drink != '') {
                                                                                        if ($model->interviewfirst->smoke_or_drink == 1) {
                                                                                                echo 'Yes';
                                                                                        } else {
                                                                                                echo 'No';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell">Drink/Other </td><td class="value"><?php
                                                                                if (isset($model->interviewfirst->drink) && $model->interviewfirst->drink != '') {

                                                                                        if ($model->interviewfirst->drink == 1) {
                                                                                                echo 'Drink : Yes';
                                                                                        } else {
                                                                                                echo 'Drink : Yes';
                                                                                        }
                                                                                }
                                                                                if (isset($model->interviewfirst->drink) && $model->interviewfirst->drink != '') {
                                                                                        echo ',';
                                                                                }

                                                                                if (isset($model->interviewfirst->other) && $model->interviewfirst->other != '') {

                                                                                        if ($model->interviewfirst->other == 1) {
                                                                                                echo 'Drink : Yes';
                                                                                        } else {
                                                                                                echo 'Drink : Yes';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.document_required'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->document_required) && $model->interviewthird->document_required != '') {
                                                                                        echo $model->interviewthird->document_required;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.document_received'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->document_received) && $model->interviewthird->document_received != '') {
                                                                                        echo $model->interviewthird->document_received;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.form_filled'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->form_filled) && $model->interviewthird->form_filled != '') {
                                                                                        if ($model->interviewthird->form_filled == 1) {
                                                                                                echo 'yes';
                                                                                        } else {
                                                                                                echo 'No';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.interest_level'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->interest_level) && $model->interviewthird->interest_level != '') {
                                                                                        if ($model->interviewthird->interest_level == 1) {
                                                                                                echo 'High';
                                                                                        } else if ($model->interviewthird->interest_level == 2) {
                                                                                                echo 'No interest';
                                                                                        } else if ($model->interviewthird->interest_level == 3) {
                                                                                                echo 'Medium';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.interview_notes'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->interview_notes) && $model->interviewthird->interview_notes != '') {
                                                                                        echo $model->interviewthird->interview_notes;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.interviewed_by'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->interviewed_by) && $model->interviewthird->interviewed_by != '') {
                                                                                        echo $model->interviewthird->interviewed_by;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell" ><?= $model->getAttributeLabel('interviewthird.interviewed_date'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->interviewed_date) && $model->interviewthird->interviewed_date != '') {
                                                                                        echo $model->interviewthird->interviewed_date;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td colspan="2"></td>

                                                                </tr>

                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Bank Details</label>
                                                                        </td>
                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.bank_ac_hodername'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->bank_ac_hodername) && $model->interviewthird->bank_ac_hodername != '') {
                                                                                        echo $model->interviewthird->bank_ac_hodername;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.bank_ac_no'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->bank_ac_no) && $model->interviewthird->bank_ac_no != '') {
                                                                                        echo $model->interviewthird->bank_ac_no;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.bank_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->bank_name) && $model->interviewthird->bank_name != '') {
                                                                                        echo $model->interviewthird->bank_name;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.bank_branch'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->bank_branch) && $model->interviewthird->bank_branch != '') {
                                                                                        echo $model->interviewthird->bank_branch;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>

                                                                        <td class="labell"><?= $model->getAttributeLabel('interviewthird.bank_ifsc'); ?> </td><td class="value"><?php
                                                                                if (isset($model->interviewthird->bank_ifsc) && $model->interviewthird->bank_ifsc != '') {
                                                                                        echo $model->interviewthird->bank_ifsc;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td colspan="2">

                                                                        </td>

                                                                </tr>







                                                        </table>







                                                </div>
                                                <script>
                                                        function printContent(el) {
                                                                var restorepage = document.body.innerHTML;
                                                                var printcontent = document.getElementById(el).innerHTML;
                                                                document.body.innerHTML = printcontent;
                                                                window.print();
                                                                document.body.innerHTML = restorepage;
                                                        }
                                                </script>

                                                <!--</html>-->
                                                <div class="print">
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;" class="btn btn-success">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>