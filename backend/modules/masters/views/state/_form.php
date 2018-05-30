<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $country = ArrayHelper::map(Country::find()->where(['status' => 1])->all(), 'id', 'country_name');
    ?>

    <div class='col-md-4 col-sm-6 col-xs-12'>

        <?= $form->field($model, 'country_id')->dropDownList($country, ['prompt' => '-Select-']) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>

        <?= $form->field($model, 'state_name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>

        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>

    </div>


    <?php ActiveForm::end(); ?>

</div>
