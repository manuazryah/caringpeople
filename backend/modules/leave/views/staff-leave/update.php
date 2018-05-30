<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\StaffLeave */

$this->title = 'Update Leave Application ';
$this->params['breadcrumbs'][] = ['label' => 'Staff Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Leave</span>', ['leave'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="staff-leave-create">
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
                                                <?=
                                                $this->render('_form', [
                                                    'model' => $model,
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= 'Leave History' ?></h3>


                        </div>
                        <div class="panel-body">
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?php // Html::a('<i class="fa-th-list"></i><span>Apply</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        //'id',
                                        //'employee_id',
//                                        [
//                                            'attribute' => 'no_of_days',
//                                            'value' => function($model) {
//                                                    if ($model->no_of_days == 1)
//                                                            return $model->no_of_days . ' day';
//                                                    else
//                                                            return $model->no_of_days . ' days';
//                                            }
//                                        ],
                                        [
                                            'attribute' => 'leave_type',
                                            'value' => function($model) {
                                                    return $model->leaveType->type;
                                            }
                                        ],
                                        'commencing_date',
                                        'admin_comment:ntext',
                                            [
                                            'attribute' => 'status',
                                            'value' => function($model) {
                                                    if ($model->status == 1)
                                                            return "Pending";
                                                    elseif ($model->status == 2)
                                                            return "Approved";
                                                    elseif ($model->status == 3)
                                                            return "Declined";
                                                    else
                                                            return "";
                                            },
                                            'filter' => [1 => 'Pending', 2 => 'Approved', 3 => 'Declined'],
                                        ],
                                        //'ending_date',
                                        // 'purpose:ntext',
                                        // 'status',
                                        // 'CB',
                                        // 'DOC',
                                        ['class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}{view}',
                                            'visibleButtons' => [
                                                'update' => function ($model) {
                                                        return $model->status == '2' ? false : true;
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                                ?>
                        </div>
                </div>
        </div>
</div>
