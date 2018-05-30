<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">



                                        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>


                                        <div class="table-responsive" style="border:none;">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        // 'patient_id',
                                                        [
                                                            'attribute' => 'service_id',
                                                            'value' => function($model) {
                                                                    if (!empty($model->service_id)) {
                                                                            $service_id = \common\models\Service::findOne($model->service_id);
                                                                            return $service_id->service_id;
                                                                    }
                                                            },
                                                        ],
                                                        'amount',
                                                        // 'CB',
                                                        [
                                                            'attribute' => 'DOC',
                                                            'header' => 'Date',
                                                        ],
                                                            [
                                                            'attribute' => 'status',
                                                            'format' => 'html',
                                                            'value' => function($model) {
                                                                    if ($model->status == 1) {
                                                                            return '<span class="paid">Paid</span>';
                                                                    } else if ($model->status == 2) {
                                                                            return '<span class="unpaid">Unpaid</span>';
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'filter' => ['1' => 'Paid', '2' => 'Unpaid']
                                                        ],
                                                            ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{print}',
                                                            'buttons' => [
                                                                //view button
                                                                'print' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'print'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'print') {
                                                                            $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                                                            $url = Url::to(['dashboard/invoicebill', 'id' => $id]);
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
</div>


<style>
        .paid{
                color: green;
        } .unpaid{
                color: red;
        }
</style>


