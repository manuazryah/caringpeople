<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Tax;
use common\models\Hsn;
use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\ItemMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-master-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $tax = ArrayHelper::map(Tax::find()->where(['status' => 1])->all(), 'id', 'name');
        $base_unit = ArrayHelper::map(BaseUnit::find()->where(['status' => 1])->all(), 'id', 'name');
        if ($model->isNewRecord) {
                $hsn_datas = [];
        } else {
                $hsn_datas = ArrayHelper::map(Hsn::find()->where(['status' => 1, 'tax' => $model->tax_id])->all(), 'id', 'hsn_name');
        }
        ?>
        <div class="row row-mrgn">
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

                </div>
                <!--                <div class='col-md-3 col-sm-6 col-xs-12'>
                <?= $form->field($model, 'item_type')->dropDownList(['0' => 'Cost', '1' => 'Service']) ?>

                                </div>-->

                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'tax_id')->dropDownList($tax, ['prompt' => '-Choose Tax-']) ?>

                </div>
                <!--                <div class='col-md-3 col-sm-6 col-xs-12'>
                <?= $form->field($model, 'hsn')->dropDownList($hsn_datas, ['prompt' => '-Choose HSN-']) ?>

                                </div>-->
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'base_unit_id')->dropDownList($base_unit, ['prompt' => '-Choose Base Unit-']) ?>

                </div>

                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'MRP')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'retail_price')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'item_cost')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'whole_sale_price')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12'>
                        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>
        </div>
        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
<script>
        $("document").ready(function () {
                $('#itemmaster-tax_id').on('change', function () {
                        var tax = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {tax_id: tax},
                                url: '<?= Yii::$app->homeUrl; ?>product/item-master/hsn',
                                success: function (data) {
                                        $('#itemmaster-hsn').html(data);
                                }
                        });
                });
        });
</script>