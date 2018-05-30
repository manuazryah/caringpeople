<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AccountHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-head-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'ac_holder')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'ifsc_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>     <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-12 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
