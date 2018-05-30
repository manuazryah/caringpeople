<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use common\models\Hospital;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $patient_hospital common\models\PatientEnquiryHospitalFirst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-hospital-first-form form-inline">

        <h4 class="h4-labels">Patient Basic Details</h4>
        <hr class="enquiry-hr"/>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'required_person_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_age')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>     <?php
                if (!$patient_hospital->isNewRecord) {
                        $patient_hospital->patient_dob = date('d-m-Y', strtotime($patient_hospital->patient_dob));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $patient_hospital,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'patient_dob',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_weight')->textInput() ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?= $form->field($patient_hospital, 'relationship')->dropDownList(['' => '--Select--', '0' => 'Spouse', '1' => 'parent', '2' => 'Grandparent', '3' => 'Others']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="relationship_others">    <?= $form->field($patient_hospital, 'relationship_others')->textInput(['maxlength' => true]) ?>

        </div><div style="clear:both;">

        </div>


        <div class="row>">
                <input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0"><label style="color:black;font-weight:bold; margin-left: 5px;"> Caller address and person address are same</label>
        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_address')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_postal_code')->textInput(['maxlength' => true]) ?>

        </div><div style="clear:both;"></div>

        <h4 class="h4-labels">Hospital Details</h4>
        <hr class="enquiry-hr"/>

        <div id="p_scents1">
                <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">


                <?php
                if (!empty($hospital_details)) {
                        if ($patient_info->branch_id == 1) {
                                $category = 5;
                        } else {
                                $category = 17;
                        }

                        $hospital_name = common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();

                        $selected[] = '';
                        $doctor[] = '';
                        $a = 0;
                        foreach ($hospital_details as $data) {
                                $a++;
                                unset($doctor);
                                $rand_1 = rand();

                                $selected[] = $data->hospital_name;
                                $doctor[] = $data->consultant_doctor;

                                $doctorlis = \common\models\ContactDirectory::find()->where(['subcategory_type' => $data->hospital_name, 'designation' => 13])->all();
                                ?>
                                <span>
                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-patientenquiryhospitaldetails-hospital_name">
                                                        <label class="control-label">Hospital Name</label>
                                                        <?= Html::dropDownList('updatee[' . $data->id . '][hospital_name][]', $selected, ArrayHelper::map($hospital_name, 'id', 'sub_category'), ['class' => 'form-control hospital', 'prompt' => '--Select--', 'id' => 'hospital_' . $rand_1]); ?>
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-patientenquiryhospitaldetails-consultant_doctor">
                                                        <label class="control-label" for="">Consultant Doctor</label>
                                                        <?= Html::dropDownList('updatee[' . $data->id . '][consultant_doctor][]', $doctor, ArrayHelper::map($doctorlis, 'id', 'name'), ['class' => 'form-control doctor', 'prompt' => '--Select--', 'id' => 'doctor']); ?>

                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-patientenquiryhospitaldetails-department">
                                                        <label class="control-label">Department</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][department][]" value="<?= $data->department; ?>" id="department_<?= $rand_1 ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-patientenquiryhospitaldetails-hospital_room_no">
                                                        <label class="control-label" >Hospital Room No</label>
                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][hospital_room_no][]" value="<?= $data->hospital_room_no; ?>" >
                                                </div>
                                        </div>

                                        
                                                <a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" style="margin-top:15px;"><i class="fa-remove"></i></a>
                                        
                                        <div style="clear:both"></div>
                                </span>
                                <hr style="border-top: 1px solid #979898 !important;">
                                <br>
                                <?php
                                unset($selected);
                        }
                }
                ?>

                <span>
                        <?php
                        $rand = rand();
                        if (!$patient_hospital_second->isNewRecord) {
                                if ($patient_info->branch_id == 1) {
                                        $category = 5;
                                } else {
                                        $category = 17;
                                }

                                $hospital_name = common\models\ContactSubcategory::find()->where(['category_id' => $category, 'status' => 1])->all();
                        } else {
                                $hospital_name = [];
                        }
                        ?>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-patientenquiryhospitaldetails-hospital_name">
                                        <label class="control-label">Hospital Name</label>

                                        <?= Html::dropDownList('addhospital[hospital_name][]', null, ArrayHelper::map($hospital_name, 'id', 'sub_category'), ['class' => 'form-control hospital', 'prompt' => '--Select--', 'id' => 'hospital_4']);
                                        ?>
                                        <a class="add-option-dropdown add-new" id="hospital_4-1" style="margin-top:0px;"> <div class="div-add-new">+ Add New </div></a>
                                </div>

                        </div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-patientenquiryhospitaldetails-consultant_doctor">
                                        <label class="control-label" for="">Consultant Doctor</label>
                                        <select name="addhospital[consultant_doctor][]" class="form-control doctor" id="doctor_4"></select>
                                        <a class="add-option-dropdown add-new" id="doctor_4-9" style="margin-top:0px;"><div class="div-add-new"> + Add New </div></a>

                                </div>
                        </div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-patientenquiryhospitaldetails-department">
                                        <label class="control-label">Department</label>
                                        <input type="text" class="form-control" name="addhospital[department][]" id="department_4">
                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-patientenquiryhospitaldetails-hospital_room_no">
                                        <label class="control-label" >Hospital Room No</label>
                                        <input type="text" class="form-control" name="addhospital[hospital_room_no][]">
                                </div>
                        </div>


                        <div style="clear:both"></div>
                </span>

        </div>



        <div class="row">
                <div class="col-md-6"> <a id="addHosp" class="btn btn-icon btn-blue addHosp"><i class="fa-plus"></i> Add More Hospital Details</a></div>
        </div>


        <h4 class="h4-labels">Medical Conditons/Current Diagnosis</h4>
        <hr class="enquiry-hr"/>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'diabetic')->dropDownList(['0' => 'No', '1' => 'Yes', '2' => 'Yes,Insulin', '3' => 'Yes, On Tablet', '4' => 'Dont Know']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='diabetic_note'>    <?= $form->field($patient_hospital_second, 'diabetic_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'hypertension')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'feeding')->dropDownList(['6' => 'NA', '0' => 'Nasogastric', '1' => 'Nasoduodenal', '2' => 'Nasojejunal Tubes', '3' => 'Gastrostomy', '4' => 'Gastrojejunostomy', '5' => 'Jejunostomyfeeding tube']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'urine')->dropDownList(['6' => 'NA', '0' => 'Foleys catheter', '1' => 'Suprapubic', '2' => 'Condom catheter']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'oxygen')->dropDownList(['0' => 'No', '1' => 'Yes', '2' => 'Ventilator', '3' => 'BiPAP', '4' => 'SOS']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'tracheostomy')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'iv_line')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'family_support')->dropDownList(['' => '--Select--', '1' => 'Close', '2' => 'Distant', '3' => 'None']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'family_support_note')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'care_currently_provided')->dropDownList(['1' => 'Family', '2' => 'Friends', '3' => 'Hospital', '5' => 'Home Nursing Agemcy', '4' => 'Others', '6' => 'Not Told']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='care_currently_provided_others'>    <?= $form->field($patient_hospital_second, 'care_currently_provided_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="date_of_discharge">
                <?php
                if (!$patient_hospital_second->isNewRecord) {
                        $patient_hospital_second->date_of_discharge = date('d-m-Y', strtotime($patient_hospital_second->date_of_discharge));
                } else {
                        $patient_hospital_second->date_of_discharge = date('d-m-Y');
                }

                echo DatePicker::widget([
                    'model' => $patient_hospital_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'date_of_discharge',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>
        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'details_of_current_care')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'difficulty_in_movement')->dropDownList(['' => '--Select--', '1' => 'No difficulty', '2' => 'Assistance required', '3' => 'Wheelchair', '4' => 'Bedridden', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">    <?= $form->field($patient_hospital_second, 'difficulty_in_movement_other')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-8 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">    <?= $form->field($patient_hospital_second, 'diagnosis')->textarea(['rows' => 1]) ?>

        </div>


</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?php if ($patient_hospital_second->isNewRecord) { ?>
                        <?= Html::submitButton($patient_hospital_second->isNewRecord ? 'Create' : 'Update', ['class' => $patient_hospital_second->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                        <?php
                } else {
                        ?>
                        <?= Html::submitButton($patient_hospital_second->isNewRecord ? 'Create' : 'Update', ['class' => $patient_hospital_second->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button', 'name' => 'update_button']) ?>
                        <?php if (!$patient_info->isNewRecord && $patient_info->status != 3) { ?>
                                <?= Html::submitButton('Proceed to Patient', ['class' => 'btn btn-primary', 'style' => 'margin-top: 18px;height: 36px; width: auto;', 'name' => 'patinet_info']) ?>
                        <?php
                        }
                }
                ?>
        </div>
</div>
