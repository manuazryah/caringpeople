<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use yii\db\Expression;


$this->title = 'Staff Report  ( '.date('d-m-Y', strtotime($from)).' to '.date('d-m-Y', strtotime($to)).' )';

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
                                <div class="panel-body"><div class="attendance-create">




                                                <div style="clear:both"></div>
                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($designations) && $designations != '') { ?>


                                                        <div class = "table-responsive">
                                                                <table class = "table table-striped">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>STAFF TYPE</th>
                                                                        <th>AMOUNT</th>
                                                                        <?php
                                                                        ?>
                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $total_amount = 0;
                                                                                $k = 0;
                                                                                $staffs = StaffInfo::find()->where(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => 1])->orWhere(new Expression('FIND_IN_SET(:designations, designation)'))->addParams([':designations' => 2])->andWhere(['branch_id' => $branch])->all();

                                                                                $k++;
                                                                                foreach ($staffs as $values) {
                                                                                        $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $values->id])->andWhere(['>=', 'date', date('Y-m-d', strtotime($from))])->andWhere(['<=', 'date', date('Y-m-d', strtotime($to))])->all();
                                                                                        foreach ($staff_schedules as $staff_schedules) {
                                                                                                $amount += $staff_schedules->rate;
                                                                                        }
                                                                                }
                                                                                $total_amount += $amount;
                                                                                ?>
                                                                                <tr>
                                                                                        <td><?= $k; ?></td>
                                                                                        <td><?= 'Caregiver Staff' ?></td>
                                                                                        <td><?= 'Rs. ' . Yii::$app->NumToWord->NumberFormat($amount) . '/-'; ?></td>


                                                                                </tr>

                                                                                <?php
                                                                                foreach ($designations as $value) {

                                                                                        if ($value->id != 1 && $value->id != 2) {

                                                                                                $k++;
                                                                                                $staffs = StaffInfo::find()->where(['branch_id' => $branch])->andWhere(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $value->id])->all();
                                                                                                $amount = 0;
                                                                                                foreach ($staffs as $values) {
                                                                                                        $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $values->id])->andWhere(['>=', 'date', date('Y-m-d', strtotime($from))])->andWhere(['<=', 'date', date('Y-m-d', strtotime($to))])->all();
                                                                                                        foreach ($staff_schedules as $staff_schedules) {
                                                                                                                $amount += $staff_schedules->rate;
                                                                                                        }
                                                                                                }
                                                                                                $total_amount += $amount;
                                                                                                ?>
                                                                                                <tr>
                                                                                                        <td><?= $k; ?></td>
                                                                                                        <td><?= $value->title; ?></td>
                                                                                                        <td><?= 'Rs. ' . Yii::$app->NumToWord->NumberFormat($amount) . '/-'; ?></td>

                                                                                                </tr>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>

                                                                                <tr>
                                                                                        <td colspan="2" style="text-align: center;"><b>Total</b></td>
                                                                                        <td><b><?= 'Rs. ' . Yii::$app->NumToWord->NumberFormat($total_amount) . ' /-' ?></b></td>
                                                                                        <td></td>
                                                                                </tr>

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->date) && $model->date != '') {
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

