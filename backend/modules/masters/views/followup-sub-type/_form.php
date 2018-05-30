<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FollowupType;

/* @var $this yii\web\View */
/* @var $model common\models\FollowupSubType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="followup-sub-type-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $type = ArrayHelper::map(FollowupType::find()->where(['status' => 1])->all(), 'id', 'type');
        ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'type_id')->dropDownList($type, ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_type')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
