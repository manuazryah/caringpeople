<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DemoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-index">

        <div class="row">
                <div class="col-md-12">
                        <div class="page-title">

                                <div class="title-env">
                                        <h1 class="title"><?= Html::encode($this->title) ?></h1>
                                </div>
                        </div>

                </div>
        </div>
        <div class="row">
                <div class="col-md-12">

                        <div class="col-md-9">
                                <div class="panel panel-default">
                                        <div class="panel-body table-responsive">
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>
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

                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'pager' => ['firstPageLabel' => 'First', 'lastPageLabel' => 'Last'],
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                                                        [
                                                            'attribute' => 'type',
                                                            'label' => 'Partner Code',
                                                            'value' => 'business_partner_code'
                                                        ],
                                                        'name',
                                                            [
                                                            'attribute' => 'type',
                                                            'format' => 'raw',
                                                            'filter' => [0 => 'Customer', 1 => 'Supplier'],
                                                            'value' => function ($model) {
                                                                    return $model->type == 1 ? 'Supplier' : 'Customer';
                                                            },
                                                        ],
//                                'email:email',
                                                        [
                                                            'attribute' => 'phone',
                                                            'value' => function ($model) {
                                                                    if (isset($model->phone)) {
                                                                            return $model->phone;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'email',
                                                            'value' => function ($model) {
                                                                    if (isset($model->email)) {
                                                                            return $model->email;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'city',
                                                            'value' => function ($model) {
                                                                    if (isset($model->city)) {
                                                                            return $model->city;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'status',
                                                            'format' => 'raw',
                                                            'filter' => [0 => 'Disabled', 1 => 'Enabled'],
                                                            'value' => function ($model) {
                                                                    return $model->status == 1 ? 'Enabled' : 'Disabled';
                                                            },
                                                        ],
                                                        // 'CB',
                                                        // 'UB',
                                                        // 'DOC',
                                                        // 'DOU',
                                                        [
                                                            'class' => 'yii\grid\ActionColumn',
                                                            'contentOptions' => ['style' => 'width:100px;'],
                                                            'header' => 'Actions',
                                                            'template' => '{update}{delete}',
                                                            'buttons' => [
                                                                'update' => function ($url, $model) {
                                                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'update'),
                                                                                    'class' => '',
                                                                        ]);
                                                                },
                                                                'delete' => function ($url, $model) {
                                                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'delete'),
                                                                                    'class' => '',
                                                                                    'data' => [
                                                                                        'confirm' => 'Are you absolutely sure ?',
                                                                                    ],
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'update') {
                                                                            $url = Url::to(['business-partner/index', 'id' => $model->id, 'type' => $model->type]);
                                                                            return $url;
                                                                    }
                                                                    if ($action === 'delete') {
                                                                            $url = Url::to(['business-partner/del', 'id' => $model->id]);
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

                        <div class="col-md-3">
                                <div class="panel panel-default">
                                        <div class="panel-body"><div class="demo-create">

                                                        <?=
                                                        $this->render('_form', [
                                                            'model' => $model,
                                                            'type' => $type,
                                                        ])
                                                        ?>
                                                </div>
                                        </div>
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


