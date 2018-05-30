<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PatientGeneral;
use common\models\MasterServiceTypes;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterDesignations;
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">

        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="row">

                <?php
                $branches = Branch::Branch();
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
                <?php ?>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$model->isNewRecord) {
                                $patient = PatientGeneral::find()->where(['status' => 1, 'branch_id' => $model->branch_id])->orderBy(['first_name' => SORT_ASC])->all();
                        } else {
                                $patient = [];
                        }
                        ?>
                        <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patient, 'id', 'first_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>
                </div>



                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        $sevice_type = MasterServiceTypes::find()->where(['status' => 1])->all();
                        ?>
                        <?= $form->field($model, 'service')->dropDownList(ArrayHelper::map($sevice_type, 'id', 'service_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>

                </div>

                <?php
                if (!$model->isNewRecord) {
                        $sub_services = common\models\SubServices::find()->where(['branch_id' => $model->branch_id])->orWhere(['branch_id' => 0])->andWhere(['service' => $model->service])->all();
                } else {
                        $sub_services = [];
                }
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_service')->dropDownList(ArrayHelper::map($sub_services, 'id', 'sub_service')) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'gender_preference')->dropDownList(['2' => 'Any', '0' => 'Male Staff', '1' => 'Female Staff']) ?>
                </div>


                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$model->isNewRecord) {
                                if (isset($model->sub_service) && $model->sub_service != '' && $model->sub_service != 0) {

                                        $rates = \common\models\RateCard::find()->where(['service_id' => $model->service, 'branch_id' => $model->branch_id, 'status' => 1, 'sub_service' => $model->sub_service])->one();
                                } else {
                                        $rates = \common\models\RateCard::find()->where(['service_id' => $model->service, 'branch_id' => $model->branch_id, 'status' => 1, 'sub_service' => 0])->one();
                                }
                                $data = Yii::$app->SetValues->Dutytype($rates);
                        } else {
                                $data = [];
                        }
                        ?>

                        <?= $form->field($model, 'duty_type')->dropDownList($data) ?>
                        <span class="rate-card-error" style="color:red;position: absolute;top: 80px;display:none">Please add rate card ! <a class="add-rate-card" style="color:#0e62c7;cursor: pointer;text-decoration: underline">Add New</a></span>
                        <span class="rate-card-update-error" style="color:red;position: absolute;top: 75px;display:none">Please update rate card rates! <a class="update-rate-card" style="color:#0e62c7;cursor: pointer;text-decoration: underline">Update Now</a></span>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="day_night_staff">
                        <?= $form->field($model, 'day_night_staff')->radioList(array('1' => 'Same Staff', 2 => 'Different Staff')); ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-frequency'>
                        <?= $form->field($model, 'frequency')->dropDownList(['' => '-Select--', '1' => 'Daily', '2' => 'Weekly', '3' => 'Monthly']) ?>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-hours'>
                        <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-days'>
                        <?= $form->field($model, 'days')->textInput(['maxlength' => true]) ?>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                        <?php
                        if (!$model->isNewRecord) {
                                $model->from_date = date('d-m-Y', strtotime($model->from_date));
                        } else {
                                $model->from_date = date('d-m-Y');
                        }
                        echo DatePicker::widget([
                            'model' => $model,
                            'form' => $form,
                            'type' => DatePicker::TYPE_INPUT,
                            'attribute' => 'from_date',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>

                        <span class="rate-card-error" style="height: 15px; color:white;display:none">Error! <a  style="color:#fff;cursor: pointer;text-decoration: underline"></a></span>

                </div>



                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->to_date = date('d-m-Y', strtotime($model->to_date));
                        } else {
                                $model->to_date = '';
                        }
                        ?>

                        <?= $form->field($model, 'to_date')->textInput(['maxlength' => true, 'readonly' => true]) ?>

                        <span class="rate-card-error" style="color:white;display:none">Error ! <a style="color:#fff;cursor: pointer;text-decoration: underline"></a></span>

                </div>




                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        $staff_managers = StaffInfo::find()->where(['status' => 1, 'post_id' => 6, 'branch_id' => $model->branch_id])->orWhere(['post_id' => 1])->orWhere(['post_id' => 13])->orderBy(['staff_name' => SORT_ASC])->all();
                        ?>
                        <?= $form->field($model, 'staff_manager')->dropDownList(ArrayHelper::map($staff_managers, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>
                </div>



                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'estimated_price')->textInput(['maxlength' => true]) ?>

                </div>



                <div class='col-md-2 col-sm-6 col-xs-12 left_padd' >
                        <?= $form->field($model, 'status')->dropDownList(['1' => 'Opened', '2' => 'Closed', '3' => 'Advanced', '4' => 'Pending']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'co_worker')->dropDownList(['0' => 'No', '1' => 'Yes',]) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'registration_fees')->checkbox(); ?>
                </div>

                <?php
                $style = 'display:none';
                if ($model->registration_fees == 1) {
                        $style = 'display:show';
                }
                ?>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd registration_fees_amount' style="<?= $style ?>">
                        <?= $form->field($model, 'registration_fees_amount')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'client_notes')->textarea(['rows' => 2]) ?>
                </div>

        </div>


        <div style="clear:both"></div>

        <div class="row" style="margin:0">
                <label style="color:#000;font-weight: bold;font-size: 14px;text-decoration: underline">Add Other Expenses</label>
        </div>

        <div id="service-expenses" class="row" style="margin: 20px 0px;">

                <div class="row" style="margin: 20px 0px;">

                        <?php
                        if (!empty($service_expenses)) {
                                foreach ($service_expenses as $expenses) {
                                        ?>
                                        <span>
                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <div class="form-group field-service">
                                                                <label class="control-label">Expense</label>
                                                                <input type="text" class="form-control" name="updateexpense[<?= $expenses->id; ?>][expense][]" value="<?= $expenses->expense; ?>" id="expense">
                                                        </div>
                                                </div>

                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <div class="form-group field-service">
                                                                <label class="control-label">Amount</label>
                                                                <input type="text" class="form-control" name="updateexpense[<?= $expenses->id; ?>][amount][]" value="<?= $expenses->expense_amount; ?>" id="expense">
                                                        </div>
                                                </div>

                                                <a id="remExpense" val="<?= $expenses->id; ?>" class="btn btn-icon btn-red remExpense" style="margin-top:15px;"><i class="fa-remove"></i></a>

                                        </span>
                                        <div style="clear:both"></div>
                                        <?php
                                }
                        }
                        ?>
                </div>


                <input type="hidden" id="delete_service_expense_vals"  name="delete_service_expense_vals" value="">
                <span>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-service">
                                        <label class="control-label">Expense</label>
                                        <input type="text" class="form-control" name="service[expense][]" id="expense">
                                </div>
                        </div>


                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-service">
                                        <label class="control-label">Amount</label>
                                        <input type="text" class="form-control" name="service[amount][]" id="amount">
                                </div>
                        </div>

                        <div style="clear:both"></div>
                </span>
        </div>

        <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6"><a id="addExpenses" class="btn btn-icon btn-blue addExpenses"><i class="fa-plus"></i>  Add Expenses</a></div>
        </div>


        <div class="row">
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px; ']) ?>
                </div>

        </div>


        <?php
        ActiveForm::end();
        ?>

        <?php if ($model->proforma_sent == 1) { ?>
                <div class="row statusr" >
                        <div class="col-md-12" >
                                <p style="float: right;">
                                        <a class="btn btn-secondary popover-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Schedules will generate on confirm this service!!" data-original-title="Confirm"><input type="checkbox" class="cbr schedule_generate" value="<?= $model->id; ?>"><span>&nbsp;Check here to confirm this service</span></a>
                                <p>
                        </div>
                </div>
        <?php } ?>







</div>

<style>
        .statusr span{
                color: #000;
                font-weight: bold;
        }
        .statusr .btn-secondary{
                background-color: #fff!important;
        }
        .btn.btn-secondary:active, .btn.btn-secondary:focus{
                border: none ! important;
        }

</style>



<script>
        $(document).ready(function () {
                $('#service-registration_fees').change(function () {
                        if ($("#service-registration_fees").prop('checked') == true) {
                                $('.registration_fees_amount').show();
                        } else {
                                $('.registration_fees_amount').hide();
                        }
                });
        });
</script>