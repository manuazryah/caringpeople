<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">

        <h4 style="color:#000;font-style: italic;">Current Employer (For Part-time employees)</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_address')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'length_of_service')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffotherinfo-current_from">
                        <label class="control-label" for="staffotherinfo-current_from">From</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->current_from = date('d-m-Y', strtotime($model->current_from));
                        } else {
                                $model->current_from = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffOtherInfo[current_from]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->current_from,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffotherinfo-current_to">
                        <label class="control-label" for="staffotherinfo-current_to">To</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->current_to = date('d-m-Y', strtotime($model->current_to));
                        } else {
                                $model->current_to = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffOtherInfo[current_to]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->current_to,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>

        </div>

        <div style="clear:both"></div>

        <h4 style="color:#000;font-style: italic;">Previous Employer</h4>
        <hr class="enquiry-hr"/>



        <div id="p_scents_1">
                <input type="hidden" id="delete_port_vals_1"  name="delete_port_vals" value="">


                <?php
                if (!empty($staff_previous_employer)) {

                        foreach ($staff_previous_employer as $data) {
                                ?>
                                <span>
                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-hospital_address">
                                                        <label class="control-label">Hospital Address</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][hospitaladdress][]" value="<?= $data->hospital_address; ?>" >
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-designation">
                                                        <label class="control-label" for="">Designation</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][designation][]" value="<?= $data->designation; ?>" >
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-length_of_service">
                                                        <label class="control-label" >Length of service</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][length][]" value="<?= $data->length_of_service; ?>" >
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-service_from">
                                                        <label class="control-label" >From</label>
                                                        <input type="date" class="form-control" name="updatee[<?= $data->id; ?>][from][]" value="<?= $data->service_from; ?>" >
                                                </div>
                                        </div>
                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-service_to">
                                                        <label class="control-label" >To</label>
                                                        <input type="date" class="form-control" name="updatee[<?= $data->id; ?>][to][]" value="<?= $data->service_to; ?>" >
                                                </div>
                                        </div>
                                        <div class='col-md-1 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-salary">
                                                        <label class="control-label" >Salary</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][salary][]" value="<?= $data->salary; ?>" >
                                                </div>
                                        </div>
                                        <div class='col-md-1 col-sm-6 col-xs-12 left_padd'>
                                                <a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" style="margin-top: 15px;"><i class="fa-remove"></i></a>
                                        </div>
                                        <div style="clear:both"></div>
                                </span>
                                <br>
                                <?php
                        }
                }
                ?>

                <span>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-hospital_address">
                                        <label class="control-label">Hospital Address</label>
                                        <input type="text" class="form-control" name="create[hospitaladdress][]">
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-designation">
                                        <label class="control-label" for="">Designation</label>
                                        <input type="text" class="form-control" name="create[designation][]">
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-length_of_service">
                                        <label class="control-label" >Length of service</label>
                                        <input type="text" class="form-control" name="create[length][]">
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-service_from">
                                        <label class="control-label" >From</label>
                                        <input type="date" class="form-control" name="create[from][]">
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-service_to">
                                        <label class="control-label" >To</label>
                                        <input type="date" class="form-control" name="create[to][]">
                                </div>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-salary">
                                        <label class="control-label" >Salary</label>
                                        <input type="text" class="form-control" name="create[salary][]">
                                </div>
                        </div>

                        <div style="clear:both"></div>
                </span>
                <br/>
        </div>

        <div class="row">
                <div class="col-md-6">
                        <a id="addScnt_1" class="btn btn-blue btn-icon btn-icon-standalone addScnt" ><i class="fa-plus"></i><span> Add More Employer Details</span></a>
                </div>
        </div>

        <hr style="border-top: 1px solid #979898 !important;">

        <h4 style="color:#000;font-style: italic;">Emergency Contact</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'contact_verified_by')->textInput(['maxlength' => true,]) ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_mobile')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_by')->textInput(['maxlength' => true,]) ?>

        </div><div style="clear: both"></div>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'guardian_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'guardian_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'guardian_email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_guardian_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_guardian_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_guardian_email')->textInput(['maxlength' => true]) ?>

        </div>
        <div style="clear: both"></div>

        <div class='col-md-12 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:123px;margin-left:12px;', 'id' => 'form_button']) ?>

                </div>
        </div>



</div>
