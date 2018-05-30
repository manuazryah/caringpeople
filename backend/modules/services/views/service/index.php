<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
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

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Service</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                       
                                        <?= Html::a("<i class='fa fa-book'></i><span>Schedules</span>", ['todayschedules'], ['target' => '_blank', 'class' => 'btn btn-info  btn-icon btn-icon-standalone', 'style' => 'float:right', 'id' => 'previous_schedule']) ?>
                                       

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
                                                [
                                                'attribute' => 'due_amount',
                                                'header' => 'Due Amount',
                                                'filter' => Html::dropDownList('Service[compareOp]', $model->compareOp, array('>' => '>', '<' => '<', '>=' => '>=', '<=' => '<=', '=' => '='), array('style' => 'width:35px;height: 25px;', 'id' => 'grid-id')) .
                                                Html::textInput('Service[compare]', $model->compare, array('style' => 'width:100px;margin-top: 5px;height: 25px;'))
                                            ],
                                                [
                                                'attribute' => 'pending_schedules',
                                                'label' => Yii::t('app', 'Pending Schedules'),
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                        return $model->PendingSchedules($model->id);
                                                }
                                            ],

                                              [
                                                'attribute' => 'estimated_bill_date',
                                                'header'=>'Bill date',
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                        if (isset($data->estimated_bill_date) && $data->estimated_bill_date != '0000-00-00') {
                                                                $data->estimated_bill_date = date('d-m-Y', strtotime($data->estimated_bill_date));
                                                        } else {
                                                                $data->estimated_bill_date = date('d-m-Y');
                                                        }
                                                        return DatePicker::widget([
                                                                    'name' => 'estimated_bill_date',
                                                                    'id' => 'date-' . $data->id,
                                                                    'options' => ['class' => 'date-change'],
                                                                    'value' => $data->estimated_bill_date,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                        ]);
                                                },
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
                                                'template' => ' {update} {delete} {estimated}  {invoice}', // the default buttons + your custom button
                                                 'visibleButtons' => [
                                                     'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id == '1' ? true : false;
                                                    },
                                                    'estimated' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id == '1' || Yii::$app->user->identity->post_id == '10' ? true : false;
                                                    },
                                                    'invoice' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id == '1' || Yii::$app->user->identity->post_id == '10' ? true : false;
                                                    }
                                                ],
                                                'buttons' => [
                                                    'estimated' => function($url, $model, $key) {     // render your custom button
                                                            return Html::a('<span class="fa fa-print" style="padding-top: 0px;"></span>', ['service/estimated-bill', 'id' => $model->id], [
                                                                        'title' => Yii::t('app', 'Estimated Proforma'),
                                                                        'class' => 'actions',
                                                                        'target' => '_blank',
                                                            ]);
                                                    },
                                                       'invoice' => function($url, $model, $key) {     // render your custom button
                                                            return Html::a('<span class="fa fa-inr" style="padding-top: 0px;"></span>', ['/invoice/invoice/service-invoice-view', 'branch' => $model->branch_id, 'patient' => $model->patient_id], [
                                                                        'title' => Yii::t('app', 'Invoices'),
                                                                        'class' => 'actions',
                                                                        'target' => '_blank',
                                                            ]);
                                                    },
                                                ]
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
                                            'rowOptions' => function($model) {
                                                if (Yii::$app->user->identity->post_id == '1') {
                                                    if ($model->due_amount <= 0) {
                                                            return ['class' => 'amount_paid'];
                                                    } else {
                                                            return ['class' => 'other_amount'];
                                                    }
                                               }
                                            },
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


             $('.date-change').change(function () {
                        var id = $(this).attr('id');
                        var service_id = id.split('-');
                        if (service_id && service_id != '') {
                                $.ajax({
                                        type: 'POST',
                                        cache: false,
                                        data: {date: $(this).val(), service: service_id},
                                        url: homeUrl + 'serviceajax/estimated-date',
                                        success: function (data) {

                                        }
                                });
                        }

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
    }.other_amount{
                background-color: #faeae9 !important;
        }
.other_amount input{
                background-color: #faeae9 !important;
        }
        
        .amount_paid input{
                background-color: #ddefdd !important;
        }
</style>



