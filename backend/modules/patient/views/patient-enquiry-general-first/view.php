<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminPosts;
use common\models\AdminUsers;
use common\models\OutgoingNumbers;
use common\models\Hospital;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryGeneralFirst */

$this->title = $model->enquiry_number;
$this->params['breadcrumbs'][] = ['label' => 'Patient Enquiries', 'url' => ['index']];
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
                                                                                <label class="label-class">Enquirer Details</label>
                                                                        </td>


                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('caller_name'); ?> <td class="value"> <?= $model->caller_name; ?></td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('caller_gender'); ?></td><td class="value"><?php
                                                                                if (isset($model->caller_gender)) {
                                                                                        if ($model->caller_gender == '0') {
                                                                                                echo 'Male';
                                                                                        } else if ($model->caller_gender == '1') {
                                                                                                echo 'Female';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('mobile_number'); ?> </td><td class="value"><?php
                                                                                if (isset($model->mobile_number)) {
                                                                                        echo $model->mobile_number;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('mobile_number_2'); ?></td><td class="value"><?php
                                                                                if (isset($model->mobile_number_2)) {
                                                                                        echo $model->mobile_number_2;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('mobile_number_3'); ?></td><td class="value"><?php
                                                                                if (isset($model->mobile_number_3)) {
                                                                                        echo $model->mobile_number_3;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                         <td class="labell"><?= $model->getAttributeLabel('referral_source'); ?></td><td class="value"><?php
                                                                                if (isset($model->referral_source)) {
                                                                                        $referal_source = common\models\ReferralSource::findOne($model->referral_source);
                                                                                        if ($model->referral_source == '5') {
                                                                                                echo $model->referral_source_others . ' (Other)';
                                                                                        } else {
                                                                                                echo $referal_source->title;
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.address'); ?> </td><td class="value"> <?php
                                                                                if (isset($model->patientGeneralInfo->address) && $model->patientGeneralInfo->address != '') {
                                                                                        echo $model->patientGeneralInfo->address;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.city'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->city) && $model->patientGeneralInfo->city != '') {
                                                                                        echo $model->patientGeneralInfo->city;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.zip_pc'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->zip_pc) && $model->patientGeneralInfo->zip_pc != '') {
                                                                                        echo $model->patientGeneralInfo->zip_pc;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.email'); ?> </td><td class="value"> <?php
                                                                                if (isset($model->patientGeneralInfo->email) && $model->patientGeneralInfo->email != '') {
                                                                                        echo $model->patientGeneralInfo->email;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.email1'); ?> </td><td class="value" colspan="4"><?php
                                                                                if (isset($model->patientGeneralInfo->email1) && $model->patientGeneralInfo->email1 != '') {
                                                                                        echo $model->patientGeneralInfo->email1;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Service Details</label>
                                                                        </td>
                                                                </tr>



                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.required_service'); ?> </td><td class="value"> <?php
                                                                                if (isset($model->patientGeneralInfo->required_service) && $model->patientGeneralInfo->required_service != '') {

                                                                                        $required_services = explode(',', $model->patientGeneralInfo->required_service);
                                                                                        $services = '';
                                                                                        $a = 0;
                                                                                        if (!empty($required_services)) {
                                                                                                foreach ($required_services as $service) {

                                                                                                        if ($a != 0) {
                                                                                                                $services .= ',';
                                                                                                        }
                                                                                                        if ($service == '1') {
                                                                                                                $services .= 'DV';
                                                                                                        } else if ($service == '2') {
                                                                                                                $services .= 'Nursing Care';
                                                                                                        } else if ($service == '3') {
                                                                                                                $services .= 'Physiotherapy';
                                                                                                        } else if ($service == '5') {
                                                                                                                $services .= 'Caregiver';
                                                                                                        } else if ($service == '4') {
                                                                                                                $services .= 'Helath Checkup';
                                                                                                        } else if ($service == '6') {
                                                                                                                $services .= 'Lab';
                                                                                                        } else if ($service == '7') {
                                                                                                                $services .= 'Equipment';
                                                                                                        } else if ($service == '8') {
                                                                                                                $services .= 'Other';
                                                                                                        } else if ($service == '9') {
                                                                                                                $services .= 'General Enquiry';
                                                                                                        } else if ($service == '10') {
                                                                                                                $services .= 'Wrong Number';
                                                                                                        }
                                                                                                        $a++;
                                                                                                }
                                                                                        }
                                                                                        echo $services;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.service_required'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->service_required) && $model->patientGeneralInfo->service_required != '') {
                                                                                        if ($model->patientGeneralInfo->service_required == 1) {
                                                                                                echo 'Immediately';
                                                                                        } else if ($model->patientGeneralInfo->service_required == 2) {
                                                                                                echo 'Couple Weeks';
                                                                                        } else if ($model->patientGeneralInfo->service_required == 3) {
                                                                                                echo 'Month';
                                                                                        } else if ($model->patientGeneralInfo->service_required == 4) {
                                                                                                echo 'Unsure';
                                                                                        } else if ($model->patientGeneralInfo->service_required == 5) {
                                                                                                echo $model->patientGeneralInfo->service_required_other ? $model->patientGeneralInfo->service_required_other : '';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.expected_date_of_service'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->expected_date_of_service) && $model->patientGeneralInfo->expected_date_of_service != '') {
                                                                                        echo $model->patientGeneralInfo->expected_date_of_service;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.how_long_service_required'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->how_long_service_required) && $model->patientGeneralInfo->how_long_service_required != '') {
                                                                                        echo $model->patientGeneralInfo->how_long_service_required;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.whatsapp_reply'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->whatsapp_reply) && $model->patientGeneralInfo->whatsapp_reply != '') {
                                                                                        if ($model->patientGeneralInfo->whatsapp_reply == '1')
                                                                                                echo 'Yes';
                                                                                        else
                                                                                                echo 'No';
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientGeneralInfo.priority'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->priority) && $model->patientGeneralInfo->priority != '') {
                                                                                        if ($model->patientGeneralInfo->priority == '1') {
                                                                                                echo 'Hot';
                                                                                        } else if ($model->patientGeneralInfo->priority == '2') {
                                                                                                echo 'Warm';
                                                                                        } else if ($model->patientGeneralInfo->priority == '3') {
                                                                                                echo 'Cold';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <?php if (isset($model->patientGeneralInfo->notes) && $model->patientGeneralInfo->notes != '') { ?>
                                                                        <tr>
                                                                                <td><?= $model->getAttributeLabel('patientGeneralInfo.notes'); ?></td>
                                                                                <td colspan="4" class="value">
                                                                                        <?= $model->patientGeneralInfo->notes; ?>
                                                                                </td>

                                                                        </tr>
                                                                <?php } ?>

                                                                <?php if (isset($model->patientGeneralInfo->quotation_details) && $model->patientGeneralInfo->quotation_details != '') { ?>
                                                                        <tr>
                                                                                <td><?= $model->getAttributeLabel('patientGeneralInfo.quotation_details'); ?></td>
                                                                                <td colspan="4" class="value">
                                                                                        <?= $model->patientGeneralInfo->quotation_details; ?>
                                                                                </td>

                                                                        </tr>
                                                                <?php } ?>


                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Patient Details</label>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.required_person_name'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->required_person_name) && $model->patientGeneralInfo->required_person_name != '') {
                                                                                        echo $model->patientGeneralInfo->required_person_name;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.patient_gender'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->patient_gender) && $model->patientGeneralInfo->patient_gender != '') {
                                                                                        if ($model->patientGeneralInfo->required_person_name == 0) {
                                                                                                echo 'Male';
                                                                                        } else if ($model->patientGeneralInfo->required_person_name == 1) {
                                                                                                echo 'Female';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.patient_age'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->patient_age) && $model->patientGeneralInfo->patient_age != '') {
                                                                                        echo $model->patientGeneralInfo->patient_age;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.patient_dob'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->patient_dob) && $model->patientGeneralInfo->patient_dob != '') {
                                                                                        echo $model->patientGeneralInfo->patient_dob;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.patient_weight'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->patient_weight) && $model->patientGeneralInfo->patient_weight != '') {
                                                                                        echo $model->patientGeneralInfo->patient_weight;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.relationship'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->relationship) && $model->patientGeneralInfo->relationship != '') {
                                                                                        if ($model->patientGeneralInfo->relationship == '0') {
                                                                                                echo 'Spouse';
                                                                                        } else if ($model->patientGeneralInfo->relationship == '1') {
                                                                                                echo 'Parent';
                                                                                        } else if ($model->patientGeneralInfo->relationship == '2') {
                                                                                                echo 'GrandParent';
                                                                                        } else if ($model->patientGeneralInfo->relationship == '3') {
                                                                                                if (isset($model->patientGeneralInfo->relationship_others)) {
                                                                                                        echo $model->patientGeneralInfo->relationship_others;
                                                                                                }
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.person_address'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->person_address) && $model->patientGeneralInfo->person_address != '') {
                                                                                        echo $model->patientGeneralInfo->person_address;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.person_city'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->person_city) && $model->patientGeneralInfo->person_city != '') {
                                                                                        echo $model->patientGeneralInfo->person_city;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.person_address'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->person_address) && $model->patientGeneralInfo->person_address != '') {
                                                                                        echo $model->patientGeneralInfo->person_address;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.person_city'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->person_city) && $model->patientGeneralInfo->person_city != '') {
                                                                                        echo $model->patientGeneralInfo->person_city;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalInfo.person_postal_code'); ?> </td><td class="value" colspan="4"><?php
                                                                                if (isset($model->patientGeneralInfo->person_postal_code) && $model->patientGeneralInfo->person_postal_code != '') {
                                                                                        echo $model->patientGeneralInfo->person_postal_code;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>


                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Hospital Details</label>
                                                                        </td>
                                                                </tr>


                                                                <?php
                                                                if (!empty($patient_hospital_setails)) {
                                                                        foreach ($patient_hospital_setails as $value) {
                                                                                ?>
                                                                                <tr>
                                                                                        <td class="labell">Hospital Name</td><td class="value"><?php
                                                                                                if (isset($value->hospital_name)) {
                                                                                                        $hospital_name = common\models\ContactSubcategory::findOne($value->hospital_name);
                                                                                                        echo $hospital_name->sub_category;
                                                                                                }
                                                                                                ?></td>
                                                                                        <td class="labell">Doctor</td><td class="value"><?php
                                                                                                if (isset($value->consultant_doctor)) {
                                                                                                        $doctor = \common\models\ContactDirectory::findOne($value->consultant_doctor);
                                                                                                        echo $doctor->name;
                                                                                                }
                                                                                                ?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="labell">Department</td><td class="value"><?php
                                                                                                if (isset($value->department)) {
                                                                                                        echo $value->department;
                                                                                                }
                                                                                                ?></td>
                                                                                        <td class="labell">Hospital Room No</td><td class="value"><?php
                                                                                                if (isset($value->hospital_room_no)) {
                                                                                                        echo $value->hospital_room_no;
                                                                                                }
                                                                                                ?></td>
                                                                                </tr>
                                                                                <?php
                                                                        }
                                                                }
                                                                ?>

                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Medical Conditons/Current Diagnosis</label>
                                                                        </td>
                                                                </tr>


                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.diabetic'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->diabetic) && $model->patientGeneralInfo->diabetic != '') {
                                                                                        if ($model->patientGeneralInfo->diabetic == '0') {
                                                                                                echo 'No';
                                                                                        } else if ($model->patientGeneralInfo->diabetic == '1') {
                                                                                                echo 'Yes';
                                                                                        } else if ($model->patientGeneralInfo->diabetic == '2') {
                                                                                                echo 'Yes,Insulin';
                                                                                        } else if ($model->patientGeneralInfo->diabetic == '3') {
                                                                                                echo 'Yes, On Tablet';
                                                                                        } else if ($model->patientGeneralInfo->diabetic == '4') {
                                                                                                echo 'Dont Know';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.hypertension'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->hypertension) && $model->patientGeneralInfo->hypertension != '') {
                                                                                        echo $model->patientGeneralInfo->hypertension;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.feeding'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->feeding) && $model->patientGeneralInfo->feeding != '') {
                                                                                        if ($model->patientGeneralInfo->feeding == '0') {
                                                                                                echo 'Nasogastric';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '1') {
                                                                                                echo 'Nasoduodenal';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '2') {
                                                                                                echo 'Nasojejunal Tubes';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '3') {
                                                                                                echo 'Gastrostomy';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '4') {
                                                                                                echo 'Gastrojejunostomy';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '5') {
                                                                                                echo 'Jejunostomyfeeding tube';
                                                                                        } else if ($model->patientGeneralInfo->feeding == '6') {
                                                                                                echo 'NA';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.urine'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->urine) && $model->patientGeneralInfo->urine != '') {
                                                                                        if ($model->patientGeneralInfo->urine == '0') {
                                                                                                echo 'Foleys catheter';
                                                                                        } else if ($model->patientGeneralInfo->urine == '1') {
                                                                                                echo 'Suprapubic';
                                                                                        } else if ($model->patientGeneralInfo->urine == '2') {
                                                                                                echo 'Condom catheter';
                                                                                        } else if ($model->patientGeneralInfo->urine == '6') {
                                                                                                echo 'NA';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.oxygen'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->oxygen) && $model->patientGeneralInfo->oxygen != '') {
                                                                                        if ($model->patientGeneralInfo->oxygen == '0') {
                                                                                                echo 'No';
                                                                                        } else if ($model->patientGeneralInfo->oxygen == '1') {
                                                                                                echo 'Yes';
                                                                                        } else if ($model->patientGeneralInfo->oxygen == '2') {
                                                                                                echo 'Ventilator ';
                                                                                        } else if ($model->patientGeneralInfo->oxygen == '3') {
                                                                                                echo 'BiPAP';
                                                                                        } else if ($model->patientGeneralInfo->oxygen == '4') {
                                                                                                echo 'SOS';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.tracheostomy'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->tracheostomy) && $model->patientGeneralInfo->tracheostomy != '') {
                                                                                        if ($model->patientGeneralInfo->tracheostomy == '0') {
                                                                                                echo 'No';
                                                                                        } else if ($model->patientGeneralInfo->tracheostomy == '1') {
                                                                                                echo 'Yes';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.iv_line'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->iv_line) && $model->patientGeneralInfo->iv_line != '') {
                                                                                        if ($model->patientGeneralInfo->iv_line == '0') {
                                                                                                echo 'No';
                                                                                        } else if ($model->patientGeneralInfo->iv_line == '1') {
                                                                                                echo 'Yes';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.family_support'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->family_support) && $model->patientGeneralInfo->family_support != '') {
                                                                                        if ($model->patientGeneralInfo->family_support == '1') {
                                                                                                echo 'Close';
                                                                                        } else if ($model->patientGeneralInfo->iv_line == '2') {
                                                                                                echo 'Distant';
                                                                                        } else if ($model->patientGeneralInfo->iv_line == '3') {
                                                                                                echo 'None';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.family_support_note'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->family_support_note) && $model->patientGeneralInfo->family_support_note != '') {
                                                                                        echo $model->patientGeneralInfo->family_support_note;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.care_currently_provided'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->care_currently_provided) && $model->patientGeneralInfo->care_currently_provided != '') {
                                                                                        if ($model->patientGeneralInfo->care_currently_provided == '1') {
                                                                                                echo 'Family';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '2') {
                                                                                                echo 'Friends';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '3') {
                                                                                                echo 'Hospital';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '4') {
                                                                                                echo 'Others';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '5') {
                                                                                                echo 'Home Nursing Agemcy';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '6') {
                                                                                                echo 'Not Told';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>


                                                                </tr>
                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.details_of_current_care'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->details_of_current_care) && $model->patientGeneralInfo->details_of_current_care != '') {
                                                                                        echo $model->patientGeneralInfo->details_of_current_care;
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientHospitalMedical.difficulty_in_movement'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientGeneralInfo->difficulty_in_movement) && $model->patientGeneralInfo->difficulty_in_movement != '') {
                                                                                        if ($model->patientGeneralInfo->difficulty_in_movement == '1') {
                                                                                                echo 'No difficulty';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '2') {
                                                                                                echo 'Assistance required';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '3') {
                                                                                                echo 'Wheelchair';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '4') {
                                                                                                echo 'Bedridden';
                                                                                        } else if ($model->patientGeneralInfo->care_currently_provided == '5') {
                                                                                                echo 'Others';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>


                                                                <tr>
                                                                        <td colspan="5">
                                                                                <label class="label-class">Assessment Details</label>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientAssessment.patient_condition'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientAssessment->patient_condition) && $model->patientAssessment->patient_condition != '') {
                                                                                        if ($model->patientAssessment->patient_condition == 1) {
                                                                                                echo 'Mobile';
                                                                                        } else if ($model->patientAssessment->patient_condition == 2) {
                                                                                                echo 'Bedridden';
                                                                                        } else if ($model->patientAssessment->patient_condition == 3) {
                                                                                                echo 'Semi Bedridden';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientAssessment.patient_conscious'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientAssessment->patient_conscious) && $model->patientAssessment->patient_conscious != '') {
                                                                                        if ($model->patientAssessment->patient_conscious == 4) {
                                                                                                echo 'Conscious';
                                                                                        } else if ($model->patientAssessment->patient_conscious == 5) {
                                                                                                echo 'UnConscious';
                                                                                        } else if ($model->patientAssessment->patient_conscious == 6) {
                                                                                                echo 'Semi Conscious';
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientAssessment.patient_medical_procedures'); ?> </td><td class="value" colspan="3"><?php
                                                                                if (isset($model->patientAssessment->patient_medical_procedures) && $model->patientAssessment->patient_medical_procedures != '') {
                                                                                        $procedures = explode(',', $model->patientAssessment->patient_medical_procedures);
                                                                                        $procedure = '';
                                                                                        $b = 0;
                                                                                        foreach ($procedures as $value) {
                                                                                                $b++;
                                                                                                if ($b != 1) {
                                                                                                        $procedure .= ' , ';
                                                                                                }
                                                                                                $skill = common\models\StaffExperienceList::findOne($value);
                                                                                                $procedure .= $skill->title;
                                                                                        }
                                                                                        echo $procedure;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="labell"><?= $model->getAttributeLabel('patientAssessment.suggested_professional'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientAssessment->suggested_professional) && $model->patientAssessment->suggested_professional != '') {
                                                                                        $suggest = explode(',', $model->patientAssessment->suggested_professional);
                                                                                        $suggested = '';
                                                                                        $c = 0;
                                                                                        foreach ($suggest as $values) {
                                                                                                $c++;
                                                                                                if ($c != 1) {
                                                                                                        $suggested .= ' , ';
                                                                                                }
                                                                                                if ($values == 1) {
                                                                                                        $suggested .= 'Registered Nurse Male';
                                                                                                } else if ($values == 2) {
                                                                                                        $suggested .= 'Registered Nurse Female';
                                                                                                } else if ($values == 3) {
                                                                                                        $suggested .= 'Associate Nurse Male';
                                                                                                } else if ($values == 3) {
                                                                                                        $suggested .= 'Associate Nurse Female';
                                                                                                } else if ($values == 3) {
                                                                                                        $suggested .= 'Nurse Attendent Male';
                                                                                                } else if ($values == 3) {
                                                                                                        $suggested .= 'Nurse Attendent Female';
                                                                                                }
                                                                                        }
                                                                                        echo $suggested;
                                                                                }
                                                                                ?>
                                                                        </td>

                                                                        <td class="labell"><?= $model->getAttributeLabel('patientAssessment.other_notes'); ?> </td><td class="value"><?php
                                                                                if (isset($model->patientAssessment->other_notes) && $model->patientAssessment->other_notes != '') {
                                                                                        echo $model->patientAssessment->other_notes;
                                                                                }
                                                                                ?>
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


