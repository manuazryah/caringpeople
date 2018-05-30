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
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>

                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Invoice</span>', ['invoice'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?= Html::a('<i class="fa fa-print"></i><span> Estimated Pro Formas</span>', ['estimated-proformas'], ['class' => 'btn btn-success  btn-icon btn-icon-standalone']) ?>
                                        <?= Html::a('<i class="fa fa-print"></i><span> Print invoice</span>', ['print-invoice'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'target' => '_blank']) ?>



<div style="float: right">
                                                <?php
                                                $_SESSION['page_size'] = $pagesize;
                                                ?>
                                                <?= Html::beginForm() ?>

                                                <label style="float: left">Show
                                                        <?= Html::dropDownList('size', $pagesize, ['20' => '20', '50' => '50', '100' => '100'], ['class' => 'page-size-dropdwn', 'id' => 'size']); ?>
                                                        Entries
                                                </label>
                                                <input type="hidden" name="page-hidden" value="<?= $pagesize ?>">

                                                <?= Html::endForm() ?>

                                        </div>
                                        <div class="table-responsive" style="border:none;">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        // 'patient_id',
                                                        [
                                                            'attribute' => 'patient_id',
                                                            'value' => function($model) {
                                                                    if (!empty($model->patient_id)) {
                                                                            $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                            return $patient->first_name;
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'service_id',
                                                            'value' => function($model) {
                                                                    if (!empty($model->service_id)) {
                                                                            $service_id = \common\models\Service::findOne($model->service_id);
                                                                            return $service_id->service_id;
                                                                    }
                                                            },
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
                                                        // 'amount',
                                                        // 'CB',
                                                        // 'DOC',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{print}{refund}',
                                                            'buttons' => [
                                                                //view button
                                                                'print' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'print'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },


                                                               'refund' => function ($url, $model) {
                                                                        if ($model->amount > 0) {
                                                                                return Html::a('<span class="fa fa-inr" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                            'title' => Yii::t('app', 'Refund'),
                                                                                            'class' => 'actions',
                                                                                            'target' => '_blank',
                                                                                ]);
                                                                        }
                                                                }
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'print') {
                                                                            $url = Url::to(['invoice/invoicebill', 'id' => $model->id]);
                                                                            return $url;
                                                                    }

                                                                    if ($action === 'refund') {
                                                                            $url = Url::to(['invoice/refund', 'id' => $model->id]);
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

