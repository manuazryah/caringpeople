<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceDiscounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-discounts-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?php $model->rate = $service->estimated_price; ?>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'readonly' => TRUE]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'discount_type')->radioList(array('1' => 'Percentage (%)', 2 => 'Fixed (Rs.)')); ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'discount_value')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true, 'readonly' => true]) ?>

        </div>

        <div class='row' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

        <label class="previous-discounts">Previously Added Discounts</label>
        <?php
        $searchModel = new \common\models\ServiceDiscountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['service_id' => $service->id]);
        ?>
        <div class="table-responsive discounts-table">

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'discount_type',
                            'value' => function($model) {
                                    if ($model->discount_type == '1') {
                                            return 'Percentage';
                                    } else if ($model->discount_type == '2') {
                                            return 'Fixed';
                                    }
                            }
                        ],
                        'discount_value',
                        'date',
                    // 'total_amount',
                    ],
                ]);
                ?>
        </div>

</div>

<style>
        .discounts-table .filters{
                display: none;
        }.discounts-table table{
                text-align: center;
                width: 80%;
        } .discounts-table th{
                text-align: center;
        }.table-responsive{
                border:none;
        }.previous-discounts{
                font-size: 15px;
                font-weight: bold;
                color: #000;
                text-decoration: underline;
        }
</style>
