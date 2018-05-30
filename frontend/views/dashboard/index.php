<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if (!isset($title))
        $title = 'Services';
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="service-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <div class="table-responsive">

                                                <button class="btn btn-white" id="search-option" style="float: right;margin-left: 10px;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>

                                                <?php if ($title != 'Closed Services') { ?>

                                                        <a href="<?= Yii::$app->homeUrl ?>dashboard/closed-services"><button class="btn btn-warning" id="search-option" style="float: right;">View Closed Services</button></a>


                                                <?php } else { ?>


                                                        <a href="<?= Yii::$app->homeUrl ?>dashboard/index"><button class="btn btn-warning" id="search-option" style="float: right;">View Services</button></a>
                                                <?php } ?>
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            [
                                                            'attribute' => 'service_id',
                                                            'header' => 'Service ID',
                                                        ],
                                                        // 'service_id',
                                                        [
                                                            'attribute' => 'service',
                                                            'value' => 'service0.service_name',
                                                            'filter' => ArrayHelper::map(common\models\MasterServiceTypes::find()->where(['status' => '1'])->orderBy(['service_name' => SORT_ASC])->asArray()->all(), 'id', 'service_name'),
                                                        ],
                                                            [
                                                            'attribute' => 'duty_type',
                                                            'value' => function($model) {
                                                                    if ($model->duty_type == '1') {
                                                                            return 'Hourly';
                                                                    } else if ($model->duty_type == '2') {
                                                                            return 'Visit';
                                                                    } else if ($model->duty_type == '3') {
                                                                            return 'Day';
                                                                    } else if ($model->duty_type == '4') {
                                                                            return 'Night';
                                                                    } else if ($model->duty_type == '5') {
                                                                            return 'Day & Night';
                                                                    }
                                                            },
                                                            'filter' => [1 => 'Hourly', 2 => 'Visit', 3 => 'Day', 4 => 'Night', 5 => 'Day & Night'],
                                                        ],
                                                        'days',
                                                            [
                                                            'attribute' => 'pending_schedules',
                                                            'label' => Yii::t('app', 'Pending Schedules'),
                                                            'format' => 'raw',
                                                            'value' => function ($model) {
                                                                    return $model->PendingSchedules($model->id);
                                                            }
                                                        ],
                                                        // 'amount',
                                                        // 'CB',
                                                        // 'DOC',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                              'template' => '{view}{bill}',
                                                            'buttons' => [
                                                                //view button
                                                                'view' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-eye" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'View Schedules'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                                'bill' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'View Bill'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'view') {
                                                                            $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                                                            $url = Url::to(['dashboard/view-schedules', 'id' => $id]);
                                                                            return $url;
                                                                    }
                                                                    if ($action === 'bill') {
                                                                            $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id);
                                                                            $url = Url::to(['dashboard/view', 'id' => $id]);
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

<script>
        $(document).ready(function () {
                $(".filters").slideToggle();
                $("#search-option").click(function () {
                        $(".filters").slideToggle();
                });
        });
</script>