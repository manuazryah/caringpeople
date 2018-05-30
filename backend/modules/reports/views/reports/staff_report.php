<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use kartik\export\ExportMenu;

$this->title = 'Staff Attendance Report';
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
                <div class="panel-body"><div class="attendance-create">


                        <div class="attendance-form form-inline">
                            <?php
                            $form = ActiveForm::begin([
                                        'method' => 'get',
                            ]);
                            ?>
                            <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?=
                                DatePicker::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'date',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>
                            </div>


                            <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?=
                                DatePicker::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'DOC',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    //    "endDate" => (string) date('d/m/Y'),
                                    ]
                                ]);
                                ?>


                            </div>

                            <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php $branch = Branch::Branch(); ?>
                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--', 'id' => 'report-branch']); ?>
                            </div>


                            <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (isset($model->rating)) {
                                    $staff = StaffInfo::find()->where(['branch_id' => $model->rating, 'status' => 1, 'post_id' => 5])->all();
                                } else {
                                    $staff = [];
                                }
                                ?>
                                <?= $form->field($model, 'staff')->dropDownList(ArrayHelper::map($staff, 'id', 'staff_name'), ['prompt' => '--Select--', 'id' => 'report-staff']) ?>
                            </div>



                            <div class='col-md-3 col-sm-6 col-xs-12' >
                                <div class="form-group" >
                                    <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                        <div style="clear:both"></div>
                        <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                        <?php if (!empty($dataProvider) && $dataProvider!= '') { ?>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts1" >
                                <p>
                                    Staff : <span><?php
                                        if (isset($model->staff) && $model->staff != '') {
                                            $staff_detail = StaffInfo::findOne($model->staff);
                                            echo $staff_detail->staff_name;
                                        }
                                        ?></span>
                                </p>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts">
                                <p>
                                    Total Schedules &nbsp;&nbsp;&nbsp;   :  &nbsp;<span> <?= $dataProvider->getTotalCount(); ?><br></span>
                                    Total Attendance &nbsp; &nbsp;:  &nbsp;<span><?= $total_attendance ?> <br></span>
                                    Total Amount Paid&nbsp;  :  &nbsp;<span>Rs.<?= $total_amount ?> /-</span>
                                </p>
                            </div>
                        </div>


                        <div class = "table-responsive">
                            <?php
                            $gridColumns = [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'date',
                                    'value' => function($data) {
                                                                                if (isset($data->date))
                                                                                        return date('d-m-Y', strtotime($data->date));
                                                                        },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'service_id',
                                    'value' => function($model) {
                                        return $model->service->service_id;
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'patient_id',
                                    'value' => function($model) {
                                        if (isset($model->patient_id)) {
                                            $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                            return $patient->first_name;
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'remarks_from_manager',
                                    'value' => function($model) {
                                        if (isset($model->remarks_from_manager)) {
                                            return $model->remarks_from_manager;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'time_in',
                                    'value' => function($model) {
                                        if (isset($model->time_in)) {
                                            return $model->time_in;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'time_out',
                                    'value' => function($model) {
                                        if (isset($model->time_out)) {
                                            return $model->time_out;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                            [
                                    'attribute' => 'rate',
                                    'value' => function($model) {
                                        if (isset($model->rate)) {
                                            return $model->rate;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                
                                [
                                    'attribute' => 'status',
                                    'format'=>'html',
                                    'value' => function($model) {
                                        if ($model->status == 2) {
                                            return '<i class="fa fa-check present" aria-hidden="true"></i>';
                                        } else{
                                            return '<i class="fa fa-times absent" aria-hidden="true"></i>';
                                        }
                                    },
                                    'filter' => '',
                                ],
                            ];
                                    
                                    //////////////export///////////////////
                                     $gridColumns1 = [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'date',
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'service_id',
                                    'value' => function($model) {
                                        return $model->service->service_id;
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'patient_id',
                                    'value' => function($model) {
                                        if (isset($model->patient_id)) {
                                            $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                            return $patient->first_name;
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'remarks_from_manager',
                                    'value' => function($model) {
                                        if (isset($model->remarks_from_manager)) {
                                            return $model->remarks_from_manager;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'time_in',
                                    'value' => function($model) {
                                        if (isset($model->time_in)) {
                                            return $model->time_in;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                [
                                    'attribute' => 'time_out',
                                    'value' => function($model) {
                                        if (isset($model->time_out)) {
                                            return $model->time_out;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                            [
                                    'attribute' => 'rate',
                                    'value' => function($model) {
                                        if (isset($model->rate)) {
                                            return $model->rate;
                                        } else {
                                            return '';
                                        }
                                    },
                                    'filter' => '',
                                ],
                                
                                [
                                    'attribute' => 'status',
                                    'format'=>'html',
                                    'value' => function($model) {
                                        if ($model->status == 2) {
                                            return 'Completed';
                                        } else  if ($model->status == 1) {
                                            return 'Pending';
                                        }else  if ($model->status == 3) {
                                            return 'Interupted';
                                        }else  if ($model->status == 4) {
                                            return 'Cancelled';
                                        }
                                    },
                                    'filter' => '',
                                ],
                            ];
                                    
                            if (Yii::$app->user->identity->post_id == '1') {
                                echo ExportMenu::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => $gridColumns1,
                                ]);
                            }
                            echo \kartik\grid\GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => $gridColumns,
                            ]);
                            ?>
                        </div>

                        <?php
                        } else {
                            if (isset($model->staff) && $model->staff != '') {
                                echo '<p class="no-result">No results found !!</p>';
                            }
                        }
                        ?>



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
    }.filters{
        display: none;
    }
</style>