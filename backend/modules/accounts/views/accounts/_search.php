<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\InvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-search">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        $model->createdFrom = $from;
        $model->createdTo = $to;
        ?>

        <div class="col-md-4">
                <div class="form-group field-accountssearch-createdfrom">
                        <label class="control-label" for="enquiry-contacted_date">From Date</label>
                        <?php
                        $from = date('d-m-Y', strtotime($from));

                        echo DatePicker::widget([
                            'name' => 'AccountsSearch[createdFrom]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $from,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]);
                        ?>
                </div>

        </div>

        <div class="col-md-4">

                <div class="form-group field-accountssearch-createdTo">
                        <label class="control-label" for="enquiry-contacted_date">To Date</label>
                        <?php
                        $to = date('d-m-Y', strtotime($to));
                        echo DatePicker::widget([
                            'name' => 'AccountsSearch[createdTo]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $to,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]);
                        ?>
                </div>

        </div>

        <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top: 20px;']) ?>

        </div>

        <?php ActiveForm::end(); ?>

</div>
