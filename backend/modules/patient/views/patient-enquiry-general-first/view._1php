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
                                <div class="panel-body"><div class="patient-enquiry-general-first-view">


                                                <div id="pdf">


                                                        <style type="text/css">

                                                                @media print {
                                                                        thead {display: table-header-group;}
                                                                        .table th{ background-color: rgba(155, 156, 157, 0.5);}
                                                                }
                                                                @page {
                                                                        size: A4;
                                                                }

                                                                @media screen{
                                                                        .main-tabl{
                                                                                width: 42%;
                                                                        }
                                                                }
                                                                .print{
                                                                        text-align: center;
                                                                        margin-top: 18px;
                                                                }

                                                                tfoot{display: table-footer-group;}
                                                                table { page-break-inside:auto;}
                                                                tr{ page-break-inside:avoid; page-break-after:auto; }

                                                                table.table{
                                                                        border: .1px solid #969696;
                                                                        border-collapse: collapse;
                                                                        margin: auto;
                                                                        color:#000;

                                                                }
                                                                .table th {
                                                                        border: 1px solid #969696;
                                                                        color: #525252;
                                                                        font-weight: bold;
                                                                }
                                                                .table td {
                                                                        border: .1px solid #969696;
                                                                        font-size: 12px;
                                                                        text-align: center;
                                                                        padding: 3px;
                                                                }
                                                                .header{
                                                                        font-size: 12.5px;
                                                                        display: inline-block;
                                                                        width: 100%;
                                                                }
                                                                .main-left{
                                                                        float: left;
                                                                }

                                                                .label_sty{
                                                                        float: left;
                                                                }
                                                                .data_sty{
                                                                        float: left;
                                                                        padding: 0px 18px;
                                                                        border-bottom: 1px solid black;
                                                                        font-weight: bold;
                                                                        margin-left: 10px;
                                                                        text-align: center;
                                                                        min-height: 30px;
                                                                }




                                                        </style>


                                                        <table class="main-tabl table table-responsive" border="0"  style="line-height:30px;">
                                                                <thead>
                                                                        <tr>
                                                                                <th style="width:100%">
                                                                                        <div class="header">
                                                                                                <div class="main-left">
                                                                                                        <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-collapsed.png" />

                                                                                                </div>
                                                                                                <div class="enqview_heading">
                                                                                                        <p>CARING PEOPLE</p>
                                                                                                        <p>CUSTOMER ENQUIRY CONTACT SHEET</p>
                                                                                                </div>
                                                                                                <br/>
                                                                                        </div>
                                                                                </th>
                                                                        </tr>

                                                                </thead>

                                                                <tbody>
                                                                        <tr>
                                                                                <td>
                                                                                        <div class="content info" style="text-align:right;">
                                                                                                <label><b>NO:<?= $model->enquiry_number; ?></b></label>
                                                                                        </div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty">
                                                                                                        <label>Contacted by:</label>
                                                                                                </div>
                                                                                                <div class="data_sty">
                                                                                                        <span><?php
                                                                                                                if ($model->contacted_source == '0') {
                                                                                                                        echo 'Phone';
                                                                                                                } elseif ($model->contacted_source == '1') {
                                                                                                                        echo 'Email';
                                                                                                                } elseif ($model->contacted_source == '2') {
                                                                                                                        echo 'Other';
                                                                                                                }
                                                                                                                ?></span>
                                                                                                </div>

                                                                                                <div class="label_sty"><label>Date:</label></div><div class="data_sty" style="width: 110px;"><span><?= $date = date('d-m-Y', strtotime($model->contacted_date)); ?></span></div>
                                                                                                <div class="label_sty"><label>Time:</label></div><div class="data_sty"><span><?= $time = date('H:i', strtotime($model->contacted_date)); ?></span></div>
                                                                                                <div class="label_sty"><label><?php
                                                                                                                if ($model->contacted_source == '0') {
                                                                                                                        echo 'Inocming Call Number:';
                                                                                                                } elseif ($model->contacted_source == '1') {
                                                                                                                        echo 'Email:';
                                                                                                                } elseif ($model->contacted_source == '2') {
                                                                                                                        echo 'Contacted Source Others:';
                                                                                                                }
                                                                                                                ?></label></div><div class="data_sty" style="width:126px;"><span><?= $model->incoming_missed; ?></span></div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Outgoing Call from:</label></div>
                                                                                                <div class="data_sty" style="width:200px;"><span>
                                                                                                                <?php
                                                                                                                if (isset($model->outgoing_number_from) && $model->outgoing_number_from != '') {

                                                                                                                        $outgoing_number = OutgoingNumbers::findOne($model->outgoing_number_from);
                                                                                                                        echo $outgoing_number->phone_number;
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span>
                                                                                                </div>
                                                                                                <div class="label_sty"><label>Date:</label></div><div class="data_sty" style="width:135px;"><span><?= date('d-m-Y', strtotime($model->outgoing_call_date)); ?></span></div>
                                                                                                <div class="label_sty"><label>Time:</label></div><div class="data_sty" style="width:144px;"><span><?= date('H:i', strtotime($model->outgoing_call_date)); ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Name of caller:</label></div><div class="data_sty" style="width:395px;"><span><?= $model->caller_name; ?></span></div>
                                                                                                <div class="label_sty"><label>Gender:</label></div><div class="data_sty" style="width:131px;"><span><?php
                                                                                                                if ($model->caller_gender == '0') {
                                                                                                                        echo 'Male';
                                                                                                                } elseif ($model->caller_gender == '1') {
                                                                                                                        echo 'Female';
                                                                                                                }
                                                                                                                ?></span></div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Referral source:</label></div><div class="data_sty" style="width:572px;"><span><?= $model->referral_source; ?>
                                                                                                                <?php
                                                                                                                if ($model->referral_source != '5') {
                                                                                                                        if ($model->referral_source == '0') {
                                                                                                                                echo 'Internet';
                                                                                                                        } elseif ($model->referral_source == '1') {
                                                                                                                                echo 'Care and care';
                                                                                                                        } elseif ($model->referral_source == '2') {
                                                                                                                                echo 'Guardian Angel';
                                                                                                                        } elseif ($model->referral_source == '3') {
                                                                                                                                echo 'Caremark';
                                                                                                                        } elseif ($model->referral_source == '4') {
                                                                                                                                echo 'Cancure';
                                                                                                                        }
                                                                                                                } else {
                                                                                                                        echo $model->referral_source_others;
                                                                                                                }
                                                                                                                ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">

                                                                                                <div class="label_sty"><label>Mobile:</label></div><div class="data_sty" style="width:165px;"><span><?= $model->mobile_number; ?></span></div>
                                                                                                <div class="label_sty"><label>Mobile 2:</label></div><div class="data_sty" style="width:165px;"><span><?= $model->mobile_number_2; ?></span></div>
                                                                                                <div class="label_sty"><label>Mobile 3:</label></div><div class="data_sty" style="width:174px;"><span><?= $model->mobile_number_3; ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>


                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Address:</label></div><div class="data_sty" style="width:612px;"><span><?= $patient_info_second->address; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>


                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>City:</label></div><div class="data_sty" style="width:160px;"><span><?= $patient_info_second->city; ?></span> </div>
                                                                                                <div class="label_sty"><label>Zip/PC:</label></div><div class="data_sty" style="width:150px;"><span><?= $patient_info_second->zip_pc; ?></span> </div>
                                                                                                <div class="label_sty"><label>Email:</label></div><div class="data_sty" style="width:230px;"><span><?= $patient_info_second->email; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Name of person requiring service:</label></div><div class="data_sty" style="width:290px;"><span><?= $patient_hospital->required_person_name; ?></span></div>
                                                                                                <div class="label_sty"><label>Gender:</label></div><div class="data_sty" ><span><?php
                                                                                                                if ($patient_hospital->patient_gender == '0') {
                                                                                                                        echo 'Male';
                                                                                                                } elseif ($patient_hospital->patient_gender == '1') {
                                                                                                                        echo 'Female';
                                                                                                                }
                                                                                                                ?></span></div>
                                                                                                <?php
                                                                                                if (isset($patient_hospital->patient_age) && $patient_hospital->patient_age != '0000-00-00') {
                                                                                                        $datee = date('d-m-Y', strtotime($patient_hospital->patient_age));
                                                                                                        $age = date_diff(date_create($datee), date_create('today'))->y;
                                                                                                }
                                                                                                ?>
                                                                                                <div class="label_sty"><label>DOB:</label></div><div class="data_sty" ><span><?= date('d-m-Y', strtotime($patient_hospital->patient_age)); ?> <?php
                                                                                                                if (isset($age)) {
                                                                                                                        echo '(' . $age . ')';
                                                                                                                }
                                                                                                                ?></span></div>

                                                                                        </div>
                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Weight:</label></div><div class="data_sty" style="width: 98px;"><span><?= $patient_hospital->patient_weight; ?></span> </div>
                                                                                                <div class="label_sty"><label>Relationship:</label></div><div class="data_sty" style="width: 280px;"><span><?php
                                                                                                                if ($patient_hospital->relationship != '3') {
                                                                                                                        if ($patient_hospital->relationship == '0') {
                                                                                                                                echo 'Spouse';
                                                                                                                        } elseif ($patient_hospital->relationship == '1') {
                                                                                                                                echo 'Parent';
                                                                                                                        } elseif ($patient_hospital->relationship == '2') {
                                                                                                                                echo 'Grandparent';
                                                                                                                        } elseif ($patient_hospital->relationship == '3') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                } else {
                                                                                                                        echo $patient_hospital->relationship_others;
                                                                                                                }
                                                                                                                ?></span> </div>


                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Person Address:</label></div><div class="data_sty" style="width:575px;"><span><?= $patient_hospital->person_address; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Person City:</label></div><div class="data_sty" style="width:140px;"><span><?= $patient_hospital->person_city; ?></span> </div>
                                                                                                <div class="label_sty"><label>Person Postal Code:</label></div><div class="data_sty" style="width:100px;"><span><?= $patient_hospital->person_postal_code; ?></span> </div>
                                                                                                <div class="label_sty"><label>Whatsapp Reply:</label></div><div class="data_sty" style="width:135px;"><span>
                                                                                                                <?php
                                                                                                                if ($patient_info_second->whatsapp_reply == '0') {
                                                                                                                        echo 'No';
                                                                                                                } elseif ($patient_info_second->whatsapp_reply == '1') {
                                                                                                                        echo 'Yes' . $patient_info_second->whatsapp_number;
                                                                                                                }
                                                                                                                ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>



                                                                                        <?php if ($patient_info_second->notes != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Notes:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $patient_info_second->notes; ?></span></div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Hospital:</label></div><div class="data_sty" style="width:200px;"><span>
                                                                                                                <?php
                                                                                                                if (isset($patient_hospital->hospital_name) && $patient_hospital->hospital_name != '') {
                                                                                                                        $hospital_name = Hospital::findOne($patient_hospital->hospital_name);
                                                                                                                        echo $hospital_name->hospital_name;
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span> </div>
                                                                                                <div class="label_sty"><label>Room No:</label></div><div class="data_sty" style="width: 65px;"><span><?= $patient_hospital->hospital_room_no; ?></span> </div>
                                                                                                <div class="label_sty"><label>Consultant Doctor:</label></div><div class="data_sty" style="width:180px;"><span><?= $patient_hospital->consultant_doctor; ?></span> </div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Department:</label></div><div class="data_sty" style="width: 315px;"><span><?= $patient_hospital->department; ?></span> </div>
                                                                                                <div class="label_sty"><label>Hypertension </label></div><div class="data_sty" style="width:205px;"><span><?= $patient_hospital_second->hypertension; ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>


                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Feeding Tube:</label></div><div class="data_sty" style="width: 195px;"><span>
                                                                                                                <?php
                                                                                                                if ($patient_hospital_second->feeding == '0') {
                                                                                                                        echo 'Nasogastric';
                                                                                                                } elseif ($patient_hospital_second->feeding == '1') {
                                                                                                                        echo 'Nasoduodenal';
                                                                                                                } elseif ($patient_hospital_second->feeding == '2') {
                                                                                                                        echo 'Nasojejunal Tubes';
                                                                                                                } elseif ($patient_hospital_second->feeding == '3') {
                                                                                                                        echo 'Gastrostomy';
                                                                                                                } elseif ($patient_hospital_second->feeding == '4') {
                                                                                                                        echo 'Gastrojejunostomy';
                                                                                                                } elseif ($patient_hospital_second->feeding == '5') {
                                                                                                                        echo 'Jejunostomyfeeding tube';
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span> </div>

                                                                                                <div class="label_sty"><label>Urine Tube:</label></div><div class="data_sty" style="width: 140px;"><span>
                                                                                                                <?php
                                                                                                                if ($patient_hospital_second->urine == '0') {
                                                                                                                        echo 'Foleys catheter';
                                                                                                                } elseif ($patient_hospital_second->urine == '1') {
                                                                                                                        echo 'Suprapubic';
                                                                                                                } elseif ($patient_hospital_second->urine == '2') {
                                                                                                                        echo 'Condom catheter';
                                                                                                                }
                                                                                                                ?></span> </div>

                                                                                                <div class="label_sty"><label>IV LINE:</label></div><div class="data_sty" style="width: 125px;"><span><?= $patient_hospital_second->iv_line; ?></span> </div>


                                                                                        </div>
                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">


                                                                                                <div class="label_sty"><label>Oxygen </label></div><div class="data_sty" style="width:130px;"><span>
                                                                                                                <?php
                                                                                                                if ($patient_hospital_second->oxygen == '0') {
                                                                                                                        echo 'No';
                                                                                                                } elseif ($patient_hospital_second->oxygen == '1') {
                                                                                                                        echo 'Yes';
                                                                                                                } elseif ($patient_hospital_second->oxygen == '2') {
                                                                                                                        echo 'Ventilator';
                                                                                                                } elseif ($patient_hospital_second->oxygen == '3') {
                                                                                                                        echo 'BiPAP';
                                                                                                                } elseif ($patient_hospital_second->oxygen == '4') {
                                                                                                                        echo 'SOS';
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span></div>
                                                                                                <div class="label_sty"><label>Tracheostomy </label></div><div class="data_sty" style="width:180px;"><span><?= $patient_hospital_second->tracheostomy; ?></span></div>
                                                                                                <div class="label_sty"><label>Diabetic:</label></div><div class="data_sty" style="width: 170px;"><span>
                                                                                                                <?php
                                                                                                                if ($patient_hospital_second->diabetic == '0') {
                                                                                                                        echo 'No';
                                                                                                                } elseif ($patient_hospital_second->diabetic == '1') {
                                                                                                                        echo 'Yes';
                                                                                                                } elseif ($patient_hospital_second->diabetic == '2') {
                                                                                                                        echo 'Yes,Insulin';
                                                                                                                } elseif ($patient_hospital_second->diabetic == '3') {
                                                                                                                        echo 'Yes, On Tablet';
                                                                                                                } elseif ($patient_hospital_second->diabetic == '4') {
                                                                                                                        echo 'Dont Know';
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span> </div>
                                                                                        </div>


<?php if ($patient_hospital_second->diabetic == '1' && $patient_hospital_second->diabetic_note != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Diabetic Notes:</label></div><div class="data_sty" ><span><?= $patient_hospital_second->diabetic_note; ?></span> </div>
                                                                                                </div>
<?php } ?>

                                                                                        <div style="clear:both"></div>




                                                                                        <div style="clear:both"></div>
<?php if ($patient_hospital_second->family_support != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Nearyby family support:</label></div><div class="data_sty" style="width:538px;"><span><?php
                                                                                                                        if ($patient_hospital_second->family_support == '1') {
                                                                                                                                echo 'Close';
                                                                                                                        } elseif ($patient_hospital_second->family_support == '2') {
                                                                                                                                echo 'Distant';
                                                                                                                        } elseif ($patient_hospital_second->family_support == '3') {
                                                                                                                                echo 'None';
                                                                                                                        }
                                                                                                                        ?></span> </div>

                                                                                                </div>
<?php } ?>

                                                                                        <div style="clear:both"></div>

<?php if ($patient_hospital_second->family_support_note != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty" ><label>Nearyby family support Note: </label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $patient_hospital_second->family_support_note; ?></span></div>
                                                                                                </div>
<?php } ?>

                                                                                        <div style="clear:both"></div>

<?php if ($patient_hospital_second->care_currently_provided != '4' && $patient_hospital_second->care_currently_provided != '') { ?>
                                                                                                <div class="content">

                                                                                                        <div class="label_sty"><label>Care currently being provided:</label></div><div class="data_sty"><span><?php
                                                                                                                        if ($patient_hospital_second->care_currently_provided == '1') {
                                                                                                                                echo 'Family';
                                                                                                                        } elseif ($patient_hospital_second->care_currently_provided == '2') {
                                                                                                                                echo 'Friends';
                                                                                                                        } elseif ($patient_hospital_second->care_currently_provided == '3') {
                                                                                                                                echo 'Hospital';
                                                                                                                        } elseif ($patient_hospital_second->care_currently_provided == '4') {
                                                                                                                                echo 'Others';
                                                                                                                        }
                                                                                                                        ?></span> </div>
        <?php if ($patient_hospital_second->care_currently_provided == '3') { ?>       <div class="label_sty"><label>Expected Date Of Discharge</label></div><div class="data_sty" style="width:230px"><span><?= $date = date('d-m-Y', strtotime($patient_hospital_second->date_of_discharge)); ?></span></div><?php } ?>


                                                                                                </div>
                                                                                                <?php
                                                                                        } else {
                                                                                                if ($patient_hospital_second->care_currently_provided_others != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Care currently being provided:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $patient_hospital_second->care_currently_provided_others; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>
<?php if ($patient_hospital_second->details_of_current_care != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Details Of Current Care:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $patient_hospital_second->details_of_current_care; ?></span></div>
                                                                                                </div>
<?php } ?>



<?php if ($patient_hospital_second->difficulty_in_movement != '5' && $patient_hospital_second->difficulty_in_movement != '') { ?>

                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Difficulty in movement:</label></div><div class="data_sty" style="width:540px;"><span>
                                                                                                                        <?php
                                                                                                                        if ($patient_hospital_second->difficulty_in_movement == '1') {
                                                                                                                                echo 'No difficulty';
                                                                                                                        } elseif ($patient_hospital_second->difficulty_in_movement == '2') {
                                                                                                                                echo 'Assistance required';
                                                                                                                        } elseif ($patient_hospital_second->difficulty_in_movement == '3') {
                                                                                                                                echo 'Wheelchair';
                                                                                                                        } elseif ($patient_hospital_second->difficulty_in_movement == '4') {
                                                                                                                                echo 'Bedridden';
                                                                                                                        } elseif ($patient_hospital_second->difficulty_in_movement == '5') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                        ?></span> </div>
                                                                                                </div>

                                                                                                <?php
                                                                                        } else {
                                                                                                if ($patient_hospital_second->difficulty_in_movement_other != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Difficulty in movement:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $patient_hospital_second->difficulty_in_movement_other; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>


                                                                                        <div style="clear:both"></div>

<?php if ($patient_info_second->service_required != '5' && $patient_info_second->service_required != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Service Required:</label></div><div class="data_sty" style="width:565px;"><span>
                                                                                                                        <?php
                                                                                                                        if ($patient_info_second->service_required == '1') {
                                                                                                                                echo 'Immediately';
                                                                                                                        } elseif ($patient_info_second->service_required == '2') {
                                                                                                                                echo 'Couple weeks';
                                                                                                                        } elseif ($patient_info_second->service_required == '3') {
                                                                                                                                echo 'Month';
                                                                                                                        } elseif ($patient_info_second->service_required == '4') {
                                                                                                                                echo 'Unsure';
                                                                                                                        } elseif ($patient_info_second->service_required == '5') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                        ?></span> </div>
                                                                                                </div>
                                                                                                <?php
                                                                                        } else {
                                                                                                if ($patient_info_second->service_required_other != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Service Required:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold"> <?= $patient_info_second->service_required_other; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                        </div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Expected Date Of Service Needed:</label></div><div class="data_sty" ><span> <?= $date = date('d-m-Y', strtotime($patient_info_second->expected_date_of_service)); ?></span></div>
                                                                                                <div class="label_sty"><label>How Long Service Required:</label></div><div class="data_sty" style="width:200px;"><span> <?= $patient_info_second->how_long_service_required; ?></span></div>



                                                                                        </div>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Priority:</label></div><div class="data_sty" style="width:615px;"><span> <?php
                                                                                                                if ($patient_info_second->priority == '1') {
                                                                                                                        echo 'Hot';
                                                                                                                } elseif ($patient_info_second->priority == '2') {
                                                                                                                        echo 'Warm';
                                                                                                                } elseif ($patient_info_second->priority == '3') {
                                                                                                                        echo 'Cold';
                                                                                                                }
                                                                                                                ?></span></div>
                                                                                        </div>



<?php if ($patient_info_second->quotation_details != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Quotation Details:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $patient_info_second->quotation_details; ?></span></div>
                                                                                                </div>
<?php } ?>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Data Entered By:</label></div><div class="data_sty" style="width:200px;">
                                                                                                        <span>
                                                                                                                <?php
                                                                                                                $data_entered = AdminUsers::findOne($model->CB);
                                                                                                                ?>
<?= $data_entered->name; ?>
                                                                                                        </span></div>
                                                                                                <div class="label_sty"><label>Data Entered On:</label></div><div class="data_sty" style="width:200px;">
                                                                                                        <span>
<?= date('d-m-Y', strtotime($model->DOC)); ?>
                                                                                                        </span></div>
                                                                                        </div>
                                                                                        </div>




                                                                                </td>

                                                                        </tr>





                                                                </tbody>


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
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


