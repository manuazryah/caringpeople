<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasterLeaveType;
use kartik\date\DatePicker;

$branch_drop = \common\models\Branch::Branch();
/* @var $this yii\web\View */
/* @var $model common\models\StaffLeave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-leave-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-3 col-sm-6 col-xs-12 '>
                        <?php
                        $types = MasterLeaveType::find()->where(['status' => 1])->all();
                        ?>
                        <?=
                                $form->field($model, 'leave_type')
                                ->dropDownList(ArrayHelper::map($types, 'id', 'type'), [
                                    'class' => 'form-control',
                                    'prompt' => '--Select--'
                                        ]
                                )
                        ?>
                        <?php // $form->field($model, 'leave_type')->textInput()   ?>

                </div>

                <?php
                if (Yii::$app->session['post']['id'] != 5) {
                        ?>

                        <div class='col-md-3 col-sm-6 col-xs-12 '>
                                <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch_drop, 'id', 'branch_name'), ['prompt' => '--Select--']); ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 '>
                                <?php $staff = []; ?>
                                <?= $form->field($model, 'employee_id')->dropDownList(ArrayHelper::map($staff, 'id', 'staff_name')) ?>
                        </div>

                        <?php
                } else {

                        $model->employee_id = Yii::$app->user->identity->id;
                }
                ?>



                <?php // $form->field($model, 'commencing_date')->textInput()    ?>
                <div class='col-md-3 col-sm-6 col-xs-12 '>
                        <div class="form-group field-commencing-date">
                                <label class="control-label" for="commencing-date">Commencing date</label>
                                <?php
                                if (isset($model->commencing_date)) {
                                        $model->commencing_date = date('d-m-Y', strtotime($model->commencing_date));
                                } else {
                                        $model->commencing_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'StaffLeave[commencing_date]',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->commencing_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>


                        </div>


                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 '>
                        <div class="form-group field-ending-date">
                                <label class="control-label" for="ending-date">Ending Date</label>
                                <?php
                                if (isset($model->ending_date)) {
                                        $model->ending_date = date('d-m-Y', strtotime($model->ending_date));
                                } else {
                                        $model->ending_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'StaffLeave[ending_date]',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->ending_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>


                        </div>


                </div>



                <div class='col-md-3 col-sm-6 col-xs-12 '>
                        <?= $form->field($model, 'purpose')->textarea(['rows' => 2]) ?>

                </div>
                <?php
                if (Yii::$app->session['post']['id'] == 1) {
                        ?>
                        <div class='col-md-3 col-sm-6 col-xs-12 '>
                                <?= $form->field($model, 'status')->dropDownList(['1' => 'Pending', '2' => 'Approved']) ?>

                        </div>
                        <?php
                        $model->approved_by = Yii::$app->user->identity->id;
                } else {
                        $model->status = 1;
                }
                ?>
        </div>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12'>
                        <div class="form-group" >
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                        </div>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>


<script>

        $(document).ready(function () {
                $('#staffleave-branch_id').change(function () {
                        var branch = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {branch: branch},
                                url: homeUrl + 'report/list-staffs',
                                success: function (data) {
                                        $('#staffleave-employee_id').html(data);
                                        hideLoader();
                                }
                        });
                });


                $("#staffleave-employee_id").select2({
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>