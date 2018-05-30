<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryGeneralFirstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-general-first-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'contacted_source') ?>

    <?= $form->field($model, 'contacted_date') ?>

    <?= $form->field($model, 'incoming_missed') ?>

    <?php // echo $form->field($model, 'outgoing_number_from') ?>

    <?php // echo $form->field($model, 'outgoing_number_from_other') ?>

    <?php // echo $form->field($model, 'outgoing_call_date') ?>

    <?php // echo $form->field($model, 'caller_name') ?>

    <?php // echo $form->field($model, 'caller_gender') ?>

    <?php // echo $form->field($model, 'referral_source') ?>

    <?php // echo $form->field($model, 'referral_source_others') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'mobile_number_2') ?>

    <?php // echo $form->field($model, 'mobile_number_3') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
