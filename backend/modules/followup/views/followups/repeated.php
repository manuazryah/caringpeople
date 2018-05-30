<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\FollowupSubType;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FollowupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repeated Followups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="followups-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>

                                <div class="panel-body">

                                        <div class="row repeated-table">

                                                <?php
                                                Pjax::begin([
                                                    'enablePushState' => false
                                                ]);
                                                echo GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'rowOptions' => function ($model, $key, $index, $grid) {
                                                            return ['id' => $model['id']];
                                                    },
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            [
                                                            'attribute' => 'sub_type',
                                                            'value' => 'to0.sub_type',
                                                            'filter' => ArrayHelper::map(FollowupSubType::find()->where(['status' => '1'])->asArray()->all(), 'id', 'sub_type'),
                                                        ],
                                                        'followup_date',
                                                        'followup_notes',
                                                            ['attribute' => 'assigned_to',
                                                            'value' => 'assigned0.staff_name',
                                                            'filter' => ArrayHelper::map(StaffInfo::find()->where(['status' => '1', 'post_id' => 5])->asArray()->all(), 'id', 'staff_name'),
                                                        ],
                                                            ['attribute' => 'assigned_from',
                                                            'value' => 'assignedfrom0.staff_name',
                                                        //'filter' => ArrayHelper::map(StaffInfo::find()->where(['status' => '1', 'post_id' => 5])->asArray()->all(), 'id', 'staff_name'),
                                                        ],
                                                            ['attribute' => 'related_staffs',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    return $model->Relatedstaffs($model->related_staffs);
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    if ($model->status == '0') {
                                                                            return 'Active';
                                                                    } elseif ($model->status == '1') {
                                                                            return 'Closed';
                                                                    }
                                                            },
                                                            'filter' => [0 => 'Active', 1 => 'Closed'],
                                                        ],
//
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{status}',
                                                            'visibleButtons' => [
                                                                'status' => function ($model, $key, $index) {
                                                                        return $model->status != '1' ? true : false;
                                                                }
                                                            ],
                                                            'buttons' => [
                                                                'status' => function ($url, $model) {

                                                                        return Html::checkbox('status', false, ['class' => 'iswitch iswitch-secondary followup-status-repeated', 'id' => $model->id]);
                                                                },
                                                            ],
                                                        ],
                                                    ],
                                                ]);
                                                Pjax::end();
                                                ?>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


