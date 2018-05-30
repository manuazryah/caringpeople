<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockAdjDtlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Adjustments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-adj-dtl-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> New Stock Adjustment</span>', ['add'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <button class="btn btn-success btn-icon" id="search-option" style="float: right;">
                        <i class="linecons-search"></i>
                        <span>Search</span>
                    </button>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
//                            'StockAdjMstId',
                            [
                                'attribute' => 'transaction',
                                'value' => function ($data) {
                                    if ($data->transaction == 0) {
                                        return 'Opening';
                                    } elseif ($data->transaction == 1) {
                                        return 'Addition';
                                    } elseif ($data->transaction == 2) {
                                        return 'Deduction';
                                    }
                                },
                                'filter' => [0 => 'Opening', 1 => 'Addition', 2 => 'Deduction'],
                            ],
                            'document_no',
                            'document_date',
                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    if ($data->status == 0) {
                                        return 'Open';
                                    } elseif ($data->status == 1) {
                                        return 'Approved';
                                    }
                                },
                                'filter' => [0 => 'Open', 1 => 'Approved'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => [],
                                'headerOptions' => ['style' => 'width:75px;'],
                                'header' => 'Actions',
                                'template' => '{view}{approve}',
                                'buttons' => [
                                    //view button
                                    'approve' => function ($url, $model) {
                                        if ($model->status == 0) {
                                            return Html::a('<span class="fa fa-check" style="padding-top: 0px;font-size: 18px;color: green;"></span>', $url, [
                                                        'title' => Yii::t('app', 'approve'),
                                                        'class' => 'actions',
                                            ]);
                                        }
                                    },
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-eye" style="padding-top: 0px;font-size: 20px;"></span>', $url, [
                                                    'title' => Yii::t('app', 'view'),
                                                    'class' => 'actions',
                                        ]);
                                    },
                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'approve') {
                                        $url = Url::to(['stock-adj-dtl/approve', 'id' => $model->id]);
//                                        $url = 'report';
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url = Url::to(['stock-adj-dtl/view', 'id' => $model->id]);
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".filters").slideToggle();
        $("#search-option").click(function () {
            $(".filters").slideToggle();
        });
    });
</script>

