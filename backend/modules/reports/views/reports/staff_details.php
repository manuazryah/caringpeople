<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use kartik\export\ExportMenu;
use yii\helpers\Url;

$this->title = 'Staff Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body">
                                        <div class="attendance-create">

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->


                                                <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts1" >

                                                                <div class="col-md-6">

                                                                        <p>Staff Id:
                                                                                <span><?php
                                                                                        if (isset($staff) && $staff != '') {
                                                                                                $staff_details = StaffInfo::findOne($staff);
                                                                                                echo $staff_details->staff_id;
                                                                                        }
                                                                                        ?>
                                                                                </span>
                                                                        </p>

                                                                        <p>Staff Name:
                                                                                <span><?php
                                                                                        if (isset($staff) && $staff != '') {
                                                                                                $staff_details = StaffInfo::findOne($staff);
                                                                                                echo $staff_details->staff_name;
                                                                                        }
                                                                                        ?>
                                                                                </span>
                                                                        </p>

                                                                        <br>
                                                                        <p> Total Amount : <span><?= 'Rs. ' . $staff_amount . ' /-' ?></span></p>

                                                                        <label style="font-size:12px;margin-top:15px;color: #000;margin-left: 15px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                                                </div>
                                                        </div>




                                                </div>
                                                <?php if ($type != 1) { ?>
                                                        <a target="_blank" href="<?= Yii::$app->homeUrl ?>reports/reports/staffdetailsprint?from=<?= $from ?>&&to=<?= $to ?>&&staff=<?= $staff ?>"><button  class="print_btn print_btn_color"><i class="fa fa-print"></i>  Save as PDF</button></a>
                                                <?php } ?>



                                                <table class="table table-bordered table-striped" style="margin-top:20px;">
                                                        <tr>
                                                                <th style="width:100px!important;">#</th>
                                                                <th>Date</th>
                                                                <th>Service ID</th>
                                                                <th>Patient</th>
                                                                <th>Rate</th>
                                                        </tr>
                                                        <?php
                                                        $from = date('Y-m-d', strtotime($from . ' - 1 days'));
                                                        $date = $from;
                                                        $end_date = $to;
                                                        $f = 0;
                                                        while (strtotime($date) < strtotime($end_date)) {


                                                                $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
                                                                $details = \common\models\ServiceSchedule::find()->where(['date' => $date, 'staff' => $staff])->all();
                                                                if (count($details) > 0) {
                                                                        foreach ($details as $details) {
                                                                                $f++;

                                                                                $service_details = \common\models\Service::findOne($details->service_id);
                                                                                $patient = \common\models\PatientGeneral::findOne($details->patient_id);
                                                                                ?>
                                                                                <tr>
                                                                                        <td><?= $f ?></td>
                                                                                        <td><?= date('d-m-Y', strtotime($date)) ?></td>
                                                                                        <td><?php
                                                                                                if (isset($service_details->service_id)) {
                                                                                                        echo $service_details->service_id;
                                                                                                } else {
                                                                                                        echo '-';
                                                                                                }
                                                                                                ?></td>
                                                                                        <td><?php
                                                                                                if (isset($patient->first_name)) {
                                                                                                        echo $patient->first_name;
                                                                                                } else {
                                                                                                        echo '-';
                                                                                                }
                                                                                                ?></td>
                                                                                        <td><?php
                                                                                                if (isset($details->rate)) {
                                                                                                        echo $details->rate;
                                                                                                } else {
                                                                                                        echo '-';
                                                                                                }
                                                                                                ?>

                                                                                        </td>
                                                                                </tr>
                                                                                <?php
                                                                        }
                                                                } else {
                                                                        $f++;
                                                                        ?>
                                                                        <tr>
                                                                                <td><?= $f ?></td>
                                                                                <td><?= date('d-m-Y', strtotime($date)) ?></td>
                                                                                <td><?php
                                                                                        echo '-';
                                                                                        ?></td>
                                                                                <td><?php
                                                                                        echo '-';
                                                                                        ?></td>
                                                                                <td><?php
                                                                                        echo '-';
                                                                                        ?>

                                                                                </td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                        }
                                                        ?>

                                                </table>





                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>

<?php if ($type != 1) { ?>
        <style>

                table td{
                        text-align:center;

                }
                table th{
                        text-align:center;
                        width:230px !important;
                }.print_btn{
                        font-weight: bold !important;
                        color: #fff;
                        border-color: #80b636;
                        cursor: pointer;
                        border: 1px solid transparent;
                        padding: 6px 12px;
                        font-size: 13px;
                        line-height: 1.42857143;
                } .print_btn_color{
                        background-color: #8dc63f;
                }
        </style>
<?php } ?>