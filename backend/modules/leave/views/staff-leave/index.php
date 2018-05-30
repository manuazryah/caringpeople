<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Leave';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .ta5 {
                border: 2px solid rgba(64, 187, 234, 0.28);
                border-radius: 10px;
                height: 60px;
                width: 230px;
                margin-left: 154px;
        }
        textarea::placeholder {
                padding: 5px 0px 0px 5px;
        }
        textarea{
                padding: 5px 0px 0px 5px;
        }
</style>
<div class="staff-leave-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <a class="leave-application btn btn-success  btn-icon btn-icon-standalone" href="<?= Yii::$app->homeUrl ?>leave/staff-leave/leave" style="float:right"><i class="glyphicon glyphicon-pencil"></i><span> Apply Leave</span></a>

                                        <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>

                                        <?php // Html::a('<i class="fa-th-list"></i><span>Apply</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone'])   ?>
                                       
<div style="float: right;margin-right: 10px;">
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


 <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //'id',
                                                //'employee_id',
                                                [
                                                    'attribute' => 'employee_id',
                                                    'value' => function($model) {
                                                            $approved = common\models\StaffInfo::findOne($model->employee_id);
                                                            return $approved->staff_name;
                                                    }
                                                ],
                                                    [
                                                    'attribute' => 'leave_type',
                                                    'value' => function($model) {
                                                            return $model->leaveType->type;
                                                    }
                                                ],
                                                'commencing_date',
                                                'ending_date',
                                                    [
                                                    'attribute' => 'admin_comment',
                                                    'value' => function($model) {
                                                            if (isset($model->admin_comment)) {
                                                                    return $model->admin_comment;
                                                            } else {
                                                                    return '';
                                                            }
                                                    },
                                                ],
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
                                                    ['attribute' => 'approved_by',
                                                    'value' => function($model) {
                                                            if (isset($model->approved_by)) {
                                                                    $staff_details = common\models\StaffInfo::findOne($model->approved_by);
                                                                    return $staff_details->staff_name;
                                                            } else {
                                                                    return '';
                                                            }
                                                    }
                                                ],
                                                    ['class' => 'yii\grid\ActionColumn',
                                                    'template' => '{approve}',
                                                    'visibleButtons' => [
                                                        'approve' => function ($model, $key, $index) {
                                                                return $model->status != '2' ? true : false;
                                                        }
                                                    ],
                                                    'buttons' => [
                                                        'approve' => function ($url, $model) {
                                                                return Html::a('<i class="fa fa-check" aria-hidden="true"></i>', $url, [
                                                                            'title' => Yii::t('app', 'Click here to approve'),
                                                                            'class' => 'approve',
                                                                            'id' => $model->id,
                                                                ]);
                                                        },
                                                    ],
                                                ],
                                            //'ending_date',
                                            // 'purpose:ntext',
                                            // 'status',
                                            // 'CB',
                                            // 'DOC',
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>



<script>
        $(document).ready(function () {
                $(document).on('click', '.approve', function (e) {
                        e.preventDefault();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {id: $(this).attr('id')},
                                url: homeUrl + 'leave/staff-leave/approval',
                                success: function (data) {
                                        $("#modal-pop-up").html(data);
                                        $('#modal-6').modal('show', {backdrop: 'static'});
                                }
                        });
                });

                $(document).on('submit', '#leave-approval-submit', function (e) {
                        e.preventDefault();
                        var data = $(this).serialize();
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'leave/staff-leave/approve',
                                data: data,
                                success: function (data) {
                                        $('#modal-6').modal('hide');
                                        location.reload();
                                }
                        });
                });
        });
</script>

