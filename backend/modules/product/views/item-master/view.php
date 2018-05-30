<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminUsers;
use common\models\Tax;
use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\ItemMaster */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Item Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Item</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="item-master-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?=
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>

                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
//                                                            'id',
                                                        'SKU',
                                                        'item_name',
//                                                            [
//                                                            'attribute' => 'item_type',
//                                                            'value' => call_user_func(function($model) {
//                                                                            if ($model->item_type == 0) {
//                                                                                    return 'Cost';
//                                                                            } else {
//                                                                                    return 'Purchase';
//                                                                            }
//                                                                    }, $model),
//                                                        ],
                                                        [
                                                            'attribute' => 'tax_id',
                                                            'value' => call_user_func(function($model) {
                                                                            return Tax::findOne($model->tax_id)->value;
                                                                    }, $model),
                                                        ],
                                                            [
                                                            'attribute' => 'base_unit_id',
                                                            'value' => call_user_func(function($model) {
                                                                            return BaseUnit::findOne($model->base_unit_id)->value;
                                                                    }, $model),
                                                        ],
                                                        'MRP',
                                                        'retail_price',
                                                        'purchase_price',
                                                        'whole_sale_price',
                                                        'item_cost',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => call_user_func(function($model) {
                                                                            if ($model->status == 1) {
                                                                                    return 'ENABLED';
                                                                            } else {
                                                                                    return 'DISABLED';
                                                                            }
                                                                    }, $model),
                                                        ],
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


