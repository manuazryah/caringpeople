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
                                                <?php if (!empty($staffs) && $staffs != '') { ?>


                                                        <div class="counts1" >
                                                                <p style="font-size:14px;margin:0;text-transform: uppercase">
                                                                        <span><?php
                                                                                if (isset($type) && $type != '') {
                                                                                        $type_details = common\models\MasterDesignations::findOne($type);
                                                                                        echo $type_details->title . '  Details';
                                                                                }
                                                                                ?></span>
                                                                        <br>
                                                                        <label style="font-size:12px;margin-top:5px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                                                </p>
                                                        </div>





                                                        <div class = "table-responsive">
                                                            
                                                                <table class = "table table-striped">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>STAFF</th>
                                                                        <th>AMOUNT</th>
                                                                        <th></th>


                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $l = 0;
                                                                                foreach ($staffs as $value) {

                                                                                        $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $value->id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                                                                                        $amount = 0;
                                                                                        foreach ($staff_schedules as $staff_schedules) {
                                                                                                $amount += $staff_schedules->rate;
                                                                                        }
                                                                                        if ($amount > 0) {
                                                                                                $l++;
                                                                                                ?>
                                                                                                <tr>
                                                                                                        <td><?= $l; ?></td>
                                                                                                        <?php $staff = StaffInfo::findOne($value->id); ?>
                                                                                                        <td><?= $staff->staff_name; ?></td>
                                                                                                        <td><?= $amount ?></td>
                                                                                                        <td><button class="btn btn-info"><a target="_blank" href="<?= Yii::$app->homeUrl ?>attendance/attendance/staffdetails?from=<?= $from ?>&to=<?= $to ?>&staff=<?= $value->id ?>" style="color: #FFF">View Details</a></button></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                        }
                                                                                     $total_amount += $amount;
                                                                                }
                                                                                ?>
                                                                                

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
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>