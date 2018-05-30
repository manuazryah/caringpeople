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
                                                                <?php
                                                                $branch_detail = Branch::findOne($model->branch_id);
                                                                ?>
                                                                <tr>
                                                                        <td class="company_address" style="text-align:center"> <?= $branch_detail->address ?></td>
                                                                </tr>

                                                        </div>
                                                </div>

                                                <br/>
                                        </div>

                                </th>
                        </tr>

                        <tr>
                                <td class="bill">
                                        <div>
                                                <span>BILL</span>
                                        </div>
                                </td>
                        </tr>

                </thead>
        </table>



        <table class="table">

                <tr>
                        <td>Date</td>
                        <td><b>
                                        <?php
                                        if (isset($model->estimated_bill_date) && $model->estimated_bill_date != '0000-00-00') {
                                                echo date('d-m-Y', strtotime($model->estimated_bill_date));
                                        } else {
                                                echo date('d-m-Y');
                                        }
                                        ?>

                                </b></td>
                        <td>No</td>
                        <td><b><?= $model->id ?></b></td>
                </tr>


                <tr>
                        <td>Patient Name / Hospital Name</td>
                        <?php
                        $patient_name = '';
                        $patient_id = '';
                        if (isset($model->patient_id)) {
                                $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                $patient_name = $patient->first_name . ' ' . $patient->last_name;
                                $patient_id = $patient->patient_id;
                        }
                        ?>
                        <td><b><?= $patient_name ?></b></td>
                        <td>Patient ID</td>
                        <td><b><?= $patient_id; ?></b></td>
                </tr>


        </table>

        <table class="table">
                <tr class="heading">
                        <td>Sl.No</td>
                        <td></td>
                        <td>Amount</td>
                        <td>Amount</td>
                </tr>

                <?php
                $service = $model;
                $service_detail = common\models\MasterServiceTypes::findOne($service->service);
                $service_name = $service_detail->service_name;
                $first_estimated_price = ServiceScheduleHistory::find()->select('price')->where(['service_id' => $model->id, 'type' => 1])->one();
                $count = 1;
                ?>
                <tr>
                        <td class="inside-table-td"><?=
                                $count;
                                $count++
                                ?></td>
                        <td><?= $service_name ?> <br>
                                <?php
                                $from = date('d-m-Y', strtotime($service->from_date));
                                $to = date('d-m-Y', strtotime($service->to_date));
                                ?>
                                <label><?= $from ?> to <?= $to ?></label>
                        </td>
                        <td></td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $first_estimated_price->price, 2, '.', ','); ?></td>
                </tr>



                <?php
                ///////////////////////////////////////////materials added//////////////////////////////
                $materials_used_amount = 0;
                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $model->id])->all();

                foreach ($materials_used as $materials_used) {
                        $materials_used_amount += $materials_used->due_amount;
                }

                if ($materials_used_amount > 0) {
                        ?>
                        <tr>
                                <td class="inside-table-td"><?=
                                        $count;
                                        $count++
                                        ?></td>
                                <td>
                                        <table class="table6" style="width:50%;margin:auto">
                                                <tr>
                                                        <td style="border:none" colspan="2"><b>Materials Used</b></td>
                                                </tr>
                                                <?php
                                                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $model->id])->all();
                                                foreach ($materials_used as $materials_used) {
                                                        $materials_used_details = common\models\SalesInvoiceDetails::find()->where(['sales_invoice_master_id' => $materials_used->id])->all();
                                                        foreach ($materials_used_details as $materials_used_details) {
                                                                ?>
                                                                <tr>
                                                                        <td style="border:none"><?= $materials_used_details->item_name ?></td>
                                                                </tr>
                                                                <?php
                                                        }
                                                }
                                                ?>


                                        </table>
                                </td>
                                <td>
                                        <table class="table6" style="width:50%;margin:auto">
                                                <tr>
                                                        <td style="border:none" colspan="2"></td>
                                                </tr>
                                                <?php
                                                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $model->id])->all();
                                                foreach ($materials_used as $materials_used) {
                                                        $materials_used_details = common\models\SalesInvoiceDetails::find()->where(['sales_invoice_master_id' => $materials_used->id])->all();
                                                        foreach ($materials_used_details as $materials_used_details) {
                                                                ?>
                                                                <tr>
                                                                        <td style="border:none"><?= $materials_used_details->net_amount ?></td>
                                                                </tr>
                                                                <?php
                                                        }
                                                }
                                                ?>


                                        </table>
                                </td>
                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $materials_used_amount, 2, '.', ','); ?></td>
                        </tr>


                <?php } ?>




                <?php
                $added_schedules_count = 0;
                $added_schedules_amount = 0;
                $added_schedule_days = 0;
                $price = 0;
                $added_schedules = ServiceScheduleHistory::find()->where(['service_id' => $model->id, 'type' => 2])->andWhere(['>', 'price', 0])->all();
                foreach ($added_schedules as $added_schedules) {
                        $added_schedules_count++;
                        $added_schedules_amount += $added_schedules->price;
                        $added_schedule_days += $added_schedules->schedules;
                }

                if ($added_schedules_count > 0 && $added_schedules_amount > 0) {
                        ?>
                        <tr>
                                <td><?=
                                        $count;
                                        $count++
                                        ?></td>
                                <td class="sub"> Extra Schedules</td>
                                <td></td>
                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $added_schedules_amount, 2, '.', ','); ?> </td>

                        </tr>
                <?php } ?>

                <?php
                $cancelled_schedules_count = 0;
                $cancelled_schedules_amount = 0;
                $cancelled_schedule_days = 0;
                $cancelled_price = 0;
                $cancelled_schedules = ServiceScheduleHistory::find()->where(['service_id' => $model->id, 'type' => 4])->andWhere(['>', 'price', 0])->all();
                foreach ($cancelled_schedules as $cancelled_schedules) {
                        $cancelled_schedules_count++;
                        $cancelled_schedules_amount += $cancelled_schedules->price;
                        $cancelled_schedule_days += $cancelled_schedules->schedules;
                }

                if ($cancelled_schedules_count > 0 && $cancelled_schedules_amount > 0) {
                        ?>
                        <tr>
                                <td><?=
                                        $count;
                                        $count++
                                        ?></td>
                                <td class="sub"> Cancelled Schedules</td>
                                <td></td>
                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $cancelled_schedules_amount, 2, '.', ','); ?> </td>

                        </tr>
                <?php } ?>

                <?php
                $registration_fees = 0;
                if ($model->registration_fees == 1) {
                        $registration_fees = $model->registration_fees_amount;
                        ?>
                        <tr>
                                <td><?=
                                        $count;
                                        $count++
                                        ?></td>
                                <td class="sub"> Registration Fees</td>
                                <td></td>
                                <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $registration_fees, 2, '.', ','); ?> </td>

                        </tr>
                <?php } ?>

                <?php
                $total_expense = 0;
                foreach ($expense as $each_expense) {
                        $total_expense += $each_expense->expense_amount;
                        ?>
                        <tr>
                                <td><?=
                                        $count;
                                        $count++
                                        ?></td>
                                <td class="sub"> <?= $each_expense->expense ?></td>
                                <td></td>
                                <?php if (isset($each_expense->expense_amount) && $each_expense->expense_amount != '') { ?>
                                        <td style="text-align:right;padding-right: 15px;"><?= $each_expense->expense_amount ?> </td>
                                <?php } else { ?>
                                        <td style="text-align:right;padding-right: 15px;"></td>
                                <?php } ?>

                        </tr>
                        <?php
                }
                ?>

                <tr>
                        <?php $total_amount = $first_estimated_price->price + $added_schedules_amount + $materials_used_amount + $registration_fees + $total_expense - $cancelled_schedules_amount; ?>
                        <td></td>
                        <td colspan="2" style="text-align:center">Bill Total</td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $total_amount, 2, '.', ','); ?></td>
                </tr>

                <tr>
                        <?php
                        $discount_amount = 0;
                        $dicounts = ServiceDiscounts::find()->where(['service_id' => $model->id])->all();
                        foreach ($dicounts as $dicounts) {
                                $discount_amount += $dicounts->discount_value;
                        }
                        ?>
                        <td></td>
                        <td colspan="2" style="text-align:center">Discount</td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $discount_amount, 2, '.', ','); ?></td>
                </tr>

                <tr>
                        <?php $grand_total = $total_amount - $discount_amount ?>
                        <td colspan="3" style="text-align:center"><b>Grand Total</b></td>
                        <td style="text-align:right;padding-right: 15px;"><b><?= number_format((float) $grand_total, 2, '.', ','); ?></b></td>
                </tr>

<!--                <tr>
                        <td colspan="3" style="text-align:center"><b>Amount Paid</b></td>
                        <td style="text-align:right"><?php // number_format((float) $model->amount, 2, '.', '');                                                                                  ?></td>
                </tr>-->


        </table>

        <table class="table table2">
                <tr>
                        <td>
                                Rupees
                        </td>
                        <td colspan="3">
                                <p style="border-bottom: 1px dotted #000;"><?php echo Yii::$app->NumToWord->convert_number_to_words($grand_total) . " Rupees Only"; ?></p>
                        </td>
                </tr>



                <tr>
                        <td style="font-style:italic">*Notes:</td>
                        <td colspan="3"><?= $model->client_notes ?></td>
                </tr>

                <tr>
                        <td colspan="2" bgcolor="#eee">For Payment through RTGS/NEFT Mode</td>
                        <!--<td></td>-->
                </tr>

                <?php
                $branch = Branch::findOne($model->branch_id);
                ?>

                <tr class="bank-details">
                        <td style="width:222px;">Account Holder</td>
                        <td style="width:200px;"><?php
                                if (isset($branch->account_holder)) {
                                        echo $branch->account_holder;
                                }
                                ?></td>
                </tr>

                <tr class="bank-details">
                        <td style="width:222px;">Bank</td>
                        <td style="width:200px;"><?php
                                if (isset($branch->bank_name)) {
                                        echo $branch->bank_name;
                                }
                                ?></td>
                </tr>

                <tr class="bank-details">
                        <td>Current Account No</td>
                        <td><?php
                                if (isset($branch->bank_account)) {
                                        echo $branch->bank_account;
                                }
                                ?></td>
                </tr>
                <tr class="bank-details">
                        <td>Branch</td>
                        <td><?php
                                if (isset($branch->bank_branch)) {
                                        echo $branch->bank_branch;
                                }
                                ?></td>
                </tr>
                <tr class="bank-details">
                        <td>IFSC Code</td>
                        <td><?php
                                if (isset($branch->bank_ifsc)) {
                                        echo $branch->bank_ifsc;
                                }
                                ?></td>
                </tr>

<!--                <tr>
                        <td>
                                <div>
                                        <table class="table" style="width:100%!important">
                                                <tr>
                                                        <td>Bank</td>
                                                        <td>State BAnk Of India</td>
                                                </tr>
                                                <tr>
                                                        <td>Current Account No</td>
                                                        <td>36717793170</td>
                                                </tr>
                                                <tr>
                                                        <td>Branch</td>
                                                        <td>Chilavannur, Kadavanthra</td>
                                                </tr>
                                                <tr>
                                                        <td>IFSC Code</td>
                                                        <td>SBIN0016331</td>
                                                </tr>
                                        </table>
                                </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                </tr>-->
        </table>

<!--        <table class="table table4" style="border:none;">
                <tr>
                        <td style="border:none">
                                <div>
                                        <table class="table" >
                <tr>
                        <td>Bank</td>
                        <td>State BAnk Of India</td>
                </tr>
                <tr>
                        <td>Current Account No</td>
                        <td>36717793170</td>
                </tr>
                <tr>
                        <td>Branch</td>
                        <td>Chilavannur, Kadavanthra</td>
                </tr>
                <tr>
                        <td>IFSC Code</td>
                        <td>SBIN0016331</td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </td>
                                        </tr>
        </table>-->






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


<div style="clear:both"></div>

<!--</body>

</html>-->