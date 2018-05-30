<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tax-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-4">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'type')->dropDownList(['0' => 'Percentage', '1' => 'Flat']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'status')->dropDownList(['0' => 'Disabled', '1' => 'Enabled']) ?>
    </div>


    <div class="col-md-4" style="margin-top: 23px;">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
            <?php // Html::resetButton('Reset', ['class' => 'btn btn-default', 'style' => 'background-color: #e6e6e6;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
