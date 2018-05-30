<?php

use yii\helpers\Html;
use common\models\StaffExperienceList;

/* @var $this yii\web\View */
/* @var $patient_assessment common\models\PatientBystanderDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
        .checkbox_css{
                width: 20px;
                height:20px;
        }
        .top{
                margin-top: 28px;
        }
</style>
<div class="patient-bystander-details-form form-inline">

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Patient's Condition</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Mobile', 'value' => 1, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Bedridden', 'value' => 2, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Semi Bedridden', 'value' => 3, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_conscious')->radio(['label' => 'Conscious', 'value' => 4, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_conscious')->radio(['label' => 'UnConscious', 'value' => 5, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_conscious')->radio(['label' => 'Semi Conscious', 'value' => 6, 'uncheck' => null]) ?></div>



        <h4 style="color:#000;font-style: italic;font-weight: bold;">Medical Procedures</h4>
        <hr class="enquiry-hr"/>
        <?php
        $skills = StaffExperienceList::find()->where(['category' => 1])->andWhere(['is', 'sub_category', null])->all();
        foreach ($skills as $value) {
                $checked = '';
                if (!$patient_assessment->isNewRecord) {
                        $procedures = explode(',', $patient_assessment->patient_medical_procedures);
                        if (in_array($value->id, $procedures))
                                $checked = "checked";
                }
                ?>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <input type='checkbox' name='patient_medical_procedures[]'  class="cbr" value='<?= $value->id; ?>' <?= $checked ?>><label class='cbr-inline top'><?= $value->title; ?></label>
                </div>
        <?php }
        ?>

        <div style="clear:both"></div>
        <?php
        $assessment_category = \common\models\AssessmentCategory::find()->where(['status' => 1])->all();
        foreach ($assessment_category as $assessment_category) {
                $assessment_category_skills = StaffExperienceList::find()->where(['sub_category' => $assessment_category->id])->all();
                if (count($assessment_category_skills) > 0) {
                        ?>
                        <div style="clear:both"></div>
                        <h4 style="color:#000;font-style: italic;font-weight: bold;"><?= $assessment_category->sub_category; ?></h4>
                        <hr class="enquiry-hr" style="margin-bottom:10px !important;"/>

                        <?php
                        foreach ($assessment_category_skills as $assessment_category_skills) {
                                $checked = '';
                                $procedures = explode(',', $patient_assessment->patient_medical_procedures);
                                if (in_array($assessment_category_skills->id, $procedures))
                                        $checked = "checked";
                                ?>
                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                        <input type='checkbox' name='patient_medical_procedures[]'  class="cbr" value='<?= $assessment_category_skills->id; ?>' <?= $checked ?>><label class='cbr-inline top'><?= $assessment_category_skills->title; ?></label>
                                </div>
                        <?php } ?>
                        <?php
                }
        }
        ?>






        <div style="clear: both"></div>
        <h4 style="color:#000;font-style: italic;font-weight: bold;">Suggested Home Care Professional</h4>
        <hr>







        <?php
        if (!$patient_assessment->isNewRecord) {
                $procedures = explode(',', $patient_assessment->suggested_professional);
        }
        ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='1' <?php
                if (isset($procedures)) {
                        if (in_array('1', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Registered Nurse Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='2' <?php
                if (isset($procedures)) {
                        if (in_array('2', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Registered Nurse Female</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='3' <?php
                if (isset($procedures)) {
                        if (in_array('3', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Associate Nurse Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='4' accept="<?php
                if (isset($procedures)) {
                        if (in_array('4', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>"><label class='cbr-inline top'>Associate Nurse Female</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='5' <?php
                if (isset($procedures)) {
                        if (in_array('5', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Nurse Attendent Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]' class="cbr" value='6' <?php
                if (isset($procedures)) {
                        if (in_array('6', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Nurse Attendent Female</label></div>


        <div style="clear: both"></div>
        <div class="row" style="margin-top:15px;">
                <div class='col-md-12 col-sm-6 col-xs-12' >
                        <?= $form->field($patient_assessment, 'other_notes')->textarea(['rows' => 3]) ?>
                </div>
        </div>


</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($patient_assessment->isNewRecord ? 'Create' : 'Update', ['class' => $patient_assessment->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>



<style>
        /* .squaredFour */
        .squaredFour {
                width: 20px;
                position: relative;
                margin: 20px auto;
                label {
                        width: 20px;
                        height: 20px;
                        cursor: pointer;
                        position: absolute;
                        top: 0;
                        left: 0;
                        background: #fcfff4;
                        background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                        border-radius: 4px;
                        box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                        &:after {
                                content: '';
                                width: 9px;
                                height: 5px;
                                position: absolute;
                                top: 4px;
                                left: 4px;
                                border: 3px solid #333;
                                border-top: none;
                                border-right: none;
                                background: transparent;
                                opacity: 0;
                                transform: rotate(-45deg);
                        }
                        &:hover::after {
                                opacity: 0.5;
                        }
                }
                input[type=checkbox] {
                        visibility: hidden;
                        &:checked + label:after {
                                opacity: 1;
                        }
                }
        }
        /* end .squaredFour */

</style>