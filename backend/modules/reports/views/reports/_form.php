<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffLeave;

/* @var $this yii\web\View */
/* @var $model common\models\Attendance */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="attendance-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-attendance-date">
                        <label class="control-label" for="attendance-date">Date</label>
                        <?php
                        if (isset($model->date)) {
                                $model->date = date('d-m-Y', strtotime($model->date));
                        } else {
                                $model->date = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'Attendance[date]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>


        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php $branch = Branch::branch(); ?>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>


        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

        <?php
        if (isset($employees) && $employees != '') {
                ?>

                <?php $form = ActiveForm::begin(); ?>
                <div class="table-responsive">
                        <table class="table table-striped">
                                <thead>
                                        <tr>
                                                <th>NO</th>
                                                <th>STAFF NAME</th>
                                                <th>TOTAL HOURS	</th>
                                                <th>OVER TIME</th>
                                                <th>ATTENDANCE TYPE</th>
                                        </tr>
                                </thead>
                                <?php
                                if (isset($employees)) {
                                        $i = 0;


                                        foreach ($employees as $staff) {
                                                $staff_leave = StaffLeave::findOne(['employee_id' => $staff->id, 'commencing_date' => date('Y-m-d', strtotime($model->date)), 'status' => 2]);
                                                //var_dump($staff_leave);
                                                $i++;
                                                ?>
                                                <tbody>
                                                        <tr>
                                                                <td><?= $i; ?></td>
                                                                <td>
                                                                        <strong><?= $staff->staff_name; ?><strong>
                                                                                        </td>
                                                                                        <td>
                                                                                                <input type="text" name="total_<?= $staff->id; ?>" class="form-control number_only" value="" style="width: 35% !important;margin-top: 15px;margin: auto;" >

                                                                                        </td>
                                                                                        <td>
                                                                                                <input type="text" name="over_time_<?= $staff->id; ?>" value="" class="form-control number_only" style="width: 35% !important;margin-top: 15px;margin: auto;">
                                                                                        </td>
                                                                                        <td>
                                                                                                <select name="attendance_<?= $staff->id; ?>" class="form-control">
                                                                                                        <?php
                                                                                                        $attendance_types = MasterAttendanceType::find()->all();

                                                                                                        $att_type = '';
                                                                                                        $selected = '';
                                                                                                        foreach ($attendance_types as $attendance_type) {
                                                                                                                if (!empty($staff_leave) || $staff_leave != '') {
                                                                                                                        if ($attendance_type->id == 3) {

                                                                                                                                $selected = 'selected';
                                                                                                                        } else {
                                                                                                                                $selected = "";
                                                                                                                        }
                                                                                                                }
                                                                                                                $att_type .= '<option value="' . $attendance_type->id . '"' . $selected . '> ' . $attendance_type->type . '</option>';
                                                                                                        }
                                                                                                        echo $att_type;
                                                                                                        ?>
                                                                                                </select>
                                                                                        </td>
                                                                                        </tr>
                                                                                        <?php
                                                                                }
                                                                        } else {
                                                                                echo '<b>No data recived</b>';
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td><input class="btn btn-warning btn-single pull-left" style="border-radius:0px;padding: 10px 50px;" type="submit" name="submit_attendance" value="Submit"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                        </table>
                                                                        </div>
                                                                        <?php ActiveForm::end(); ?>

                                                                        <?php
                                                                }
                                                                ?>
                                                                </div>

