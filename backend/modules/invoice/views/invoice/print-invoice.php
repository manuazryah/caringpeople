<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ServiceScheduleHistory;
use common\models\ServiceSchedule;
use common\models\ServiceDiscounts;
use common\models\SalesInvoiceMaster;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?= Html::a('<i class="fa-th-list"></i><span> Manage Invoice</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="invoice-form form-inline">
                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?php $branch = Branch::Branch();
                                                        ?>
                                                        <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--', 'id' => 'report-patient-branch']); ?>
                                                </div>

                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?php
                                                        if (isset($model->branch_id)) {
                                                                $patients = \common\models\PatientGeneral::find()->where(['branch_id' => $model->branch_id, 'status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
                                                        } else {
                                                                $patients = [];
                                                        }
                                                        ?>
                                                        <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'first_name'), ['prompt' => '--Select--', 'id' => 'report-patient']) ?>
                                                </div>

                                                <div class='col-md-3 col-sm-6 col-xs-12' >
                                                        <div class="form-group" >
                                                                <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                        </div>
                                                </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>

                                        <div style="clear:both"></div>


                                        <!----------------------------------After Submit------------------------------------->


                                        <?php
                                        if (!empty($services) && $services != '') {
                                                ?>
                                                <?php $form1 = ActiveForm::begin(['action' => 'print-bill']); ?>
                                                <table class="table table-bordered table-striped">
                                                        <tr>
                                                                <th style="width:5%"></th>
                                                                <th>Service</th>
                                                                <th>Amount Paid</th>
                                                        </tr>

                                                        <?php
                                                        foreach ($services as $value) {
                                                                $service = common\models\Service::findOne($value);
                                                                $amount_paid = \common\models\Invoice::find()->where(['service_id' => $value])->sum('amount');
                                                                ?>
                                                                <tr>
                                                                        <td><input type="checkbox" name="checked[]" value="<?= $value ?>" style="margin-left:15px"></td>
                                                                        <td><?= $service->service_id ?></td>
                                                                        <td>Rs.<?= $amount_paid ?></td>
                                                                </tr>
                                                        <?php }
                                                        ?>
                                                </table>

                                                <div class="row">
                                                        <input type="hidden" name="serv_patient_id" value="<?= $model->patient_id ?>">
                                                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;margin-right: 15px;float:right']) ?>
                                                </div>
                                                <?php ActiveForm::end(); ?>


                                        <?php } else { ?>
                                                <p style="text-align: center">No result found !!</p>
                                        <?php } ?>

                                </div>
                        </div>
                </div>
        </div>
</div>




<style>
        table{
                margin-top:10px;
        }
        table .heading{
                font-weight: bold;
        }
        .service_name{
                font-weight: bold;
                color: #008cbd;
                text-align: left;
                text-transform: uppercase;
        }.amount_paid{
                border: 1px solid #e4e4e4;
                height: 25px;
        }
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
                color: #e4e4e4;
        }
        ::-moz-placeholder { /* Firefox 19+ */
                color: #e4e4e4;
        }
        :-ms-input-placeholder { /* IE 10+ */
                color: #e4e4e4;
        }
        :-moz-placeholder { /* Firefox 18- */
                color: #e4e4e4;
        }.no-result{
                text-align: center;
                font-style: italic;
        }.sub{
                font-size: 10px !important;
        }.patient{
                margin-bottom: 5px;
                color:#000;
                text-transform: uppercase;
                margin-left: 15px;
                font-weight: bold;
        }.submit_btn{
                float: right;
        }

</style>

<script>
        $(document).ready(function () {
                $('.paid').hide();
                $('.unpaid').hide();
                $('#invoice-status').change(function () {
                        if ($(this).val() == '1') {
                                $('.paid').show();
                        } else {
                                $('.paid').hide();
                        }

                        if ($(this).val() == '2') {
                                $('.unpaid').show();
                        } else {
                                $('.unpaid').hide();
                        }
                });


                $('#w1').submit(function (e) {
                        var reference_no = $('#invoice-reference_no').val();
                        $.ajax({
                                url: homeUrl + 'report/referenceno',
                                'async': false,
                                'type': "POST",
                                'global': false,
                                data: {reference_no: reference_no},
                                beforeSend: function () {
                                        showLoader();
                                }
                        })
                                .done(function (data) {
                                        if (data == 0) {
                                                return true;

                                        } else {
                                                $('.error').show();
                                                e.preventDefault();
                                                hideLoader();
                                                return false;
                                        }
                                });

                });


        });
</script>