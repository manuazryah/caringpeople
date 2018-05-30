<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPosts */

$this->title = $model->post_name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Admin Posts</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="admin-posts-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?=
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>

                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        //'id',
                                                        'post_name',
                                                            [
                                                            'attribute' => 'admin',
                                                            'value' => $model->admin == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'masters',
                                                            'value' => $model->masters == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'enquiry',
                                                            'value' => $model->enquiry == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'staffs',
                                                            'value' => $model->staffs == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'attendance',
                                                            'value' => $model->attendance == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'leave_application',
                                                            'value' => $model->leave_application == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'leave_approval',
                                                            'value' => $model->leave_approval == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'service',
                                                            'value' => $model->service == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'rate_card',
                                                            'value' => $model->rate_card == 1 ? 'Yes' : 'No',
                                                        ],
                                                            [
                                                            'attribute' => 'expenses',
                                                            'value' => $model->expenses == 1 ? 'Yes' : 'No',
                                                        ],
                                                        [
                                                            'attribute' => 'staff_payroll',
                                                            'value' => $model->staff_payroll == 1 ? 'Yes' : 'No',
                                                        ],
                                                        [
                                                            'attribute' => 'invoice',
                                                            'value' => $model->invoice == 1 ? 'Yes' : 'No',
                                                        ],
                                                        [
                                                            'attribute' => 'account_head',
                                                            'value' => $model->account_head == 1 ? 'Yes' : 'No',
                                                        ],
                                                        [
                                                            'attribute' => 'reports',
                                                            'value' => $model->reports == 1 ? 'Yes' : 'No',
                                                        ],
                                                        [
                                                            'attribute' => 'inventory',
                                                            'value' => $model->inventory == 1 ? 'Yes' : 'No',
                                                        ],
                                                    //'enquiry',
                                                    //'users',
                                                    //'employees',
//                                'status',
//                                'CB',
//                                'UB',
//                                'DOC',
//                                'DOU',
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


