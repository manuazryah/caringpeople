<?php

use yii\helpers\Html;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\PatientPresentCondition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-present-condition-form form-inline">

        <div class="row">
                <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'diagnosis')->textInput(['maxlength' => true]) ?>


                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'paralised_or_bedridden', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>
                </div><div class='col-md-9 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'paralised_specify')->textarea(['rows' => 1]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'ryles_tube_or_feeding_tube', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div>
                <div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'tube_size')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-patientpresentcondition-last_change_date">
                                <label class="control-label" for="patientpresentcondition-last_change_date">Last Change Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->last_change_date = date('d-m-Y', strtotime($model->last_change_date));
                                } else {
                                        $model->last_change_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'PatientPresentCondition[last_change_date]',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->last_change_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>

                                <div class="help-block"></div>
                        </div>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'iv_cannula', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div>
                <div class='col-md-9 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'specify')->textarea(['rows' => 1
                        ])
                        ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'foleys_cath_or_urine_tube', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'tube_no')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'foleys_tube_type')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-patientpresentcondition-foleys_last_change_date">
                                <label class="control-label" for="patientpresentcondition-foleys_last_change_date">Foleys Last Change Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->foleys_last_change_date = date('d-m-Y', strtotime($model->foleys_last_change_date));
                                } else {
                                        $model->foleys_last_change_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'PatientPresentCondition[foleys_last_change_date]',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->foleys_last_change_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>

                                <div class="help-block"></div>
                        </div>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
<?=
$form->field($model, 'bladder_wash', [
    'template' => "<label class='cbr-inline top'>{input}</label>",
])->checkbox(['class' => 'cbr'])
?>
                </div>
                <div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
<?= $form->field($model, 'bladder_wash_data')->textarea(['rows' => 1]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
<?= $form->field($model, 'cath_care')->textarea(['rows' => 1]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
<?=
$form->field($model, 'bed_sore', [
    'template' => "<label class='cbr-inline top'>{input}</label>",
])->checkbox(['class' => 'cbr'])
?>

                </div><div class='col-md-9 col-sm-6 col-xs-12 left_padd'>
<?= $form->field($model, 'others_specify')->textarea(['rows' => 1]) ?>

                </div>        </div>



</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>