<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;

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
                                                <?php if (!empty($schedules) && $schedules != '') { ?>

                                                        <div class="row">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts1" >

                                                                        <div class="col-md-6">
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


                                                        <div class = "table-responsive">

                                                                <table class = "table table-striped">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>DATE</th>
                                                                        <th>SERVICE</th>
                                                                        <th>PATIENT NAME</th>
                                                                        <th>RATE</th>



                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $k = 0;
                                                                                $total_amount = 0;
                                                                                foreach ($schedules as $value) {
                                                                                        $k++;
                                                                                        $total_amount += $value->rate;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>
                                                                                                <td><?= date('d-m-Y', strtotime($value->date)) ?></td>
                                                                                                <?php $service = common\models\Service::findOne($value->service_id) ?>
                                                                                                <td><?= $service->service_id ?></td>
                                                                                                <td><?php
                                                                                                        if (isset($value->patient_id) && $value->patient_id != '') {
                                                                                                                $patient = common\models\PatientGeneral::findOne($value->patient_id);
                                                                                                                echo $patient->first_name;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->rate) && $value->rate != '') {
                                                                                                                echo $value->rate;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>


                                                                                        </tr>
                                                                                <?php } ?>

        <!--                                                                                <tr>
                                                                                                <td colspan="4" style="text-align: center"><b>Total</b></td>
                                                                                                <td><b><?= 'Rs. ' . $total_amount . ' /-' ?></b></td>
                                                                                        </tr>-->

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->staff) && $model->staff != '') {
                                                                echo '<p class="no-result">No results found !!</p>';
                                                        }
                                                }
                                                ?>



                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>

        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1 p{
                margin-left: 20px;
                color: #000;
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>