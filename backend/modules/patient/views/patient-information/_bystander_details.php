<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PatientBystanderDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-bystander-details-form form-inline">

        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$model->isNewRecord) {

                                $model->service_need_for = explode(',', $model->service_need_for);
                        }
                        ?>

                        <?= $form->field($model, 'service_need_for')->dropDownList(['1' => 'Home', '2' => 'Hospital'], ['multiple' => 'multiple', 'style' => 'height:40px !important']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'room_no')->textInput() ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'consulting_doctor')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'no_of_days')->textInput() ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>


                        <?php
                        if (!$model->isNewRecord) {
                                $model->can_provide = explode(',', $model->can_provide);
                        }
                        ?>
                        <?= $form->field($model, 'can_provide')->dropDownList(['1' => 'Food', '2' => 'Accommodation', '3' => 'Transportation'], ['multiple' => 'multiple', 'style' => 'height:58px !important']) ?>

                </div>        </div>


</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>
