<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\StaffInfo;

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="table-responsive">
        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                        <tr>
                                <th style="width:10px;">No</th>
                                <th>Date</th>
                                <th>Remarks from staff</th>


                        </tr>
                </thead>

                <tbody>
                        <?php
                        $p = 0;
                        foreach ($service_schedule as $value) {
                                $p++;
                                $class = 'completed';
                                $class1 = 'hide-class';
                                ?>
                                <tr  id="<?= $value->id; ?>" style="text-align:center;height: 60px;">
                                        <td><?= $p; ?></td>

                                        <td><?php
                                                if (isset($value->date) && $value->date != '') {
                                                        $date = date('d-m-Y', strtotime($value->date));
                                                } else {
                                                        $date = '';
                                                }
                                                echo DatePicker::widget([
                                                    'name' => 'date',
                                                    'id' => 'schedule_date-' . $value->id,
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'value' => $date,
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'dd-mm-yyyy',
                                                    ],
                                                    'options' => [
                                                        'class' => 'schedule-update-dates ' . $class . '',
                                                    ]
                                                ]);
                                                ?>
                                        </td>

                                        <td class="sas">

                                                <button class="btn btn-gray" style="margin: 15px 0px 0px 30px;float: left;"><a id="<?= $value->id ?>" class="remarks_Staff"><?php if (!isset($value->remarks_from_staff) && $value->remarks_from_staff == '') { ?> Add Remarks<?php } else { ?> View Remarks<?php } ?></a></button>
                                        </td>

                                </tr>
                        <?php } ?>
                </tbody>
        </table>
</div>







<script>
        $(document).ready(function () {
                $('.remarks_staff').change(function () {
                        alert();
                });
        });
</script>

























<style>
        .cke_contents{
                height:210px !important;
        }
        .form-control{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }

        table td{
                padding: 0 !important;
        }
        table td .sorting_1{
                text-align: center !important;
        }
        #example-1_filter{
                display: none;
        }.dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }.sorting_1{
                text-align: center;
        }.completed{
                pointer-events: none;
        }.serv_details{
                float: right;
                margin-top: 10px;
        }

</style>

