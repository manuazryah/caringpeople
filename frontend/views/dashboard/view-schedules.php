<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';
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

                                        <div class="row" style="margin-left: -6px;margin-right: 0px;">

                                                <?=
                                                $this->render('_service_details', [
                                                    'service' => $service,
                                                ])
                                                ?>

                                        </div>


                                        <div class="table-responsive">
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>

                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        'date',
                                                            [
                                                            'attribute' => 'staff',
                                                            'value' => function($model) {
                                                                    if (isset($model->staff) && $model->staff != '') {
                                                                            $staff = StaffInfo::findOne($model->staff);
                                                                            if (!empty($staff)) {
                                                                                    return $staff->staff_name;
                                                                            }
                                                                    } else {
                                                                            return 'Not Assigned';
                                                                    }
                                                            },
                                                            'filter' => '',
                                                        ],
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model) {
                                                                    if ($model->status == 1) {
                                                                            return 'Pending';
                                                                    } else if ($model->status == 2) {
                                                                            return 'Completed';
                                                                    } else if ($model->status == 3) {
                                                                            return 'Interrupted';
                                                                    } else if ($model->status == 4) {
                                                                            return 'Cancelled';
                                                                    }
                                                            },
                                                            'filter' => [1 => 'Pending', 2 => 'Completed', 3 => 'Interrupted', 4 => 'Cancelled']
                                                        ],
                                                            ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{remarks}',
                                                            'visibleButtons' => [
                                                                'remarks' => function ($model, $key, $index) {
                                                                        $service = common\models\Service::findOne($model->service_id);
                                                                        return $service->status == '2' ? false : true;
                                                                },
                                                            ],
                                                            'buttons' => [
                                                                'remarks' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-tasks" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'Add Remarks'),
                                                                                    'class' => 'add-remarks',
                                                                                    'id' => $model->id,
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'remarks') {

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


                $('.add-remarks').click(function (e) {
                        e.preventDefault();
                        var schedule_id = $(this).attr('id');
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'dashboard/remarks',
                                data: {schedule_id: schedule_id},
                                success: function (data) {
                                        $("#modal-4-pop-up").html(data);
                                        $('#modal-4').modal('show', {backdrop: 'static'});
                                        hideLoader();

                                }
                        });
                });

                $(document).on('submit', '#add-remarks', function (e) {
                        e.preventDefault();
                        var data = $(this).serialize();
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'dashboard/add-remarks',
                                data: data,
                                success: function (data) {
                                        $('#modal-4').modal('hide');
                                        hideLoader();
                                }
                        });
                        hideLoader();
                });
        });
</script>

<style>
        .action-column{
                width:10%!important;
        }.add-remarks{
                cursor: pointer;
                padding-left: 10px !important;
        }.modal-dialog{
z-index:9999 !important;
}
</style>