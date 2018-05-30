<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-search">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>
        <div class="row patient-advanced-search-form">
                <div class="col-md-12">
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'patient_id') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'first_name')->label('Patient Name') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'age') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'blood_group') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'landmark') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'contact_number') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'email') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'guardian_name') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'guardian_id_or_passport_no') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'guardian_landmark') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'guardian_contact_no') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'guardian_email') ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group">
                                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top:20px']) ?>
                                        <?= Html::resetButton('Reset', ['class' => 'btn btn-default', 'style' => 'margin-top:20px']) ?>
                                </div>
                        </div>
                </div>
        </div>
        <?php ActiveForm::end(); ?>


</div>
