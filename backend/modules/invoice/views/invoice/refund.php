<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ServiceScheduleHistory;
use common\models\SalesInvoiceMaster;
use common\models\ServiceDiscounts;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">

        @media print {
                thead {display: table-header-group;}
                tfoot {display: table-footer-group}
                /*tfoot {position: absolute;bottom: 0px;}*/
                .main-tabl{width: 100%}
                .footer {position: fixed ; left: 0px; bottom: 20px; right: 0px; font-size:10px; }
                body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,th,div{
                        color:#525252 !important;
                }
                .header{
                        font-size: 12.5px;
                        display: inline-block;
                        width: 100%;
                }
                .main-left{
                        padding-top: 12px;
                        float: left;
                }
                .main-right{
                        float: right;
                }
                table.table{
                        border-collapse: collapse;
                        width:100%;
                }
                .table td{
                        font-size: 12px;
                        text-align: center;
                        padding-top: 5px;
                        padding-bottom: 5px;
                }
                body {-webkit-print-color-adjust: exact;
                      margin-left: 10mm; margin-right: 10mm;
                }


        }
        @media screen{
                .main-tabl{
                        width: 60%;
                }
                .table {
                        width: 60% !important;
                        color: #000 !important;
                }
        }
        .print{
                margin-top: 18px;
                margin-left: 315px;
        }
        footer {
                width: 100%;
                position: absolute;
                bottom: 0px;
        }
        .tax-declarations p{
                font-size: 12px;
                line-height: 18px;
        }
        .bill{
                text-align: center;
                font-size: 17px;
        } .bill span{
                background-color:  #e4e4e4;
                padding: 12px 80px 11px 80px;
                border-radius: 5px;
        }  .table {
                border-collapse: collapse;
                font-size: 12px;
                margin-top:20px !important;
                margin:auto;
        }

        .table, .table td{
                border: 1px solid #aea6a6;
                text-align: center;
        } .print_btn{
                font-weight: bold !important;
                color: #fff;
                border-color: #80b636;
                cursor: pointer;
                border: 1px solid transparent;
                padding: 6px 12px;
                font-size: 13px;
                line-height: 1.42857143;
        } .print_btn_color{
                background-color: #8dc63f;
        } .close_btn_color{
                background-color: #b60d14;
        } .table2,.table2 td{
                border:none;
        }.table3{
                width:30% !important;
        }.table4{
                border:none  !important;
                float:left  !important;
        }.bank-details td{
                border: 1px solid #aea6a6!important;
        }



</style>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Invoice</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body">

                                        <div class="row">
                                                <?php
                                                $patient = common\models\PatientGeneral::findOne($model->patient_id);
                                                $service = common\models\Service::findOne($model->service_id);
                                                ?>
                                                <div class="col-md-12">
                                                        <label style="color: #000">Patient Name : </label>  <b><span style="color: #000;"><?= $patient->first_name ?></span></b><br>
                                                        <label style="color: #000">Service ID :</label>  <b><span style="color: #000;"><?= $service->service_id ?></span></b>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <table class="table">
                                                        <tr>
                                                                <td colspan="2"> To,</td>
                                                                <td>Bill No</td>
                                                                <?php
                                                                $bill_no = '';
                                                                $branch = Branch::findOne($model->branch_id);
                                                                $date = date('m-d', strtotime($model->DOC));
                                                                if (!empty($branch)) {
                                                                        $bill_no = $branch->branch_code . '  ' . $model->id . '/' . $date;
                                                                }
                                                                ?>
                                                                <td><?= $bill_no ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td>Patient Name</td>
                                                                <?php
                                                                $patient_name = '';
                                                                $patient_id = '';
                                                                if (isset($model->patient_id)) {
                                                                        $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                        $patient_name = $patient->first_name . ' ' . $patient->last_name;
                                                                        $patient_id = $patient->patient_id;
                                                                }
                                                                ?>
                                                                <td><?= $patient_name ?></td>
                                                                <td>Date</td>
                                                                <td><?= date('d-m-Y', strtotime($model->DOC)) ?></td>
                                                        </tr>

                                                        <?php
                                                        $service = common\models\Service::findOne($model->service_id);
                                                        ?>
                                                        <tr>
                                                                <td>Patient ID</td>
                                                                <td><?= $patient_id; ?></td>
                                                                <td>Ref No</td>
                                                                <td><?= $service->service_id ?></td>
                                                        </tr>
                                                </table>

                                                <table class="table">
                                                        <tr class="heading">
                                                                <td style="width:10%">Sl.No</td>
                                                                <td>Service</td>
                                                                <td>Amount</td>
                                                        </tr>

                                                        <?php
                                                        $service = common\models\Service::findOne($model->service_id);
                                                        $service_detail = common\models\MasterServiceTypes::findOne($service->service);
                                                        $service_name = $service_detail->service_name;
                                                        $first_estimated_price = ServiceScheduleHistory::find()->select('price')->where(['service_id' => $model->service_id, 'type' => 1])->one();
                                                        $count = 1;
                                                        ?>
                                                        <tr>
                                                                <td class="inside-table-td"><?=
                                                                        $count;
                                                                        $count++
                                                                        ?></td>
                                                                <td>
                                                                        <?php
                                                                        $added_schedules_count = 0;
                                                                        $added_schedules_amount = 0;
                                                                        $added_schedule_days = 0;
                                                                        $price = 0;
                                                                        $added_schedules = ServiceScheduleHistory::find()->where(['service_id' => $model->service_id, 'type' => 2])->andWhere(['>', 'price', 0])->all();
                                                                        foreach ($added_schedules as $added_schedules) {
                                                                                $added_schedules_count++;
                                                                                $added_schedules_amount += $added_schedules->price;
                                                                                $added_schedule_days += $added_schedules->schedules;
                                                                        }

                                                                        $cancelled_schedules_amount = 0;
                                                                        $cancelled_schedule_days = 0;
                                                                        $cancelled_schedules = ServiceScheduleHistory::find()->where(['type' => 3])->orWhere(['type' => 4])->andWhere(['>', 'price', 0])->andWhere(['service_id' => $model->service_id])->all();
                                                                        foreach ($cancelled_schedules as $cancelled_schedules) {
                                                                                $cancelled_schedules_count++;
                                                                                $cancelled_schedules_amount += $cancelled_schedules->price;
                                                                                $cancelled_schedule_days += $cancelled_schedules->schedules;
                                                                        }
                                                                        $service_price = $first_estimated_price->price + $added_schedules_amount - $cancelled_schedules_amount;
                                                                        ?>
                                                                        <?= $service_name ?> <br>
                                                                        <?php
                                                                        $from = date('d-m-Y', strtotime($service->from_date));
                                                                        $to = date('d-m-Y', strtotime($service->to_date));
                                                                        ?>
                                                                        <label><?= $from ?> to <?= $to ?></label>
                                                                </td>
                                                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $service_price, 2, '.', ','); ?></td>
                                                        </tr>



                                                        <?php
                                                        ///////////////////////////////////////////materials added//////////////////////////////
                                                        $materials_used_amount = 0;
                                                        $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $model->service_id])->all();
                                                        foreach ($materials_used as $materials_used) {
                                                                $materials_used_amount += $materials_used->due_amount;
                                                        }

                                                        if ($materials_used_amount > 0) {
                                                                ?>
                                                                <tr>
                                                                        <td><?=
                                                                                $count;
                                                                                $count++
                                                                                ?></td>
                                                                        <td>Materials Used</td>
                                                                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $materials_used_amount, 2, '.', ','); ?></td>

                                                                </tr>
                                                        <?php } ?>


                                                        <?php
                                                        $registration_fees = 0;
                                                        if ($service->registration_fees == 1) {
                                                                $registration_fees = $service->registration_fees_amount;
                                                                ?>
                                                                <tr>
                                                                        <td><?=
                                                                                $count;
                                                                                $count++
                                                                                ?></td>
                                                                        <td class="sub"> Registration Fees</td>
                                                                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $registration_fees, 2, '.', ','); ?> </td>

                                                                </tr>
                                                        <?php } ?>

                                                        <?php
                                                        $expenses = common\models\ServiceExpenses::find()->where(['service_id' => $model->service_id])->all();
                                                        $expense_amount = 0;
                                                        foreach ($expenses as $expense) {
                                                                if (isset($expense->expense_amount) && $expense->expense_amount != '') {
                                                                        $expense_amount += $expense->expense_amount;
                                                                        ?>
                                                                        <tr>
                                                                                <td><?=
                                                                                        $count;
                                                                                        $count++
                                                                                        ?></td>
                                                                                <td class="sub"> <?= $expense->expense ?></td>
                                                                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $expense->expense_amount, 2, '.', ','); ?> </td>

                                                                        </tr>
                                                                        <?php
                                                                }
                                                        }
                                                        ?>





                                                        <tr>
                                                                <?php $total_amount = $first_estimated_price->price + $added_schedules_amount + $materials_used_amount - $cancelled_schedules_amount + $registration_fees + $expense_amount; ?>
                                                                <td></td>
                                                                <td colspan="1" style="text-align:center">Bill Total</td>
                                                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $total_amount, 2, '.', ','); ?></td>
                                                        </tr>

                                                        <tr>
                                                                <?php
                                                                $discount_amount = 0;
                                                                $dicounts = ServiceDiscounts::find()->where(['service_id' => $model->service_id])->all();
                                                                foreach ($dicounts as $dicounts) {
                                                                        $discount_amount += $dicounts->discount_value;
                                                                }
                                                                ?>
                                                                <td></td>
                                                                <td colspan="1" style="text-align:center">Discount</td>
                                                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $discount_amount, 2, '.', ','); ?></td>
                                                        </tr>

                                                        <tr>
                                                                <?php $grand_total = $total_amount - $discount_amount ?>
                                                                <td colspan="2" style="text-align:center"><b>Grand Total</b></td>
                                                                <td style="text-align:right;padding-right: 15px;"><b><?= number_format((float) $grand_total, 2, '.', ','); ?></b></td>
                                                        </tr>

                                                        <tr>
                                                                <td colspan="2" style="text-align:center"><b>Amount Paid</b></td>
                                                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $model->amount, 2, '.', ','); ?></td>
                                                        </tr>


                                                </table>
                                        </div>






                                        <div class="row" style="margin:20px 0px">

                                                <div class="invoice-create">
                                                        <div class="invoice-form form-inline">

                                                                <?php $form = ActiveForm::begin(['id' => 'refund-form']); ?>

                                                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'branch_id')->textInput() ?>

                                                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'patient_id')->textInput() ?>

                                                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'service_id')->textInput() ?>

                                                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'type')->textInput() ?>

                                                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'readonly' => true])->label('Amount Paid') ?>
                                                                        <?php $model->refund_amount = ''; ?>
                                                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'refund_amount')->textInput() ?>
                                                                        <p id="amount-error" style="color:red">Refund amount should be less than or equal to amount paid</p>
                                                                </div>
                                                                <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                                                                        <div class="form-group" style="float: right;">
                                                                                <?= Html::submitButton($model->isNewRecord ? 'Refund' : 'Refund', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                        </div>
                                                                </div>

                                                                <?php ActiveForm::end(); ?>

                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        $(document).ready(function () {
                $('#amount-error').hide();
                $('#invoice-refund_amount').keyup(function () {
                        var val = $(this).val();
                        var amount_paid = $('#invoice-amount').val();
                        if (parseInt(val) > parseInt(amount_paid)) {
                                $('#amount-error').show();
                        } else {
                                $('#amount-error').hide();
                        }
                });


                $('#refund-form').click(function (e) {

                        var val = $('#invoice-refund_amount').val();
                        var amount_paid = $('#invoice-amount').val();
                        if (parseInt(val) <= parseInt(amount_paid)) {
                                return true;
                        } else {
                                e.preventDefault();
                                return false;
                        }
                });
        });
</script>