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
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'category')->dropDownList(['' => '--Select--', '1' => 'Assessment', '2' => 'Staff Skills']) ?>

                </div>

                <?php $sub_category = \common\models\AssessmentCategory::find()->where(['status' => 1])->all(); ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="sub_category">    <?= $form->field($model, 'sub_category')->dropDownList(ArrayHelper::map($sub_category, 'id', 'sub_category'), ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12' >
                        <div class="form-group" >
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                        </div>
                </div>

                <?php ActiveForm::end(); ?>

        </div>


        <script>
                $(document).ready(function () {
                        $('#sub_category').hide();
                        $('#staffexperiencelist-category').change(function () {
                                if ($(this).val() == '1')
                                        $('#sub_category').show();
                                else
                                        $('#sub_category').hide();
                        });


                        var category = $('#staffexperiencelist-category').val();
                        if (category == '1')
                                $('#sub_category').show();
                        else
                                $('#sub_category').hide();

                });
        </script>