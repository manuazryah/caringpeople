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
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

        <table border ="0"  class="main-tabl " border="0">
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
                                                                $branch = Branch::findOne($model->branch_id);
                                                                ?>
                                                                <table style="width:100%">
                                                                        <tr>
                                                                                <td class="company_address" style="text-align:center"> <?= $branch->address ?></td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </div>

                                                <br/>
                                        </div>

                                </th>
                        </tr>

                        <tr>
                                <td class="bill" style="text-align:center;">
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
                        $branch = Branch::findOne($model->branch_id);
                        $date = date('m-d', strtotime($model->DOC));
                        if (!empty($branch)) {
                                $bill_no = $branch->branch_code . '  ' . $model->id . '/' . $date;
                        }
                        ?>
                        <td><?= $bill_no ?></td>
                </tr>

                <tr>
                        <td>Patient Name / Hospital name</td>
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
                        <td>Sl.No</td>
                        <td></td>
                        <td>Amount</td>
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
                        <td></td>
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
                                <td></td>
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
                                <td></td>
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
                                        <td></td>
                                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $expense->expense_amount, 2, '.', ','); ?> </td>

                                </tr>
                                <?php
                        }
                }
                ?>




                <tr>
                        <?php $total_amount = $first_estimated_price->price + $added_schedules_amount + $materials_used_amount - $cancelled_schedules_amount + $registration_fees + $expense_amount; ?>
                        <td></td>
                        <td colspan="2" style="text-align:center">Bill Total</td>
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
                        <td colspan="2" style="text-align:center">Discount</td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $discount_amount, 2, '.', ','); ?></td>
                </tr>

                <tr>
                        <?php $grand_total = $total_amount - $discount_amount ?>
                        <td colspan="3" style="text-align:center"><b>Grand Total</b></td>
                        <td style="text-align:right;padding-right: 15px;"><b><?= number_format((float) $grand_total, 2, '.', ','); ?></b></td>
                </tr>

                <tr>
                        <td colspan="3" style="text-align:center"><b>Amount Paid</b></td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $model->amount, 2, '.', ','); ?></td>
                </tr>

                <tr>
                        <td colspan="3" style="text-align:center"><b>Balance Payment</b></td>
                        <td style="text-align:right;padding-right: 15px;"><?= number_format((float) $model->due_amount, 2, '.', ','); ?></td>
                </tr>
        </table>

        <table class="table table2">
                <tr>
                        <td>
                                Rupees
                        </td>
                        <td colspan="3">
                                <p style="border-bottom: 1px dotted #000;"><?php echo Yii::$app->NumToWord->convert_number_to_words($model->amount) . " Rupees Only"; ?></p>
                        </td>
                </tr>
                <tr>
                        <td>Bank Name:</td>
                        <?php
                        $payment_mode = '';
                        if (isset($model->payment_type)) {
                                $payment = common\models\AccountHead::findOne($model->payment_type);
                                $payment_mode = $payment->bank_name;
                        }
                        ?>
                        <td><p style="border-bottom: 1px dotted #000;"><?= $payment_mode ?></p></td>
                        <td>Cheque No:</td>
                        <td><p style="border-bottom: 1px dotted #000;"><?= $model->reference_no ?></p></td>
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


        </table>

        <table class="main-tabl">
                <tr>
                        <td>
                                <p class="message" style="font-size:10px;font-style: italic">**This is a computer generated copy stamp or seal is not required.<p>
                        </td>
                </tr>
        </table>





</div>


<div class="clearfix" style="clear:both"></div>


<div style="clear:both"></div>

<!--</body>

</html>-->