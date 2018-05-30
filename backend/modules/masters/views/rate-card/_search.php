<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RateCardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-card-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'rate_card_name') ?>

    <?= $form->field($model, 'rate_per_hour') ?>

    <?= $form->field($model, 'rate_per_visit') ?>

    <?php // echo $form->field($model, 'rate_per_day') ?>

    <?php // echo $form->field($model, 'rate_per_night') ?>

    <?php // echo $form->field($model, 'rate_per_day_night') ?>

    <?php // echo $form->field($model, 'period_from') ?>

    <?php // echo $form->field($model, 'period_to') ?>

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
