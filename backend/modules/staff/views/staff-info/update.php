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
<?php $posts = \common\models\AdminPosts::find()->orderBy(['post_name' => SORT_ASC])->all(); ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'add-staff-form']]); ?>
<div class="staff-info-form form-inline">


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'staff_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none;">

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none;">

                <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none;">

                <?= $form->field($model, 'post_id')->dropDownList(ArrayHelper::map($posts, 'id', 'post_name'), ['prompt' => '--Select--']) ?>


        </div>


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>  <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control religion-change']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $caste = Caste::find()->where(['r_id' => $model->religion, 'status' => '1'])->all();
                } else {
                        $caste = [];
                }
                echo $form->field($model, 'caste')->dropDownList(ArrayHelper::map($caste, 'id', 'caste'), ['prompt' => '--Select--', 'class' => 'form-control caste-change']);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php $nationality = Nationality::find()->where(['status' => '1'])->all(); ?>   <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div>
        <div style="clear:both;"></div>
        <div class="row"><input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0" style="margin-left: 20px;"><label style="color:black;font-weight:bold;margin-left: 5px;">Permanent contact details and Present contact details are same</label>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pan_or_adhar_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($model, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>
                <?php $form->field($model, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant', '12' => 'Nurse Manager']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'years_of_experience')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'driving_licence')->dropDownList(['' => '--Select--', '0' => 'No', '1' => 'Motor Cycle & LMV', '2' => 'Motor Cycle', '3' => 'LMV']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'licence_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div style="clear: both"></div>
        <h2 style="color:#148eaf;">Educational Qualification</h2>
        <hr class="enquiry-hr"/>


        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >SSLC </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_place')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both"></div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >HSE </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_place')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both"></div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >Nursing </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_place')->textInput(['maxlength' => true]) ?>

        </div>

        <div class='col-md-12 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

                </div>
        </div>
        <div style="clear:both"></div>

        <?php if ($staff_uploads->biodata != '' || $staff_uploads->profile_image_type != '' || $staff_uploads->sslc != '' || $staff_uploads->hse != '' || $staff_uploads->KNC != '' || $staff_uploads->INC != '' || $staff_uploads->marklist != '' || $staff_uploads->experience != '' || $staff_uploads->id_proof != '' || $staff_uploads->PCC != '' || $staff_uploads->authorised_letter != '') { ?>
                <div class="row">
                        <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
                </div>
        <?php } ?>

        <div class="row">

                <?php
                if (!$model->isNewRecord) {
                        if ($staff_uploads->profile_image_type != '') {
                                $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                                //echo Yii::getAlias(@paths . '/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type;
                                ?>

                                <div class="col-md-2" id="profile_image_type">
                                        <?php $image_nme = 'profile_image_type.' . $staff_uploads->profile_image_type; ?>
                                        <img src="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/profile_image_type.' . $staff_uploads->profile_image_type; ?> " style="width:175px;height: 175px;"/>

                                </div>

                        <?php } ?>



                        <!-----------------View uploaded files--------->

                        <?php
                        $images = array('biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter');
                        $i = 0;

                        foreach ($images as $value) {

                                if ($staff_uploads->$value != '') {

                                        $i++;
                                        if ($i == 1) {

                                                echo '<div class="col-md-2">';
                                        }
                                        ?>
                                        <div class="img_data" id="<?= $value; ?>">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/staff/' . $staff_info->id . '/' . $value . '.' . $staff_uploads->$value; ?>" target="_blank"><?php
                                                        if ($value == 'authorised_letter') {
                                                                echo 'Authorised Letter';
                                                        } else {
                                                                echo $staff_uploads->getAttributeLabel($value);
                                                        }
                                                        ?></a>


                                                <?php
                                                if ($i == 5) {
                                                        echo '</div><div class="col-md-2">';
                                                }
                                        }
                                }
                                if ($i > 0)
                                        echo '</div>';

                                /*   View uploaded files    */
                        }
                        ?>




                </div>

        </div>
        <?php ActiveForm::end(); ?>


        <style>
                .img_data {
                        margin-top: 16px;
                }
                a{
                        color: #3c4ba1;
                }
        </style>


