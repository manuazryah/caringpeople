<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deleted Services';
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
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>






                                        <?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'service_id',
                                                [
                                                'attribute' => 'patient_id',
                                                'value' => 'patient.first_name',
                                                'filter' => ArrayHelper::map(common\models\PatientGeneral::find()->where(['status' => '1'])->orderBy(['first_name' => SORT_ASC])->asArray()->all(), 'id', 'first_name'),
                                                'filterOptions' => array('id' => "patient_name_search"),
                                            ],
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
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => 'branch.branch_name',
                                                'filter' => ArrayHelper::map(common\models\Branch::find()->where(['status' => '1'])->asArray()->all(), 'id', 'branch_name'),
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == 1) {
                                                                return 'Opened';
                                                        } else if ($model->status == 2) {
                                                                return 'Closed';
                                                        } else if ($model->status == 3) {
                                                                return 'Advanced';
                                                        } else if ($model->status == 4) {
                                                                return 'Pending';
                                                        }
                                                },
                                                'filter' => [1 => 'Opened', 2 => 'Closed', 3 => 'Advanced'],
                                            ],
                                            //'staff_id',
                                            // 'staff_manager',
                                            // 'from_date',
                                            // 'to_date',
                                            // 'estimated_price_per_day',
                                            // 'estimated_price',
                                            // 'status',
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => ' {update} {delete} {restore} ', // the default buttons + your custom button
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    },
                                                ],
                                                'buttons' => [
                                                    'restore' => function($url, $model, $key) {     // render your custom button
                                                            return Html::a('<span class="fa fa-reply" style="padding-top: 0px;"></span>', ['service-bin/restore', 'id' => $model->id], [
                                                                        'title' => Yii::t('app', 'Restore'),
                                                                        'class' => 'actions',
                                                            ]);
                                                    },
                                                ]
                                            ],
                                        ];


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
                $('#staff_name_search select').attr('id', 'staff_name');
                $('#patient_name_search select').attr('id', 'patient_name');
                $("#staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#patient_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });


                $('#grid-id').change(function (e) {
                        e.preventDefault();
                        return false;
                });

                $('#size').change(function () {
                        //var d = $('#size :selected').val();
                        this.form.submit();

                });

        });
</script>

<style>
        #patient_name_search{
                width: 17%;
        }.amount_paid{
                background-color: #ddefdd !important;
        }.page-size-dropdwn{
                height: 30px !important;
                line-height: 30px;
                font-size: 13px;
                display: inline-block;
                padding: 0px 0px 0px 7px;
        }
</style>



