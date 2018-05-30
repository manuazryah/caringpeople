<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\StaffExperienceList;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">





        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'police_station_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'muncipality_corporation')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_2')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
        if (!$staff_interview_third->isNewRecord) {

                $staff_interview_third->staff_experience = explode(',', $staff_interview_third->staff_experience);
        }
        ?>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php $exp = StaffExperienceList::find()->where(['status' => '1', 'category' => 2])->orderBy(['title' => SORT_ASC])->all(); ?>  <?= $form->field($staff_interview_third, 'staff_experience')->dropDownList(ArrayHelper::map($exp, 'id', 'title'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'skills_staffs']) ?>
                <a class="add-option-dropdown add-new" id="skills_staffs-4" type="<?= $type ?>" style="margin-top:0px;"> <div class="div-add-new">+ Add New </div></a>
        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'mentioned_per_day_salary')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'smoke_or_drink', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'drink', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'other', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div style="clear: both">

        </div>


        <h4 style="color:#000;font-style: italic;">Languages Known</h4>
        <hr class="enquiry-hr"/>

        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">#

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd lang_check'>    <label>Language </label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label> Read</label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label> Write</label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label>  Speak</label>

                </div>
        </div>
        <?php
        if (!$staff_interview_first->isNewRecord) {
                if (isset($staff_interview_first->language_1)) {
                        $language_1 = explode(',', $staff_interview_first->language_1);
                        $staff_interview_first->language_1 = $language_1[0];
                }

                if (isset($staff_interview_first->language_2)) {
                        $language_2 = explode(',', $staff_interview_first->language_2);
                        $staff_interview_first->language_2 = $language_2[0];
                }

                if (isset($staff_interview_first->language_3)) {
                        $language_3 = explode(',', $staff_interview_first->language_3);
                        $staff_interview_first->language_3 = $language_3[0];
                }

                if (isset($staff_interview_first->language_4)) {
                        $language_4 = explode(',', $staff_interview_first->language_4);
                        $staff_interview_first->language_4 = $language_4[0];
                }
        }
        ?>


        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">1.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'language_1')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_1" id="language_1_read" class="cbr" <?php
                        if (isset($language_1[1])) {
                                if ($language_1[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_2" id="language_1_write" class="cbr" <?php
                        if (isset($language_1[2])) {
                                if ($language_1[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_3" id="language_1_speak" class="cbr" <?php
                        if (isset($language_1[3])) {
                                if ($language_1[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">2.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_2')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_1" id="language_2_read" class="cbr"<?php
                        if (isset($language_2[1])) {
                                if ($language_2[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_2" id="language_2_write" class="cbr" <?php
                        if (isset($language_2[2])) {
                                if ($language_2[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_3" id="language_2_speak" class="cbr" <?php
                        if (isset($language_2[3])) {
                                if ($language_2[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">3.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_3')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_1" id="language_3_read" class="cbr" <?php
                        if (isset($language_3[1])) {
                                if ($language_3[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_2" id="language_3_write" class="cbr" <?php
                        if (isset($language_3[2])) {
                                if ($language_3[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_3" id="language_3_speak" class="cbr" <?php
                        if (isset($language_3[3])) {
                                if ($language_3[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">4.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_4')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_1" id="language_4_read" class="cbr" <?php
                        if (isset($language_4[1])) {
                                if ($language_4[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_2" id="language_4_write" class="cbr" <?php
                        if (isset($language_4[2])) {
                                if ($language_4[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_3" id="language_4_speak" class="cbr" <?php
                        if (isset($language_4[3])) {
                                if ($language_4[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>



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
                                                <a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" style="margin-top: 15px;" ><i class="fa-remove"></i></a>
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
                        <a id="addScnt_1" class="btn btn-blue btn-icon btn-icon-standalone addScnt_1" ><i class="fa-plus"></i><span> Add More Employer Details</span></a>
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

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_mobile')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_by')->textInput(['maxlength' => true,]) ?>

        </div>







</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($staff_enquiry->isNewRecord ? 'Create' : 'Update', ['class' => $staff_enquiry->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                <?php
                if (!$staff_enquiry->isNewRecord && $staff_enquiry->proceed != 1) {
                        echo Html::submitButton('Proceed to Staff', ['name' => 'proceed', 'class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:125px;']);
                }
                ?>
        </div>
</div>