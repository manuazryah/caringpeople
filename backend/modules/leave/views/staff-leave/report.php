<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\StaffLeave;
use common\models\MasterLeaveType;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leave Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-leave-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <div class="attendance-form form-inline">
                                                <?php $form = ActiveForm::begin(); ?>
                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?=
                                                        DatePicker::widget([
                                                            'model' => $model,
                                                            'form' => $form,
                                                            'type' => DatePicker::TYPE_INPUT,
                                                            'attribute' => 'commencing_date',
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
                                                            'attribute' => 'ending_date',
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ]
                                                        ]);
                                                        ?>


                                                </div>


                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php $branch = Branch::branch(); ?>   <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                                                </div>
                                                <div class='col-md-3 col-sm-6 col-xs-12' >
                                                        <div class="form-group" >
                                                                <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                        </div>
                                                </div>

                                                <?php ActiveForm::end(); ?>
                                        </div>

                                        <!-------------------------------------------------REPORT----------------------------------------------------------------------------->

                                        <?php if (!empty($staffs) && $staffs != '') { ?>


                                                <table class="table table-striped">


                                                        <?php
                                                        $s = 0;
                                                        foreach ($staffs as $value) {
                                                                $staff_exists = StaffLeave::find()->where(['employee_id' => $value->id, 'status' => 2])->andWhere(['>=', 'commencing_date', $from])->andWhere(['<=', 'commencing_date', $to])->andWhere(['<=', 'commencing_date', $to])->exists();
                                                                if ($staff_exists == 1) {
                                                                        $s++;
                                                                        if ($s == 1) {
                                                                                ?>
                                                                                <thead>
                                                                                <th>NO</th>
                                                                                <th>EMPLOYEE NAME</th>
                                                                                <th>NO OF LEAVES </th>
                                                                                <th></th>
                                                                                </thead>

                                                                                <tbody>
                                                                                        <?php
                                                                                }
                                                                                ?>
                                                                                <tr>
                                                                                        <td><?= $s; ?></td>
                                                                                        <td><?= $value->staff_name; ?></td>
                                                                                        <?php $count = StaffLeave::find()->where(['employee_id' => $value->id, 'status' => 2])->andWhere(['>=', 'commencing_date', $from])->andWhere(['<=', 'commencing_date', $to])->count(); ?>
                                                                                        <td><?= $count; ?></td>
                                                                                        <td><a data-toggle="collapse" data-parent="#accordion-test-2" href="#<?= $s ?>" class="collapsed" id="<?= $s ?>" title="View More Details"><i class="fa-plus-circle"></i></a></td>
                                                                                </tr>

                                                                                <tr id="collapse_<?= $s ?>" class="expand">
                                                                                        <td colspan="4">
                                                                                                <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                                <div class="panel-group" id="accordion-test-2">
                                                                                                                        <div class="panel panel-default">
                                                                                                                                <table class="table table-hover" style="    border: 1px solid #eee;">

                                                                                                                                        <thead>
                                                                                                                                                <tr>
                                                                                                                                                        <th>Date</th>
                                                                                                                                                        <th>Leave Type</th>
                                                                                                                                                        <th>Purpose</th>
                                                                                                                                                        <th>Comments</th>
                                                                                                                                                </tr>
                                                                                                                                        </thead>
                                                                                                                                        <tbody>
                                                                                                                                                <?php
                                                                                                                                                $leaves = StaffLeave::find()->where(['employee_id' => $value->id, 'status' => 2])->andWhere(['>=', 'commencing_date', $from])->andWhere(['<=', 'commencing_date', $to])->all();
                                                                                                                                                foreach ($leaves as $leave) {
                                                                                                                                                        ?>

                                                                                                                                                        <tr>
                                                                                                                                                                <td><?= date('d-m-Y', strtotime($leave->commencing_date)); ?></td>
                                                                                                                                                                <?php $leave_type = MasterLeaveType::findOne($leave->leave_type); ?>
                                                                                                                                                                <td><?= $leave_type->type; ?></td>
                                                                                                                                                                <td><?= $leave->purpose; ?></td>
                                                                                                                                                                <td><?= $leave->admin_comment; ?></td>
                                                                                                                                                        </tr>

                                                                                                                                                        <?php
                                                                                                                                                }
                                                                                                                                                ?>
                                                                                                                                        </tbody>
                                                                                                                                </table>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </td>
                                                                                </tr>
                                                                                <?php
                                                                        }
                                                                }
                                                                ?>

                                                        </tbody>
                                                </table>



                                        <?php } ?>
                                </div>
                        </div>

                </div>
        </div>

        <style>
                .table th{
                        text-align: center;

                }
                table.table.table-hover th{
                        background-color: #fff !important;
                        border-top:1px solid #eee !important;
                }
        </style>
</div>

<script>
        $(document).ready(function () {
                $('.expand').hide();

                $('.collapsed').click(function () {
                        var id = $(this).attr('id');
                        $('#collapse_' + id).toggle();
                        $('.collapse').css({'display': 'inline-block'});
                        $('.collapse').css({'visibility': 'visible'});
                });
        });
</script>