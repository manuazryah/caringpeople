<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">

        <div role="tabpanel" class="tab-pane fade active in" id="salary_details_tab">
                <div class="col-sm-6 form-horizontal">
                        <div class="col-sm-12 form-horizontal">
                                <h4 style="color:#000;font-style: italic;">Account Details</h4>
                                <hr class="enquiry-hr"/>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="pan_number">PAN/AADHAR Number</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staffinfo, 'pan_or_adhar_no')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="account_name">Account Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staff_interview_third, 'bank_ac_hodername')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="account_number">Account Number</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staff_interview_third, 'bank_ac_no')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>



                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="bank_name">Bank Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staff_interview_third, 'bank_name')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="bank_branch">Branch</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staff_interview_third, 'bank_branch')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                                <label for="ifsc_code">IFSC Code</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                        <div class="form-line">
                                                                <?= $form->field($staff_interview_third, 'bank_ifsc')->textInput(['maxlength' => true])->label(false); ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="col-sm-6 form-horizontal">
                        <h4 style="color:#000;font-style: italic;">Salary Details</h4>
                        <hr class="enquiry-hr"/>
                        <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="basic_salary">Basic Salary</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <div class="form-group">
                                                <div class="form-line">
                                                        <?= $form->field($staff_salary, 'basic_salary')->textInput(['maxlength' => true])->label(false); ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="row clearfix">
                                <table class="table table-bordered table-condensed staff-salary">
                                        <tbody><tr style="background:#ccc">
                                                        <th colspan="2" class="text-center">Allowances</th>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">HRA</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'hra')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Food and Accommodation</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'food_and_accomodation')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Conveyance</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'conveyance')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">LTA</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'lta')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Medical Allowance</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'medical_allowance')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Other Allowances</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'other_allowances')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Stipend</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'stipend')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr style="background:#ccc">
                                                        <th colspan="2" class="text-center">Deductions</th>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">PF Deduction</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'PF_deduction')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">ESI Deduction</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'ESI_deduction')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <th style="padding: 2px;padding-left:5px;vertical-align:middle;">Other Deduction</th>
                                                        <td width="48%" style="padding: 2px">
                                                                <div class="form-group" style="width: 90%; padding-left: 5px;margin-left: 5px;">
                                                                        <?= $form->field($staff_salary, 'other_deduction')->textInput(['maxlength' => true])->label(false); ?>
                                                                </div>
                                                        </td>
                                                </tr>
                                        </tbody></table>
                        </div>
                        <div class="row clearfix">
                                <div class="col-lg-5 col-md-3 col-sm-5 col-xs-5 form-control-label">
                                </div>
                                <div class="col-lg-7 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                                <div class="form-line">

                                                        <?php
                                                        if (!$staff_salary->isNewRecord) {
                                                                $staff_salary->date_of_salary = date('d-m-Y', strtotime($staff_salary->date_of_salary));
                                                        } else {
                                                                $staff_salary->date_of_salary = date('d-m-Y');
                                                        }
                                                        echo DatePicker::widget([
                                                            'model' => $staff_salary,
                                                            'form' => $form,
                                                            'type' => DatePicker::TYPE_INPUT,
                                                            'attribute' => 'date_of_salary',
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ]
                                                        ]);
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="clearfix"></div>
        </div>

        <div class='col-md-12 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($staffinfo->isNewRecord ? 'Create' : 'Update', ['class' => $staffinfo->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:123px;margin-left:12px;', 'id' => 'form_button']) ?>

                </div>
        </div>



</div>
