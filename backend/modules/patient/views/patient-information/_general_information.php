<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use common\models\Religion;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-form form-inline">


        <div class="row">
                <div class="row">
                        <div class="col-md-8">
                                <h4 class="h4-labels"></h4>

                        </div>
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $patient_general->id;
                        if (count(glob("{$path}/*")) > 0) {
                                foreach (glob("{$path}/*") as $file) {
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nam = explode('.', $img_nmee);
                                        if ($img_nam[0] == 'Patient Image') {
                                                ?>
                                                <div class="col-md-4 disp-image" id="patient_image">
                                                        <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . $img_nmee ?>"/>
                                                </div>

                                                <?php
                                        }
                                }
                        }
                        ?>

                </div>


                <div class="row">


                        <?php
                        $branch = Branch::Branch();
                        //if (Yii::$app->user->identity->branch_id == '0') {
                        $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                        ?>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_general, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                        </div>
                        <?php //} ?>


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'patient_id')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'patient_old_id')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'first_name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'last_name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>     <?= $form->field($patient_general, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'age')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (!$patient_general->isNewRecord) {
                                        $patient_general->dob = date('d-m-Y', strtotime($patient_general->dob));
                                }
                                ?>
                                <?=
                                DatePicker::widget([
                                    'model' => $patient_general,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'dob',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'weight')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'blood_group')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'present_address')->textarea(['rows' => 1]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'pin_code')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'landmark')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'contact_number')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'email')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' >
                                <?php $managers = \common\models\StaffInfo::find()->where(['post_id' => 6])->orderBy(['staff_name' => SORT_ASC])->all(); ?>
                                <?= $form->field($patient_general, 'staff_manager')->dropDownList(ArrayHelper::map($managers, 'id', 'staff_name'), ['prompt' => '--Select--']) ?>


                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'status')->dropDownList(['1' => 'Active', '2' => 'Closed', '3' => 'Pending', '4' => 'Deceased']) ?>

                        </div>


                </div>



                <div style="clear:both"></div>





                <h4 class="h4-labels">Guardian Details</h4>
                <hr class="enquiry-hr"/>

                <div class="row">
                        <input type="checkbox" id="address_id" name="check" checkvalue="1" uncheckValue="0"><label style="color:black;font-weight:bold; margin-left: 5px;"> Guardian address and patient address are same</label>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                        <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>
                        <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php $nationality = Nationality::find()->where(['status' => '1'])->orderBy(['nationality' => SORT_ASC])->all(); ?>
                        <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'occupatiion')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 1]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number')->textInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div>
                <div class="row" style="margin:0;float: right">
                        <a class="btn btn-blue btn-icon btn-icon-standalone" id="enquirer_1" style="<?php if (isset($patient_info_second->caller_name_1) && $patient_info_second->caller_name_1 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Guardian</span></a>

                </div>


                <div style="clear:both"></div>
                <div class="row enquirer_1" style="margin: 0;<?php if (isset($model->first_name_1) && $model->first_name_1 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">
                        <span class="inquiry">
                                <h4 class="h4-labels" style="position: relative;">Guardian Details 1<a id="close_1" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a></h4>
                                <hr class="enquiry-hr"/>
                        </span>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'first_name_1')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'last_name_1')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'gender_1')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                                <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>
                                <?= $form->field($model, 'religion_1')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php $nationality = Nationality::find()->where(['status' => '1'])->orderBy(['nationality' => SORT_ASC])->all(); ?>
                                <?= $form->field($model, 'nationality_1')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'occupatiion_1')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address_1')->textarea(['rows' => 1]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode_1')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'landmark_1')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number_1')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_1')->textInput(['maxlength' => true]) ?>

                        </div><div style="clear:both"></div>

                        <div class="row" style="margin:0;float: right">
                                <a class="btn btn-blue btn-icon btn-icon-standalone" id="enquirer_2" style="<?php if (isset($model->first_name_2) && $model->first_name_2 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Guardian</span></a>

                        </div>


                </div>


                <div class="row enquirer_2" style="margin: 0;<?php if (isset($model->first_name_2) && $model->first_name_2 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">

                        <span class="inquiry">
                                <h4 class="h4-labels" style="position: relative;">Guardian Details 2<a id="close_2" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a></h4>
                                <hr class="enquiry-hr"/>
                        </span>


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'first_name_2')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'last_name_2')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'gender_2')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                                <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>
                                <?= $form->field($model, 'religion_2')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php $nationality = Nationality::find()->where(['status' => '1'])->orderBy(['nationality' => SORT_ASC])->all(); ?>
                                <?= $form->field($model, 'nationality_2')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'occupatiion_2')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address_2')->textarea(['rows' => 1]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode_2')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'landmark_2')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number_2')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_2')->textInput(['maxlength' => true]) ?>

                        </div><div style="clear:both"></div>
                        

                </div>


                <div style="clear:both"></div>
                <h4 class="h4-labels">Other Details</h4>
                <hr class="enquiry-hr"/>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'police_station_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'police_station_email')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'panchayath_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'ward_no')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_mobile_no')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'diagnosis')->textarea(['rows' => 2]) ?>

                </div>

                <div style="clear:both"></div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_general, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='2'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>

                </div>

        </div>

        <div style = "clear:both"></div>

        <div id = "p_attach">
                <input type = "hidden" id = "delete_port_vals" name = "delete_port_vals" value = "">
                <h4 style = "color:#000;font-style: italic;">Attachments</h4>
                <hr class = "enquiry-hr"/>


                <span>
                        <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class = "form-group field-staffperviousemployer-hospital_address">
                                        <label class = "control-label">Attachment</label>
                                        <input type = "file" name = "creates[file][]">

                                </div>
                        </div>
                        <?php
                        $rand = rand();
                        $uploads_type = common\models\UploadCategory::find()->where(['status' => 1, 'type' => 1])->all();
                        ?>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-designation">
                                        <label class="control-label" for="">Attachment Name</label>
                                        <?= Html::dropDownList('creates[file_name][]', null, ArrayHelper::map($uploads_type, 'id', 'sub_category'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'atachment_' . $rand]); ?>
                                        <a class="add-option-dropdown add-new" id="atachment_<?= $rand ?>-5" style="margin-top:0px;" type='1'> + Add New</a>

                                </div>
                        </div>


                        <div style="clear:both"></div>
                </span>
                <br/>
        </div>

        <div class="row">
                <div class="col-md-6">
                        <a id="addAttach" class="btn btn-blue btn-icon btn-icon-standalone addAttach" type="1"><i class="fa-plus"></i><span> Add More</span></a>
                </div>
        </div>




        <div style="clear:both"></div>


        <?php if (!$model->isNewRecord) { ?>
                <br/>

                <div class="row">
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $patient_general->id;

                        if (count(glob("{$path}/*")) > 0) {
                                echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Uploaded Files</h4>";

                                $z = 0;
                                foreach (glob("{$path}/*") as $file) {
                                        $z++;
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nmees = explode('.', $img_nmee);
                                        ?>

                                        <div class = "col-md-2 img-box" id="ss_<?= $z; ?>">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                <a  title="Delete" class="patient-img-remove" id="<?= $patient_general->id . "-" . $img_nmee . "-" . $z; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                }
                        }
                        ?>
                </div>

        <?php } ?>






        <!--        <div class="row">

        <?php
        /* if (!$model->isNewRecord) {

          $images = array('passport');
          $i = 0;

          foreach ($images as $value) {
          if ($model->$value != '') {
          $i++;
          if ($i == 1) {

          echo '<div class="col-md-2">';
          }
          ?>
          <div class="img_data">
          <a href="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . $value . '.' . $model->$value; ?>" target="_blank"><?= $model->getAttributeLabel($value); ?></a>
          </div>
          <?php
          if ($i == 5) {
          echo '</div><div class="col-md-2">';
          }
          }
          }
          if ($i > 0)
          echo '</div>';
          } */
        ?>



                        ---------------View uploaded files-------






                </div>-->

</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($patient_general->isNewRecord ? 'Create' : 'Update', ['class' => $patient_general->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>


<script>
        $(document).ready(function () {
                $('#patientgeneral-branch_id').change(function () {
                        var branch = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {branch: branch},
                                url: homeUrl + 'ajax/patientid',
                                success: function (data) {

                                        $('#patientgeneral-patient_id').val(data);
                                }
                        });
                });
        });
</script>
<style>
        .remove-enquirer{
                position: absolute;
                right: 0px;
                margin-bottom: 0px;
                top: -10px;
        }
</style>