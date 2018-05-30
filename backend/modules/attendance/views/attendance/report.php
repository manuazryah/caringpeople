<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;

$this->title = 'Attendance Report';
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


                                                <div class="attendance-form form-inline">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php $branch = Branch::branch(); ?>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                                                        </div>
                                                        <div class='col-md-3 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>


                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->

                                                <?php if (!empty($report) && $report != '') { ?>
                                                        <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>EMPLOYEE NAME</th>
                                                                        <th>TOTAL HOURS	</th>
                                                                        <th>TOTAL OVER TIME</th>
                                                                        <?php
                                                                        $attendance_types = MasterAttendanceType::find()->all();
                                                                        foreach ($attendance_types as $atend) {
                                                                                ?>
                                                                                <th><?= $atend->type; ?></th>
                                                                                <?php
                                                                        }
                                                                        ?>
                                                                        </thead>
                                                                        <tbody>
                                                                                <?php
                                                                                $attende_id = array();
                                                                                foreach ($report as $attende) {
                                                                                        $attende_id[] = $attende->id;
                                                                                }

                                                                                $employees = common\models\StaffInfo::find()->where(['branch_id' => $selected_branch])->orWhere(['branch_id' => '0'])->andWhere(['<>', 'post_id', 5])->andWhere(['<>', 'post_id', 1])->all();
                                                                                $k = 0;
                                                                                foreach ($employees as $employee) {
                                                                                        $k++;

                                                                                        $attendence = AttendanceEntry::find()->select('SUM(total_hours) as total_hours, SUM(over_time) as over_time')->where(['IN', 'attendance_id', $attende_id])->andWhere(['staff_id' => $employee->id])->one();
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>
                                                                                                <td><?php echo $employee->staff_name; ?></td>
                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($attendence->total_hours))
                                                                                                                echo $attendence->total_hours;
                                                                                                        else
                                                                                                                echo '0';
                                                                                                        ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($attendence->over_time))
                                                                                                                echo $attendence->over_time;
                                                                                                        else
                                                                                                                echo '0';
                                                                                                        ?>
                                                                                                </td>

                                                                                                <?php
                                                                                                $attendance_types = MasterAttendanceType::find()->all();
                                                                                                $attendence_type = AttendanceEntry::find()->select('attendance')->where(['staff_id' => $employee->id])->andWhere(['IN', 'attendance_id', $attende_id])->all();

                                                                                                $atend = array();
                                                                                                foreach ($attendence_type as $attend) {
                                                                                                        array_push($atend, $attend->attendance);
                                                                                                }
                                                                                                foreach ($attendance_types as $types) {
                                                                                                        ?>
                                                                                                        <td><?php
                                                                                                                if (in_array($types->id, $atend)) {
                                                                                                                        $newArray = array_count_values($atend);
                                                                                                                        foreach ($newArray as $key => $value) {
                                                                                                                                if ($key == $types->id) {
                                                                                                                                        echo $value;
                                                                                                                                }
                                                                                                                        }
                                                                                                                } else {
                                                                                                                        echo '-';
                                                                                                                }
                                                                                                                ?></td>
                                                                                                        <?php
                                                                                                }
                                                                                                ?>

                                                                                        </tr>
                                                                                        <?php
                                                                                }
                                                                                ?>
                                                                        </tbody>
                                                                </table>
                                                        </div>
                                                <?php } ?>


                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .table th{
                text-align: center;
        }
</style>