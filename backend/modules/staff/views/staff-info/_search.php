<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Religion;
use common\models\Caste;
use yii\helpers\ArrayHelper

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-info-search staff-info-advance">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>
        <div class="col-md-12">


                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>
                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $religion = Religion::find()->where(['status' => '1'])->all(); ?>  <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control religion-change']) ?>
                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $caste = []; ?>
                        <?= $form->field($model, 'caste')->dropDownList(ArrayHelper::map($caste, 'id', 'caste'), ['prompt' => '--Select--', 'class' => 'form-control caste-change']); ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php echo $form->field($model, 'contact_no') ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php echo $form->field($model, 'email') ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php echo $form->field($model, 'place') ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php echo $form->field($model, 'blood_group') ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php echo $form->field($model, 'years_of_experience') ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'driving_licence')->dropDownList(['' => '--Select--', '0' => 'No', '1' => 'Motor Cycle & LMV', '2' => 'Motor Cycle', '3' => 'LMV']) ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'uniform')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No','2'=>'Returned']) ?>
                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'company_id')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No','2'=>'Returned']) ?>
                </div>
                <?php // echo $form->field($model, 'nationality')  ?>

                <?php // echo $form->field($model, 'pan_or_adhar_no')  ?>

                <?php // echo $form->field($model, 'permanent_address')  ?>

                <?php // echo $form->field($model, 'pincode')  ?>

                <?php // echo $form->field($model, 'contact_no')  ?>

                <?php // echo $form->field($model, 'email')  ?>

                <?php // echo $form->field($model, 'present_address')  ?>

                <?php // echo $form->field($model, 'present_pincode')  ?>

                <?php // echo $form->field($model, 'present_contact_no')  ?>

                <?php // echo $form->field($model, 'present_email')  ?>

                <?php // echo $form->field($model, 'years_of_experience')  ?>

                <?php // echo $form->field($model, 'driving_licence')  ?>

                <?php // echo $form->field($model, 'licence_no')  ?>

                <?php // echo $form->field($model, 'sslc_institution')  ?>

                <?php // echo $form->field($model, 'sslc_year_of_passing')  ?>

                <?php // echo $form->field($model, 'sslc_place')  ?>

                <?php // echo $form->field($model, 'hse_institution')  ?>

                <?php // echo $form->field($model, 'hse_year_of_passing')  ?>

                <?php // echo $form->field($model, 'hse_place')  ?>

                <?php // echo $form->field($model, 'nursing_institution')  ?>

                <?php // echo $form->field($model, 'nursing_year_of_passing')  ?>

                <?php // echo $form->field($model, 'nursing_place')  ?>

                <?php // echo $form->field($model, 'timing')  ?>

                <?php // echo $form->field($model, 'profile_image_type')  ?>

                <?php // echo $form->field($model, 'uniform')  ?>

                <?php // echo $form->field($model, 'company_id')  ?>

                <?php // echo $form->field($model, 'emergency_conatct_verification')  ?>

                <?php // echo $form->field($model, 'panchayath_cleraance_verification')  ?>

                <?php // echo $form->field($model, 'biodata')  ?>

                <?php // echo $form->field($model, 'branch_id')  ?>

                <?php // echo $form->field($model, 'status')  ?>

                <?php // echo $form->field($model, 'CB')  ?>

                <?php // echo $form->field($model, 'UB')  ?>

                <?php // echo $form->field($model, 'DOC')  ?>

                <?php // echo $form->field($model, 'DOU')    ?>
        </div>
        <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
