<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use common\models\StaffInfoUploads;
use kartik\export\ExportMenu;

//AppsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staffs';
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias(Yii::$app->params['uploadPath']);
$branch = Branch::branch();
$designations = \common\models\MasterDesignations::designationlist();
$timing = \common\models\Timing::find()->where(['status' => 1])->all();
$districts = \common\models\Districts::find()->where(['status' => 1])->all();
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>

                                        <a class="advanced-search" style="font-size: 17px;color:#0e62c7;cursor: pointer;">Advanced Search</a>
                                        <hr class="appoint_history" style="margin-top:5px;"/>
                                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Staff</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>


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

                                        <?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'staff_id',
                                            'staff_name',
                                                [
                                                'attribute' => 'gender',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->gender == '0') {
                                                                return 'Male';
                                                        } else if ($model->gender == '1') {
                                                                return 'Female';
                                                        }
                                                },
                                                'filter' => [1 => 'Female', 0 => 'Male'],
                                            ],
                                            'place',
                                                [
                                                'attribute' => 'designation',
                                                'value' => function($model, $key, $index, $column) {
                                                        //  $designation = \common\models\MasterDesignations::findOne(['id' => $model->designation]);
//
                                                        return $model->designation($model->designation);
                                                },
                                                'filter' => ArrayHelper::map(\common\models\MasterDesignations::designationlist(), 'id', 'title'),
                                            ],
                                                [
                                                'attribute' => 'timing',
                                                'value' => function($model, $key, $index, $column) {

                                                        $timimg = explode(',', $model->staffEducation->timing);
                                                        $timing_val = '';
                                                        foreach ($timimg as $value) {
                                                                if (isset($value) && $value != '') {
                                                                        $timing_detail = \common\models\Timing::findOne($value);
                                                                        $timing_val .= $timing_detail->timing . ', ';
                                                                }
                                                        }
                                                        return $timing_val;
                                                },
                                                'filter' => Html::activeDropDownList($searchModel, 'timing', ArrayHelper ::map($timing, 'id', 'timing'), ['class' => 'form-control', 'multiple' => true, 'id' => 'timing-search']),
                                            ],
                                                [
                                                'attribute' => 'area_interested',
                                                'value' => function($model, $key, $index, $column) {

                                                        $area = explode(',', $model->area_interested);
                                                        $district_val = '';
                                                        foreach ($area as $areas) {
                                                                if (isset($areas) && $areas != '') {
                                                                        $district_detail = \common\models\Districts::findOne($areas);
                                                                        $district_val .= $district_detail->district . ', ';
                                                                }
                                                        }
                                                        return $district_val;
                                                },
                                                'filter' => Html::activeDropDownList($searchModel, 'area_interested', ArrayHelper ::map($districts, 'id', 'district'), ['class' => 'form-control', 'multiple' => true, 'id' => 'interested-area']),
                                            ],
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => function($data) {
                                                        return Branch::findOne($data->branch_id)->branch_name;
                                                },
                                                'filter' => ArrayHelper::map(\common\models\Branch::branch(), 'id', 'branch_name'),
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == '1') {
                                                                return 'Opened';
                                                        } else if ($model->status == '2') {
                                                                return 'Closed';
                                                        } else if ($model->status == '3') {
                                                                return 'Terminated';
                                                        } else if ($model->status == '4') {
                                                                return 'Resigned';
                                                        } else if ($model->status == '5') {
                                                                return 'Without Resignation';
                                                        }
                                                },
                                                'filter' => [1 => 'Opened', 2 => 'Closed', 3 => 'Terminated', 4 => 'Resigned', 5 => 'Without Resignation'],
                                            ],
                                            'average_point',
                                                [
                                                'attribute' => 'working_status',
                                                'value' => function($model) {
                                                        if ($model->working_status == 0) {
                                                                return 'Bench';
                                                        } else if ($model->working_status == 1) {
                                                                return 'On Duty';
                                                        }
                                                },
                                                'filter' => [0 => 'Bench', 1 => 'On Duty'],
                                            ],
                                                ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{view}{update}{delete}{missing}{leave}',
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    }
                                                ],
                                                'buttons' => [
                                                    'missing' => function($url, $model, $key) {     // render your custom button
                                                            $checking = $model->check($model->id);
                                                            if ($checking == 1) {
                                                                    return Html::a('<span class="fa fa-file-image-o" style="padding-top: 0px;"></span>', ['#'], [
                                                                                'title' => Yii::t('app', 'Missing Fileds/ Files'),
                                                                                'class' => 'actions missing-files',
                                                                                'type' => '2',
                                                                                'target' => '_blank',
                                                                                'id' => $model->id
                                                                    ]);
                                                            }
                                                    },
                                                    'leave' => function($url, $model, $key) {     // render your custom button
                                                            return Html::a('<span class="fa fa-minus-circle" style="padding-top: 0px;"></span>', ['/staff/staff-info/leave', 'id' => $model->id], [
                                                                        'title' => Yii::t('app', 'Leave'),
                                                                        'class' => 'actions staff-leave',
                                                                        'type' => '2',
                                                                        'target' => '_blank',
                                                                        'id' => $model->id
                                                            ]);
                                                    },
                                                ]
                                            ],
                                        ];

                                        if (Yii::$app->user->identity->post_id == '1') {
                                                echo ExportMenu::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'columns' => $searchModel->getExportColumns(),
                                                    'filename' => 'Staff-Details-' . date('Y-m-d'),
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


<script>
        $(document).ready(function () {
                $('.staff-info-advance').hide();
                $('.advanced-search').click(function () {
                        $('.staff-info-advance').slideToggle();
                });

                $("#timing-search").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#interested-area").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>


