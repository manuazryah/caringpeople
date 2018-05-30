<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\City;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessPartner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-partner-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $city = ArrayHelper::map(City::find()->where(['status' => 1])->all(), 'id', 'city_name');
    $model->type = $type;
    ?>

    <input type="hidden" id="businesspartner-type" class="form-control" name="BusinessPartner[type]" value="<?= $type ?>" aria-required="true" aria-invalid="false">
    <?php
    if ($model->isNewRecord) {
        $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 5])->one();
        $model->business_partner_code = $this->context->generatePartner($serial_no->prefix, $serial_no->sequence_no);
    }
    ?>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'business_partner_code')->textInput(['maxlength' => true, 'readonly' => 'true'])->label('Partner Code') ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'phone')->textInput() ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 remove-padd'>
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php if (!empty($model->id)) { ?>
                <?= Html::a('Reset', ['index', 'type' => $type], ['class' => 'btn btn-gray btn-reset']) ?>
            <?php }
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
