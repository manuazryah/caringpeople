<?php

use yii\helpers\Html;
?>
<style>
        .checkbox_css{
                width: 20px;
                height:20px;
        }
        .top{
                margin-top: 28px;
        }
</style>

<div class="patient-chronic-form form-inline">


        <div class="row">

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>

                        <?=
                        $form->field($model, 'asthma', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'cardiac', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>


                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'emotional_behaviour_disturbance', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'bleeding_disorders', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'urinary_infection', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'vision_contacts', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'convolutions', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'syncope', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'teeth_dentures', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'ear_infection', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'psychiatry', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'Other', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div>

                <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'othersspecify')->textarea(['rows' => 1]) ?>


                </div>
                <div style="clear:both"></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'diabetic', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'diabetic_since')->textInput(['rows' => 1]) ?>

                </div><div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'diabetic_medication')->textarea(['rows' => 1]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'hypertension', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'hypertension_since')->textInput(['rows' => 6]) ?>

                </div><div class='col-md-5 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hypertension_medication')->textarea(['rows' => 1]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'allergy', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-10 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'allergy_specify')->textarea(['rows' => 1]) ?>

                </div>
                <div style="clear:both"></div>
                <div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'serology')->radioList(array('1' => 'HIV', 2 => 'HCV', 3 => 'VDRL', 4 => 'HBsAg')); ?>


                </div>

                <div class='col-md-7 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'serology_specify')->textarea(['rows' => 1]) ?>

                </div>
                <div style="clear:both"></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'psychiatry_disease', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?=
                        $form->field($model, 'communicable_disease', [
                            'template' => "<label class='cbr-inline top'>{input}</label>",
                        ])->checkbox(['class' => 'cbr'])
                        ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'others_specify')->textarea(['rows' => 1]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'history_of_surgery')->radioList(array('1' => 'Yes', '2' => 'No')); ?>
                </div><div class='col-md-9 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'specify_surgery_details')->textarea(['rows' => 1]) ?>

                </div>
                <div style="clear:both"></div>
                <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name_of_doctor_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'doctor1_mob')->textInput() ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name_of_hospital_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital1_phone_no')->textInput() ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name_of_doctor_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'doctor2_mob')->textInput() ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name_of_hospital_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital2_phone_no')->textInput() ?>

                </div>        </div>


</div>
<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>
