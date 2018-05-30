<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\StaffExperienceList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-experience-list-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <?php $category = common\models\SkillsCategory::find()->where(['status'=>1])->all(); ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map($category, 'id', 'category'), ['prompt' => '--Select--']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>
        </div>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12' >
                        <div class="form-group" >
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                        </div>
                </div>

                <?php ActiveForm::end(); ?>

        </div>
