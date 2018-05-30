<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-register-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
//                            'transaction',
//                            'document_line_id',
//                            'document_no',
//                            'document_date',
                            // 'item_id',
                            'item_code',
                            'item_name',
                            // 'location_code',
                            'item_cost',
                            'qty_in',
                            'qty_out',
                            'balance_qty',
                        // 'weight_in',
                        // 'weight_out',
                        // 'total_cost',
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


