<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;
use common\models\State;
use common\models\City;

/* @var $this yii\web\View */
/* @var $model common\models\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>       <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'> <?= $form->field($model, 'branch_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'> <?php $country = Country::find()->where(['status' => '1'])->all(); ?>    <?= $form->field($model, 'country')->dropDownList(ArrayHelper::map($country, 'id', 'country_name'), ['prompt' => '--Select--', 'class' => 'form-control country-change']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'> <?php
                if (!$model->isNewRecord) {
                        $states = State::find()->where(['country_id' => $model->country, 'status' => '1'])->all();
                } else {
                        $states = [];
                }
                echo $form->field($model, 'state')->dropDownList(ArrayHelper::map($states, 'id', 'state_name'), ['prompt' => '--Select--', 'class' => 'form-control state-change']);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?php
                if (!$model->isNewRecord) {
                        $city = City::find()->where(['country_id' => $model->country, 'state_id' => $model->state, 'status' => '1'])->all();
                } else {
                        $city = [];
                }
                echo $form->field($model, 'city')->dropDownList(ArrayHelper::map($city, 'id', 'city_name'), ['prompt' => '--Select--', 'class' => 'form-control city-change']);
                ?>



        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textArea(['rows' => 2]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_number1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_number2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person_email')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['' => '--Select--', '1' => 'Enabled', '0' => 'Disabled']) ?>

        </div> <div style="clear:both"></div>

        <h4 class="h4-labels">Bank Details</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'account_holder')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_account')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_ifsc')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12'>
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
