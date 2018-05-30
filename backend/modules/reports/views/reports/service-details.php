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

$this->title = 'Patient Report';
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
                                <div class="panel-body">
                                        <div class="attendance-create">

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($services) && $services != '') { ?>

                                                        <div class="row">
                                                                <div class="counts1 col-md-6" >
                                                                        <p style="font-size:14px;margin:0;text-transform: uppercase">
                                                                                <span><?php
                                                                                        if (isset($patient_id) && $patient_id != '') {
                                                                                                $patient_details = common\models\PatientGeneral::findOne($patient_id);
                                                                                                echo $patient_details->patient_id . '<br>';
                                                                                                echo $patient_details->first_name;
                                                                                        }
                                                                                        ?></span>
                                                                                <br>
                                                                                <label style="font-size:12px;margin-top:5px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                                                        </p>
                                                                </div>

                                                                <div class="col-md-6 counts1">
                                                                        <?php
                                                                        foreach ($services as $services) {
                                                                                $value = common\models\Service::findOne($services->service_id);
                                                                                $total_amount = $value->due_amount;
                                                                                ?>

                                                                                <b><?= $value->service_id ?>  :</b>
                                                                                <span><?= 'Rs.' . Yii::$app->NumToWord->NumberFormat($total_amount) ?></span><br>

                                                                        <?php } ?>
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
                                                                        'attribute' => 'staff',
                                                                        'value' => function($model) {
                                                                                if (isset($model->staff)) {
                                                                                        $staff = \common\models\StaffInfo::findOne($model->staff);
                                                                                        return $staff->staff_name;
                                                                                }
                                                                        },
                                                                        'filter' => '',
                                                                    ],
                                                                        [
                                                                        'attribute' => 'patient_rate',
                                                                        'filter' => '',
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
                                                                ]);
                                                                ?>
                                                        </div>

                                                        <?php
                                                } else {
                                                        // if (isset($model->staff) && $model->staff != '') {
                                                        echo '<p class="no-result">No results found !!</p>';
                                                        // }
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
        }
</style>