<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\StaffInfo;
use kartik\export\ExportMenu;
use yii\helpers\Url;

$this->title = 'Staffs Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body">
                                        <div class="attendance-create">

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->



                                                <div class="counts1" >
                                                        <p style="font-size:14px;margin:0;text-transform: uppercase">
                                                                <span><?php
                                                                        if (isset($type) && $type != '') {
                                                                                $type_details = common\models\MasterDesignations::findOne($type);
                                                                                echo $type_details->title . '  Details';
                                                                        }
                                                                        ?></span>
                                                                <br>
                                                                <label style="font-size:12px;margin-top:5px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                                        </p>
                                                </div>





                                                <div class = "table-responsive">

                                                        <?php
                                                        $gridColumns = [
                                                                ['class' => 'yii\grid\SerialColumn'],


                                                            [
                                                                'attribute' => 'staff_id',
                                                                'value' => function($model) {
                                                                        return $model->staff_id;
                                                                },
                                                            ],

                                                            [
                                                                'attribute' => 'staff_name',
                                                                'value' => function($model) {
                                                                        return $model->staff_name;
                                                                },
                                                            ],
                                                                [
                                                                'header' => 'Amount',
                                                                'attribute' => 'staff_id',
                                                                'value' => function($model) use ($from, $to) {
                                                                        return $model->total($model->id, $from, $to);
                                                                },
                                                                'filter' => '',
                                                            ],
                                                                ['class' => 'yii\grid\ActionColumn',
                                                                'template' => '{print}',
                                                                'buttons' => [
                                                                    //view button
                                                                    'print' => function ($url, $model) {
                                                                            return Html::a('View Details', $url, [
                                                                                        'title' => Yii::t('app', 'print'),
                                                                                        'class' => 'btn btn-info',
                                                                                        'target' => '_blank',
                                                                                        'style' => 'color:#fff',
                                                                            ]);
                                                                    },
                                                                ],
                                                                'urlCreator' => function($action, $model) use ($from, $to) {
                                                                        if ($action === 'print') {
                                                                                $url = Url::to(['reports/staffdetails', 'from' => $from, 'to' => $to, 'staff' => $model->id]);
                                                                                return $url;
                                                                        }
                                                                }
                                                            ],
                                                        ];
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                echo ExportMenu::widget([
                                                                    'dataProvider' => $dataProvider,
                                                                    'columns' => $gridColumns,
                                                                ]);
                                                        }
                                                        echo \kartik\grid\GridView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'filterModel' => $searchModel,
                                                            'columns' => $gridColumns,
                                                        ]);
                                                        ?>
                                                </div>






                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>

        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1 p{
                margin-left: 20px;
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>