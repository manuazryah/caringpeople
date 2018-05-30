<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Tax;
use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-master-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Add Item</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                                                'SKU',
                                                'item_name',
//                                                    [
//                                                    'attribute' => 'item_type',
//                                                    'format' => 'raw',
//                                                    'filter' => [1 => 'Purchase', 0 => 'Cost'],
//                                                    'value' => function ($model) {
//                                                            return $model->item_type == 1 ? 'Purchase' : 'Cost';
//                                                    },[
//                                                ],
                                                [
                                                    'attribute' => 'tax_id',
                                                    'format' => 'raw',
                                                    'value' => function ($model) {
                                                            return Tax::findOne($model->tax_id)->value;
                                                    },
                                                ],
                                                    [
                                                    'attribute' => 'base_unit_id',
                                                    'format' => 'raw',
                                                    'value' => function ($model) {
                                                            return BaseUnit::findOne($model->base_unit_id)->value;
                                                    },
                                                ],
                                                // 'MRP',
                                                // 'retail_price',
                                                // 'purchase_price',
                                                // 'item_cost',
                                                // 'status',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


