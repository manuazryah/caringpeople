<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Religion;
use common\models\Nationality;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = $patient_details->first_name;
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
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Patients</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="staff-info-view">
                                                <div id="pdf" class="table-responsive">


                                                        <style type="text/css">

                                                                @media print {
                                                                        thead {display: table-header-group;}
                                                                        .table th{ background-color: rgba(155, 156, 157, 0.5);}
                                                                        .cbr-replaced.cbr-checked span {
                                                                                background-image: url(../../images/ok.png);
                                                                                list-style-position: inside;
                                                                        }
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
                                                                        /* border: .1px solid #969696;*/
                                                                        border-collapse: collapse;
                                                                        margin: auto;
                                                                        color:#000;

                                                                }
                                                                .table th {
                                                                        border: .1px solid #969696;
                                                                        color: #525252;
                                                                        font-weight: bold;
                                                                        background-color: #fff !important;
                                                                }
                                                                .table td {
                                                                        border: 1px solid #969696;
                                                                        font-size: 12px;
                                                                        text-align: center;
                                                                        padding: 3px;
                                                                }
                                                                .table1 td{
                                                                        border: 0px solid #969696;

                                                                }
                                                                .table p{
                                                                        color:#000;
                                                                        font-size: 12px;
                                                                        font-weight: normal;
                                                                }
                                                                .header{
                                                                        font-size: 12.5px;
                                                                        display: inline-block;
                                                                        width: 100%;
                                                                        height: 110px;
                                                                }
                                                                .main-left{
                                                                        float: left;
                                                                        font-size: 13px;
                                                                }
                                                                .heading{
                                                                        font-size: 16px;
                                                                        font-weight: bold;
                                                                }
                                                                .label_sty{
                                                                        float: left;
                                                                        font-size:14px;
                                                                }
                                                                .data_sty{
                                                                        float: left;
                                                                        padding: 0px 18px;
                                                                        border-bottom: 1px dotted black;
                                                                        font-weight: bold;
                                                                        margin-left: 10px;
                                                                        text-align: center;
                                                                        min-height: 30px;
                                                                }
                                                                .education .label_sty{
                                                                        text-align: center;
                                                                }
                                                                .break { page-break-before: always; }






                                                        </style>

                                                        <table class="main-tabl table table-responsive" border="0"  style="line-height:30px;">

                                                                <tr>
                                                                        <td>
                                                                                <table class="table1">
                                                                                        <tr>
                                                                                                <td>
                                                                                                        <div class="main-left">
                                                                                                                <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-1.png" style="width:250px;"/>
                                                                                                        </div>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <div class="main-left" style="width:225px;margin-left: 25px;text-align: justify;">
                                                                                                                Door No.5 DD Vyapar Bhavan <br>
                                                                                                                K.P Vallon Road, Kavandthra Jn<br>
                                                                                                                <b>Kochi-20 | </b>Tel:0484 4033505<br>

                                                                                                        </div>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <div class="main-left" style="width:230px;text-align: right;">
                                                                                                                Shop No 16, Brindavan Co-op Housing <br>
                                                                                                                Evershine Nagar, Malad West<br>
                                                                                                                <b>Mumbai -40064 |</b> Tel:022 40 111 351<br>

                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                                <td></td>
                                                                                                <td colspan="2">
                                                                                                        <div class="main-left" style="margin-left:25px;">
                                                                                                                www.caringpeople.in <b>|</b> Email :info@caringpeople.in <b>|</b> Helpline No: 90 20 599 599
                                                                                                        </div>

                                                                                                </td>
                                                                                        </tr>
                                                                                </table>
                                                                        </td>


                                                                </tr>



                                                                <tbody>

                                                                        <tr>
                                                                                <td style="padding-top:25px;">
                                                                                        <div class="heading">PATIENT REGISTRAION FORM</div>
                                                                                </td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">FOR GUARDIAN</div>
                                                                                                        </td>
                                                                                                </tr>



                                                                                                <tr>
                                                                                                        <td width="80%">

                                                                                                                <div class="content" style="">
                                                                                                                        <div class="label_sty">
                                                                                                                                Name:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 300px;text-transform: uppercase;">
                                                                                                                                <?= $guardian_details->first_name . ' ' . $guardian_details->last_name; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <?php if ($guardian_details->guardian_profile_image != '') { ?>
                                                                                                                <td>
                                                                                                                        <div class="view-profile_image">
                                                                                                                                <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_details->id . '/guardian_profile_image.' . $guardian_details->guardian_profile_image; ?> "/>
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Sex :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 250px;">
                                                                                                                                <?php
                                                                                                                                if ($guardian_details->gender == 0)
                                                                                                                                        echo "Male";
                                                                                                                                elseif ($guardian_details->gender == 1) {
                                                                                                                                        echo "Female";
                                                                                                                                } else {
                                                                                                                                        echo "";
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                ID Card/Passport No:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 170px;">
                                                                                                                                <?= $guardian_details->id_card_or_passport_no; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Religion:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 250px;">
                                                                                                                                <?php
                                                                                                                                if (isset($guardian_details->religion) && $guardian_details->religion != '') {
                                                                                                                                        $religion = Religion::findOne($guardian_details->religion);
                                                                                                                                        echo $religion->religion;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Nationality:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 170px;">
                                                                                                                                <?php
                                                                                                                                if (isset($guardian_details->nationality) && $guardian_details->nationality != '') {
                                                                                                                                        $nationality = Nationality::findOne($guardian_details->nationality);
                                                                                                                                        echo $nationality->nationality;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>




                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Occupation:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:595px;">
                                                                                                                                <?= $guardian_details->occupatiion; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Permanent Address:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:595px;">
                                                                                                                                <?= $guardian_details->permanent_address; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Pincode:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $guardian_details->pincode; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Landmark:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $guardian_details->landmark; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Contact Number:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 224px;">
                                                                                                                                <?= $guardian_details->contact_number; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Email:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $guardian_details->email; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Adhar Card No:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:595px;">
                                                                                                                                <?= $guardian_details->adhar_card_no; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Copy Of Proof :
                                                                                                                        </div>

                                                                                                                        <div class="">
                                                                                                                                <input  type="checkbox"  <?= !empty($guardian_details->passport) ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                                <span class="checkboxtext">
                                                                                                                                        Passport
                                                                                                                                </span>
                                                                                                                                <input  type="checkbox"  <?= !empty($guardian_details->driving_license) ? "checked" : "" ?> disabled="disabled" />
                                                                                                                                <span class="checkboxtext">
                                                                                                                                        Driving Licence
                                                                                                                                </span>
                                                                                                                                <input  type="checkbox"  <?= !empty($guardian_details->pan_card) ? "checked" : "" ?> disabled="disabled" />
                                                                                                                                <span class="checkboxtext">
                                                                                                                                        Pan Card
                                                                                                                                </span>
                                                                                                                                <input  type="checkbox"  <?= !empty($guardian_details->voters_id) ? "checked" : "" ?> disabled="disabled" />
                                                                                                                                <span class="checkboxtext">
                                                                                                                                        Voters ID
                                                                                                                                </span>

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                        </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">Patient Details</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td width="80%">

                                                                                                                <div class="content" style="">
                                                                                                                        <div class="label_sty">
                                                                                                                                Name:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 415px;text-transform: uppercase;">
                                                                                                                                <?= $patient_details->first_name . ' ' . $patient_details->last_name; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <?php if ($patient_details->patient_image != '') { ?>
                                                                                                                <td>
                                                                                                                        <div class="view-profile_image">
                                                                                                                                <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_details->id . '/patient_image.' . $patient_details->patient_image; ?> "/>
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 33%;float: left">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Sex :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 170px;">
                                                                                                                                <?php
                                                                                                                                if ($patient_details->gender == 0)
                                                                                                                                        echo "Male";
                                                                                                                                elseif ($patient_details->gender == 1) {
                                                                                                                                        echo "Female";
                                                                                                                                } else {
                                                                                                                                        echo "";
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <?php
                                                                                                                if (isset($patient_details->age) && $patient_details->age != '0000-00-00') {
                                                                                                                        $datee = date('d-m-Y', strtotime($patient_details->age));
                                                                                                                        $age = date_diff(date_create($datee), date_create('today'))->y;
                                                                                                                }
                                                                                                                ?>
                                                                                                                <div class="content" style="width: 33%;float: right">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Age :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 170px;">
                                                                                                                                <?= date('d-m-Y', strtotime($patient_details->age)); ?>
                                                                                                                                <?php
                                                                                                                                if (isset($age)) {
                                                                                                                                        echo '(' . $age . ')';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 33%;float: right">
                                                                                                                        <div class="label_sty" style="width: auto;">
                                                                                                                                Weight :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 170px;">
                                                                                                                                <?= $patient_details->weight; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>





                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Present Address:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:595px;">
                                                                                                                                <?= $patient_details->present_address; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Pincode:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $patient_details->pin_code; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Landmark:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $patient_details->landmark; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Contact Number:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 224px;">
                                                                                                                                <?= $patient_details->contact_number; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Email:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $patient_details->email; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>




                                                                                        </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">CHRONIC OR RECURRING( CHECK ALL THAT APPLY)</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->asthma == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Asthma
                                                                                                                        </span>

                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->cardiac == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Cardiac
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->emotional_behaviour_disturbance == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Emotional Behaviour Disturbance
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->bleeding_disorders == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Bleeding Disorders
                                                                                                                        </span>

                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->urinary_infection == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Urinary Infection
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->vision_contacts == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Vision-Contacts/Glasses
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->convolutions == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Convolutions/Seizures
                                                                                                                        </span>

                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->syncope == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Syncope
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->teeth_dentures == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Teeth Dentures/bridges
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->ear_infection == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Ear Infection
                                                                                                                        </span>

                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->psychiatry == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Psychiatry
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                        <td> <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->Other == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Other
                                                                                                                        </span>


                                                                                                                </div></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Others(specify):
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:580px;text-align: left">
                                                                                                                                <?= $chronic_imformation->othersspecify; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->diabetic == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Diabetic
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Since :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $chronic_imformation->diabetic_since ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Medication :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $chronic_imformation->diabetic_medication ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->hypertension == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Hypertension
                                                                                                                        </span>



                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Since :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $chronic_imformation->hypertension_since ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Medication :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $chronic_imformation->hypertension_medication ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->allergy == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Allergy
                                                                                                                        </span>


                                                                                                                </div>
                                                                                                        </td>



                                                                                                        <td colspan="5">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 50px;">
                                                                                                                                Specify
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 458px;">
                                                                                                                                <?= $chronic_imformation->allergy_specify ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>



                                                                                                </tr>
                                                                                                <tr>

                                                                                                        <td><span style="font-size: 16px;
                                                                                                                  font-weight: 700;">Serology</span>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2"> <div class="content">
                                                                                                                        <label style="padding-left: 64px"><input type="radio" <?= $chronic_imformation->serology == 1 ? "checked" : "" ?>> HIV</label>
                                                                                                                        <label style=""><input type="radio" <?= $chronic_imformation->serology == 2 ? "checked" : "" ?>> HCV</label>
                                                                                                                        <label style=""><input type="radio" <?= $chronic_imformation->serology == 3 ? "checked" : "" ?>> VDRL</label>
                                                                                                                        <label style=""><input type="radio" <?= $chronic_imformation->serology == 4 ? "checked" : "" ?>> HBsAg</label>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td >
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 50px;">
                                                                                                                                Specify
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:250px">
                                                                                                                                <?= $chronic_imformation->serology_specify ?>
                                                                                                                        </div>


                                                                                                                </div>

                                                                                                        </td>




                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->psychiatry_disease == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Psychiatry
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $chronic_imformation->communicable_disease == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Communicable Disease
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Others(Specify)
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:580px">
                                                                                                                                <?= $chronic_imformation->others_specify ?>
                                                                                                                        </div>


                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Any History Of Surgery:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?php
                                                                                                                                if ($chronic_imformation->history_of_surgery == 1)
                                                                                                                                        echo "Yes";
                                                                                                                                elseif ($chronic_imformation->history_of_surgery == 2) {
                                                                                                                                        echo "No";
                                                                                                                                } else {
                                                                                                                                        echo "";
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>


                                                                                                        </td>



                                                                                                </tr>

                                                                                                <tr>

                                                                                                        <td colspan="6">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                If any Specify:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:450px">
                                                                                                                                <?= $chronic_imformation->specify_surgery_details ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Name Of Doctor:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->name_of_doctor_1 ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Mob:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->doctor1_mob ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Name Of Hospital:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->name_of_hospital_1 ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Ph.NO:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->hospital1_phone_no ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Name Of Doctor:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->name_of_doctor_2 ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Mob:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->doctor2_mob ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Name Of Hospital:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->name_of_hospital_2 ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Ph.NO:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $chronic_imformation->hospital2_phone_no ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>

                                                                                        </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:center;">PRESENT MEDICATION</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                        </table>
                                                                                        <table class="border table">
                                                                                                <thead>
                                                                                                <th>
                                                                                                        Sl.No
                                                                                                </th>
                                                                                                <th>
                                                                                                        Tablet/Injection
                                                                                                </th>
                                                                                                <th>
                                                                                                        Medicine Name
                                                                                                </th>
                                                                                                <th>
                                                                                                        Dosage
                                                                                                </th>
                                                                                                <th>
                                                                                                        Mode
                                                                                                </th>
                                                                                                <th>
                                                                                                        Since
                                                                                                </th>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                        <?php
                                                                                                        $i = 1;
                                                                                                        foreach ($pationt_medication_details as $medications) {
                                                                                                                ?>
                                                                                                                <tr>

                                                                                                                        <td><?= $i ?></td>
                                                                                                                        <td><?php
                                                                                                                                if ($medications->tablet_injection == 0)
                                                                                                                                        echo "Tablet";
                                                                                                                                elseif ($medications->tablet_injection == 1) {
                                                                                                                                        echo "Injection";
                                                                                                                                }
                                                                                                                                ?></td>
                                                                                                                        <td><?= $medications->medicine_name; ?></td>
                                                                                                                        <td><?= $medications->dosage; ?></td>
                                                                                                                        <td><?= $medications->mode; ?></td>
                                                                                                                        <td><?= $medications->since; ?></td>
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                                $i++;
                                                                                                        }
                                                                                                        ?>

                                                                                                </tbody>

                                                                                        </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">PRESENT CONDITION</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Diagnosis:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:580px;">
                                                                                                                                <?= $present_condition->diagnosis; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->paralised_or_bedridden == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Paralised/Bedridden
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 50px;">
                                                                                                                                Specify
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $present_condition->paralised_specify ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->ryles_tube_or_feeding_tube == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Ryles Tube/ Feeding Tube
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Tube Size :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $present_condition->tube_size ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Last Change Date :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $present_condition->last_change_date ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->iv_cannula == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                IV/Cannula
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 50px;">
                                                                                                                                Specify
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $present_condition->specify ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->foleys_cath_or_urine_tube == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Foley's Cath/Urine Tube
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td><div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Tube No :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:70px">
                                                                                                                                <?= $present_condition->tube_no ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Type :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:100px">
                                                                                                                                <?= $present_condition->foleys_tube_type ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Last Change Date :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $present_condition->foleys_last_change_date ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->bladder_wash == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Bladder Wash
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">

                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $present_condition->bladder_wash_data ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Cath Care:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $present_condition->cath_care ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <input  type="checkbox"  <?= $present_condition->bed_sore == 1 ? "checked" : "" ?> disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Bed Sore
                                                                                                                        </span>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Others(if Others Specify)
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?= $present_condition->specify ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>







                                                                                        </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">BYSTANDER/ CARE GIVER SERVICE</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Service Required For:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if (!empty($bystander_details->service_need_for)) {
                                                                                                                                        $service_datas = explode(',', $bystander_details->service_need_for);


                                                                                                                                        foreach ($service_datas as $data) {
                                                                                                                                                if ($data == 1)
                                                                                                                                                        $service_result = 'Home';
                                                                                                                                                elseif ($data == 2) {
                                                                                                                                                        if (!empty($service_result))
                                                                                                                                                                $service_result = $service_result . ', Hospital';
                                                                                                                                                        else
                                                                                                                                                                $service_result = 'Hospital';
                                                                                                                                                }
                                                                                                                                        }
                                                                                                                                        echo $service_result;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Name of Hospital:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?= $bystander_details->hospital_name ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 70px;">
                                                                                                                                Room No:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $bystander_details->room_no ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Consulting Doctor:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?= $bystander_details->consulting_doctor ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                No. of days:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?= $bystander_details->no_of_days ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 70px;">
                                                                                                                                Mode:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 150px;">
                                                                                                                                <?= $bystander_details->mode ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                I can provide:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if (!empty($bystander_details->can_provide)) {
                                                                                                                                        $datas = explode(',', $bystander_details->can_provide);


                                                                                                                                        foreach ($datas as $data) {
                                                                                                                                                if ($data == 1)
                                                                                                                                                        $result = 'Food';
                                                                                                                                                elseif ($data == 2) {
                                                                                                                                                        if (!empty($result))
                                                                                                                                                                $result = $result . ', accomodation';
                                                                                                                                                        else
                                                                                                                                                                $result = 'accomodation';
                                                                                                                                                } elseif ($data == 3) {
                                                                                                                                                        if (!empty($result))
                                                                                                                                                                $result = $result . ', transportaion';
                                                                                                                                                        else
                                                                                                                                                                $result = 'transportaion';
                                                                                                                                                }
                                                                                                                                        }
                                                                                                                                        echo $result;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>


                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                        </table>
                                                                                </td>
                                                                        </tr>


                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">PATIET ASSESSMENT</div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Patient's Condition:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if ($assessment->patient_condition == 1) {
                                                                                                                                        echo 'Mobile';
                                                                                                                                } else if ($assessment->patient_condition == 2) {
                                                                                                                                        echo 'Bedridden';
                                                                                                                                } else if ($assessment->patient_condition == 3) {
                                                                                                                                        echo 'Semi Bedridden';
                                                                                                                                }
                                                                                                                                echo ' , ';

                                                                                                                                if ($assessment->patient_conscious == 4) {
                                                                                                                                        echo 'Conscious';
                                                                                                                                } else if ($assessment->patient_conscious == 5) {
                                                                                                                                        echo 'UnConscious';
                                                                                                                                } else if ($assessment->patient_conscious == 6) {
                                                                                                                                        echo 'Semi Conscious';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>


                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Medical Procedures:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if (isset($assessment->patient_medical_procedures) && $assessment->patient_medical_procedures != '') {
                                                                                                                                        $procedures = explode(',', $assessment->patient_medical_procedures);
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
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>


                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Suggested Home Care Professional:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if (isset($assessment->suggested_professional) && $assessment->suggested_professional != '') {
                                                                                                                                        $suggest = explode(',', $assessment->suggested_professional);
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
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Notes :
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width: 300px;">
                                                                                                                                <?php
                                                                                                                                if (isset($assessment->other_notes) && $assessment->other_notes != '') {
                                                                                                                                        echo $assessment->other_notes;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                        </table>
                                                                                </td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">CONSENT</div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>

                                                                                                                <p class="patient_consent">I hereby agree that, I had consented for the Nursing Care/ Doctor Visit/ Physiotherapy /
                                                                                                                        Companion Service / Care Giver service on behalf of my  .............................(Relationship).
                                                                                                                        I hereby agree to get service from Caring People. I appreciate the care rendered by the Caring People staff
                                                                                                                        and acknowledge that the care given was holistic and satisfactory.
                                                                                                                </p>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Place:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Name:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>


                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Date:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Sign:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>


                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Relationship to Patient:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>


                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 200px;">
                                                                                                                                How did you hear about us:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>


                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <input  type="checkbox"  disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Friends
                                                                                                                        </span>
                                                                                                                        <input  type="checkbox"  disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Media
                                                                                                                        </span>
                                                                                                                        <input  type="checkbox"  disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Add
                                                                                                                        </span>
                                                                                                                        <input  type="checkbox"  disabled="disabled"/>
                                                                                                                        <span class="checkboxtext">
                                                                                                                                Other(Specify).............................................................
                                                                                                                        </span>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty" style="width: 550px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>


                                                                                        </table>
                                                                                </td>
                                                                        </tr>









                                                                </tbody>


                                                        </table>

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

                                                </div>

                                                <?php if (isset($guardian_details->passport) && $guardian_details->passport != '') { ?>
                                                        <div class="row">
                                                                <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
                                                        </div>
                                                        <div class="col-md-3" >
                                                                <?php
                                                                $images = array('passport');
                                                                $i = 0;

                                                                foreach ($images as $value) {
                                                                        if ($guardian_details->$value != '') {
                                                                                $i++;
                                                                                ?>

                                                                                <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_details->id . '/' . $value . '.' . $guardian_details->$value; ?> " style="width:100px;height: 100px;"/>
                                                                                </br><span style="font-size: 12px;"><?= $guardian_details->getAttributeLabel($value); ?></span>

                                                                                <?php
                                                                        }
                                                                }
                                                                ?>
                                                        </div>
                                                <?php } ?>


                                                <div class="print">
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


