<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StaffLeave */

$this->title = Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = ['label' => 'Staff Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <div class="panel-body"><div class="staff-leave-view">
                                                <p>
                                                        <?= Html::a('Leave History', ['leave-history'], ['class' => 'btn btn-primary']) ?>
                                                        <?php
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>
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
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        //'id',
                                                        //'employee_id',
                                                        //	'no_of_days',
                                                            [
                                                            'attribute' => 'leave_type',
                                                            'value' => $model->leaveType->type,
                                                        ],
                                                        'commencing_date',
                                                        'ending_date',
                                                        'purpose:ntext',
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
                                                        ],
                                                    //'CB',
                                                    //'DOC',
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


