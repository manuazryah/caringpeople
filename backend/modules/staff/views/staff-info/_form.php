<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\MasterDesignations;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="staff-info-form form-inline">
    
        
     <div class="row">
                <div class="col-md-8">
                        <h4 class="h4-labels"></h4>

                </div>
                <?php
                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $model->id;
                if (count(glob("{$path}/*")) > 0) {
                        foreach (glob("{$path}/*") as $file) {
                                $arry = explode('/', $file);
                                $img_nmee = end($arry);
                                $img_nam = explode('.', $img_nmee);

                                if ($img_nam[0] == 'Profile Image') {
                                        ?>
                                        <div class="col-md-4 disp-image" id="patient_image">
                                                <img src="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/' . $img_nmee ?>"/>
                                        </div>

                                        <?php
                                }
                        }
                }
                ?>




        </div>
    

 <?php
     if (Yii::$app->user->identity->branch_id == '0') {
                $branch = Branch::Allbranch();
        } else {
                $branch = Branch::Branch();
        }
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php //} ?>


        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'staff_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        </div>
        <?php if ($model->isNewRecord) { ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
                </div>

        <?php } ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' >

         <?php
                if (Yii::$app->session['post']['id'] == '1') {
                        $posts = \common\models\AdminPosts::find()->orderBy(['post_name' => SORT_ASC])->all();
                } else {
                        $posts = \common\models\AdminPosts::find()->where(['id' => 5])->orderBy(['post_name' => SORT_ASC])->all();
                }
                ?>

                <?= $form->field($model, 'post_id')->dropDownList(ArrayHelper::map($posts, 'id', 'post_name'), ['prompt' => '--Select--']) ?>


        </div>
        <?php
        if (!$model->isNewRecord) {

                $model->designation = explode(',', $model->designation);
        }
        ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="designation">
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($model, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['class' => 'form-control', 'multiple' => 'multiple', 'style' => 'height:120px','id' => 'staffdesignation']) ?>
                <?php $form->field($model, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant', '12' => 'Nurse Manager']) ?>
<div class="div-add-new" style="margin-top: -20px;"><a class="add-option-dropdown add-new" id="staffdesignation<?= $rand ?>-13" style="margin-top:0px;"> + Add New</a></div>
        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' >
                <?php $managers = \common\models\StaffInfo::find()->where(['post_id' => 6])->orWhere(['post_id' => 10])->orderBy(['staff_name' => SORT_ASC])->all(); ?>
                <?= $form->field($model, 'staff_manager')->dropDownList(ArrayHelper::map($managers, 'id', 'staff_name'), ['prompt' => '--Select--']) ?>


        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffinfo-dob">
                        <label class="control-label" for="staffinfo-dob">DOB</label>
                        <?php
                        if (!$model->isNewRecord && $model->dob != '1970-01-01') {
                                $model->dob = date('d-m-Y', strtotime($model->dob));
                        } else {
                                $model->dob = '';
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffInfo[dob]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->dob,
                            'id'=>'dob',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'age')->textInput(['maxlength' => true,'id'=>'age']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>  <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control religion-change']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $caste = Caste::find()->where(['r_id' => $model->religion, 'status' => '1'])->all();
                } else {
                        $caste = [];
                }
                echo $form->field($model, 'caste')->dropDownList(ArrayHelper::map($caste, 'id', 'caste'), ['prompt' => '--Select--', 'class' => 'form-control caste-change']);
                ?>

        </div>

        <?php if (!$model->isNewRecord) { ?><div style="clear:both"></div><?php } ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php $nationality = Nationality::find()->where(['status' => '1'])->all(); ?>   <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div>


        <div style="clear:both"></div>

        <div class="row"><input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0" style="margin-left: 20px;"><label style="color:black;font-weight:bold;margin-left: 5px;">Permanent contact details and Present contact details are same</label>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'alternate_number_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'alternate_number_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pan_or_adhar_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

        </div>

<div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                $districts = \common\models\Districts::find()->where(['status' => 1])->all();
                if (!$model->isNewRecord) {
                        if (isset($model->area_interested) && $model->area_interested != '') {
                                $model->area_interested = explode(',', $model->area_interested);
                        }
                }
                ?>
                <?= $form->field($model, 'area_interested')->dropDownList(ArrayHelper::map($districts, 'id', 'district'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'district']) ?>
                

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>

                <?php
                $timing = \common\models\Timing::find()->where(['status' => 1])->all();
                if (!$model->isNewRecord) {
                        if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                $staff_edu->timing = explode(',', $staff_edu->timing);
                        }
                }
                ?>
                <?= $form->field($staff_edu, 'timing')->dropDownList(ArrayHelper::map($timing, 'id', 'timing'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'timing']) ?>
                <a class="add-option-dropdown add-new" id="timing-14"> <div class="div-add-new">+ Add New Timing</div></a>
        </div>

<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'years_of_experience')->textInput() ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'driving_licence')->dropDownList(['' => '--Select--', '0' => 'No', '1' => 'Motor Cycle & LMV', '2' => 'Motor Cycle', '3' => 'LMV']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'licence_no')->textInput(['maxlength' => true]) ?>

        </div>
        
        <div style="clear: both"></div>

        <h4 style="color:#000;font-style: italic;">Educational Qualification</h4>
        <hr class="enquiry-hr"/>


        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >SSLC </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_place')->textInput(['maxlength' => true]) ?>

        </div> <div style="clear:both"></div>

      <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >HSE </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_place')->textInput(['maxlength' => true]) ?>

        </div> <div style="clear:both"></div>
        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >Nursing </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'uniform')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No','2'=>'Returned']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'company_id')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No','2'=>'Returned']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'emergency_conatct_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'panchayath_cleraance_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Opened', '2' => 'Closed', '3' => 'Terminated', '4' => 'Resigned', '5' => 'Without Resignation']) ?>

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
                        $uploads_type = common\models\UploadCategory::find()->where(['status' => 1, 'type' => 2])->all();
                        ?>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-designation">
                                        <label class="control-label" for="">Attachment Name</label>
                                        <?= Html::dropDownList('creates[file_name][]', null, ArrayHelper::map($uploads_type, 'id', 'sub_category'), ['class' => 'form-control', 'prompt' => '--Select--','id' => 'atachment_' . $rand]); ?>
                                        <a class="add-option-dropdown add-new" id="atachment_<?= $rand ?>-5" style="margin-top:0px;" type='2'><div class="div-add-new"> + Add New </div></a>

                                </div>
                        </div>


                        <div style="clear:both"></div>
                </span>
                <br/>
        </div>

        <div class="row" style="margin:0">
                <div class="col-md-6">
                        <a id="addAttach" class="btn btn-blue btn-icon btn-icon-standalone addAttach" type="2"><i class="fa-plus"></i><span> Add More Attachments</span></a>
                </div>
        </div>




        <div style="clear:both"></div>


        <?php if (!$model->isNewRecord) { ?>
                <br/>

                <div class="row">
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $model->id;

                        if (count(glob("{$path}/*")) > 0) {
                                echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Uploaded Files</h4>";

                                $k = 0;
                                foreach (glob("{$path}/*") as $file) {
                                        $k++;
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nmees = explode('.', $img_nmee);
                                        ?>

                                        <div class = "col-md-2 img-box" id="<?= $k; ?>">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                <a  title="Delete" class="staff-enq-img-remove" id="<?= $model->id . "-" . $img_nmee . "-" . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                }
                        }
                        ?>
                </div>

        <?php } ?>

        <div class='row' style="margin:0">
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:123px;margin-left:12px;', 'id' => 'form_button']) ?>

                </div>
        </div>
</div>


<style>
        .img_data {
                margin-top: 16px;
        }
        a{
                color: #3c4ba1;
        }
</style>


<script>
$(document).ready(function(){
   $('#staffinfo-branch_id').change(function(){
     var branch=$(this).val();
     $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'ajax/staffid',
                        success: function (data) {
                            
                              $('#staffinfo-staff_id').val(data);
                        }
                });
   });

    $("#timing").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });


             $("#district").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

});
</script>

