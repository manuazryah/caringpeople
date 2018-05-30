<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tax */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tax-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <?= $form->field($model, 'type')->dropDownList(['0' => 'Percentage', '1' => 'Flat']) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <?= $form->field($model, 'value')->textInput() ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php if (!empty($model->id)) { ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-gray btn-reset']) ?>
            <?php }
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
