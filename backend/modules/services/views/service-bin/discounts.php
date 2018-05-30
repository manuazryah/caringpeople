<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceDiscounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-discounts-form form-inline">



        <?php
        $searchModel = new \common\models\ServiceDiscountsBinSearch();
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
