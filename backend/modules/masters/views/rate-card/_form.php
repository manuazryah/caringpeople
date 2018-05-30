<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasterServiceTypes;
use kartik\date\DatePicker;
use common\models\Branch;

$branch = Branch::branch();
if ($model->isNewRecord)
        $action = 1;
else
        $action = 2;
/* @var $this yii\web\View */
/* @var $model common\models\RateCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-card-form form-inline">



        <?php $form = ActiveForm::begin(['id' => 'rate-card']); ?>
        <input type="hidden" value="<?= $action ?>" id="action">


        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--',]) ?>

        </div>
        <?php
        $services = MasterServiceTypes::find()->where(['status' => 1])->all();
        ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map($services, 'id', 'service_name'), ['prompt' => '--Service--']) ?>

        </div>
        <?php
        if (!$model->isNewRecord) {
                $sub_services = common\models\SubServices::find()->where(['service' => $model->service_id, 'branch_id' => $model->branch_id])->all();
        } else {
                $sub_services = [];
        }
        ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_service')->dropDownList(ArrayHelper::map($sub_services, 'id', 'sub_service'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_card_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_hour')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_visit')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_day')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_night')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_day_night')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_price')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'estimated_staff_price')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>

        <div class='col-md-2 col-sm-6 col-xs-12'>
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
