<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?php // Html::a('<i class="fa-th-list"></i><span> Create Stock View</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
//                            'id',
//                            'item_id',
                                                'item_code',
                                                'item_name',
//                            'mrp',
                                                'retail_price',
                                                // 'ws_price',
                                                // 'location_code',
                                                'available_qty',
                                            // 'available_weight',
                                            //    'average_cost',
                                            // 'error_msg',
                                            // 'status',
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
//                            ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


