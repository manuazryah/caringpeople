<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caringpeople';
$this->params['breadcrumbs'][] = $this->title;
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="row">



        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" >
                        <div class="xe-icon">
                                <i class="fa fa-money"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $due_amount ?></strong>
                                <span>Due Amount</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-red" >
                        <div class="xe-icon">
                                <i class="fa-life-ring"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $services ?></strong>
                                <span>Total Services</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter" >
                        <div class="xe-icon">
                                <i class="fa fa-medkit"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $live_services ?></strong>
                                <span>Live Services</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">
                
                        <div class="xe-widget xe-counter xe-counter-yellow"  >
                                <div class="xe-icon">
                                        <i class="fa fa-shield"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= $closed_services ?></strong>
                                        <span>Closed Services</span>
                                </div>
                        </div>
               

        </div>












        <div style="clear:both"></div>




        <div class="row row-style" style="margin:0">
                <div class="col-sm-12">

                        <div class="panel panel-default" style="height: 450px;">
                                <div class="panel-heading">
                                        Services
                                </div>

                                <div style="min-height: 210px;" class="table-responsive">
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
                                            ],
                                        ]);
                                        ?>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['dashboard/services'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>

        </div>

</div>

<style>
        .summary{
                display: none;
        } .filters{
                display: none;
        }
</style>
