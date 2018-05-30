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

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'police_station_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'panchayat')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'muncipality_corporation')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
        if (!$staff_interview_third->isNewRecord && $staff_interview_third->staff_experience != '') {

                $staff_interview_third->staff_experience = explode(',', $staff_interview_third->staff_experience);
        }
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php $exp = StaffExperienceList::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>  <?= $form->field($staff_interview_third, 'staff_experience')->dropDownList(ArrayHelper::map($exp, 'id', 'title'), ['class' => 'form-control', 'multiple' => 'multiple', 'style' => 'height: 110px;']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'mentioned_per_day_salary')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'smoke_or_drink', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div style="clear: both">

        </div>


        <h3 style="color:#148eaf;">Languages Known</h3>
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



        <h3 style="color:#148eaf;">Previous Employer</h3>
        <hr class="enquiry-hr"/>



        <div id="p_scents">
                <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">


                <?php
                if (!empty($staff_previous_employer)) {

                        foreach ($staff_previous_employer as $data) {
                                ?>
                                <span>
                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-hospital_address">
                                                        <label class="control-label">Hospital Address</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][hospitaladdress][]" value="<?= $data->hospital_address; ?>" required>
                                                </div>
                                        </div>

                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-designation">
                                                        <label class="control-label" for="">Designation</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][designation][]" value="<?= $data->designation; ?>" required>
                                                </div>
                                        </div>

                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-length_of_service">
                                                        <label class="control-label" >Length of service</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][length][]" value="<?= $data->length_of_service; ?>" required>
                                                </div>
                                        </div>

                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-service_from">
                                                        <label class="control-label" >From</label>
                                                        <input type="date" class="form-control" name="updatee[<?= $data->id; ?>][from][]" value="<?= $data->service_from; ?>" required>
                                                </div>
                                        </div>
                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-service_to">
                                                        <label class="control-label" >To</label>
                                                        <input type="date" class="form-control" name="updatee[<?= $data->id; ?>][to][]" value="<?= $data->service_to; ?>" required>
                                                </div>
                                        </div>
                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffperviousemployer-salary">
                                                        <label class="control-label" >Salary</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][salary][]" value="<?= $data->salary; ?>" required>
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
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-hospital_address">
                                        <label class="control-label">Hospital Address</label>
                                        <input type="text" class="form-control" name="create[hospitaladdress][]">
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-designation">
                                        <label class="control-label" for="">Designation</label>
                                        <input type="text" class="form-control" name="create[designation][]">
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-length_of_service">
                                        <label class="control-label" >Length of service</label>
                                        <input type="text" class="form-control" name="create[length][]">
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-service_from">
                                        <label class="control-label" >From</label>
                                        <input type="date" class="form-control" name="create[from][]">
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-service_to">
                                        <label class="control-label" >To</label>
                                        <input type="date" class="form-control" name="create[to][]">
                                </div>
                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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
                        <a id="addScnt" class="btn btn-blue btn-icon btn-icon-standalone addScnt" ><i class="fa-plus"></i><span> Add More</span></a>
                </div>
        </div>

        <hr style="border-top: 1px solid #979898 !important;">

        <h3 style="color:#148eaf;">Emergency Contact</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both;">

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_mobile')->textInput(['maxlength' => true]) ?>

        </div>
        <div style="clear:both"></div>

        <h3 style="color:#148eaf;">Family Details</h3>
        <hr class="enquiry-hr"/>

        <div id="staff_family">

                <input type="hidden" id="delete_port_vals_family"  name="delete_port_vals_family" value="">
                <?php
                if (!empty($staff_family)) {
                        foreach ($staff_family as $family) {
                                ?>
                                <span>
                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                                        <label class="control-label" for="">Name</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][name][]" value="<?= $family->name; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                                        <label class="control-label" for="">Relationship</label>
                                                        <select name="updatefamily[<?= $family->id; ?>][relationship][]" id="family_relationships" class="form-control">
                                                                <option value="">--Select--</option>
                                                                <option value="Father" <?php
                                                                if ($family->relationship == 'Father') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Father</option>
                                                                <option value="Mother" <?php
                                                                if ($family->relationship == 'Mother') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Mother</option>
                                                                <option value="Spouse" <?php
                                                                if ($family->relationship == 'Spouse') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Spouse</option>
                                                                <option value="Brother" <?php
                                                                if ($family->relationship == 'Brother') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Brother</option>
                                                                <option value="Sister" <?php
                                                                if ($family->relationship == 'Sister') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Sister</option>
                                                        </select>
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                                        <label class="control-label" for="">Job</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][job][]"  value="<?= $family->job; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                                        <label class="control-label" for="">Mobile No</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][mobile_no][]" value="<?= $family->mobile_no; ?>">
                                                </div>
                                        </div>

                                        <div class="col-md-1 col-sm-6 col-xs-12 left_padd">
                                                <a id="remFamily" val="<?= $family->id; ?>" class="btn btn-icon btn-red remFamily" style="margin-top: 15px;"><i class="fa-remove"></i></a>
                                        </div>
                                </span>
                                <?php
                        }
                }
                ?>



                <span>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                        <label class="control-label" for="">Name</label>
                                        <input type="text" class="form-control" name="createfamily[name][]">
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                        <label class="control-label" for="">Relationship</label>
                                        <select name="createfamily[relationship][]" id="family_relationships" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                        </select>
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                        <label class="control-label" for="">Job</label>
                                        <input type="text" class="form-control" name="createfamily[job][]">
                                </div>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                        <label class="control-label" for="">Mobile No</label>
                                        <input type="text" class="form-control" name="createfamily[mobile_no][]">
                                </div>
                        </div>

                </span>
        </div>

        <div class="row">
                <div class="col-md-6"> <a id="add_Staff_family" class="btn btn-blue btn-icon btn-icon-standalone Staff_family" ><i class="fa-plus"></i><span> Add Family Details</span></a>
                </div>
        </div>

        <h3 style="color:#148eaf;">Bank Details</h3>
        <hr class="enquiry-hr"/>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_ac_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_third, 'bank_ac_hodername')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_ifsc')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both">

        </div>



        <h3 style="color:#148eaf;">Emergency Contact Verification</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'contact_verified_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->contact_verified_date = date('d-m-Y', strtotime($staff_interview_second->contact_verified_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'contact_verified_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'contact_verified_note')->textarea(['rows' => 2]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->alt_contact_verified_date = date('d-m-Y', strtotime($staff_interview_second->alt_contact_verified_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'alt_contact_verified_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_note')->textarea(['rows' => 2]) ?>

        </div>



        <h3 style="color:#148eaf;"> Verification Details</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_1 = date('d-m-Y', strtotime($staff_interview_second->verified_date_1));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_1',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_2 = date('d-m-Y', strtotime($staff_interview_second->verified_date_2));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_2',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_3 = date('d-m-Y', strtotime($staff_interview_second->verified_date_3));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_3',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>



        </div>



        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_required')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_received')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interest_level')->dropDownList(['' => '--Select--', '1' => 'High', '2' => 'No Interest', '3' => 'Medium']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->expected_date_of_joining = date('d-m-Y', strtotime($staff_interview_third->expected_date_of_joining));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'expected_date_of_joining',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'form_filled', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interview_notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interviewed_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->interviewed_date = date('d-m-Y', strtotime($staff_interview_third->interviewed_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'interviewed_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div style="clear:both"></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_first, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='3' style='color: #3c4ba1;text-decoration: underline;'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>



        </div>
</div>

<style>
        .cbr-inline{ margin-top: 10px; }
        .lang_check{text-align: center;color: #000;}
        .languages .col-md-3{height: 65px;}
        .languages{margin-left: 0px;margin-right: 0px;}
        .lang_check label{font-weight: bold}

</style>
