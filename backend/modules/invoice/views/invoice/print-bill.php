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
use common\models\Service;
use common\models\Invoice;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>-->
<div id="print">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/invoice.css">
        <?php
        if (Yii::$app->controller->action->id != 'prints') {
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
        <?php } ?>
        <!--    </head>
            <body >-->
        <table border ="0"  class="main-tabl" border="0">
                <thead>
                        <tr>
                                <th style="width:100%">
                                        <div class="header">
                                                <div class="">
                                                        <div>
                                                                <img src="<?= Yii::$app->homeUrl ?>images/logos/logo-1.png" height="100"/>
                                                        </div>
                                                        <div style="">
                                                                <table style="width:100%">
                                                                        <?php
                                                                        $branch = Branch::findOne(1);
                                                                        ?>
                                                                        <tr>
                                                                                <td class="company_address"> <?= $branch->address ?></td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </div>

                                                <br/>
                                        </div>

                                </th>
                        </tr>

                        <tr>
                                <td class="bill">
                                        <div>
                                                <span>RECEIPT</span>
                                        </div>
                                </td>
                        </tr>

                </thead>
        </table>



        <table class="table">
                <tr>
                        <td colspan="2"> To,</td>
                        <td>Bill No</td>
                        <?php
                        $bill_no = '';
                        $branch = Branch::findOne($patient->branch_id);
                        $date = date('m-d', strtotime($model->DOC));
                        $bill_no = '';
                        if (!empty($branch)) {
                                $bill_no = $branch->branch_code . '  ' . $model->id . '/' . $date;
                        }
                        ?>
                        <td><?= $bill_no ?></td>
                </tr>

                <tr>
                        <td>Patient Name / Hospital name</td>
                        <?php
                        if (isset($patient_id)) {
                                $patient = \common\models\PatientGeneral::findOne($patient_id);
                                $patient_name = $patient->first_name . ' ' . $patient->last_name;
                        }
                        ?>
                        <td><?= $patient_name ?></td>
                        <td>Date</td>
                        <td><?= date('d-m-Y') ?></td>
                </tr>

                <tr>
                        <td>Patient ID</td>
                        <td><?= $patient_id; ?></td>
                        <td>Ref No</td>
                        <td></td>
                </tr>
        </table>





        <table class="table">
                <tr class="heading">
                        <td>Sl.No</td>
                        <td>Service</td>
                        <td>Amount</td>
                        <td>Amount Paid</td>
                </tr>

                <?php
                $n = 0;
                $total_amount = 0;
                $total_amount_paid = 0;
                $total_discount = 0;
                foreach ($services as $value) {
                        if (isset($value) && $value != '') {
                                $n++;
                                $service = Service::findOne($value);
                                $service_name = common\models\MasterServiceTypes::findOne($service->service);
                                $added_schedules = ServiceScheduleHistory::find()->where(['service_id' => $service->id, 'type' => 2])->andWhere(['>', 'price', 0])->all();

                                ///////////////////////////////////////////added schedules//////////////////////////////
                                $added_schedules_count = 0;
                                $added_schedules_amount = 0;
                                $added_schedule_days = 0;
                                $price = 0;
                                foreach ($added_schedules as $added_schedules) {
                                        $added_schedules_count++;
                                        $added_schedules_amount += $added_schedules->price;
                                        $added_schedule_days += $added_schedules->schedules;
                                }

                                ///////////////////////////////////////////cancelled schedules//////////////////////////////
                                $cancelled_schedules_count = 0;
                                $cancelled_schedules_amount = 0;
                                $cancelled_schedule_days = 0;
                                $cancelled_schedules = ServiceScheduleHistory::find()->where(['type' => 3])->orWhere(['type' => 4])->andWhere(['>', 'price', 0])->andWhere(['service_id' => $service->id])->all();

                                foreach ($cancelled_schedules as $cancelled_schedules) {
                                        $cancelled_schedules_count++;
                                        $cancelled_schedules_amount += $cancelled_schedules->price;
                                        $cancelled_schedule_days += $cancelled_schedules->schedules;
                                }

                                ///////////////////////////////////////////materials added//////////////////////////////
                                $materials_used_amount = 0;
                                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $service->id])->all();
                                foreach ($materials_used as $materials_used) {
                                        $materials_used_amount += $materials_used->due_amount;
                                }

                                ///////////////////////////////////////////discounts//////////////////////////////
                                $discount_amount = 0;
                                $dicounts = ServiceDiscounts::find()->where(['service_id' => $service->id])->all();
                                foreach ($dicounts as $dicounts) {
                                        $discount_amount += $dicounts->discount_value;
                                }

                                $total_discount += $discount_amount;
                                ///////////////////////////////////////////expenses//////////////////////////////
                                $expenses = common\models\ServiceExpenses::find()->where(['service_id' => $service->id])->all();
                                $expense_count = 0;
                                $expense_amount = 0;
                                foreach ($expenses as $expenses_each) {

                                        $expense_amount += $expenses_each->expense_amount;
                                        $expense_count++;
                                }

                                ////////////////////////////////rowspan////////////////////////////////////////
                                $count = 1;

                                if ($materials_used_amount > 0) {
                                        $count += 1;
                                }if ($service->registration_fees == 1) {
                                        $count += 1;
                                }if ($expense_count > 0) {
                                        $count += $expense_count;
                                }if ($discount_amount > 0) {
                                        $count += 1;
                                }

                                $count += 1;
                                $first_estimated_price = ServiceScheduleHistory::find()->select('price')->where(['service_id' => $service->id, 'type' => 1])->one();
                                $service_price = $first_estimated_price->price + $added_schedules_amount - $cancelled_schedules_amount;
                                ?>


                                <tr>
                                        <td rowspan="<?= $count ?>"><?= $n; ?></td>
                                        <td>    <?= $service_name->service_name ?><br>
                                                <?php
                                                $from = date('d-m-Y', strtotime($service->from_date));
                                                $to = date('d-m-Y', strtotime($service->to_date));
                                                ?>
                                                <label><?= $from ?> to <?= $to ?></label>
                                        </td>
                                        <td><?= 'Rs. ' . number_format((float) $service_price, 2, '.', ''); ?></td>
                                        <?php
                                        $amount_paid = Invoice::find()->where(['service_id' => $service->id])->sum('amount');
                                        $total_amount_paid += $amount_paid;
                                        ?>
                                        <td rowspan="<?= $count ?>"><?= 'Rs. ' . number_format((float) $amount_paid, 2, '.', ''); ?></td>
                                </tr>

                                <?php if ($materials_used_amount > 0) { ?>
                                        <tr>
                                                <td>Materials Added</td>
                                                <td><?= 'Rs. ' . number_format((float) $materials_used_amount, 2, '.', ''); ?></td>
                                        </tr>
                                <?php } ?>

                                <?php
                                foreach ($expenses as $each_expense) {
                                        ?>
                                        <tr>
                                                <td class="sub"> <?= $each_expense->expense ?> </td>
                                                <?php if (isset($each_expense->expense_amount) && $each_expense->expense_amount != '') { ?>
                                                        <td>Rs. <?= $each_expense->expense_amount ?> </td>
                                                <?php } else { ?>
                                                        <td></td>
                                                <?php } ?>

                                        </tr>
                                        <?php
                                }
                                ?>

                                <?php
                                $registration_fees = 0;
                                if ($service->registration_fees == 1) {
                                        $registration_fees = $service->registration_fees_amount;
                                        ?>
                                        <tr>

                                                <td class="sub"> Registration Fees</td>
                                                <td><?= 'Rs. ' . number_format((float) $registration_fees, 2, '.', ','); ?> </td>

                                        </tr>
                                <?php } ?>

                                <?php
                                if ($discount_amount > 0) {
                                        ?>
                                        <tr>

                                                <td class="sub"> Discount</td>
                                                <td><?= 'Rs. ' . number_format((float) $discount_amount, 2, '.', ','); ?> </td>

                                        </tr>
                                <?php } ?>

                                <tr>
                                        <td class="sub"> <b>Total</b></td>
                                        <?php
                                        $total = $service_price + $materials_used_amount + $expense_amount + $registration_fees - $discount_amount;
                                        $total_amount += $total;
                                        ?>
                                        <td><b><?= 'Rs. ' . number_format((float) $total, 2, '.', ','); ?></b></td>
                                </tr>
                                <?php
                        }
                }
                ?>

                <tr>
                        <td colspan="3">Bill Total</td>
                        <td><?= 'Rs. ' . number_format((float) $total_amount, 2, '.', ','); ?></td>
                </tr>




                <tr>
                        <td colspan="3">Total Amount Paid</td>
                        <td><?= 'Rs. ' . number_format((float) $total_amount_paid, 2, '.', ','); ?></td>
                </tr>

        </table>

        <table class="table table2">
                <tr>
                        <td>
                                Rupees
                        </td>
                        <td colspan="3">
                                <p style="border-bottom: 1px dotted #000;"><?php echo Yii::$app->NumToWord->convert_number_to_words($total_amount_paid) . " Rupees Only"; ?></p>
                        </td>
                </tr>



        </table>








</div>


<div class="clearfix" style="clear:both"></div>

<script>
        function printContent(el) {
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
        }
</script>
<?php
if (Yii::$app->controller->action->id != 'prints') {
        ?>
        <div class="print">
                <div class="print" style="float:left;">

                        <button onclick="printContent('print')"  class="print_btn print_btn_color">Print</button>
                        <a href="<?= Yii::$app->homeUrl ?>invoice/invoice/prints?checked_services=<?= $check_service ?>&patient_id=<?= $patient_id ?>"><button  class="print_btn print_btn_color">Save as PDF</button></a>
                        <button onclick="window.close();"  class="print_btn close_btn_color">Close</button>


                </div>
        </div>
<?php } ?>
<div style="clear:both"></div>

<!--</body>

</html>-->