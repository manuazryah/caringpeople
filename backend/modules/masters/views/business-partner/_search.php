<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessPartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-partner-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="col-md-4">
        <?= $form->field($model, 'type')->dropDownList(['0' => 'Customer', '1' => 'Supplier'], ['prompt' => 'Select Type'])->label('Type') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'business_partner_code') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'phone') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled'], ['prompt' => 'Select Status']) ?>
    </div>


    <div class="col-md-4" style="margin-top: 23px;">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
            <?php // Html::resetButton('Reset', ['class' => 'btn btn-default', 'style' => 'background-color: #e6e6e6;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
