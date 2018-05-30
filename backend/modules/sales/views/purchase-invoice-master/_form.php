<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PurchaseInvoiceMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-invoice-master-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'sales_invoice_number')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'sales_invoice_date')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'order_type')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'busines_partner_code')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'salesman')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'payment_terms')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'delivery_terms')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'tax_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'order_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'ship_to_adress')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'card_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'cash_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'round_of_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'amount_payed')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'due_amount')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'payment_status')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'error_message')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'status')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'CB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'UB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'DOC')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'DOU')->textInput() ?>

</div>        <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>

<?php ActiveForm::end(); ?>

</div>
