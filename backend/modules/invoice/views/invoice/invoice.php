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

$this->title = 'Invoice';
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



                                        <?php if (!empty($services) && $services != '') { ?>

                                                <div class="row">
                                                        <?php $patient = \common\models\PatientGeneral::findOne($model->patient_id); ?>
                                                        <p class="patient">PATIENT NAME : <?= $patient->first_name; ?></p>
                                                </div>

                                                <?php $form1 = ActiveForm::begin(['action' => ['payment']]); ?>
                                                <div class="row table-responsive" style="border:none">
                                                        <div class="col-md-12">



                                                                <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                                <tr class="heading">
                                                                                        <td style="width:10px;">#</td>
                                                                                        <td colspan="2">Service</td>
                                                                                        <td style="width:10%">Total Amount</td>
                                                                                        <td style="width:10%">Amount Paid</td>
                                                                                        <td style="width:10%">Due Amount</td>
                                                                                        <td style="width:10%">Amount Received</td>
                                                                                </tr>
                                                                        </thead>
                                                                        <?php
                                                                        $n = 0;

                                                                        foreach ($services as $value) {

                                                                                $n++;
                                                                                $service_name = common\models\MasterServiceTypes::findOne($value->service);
                                                                                $added_schedules = ServiceScheduleHistory::find()->where(['service_id' => $value->id, 'type' => 2])->andWhere(['>', 'price', 0])->all();

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
                                                                                $cancelled_schedules = ServiceScheduleHistory::find()->where(['type' => 3])->orWhere(['type' => 4])->andWhere(['>', 'price', 0])->andWhere(['service_id' => $value->id])->all();

                                                                                foreach ($cancelled_schedules as $cancelled_schedules) {
                                                                                        $cancelled_schedules_count++;
                                                                                        $cancelled_schedules_amount += $cancelled_schedules->price;
                                                                                        $cancelled_schedule_days += $cancelled_schedules->schedules;
                                                                                }

                                                                                ///////////////////////////////////////////materials added//////////////////////////////
                                                                                $materials_used_amount = 0;
                                                                                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $value->id])->all();
                                                                                foreach ($materials_used as $materials_used) {
                                                                                        $materials_used_amount += $materials_used->due_amount;
                                                                                }

                                                                                ///////////////////////////////////////////discounts//////////////////////////////
                                                                                $discount_amount = 0;
                                                                                $dicounts = ServiceDiscounts::find()->where(['service_id' => $value->id])->all();
                                                                                foreach ($dicounts as $dicounts) {
                                                                                        $discount_amount += $dicounts->discount_value;
                                                                                }


                                                                                ///////////////////////////////////////////expenses//////////////////////////////
                                                                                $expenses = common\models\ServiceExpenses::find()->where(['service_id' => $value->id])->all();
                                                                                $expense_count = 0;
                                                                                $expense_amount = 0;
                                                                                foreach ($expenses as $expenses_each) {

                                                                                        $expense_amount += $expenses_each->expense_amount;
                                                                                        $expense_count++;
                                                                                }


                                                                                ////////////////////////////////rowspan////////////////////////////////////////
                                                                                $count = 1;
                                                                                if ($added_schedules_count > 0) {
                                                                                        $count += 1;
                                                                                }
                                                                                if ($materials_used_amount > 0) {
                                                                                        $count += 1;
                                                                                }if ($discount_amount > 0) {
                                                                                        $count += 1;
                                                                                }if ($cancelled_schedules_amount > 0) {
                                                                                        $count += 1;
                                                                                }if ($value->registration_fees == 1) {
                                                                                        $count += 1;
                                                                                }if ($expense_count > 0) {
                                                                                        $count += $expense_count;
                                                                                }

                                                                                //////////////////////////////////total amount////////////////////////////////

                                                                                $registration_fees = 0;
                                                                                if ($value->registration_fees == 1) {
                                                                                        $registration_fees = $value->registration_fees_amount;
                                                                                }

                                                                                $first_estimated_price = ServiceScheduleHistory::find()->select('price')->where(['service_id' => $value->id, 'type' => 1])->one();
                                                                                $total_amount = $value->estimated_price + $added_schedules_amount + $materials_used_amount - $discount_amount - $cancelled_schedules_amount + $registration_fees;
                                                                                $amount_paid = common\models\Invoice::find()->where(['service_id' => $value->id])->sum('amount');
                                                                                if (empty($amount_paid))
                                                                                        $amount_paid = 0;



                                                                                $total_amount = $first_estimated_price->price + $added_schedules_amount + $materials_used_amount - $discount_amount - $cancelled_schedules_amount + $registration_fees + $expense_amount;
                                                                                $due_amount = $total_amount - $amount_paid;
                                                                                ?>

                                                                                <tr>
                                                                                        <td colspan="7"><h5 class="service_name" ><?= $value->service_id; ?></h5> <?= $service_name->service_name ?> service</td>

                                                                                </tr>



                                                                                <!-----------------------------------Service details--------------------------------------------->
                                                                                <tr>
                                                                                        <td rowspan="<?= $count ?>"><?= $n; ?></td>
                                                                                        <td><b>SERVICE FEE</b></td>
                                                                                        <td><b><?= 'Rs. ' . $first_estimated_price->price; ?></b></td>
                                                                                        <td rowspan="<?= $count ?>"> <?= 'Rs. ' . number_format((float) $total_amount, 2, '.', ''); ?></td>

                                                                                        <td rowspan="<?= $count ?>"><?= 'Rs. ' . number_format((float) $amount_paid, 2, '.', ''); ?></td>
                                                                                        <td rowspan="<?= $count ?>"><?= 'Rs. ' . number_format((float) $due_amount, 2, '.', ''); ?></td>
                                                                                        <td rowspan="<?= $count ?>"><input type="text" name="amount_paid_<?= $value->id ?>" id="amount_paid" class="amount_paid" placeholder="    ENTER AMOUNT"></td>
                                                                                </tr>



                                                                                <!-----------------------------------more schedules------------------------------------->
                                                                                <?php
                                                                                if ($added_schedules_count > 0 && $added_schedules_amount > 0) {
                                                                                        $count = '';
                                                                                        if (isset($value->frequency)) {
                                                                                                if ($value->frequency == 1) {
                                                                                                        $count = 'DAYS';
                                                                                                } else if ($value->frequency == 2) {
                                                                                                        $count = 'WEEKS';
                                                                                                } else if ($value->frequency == 3) {
                                                                                                        $count = 'MONTHS';
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                        <tr >
                                                                                                <td class="sub">ADDED <?= $added_schedule_days . ' SCHEDULES' ?> <span style="color:red">( Extra Schedules )</span></td>
                                                                                                <td><?= 'Rs. ' . number_format((float) $added_schedules_amount, 2, '.', ''); ?> </td>

                                                                                        </tr>
                                                                                <?php } ?>







                                                                                <!-----------------------------------cancelled schedules------------------------------------->
                                                                                <?php
                                                                                if ($cancelled_schedules_count > 0 && $cancelled_schedules_amount > 0) {
                                                                                        $count = '';
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td class="sub">CANCELLED <?= $cancelled_schedule_days . ' SCHEDULES' ?></td>
                                                                                                <td><?= 'Rs. ' . number_format((float) $cancelled_schedules_amount, 2, '.', ''); ?> </td>

                                                                                        </tr>
                                                                                <?php } ?>


                                                                                <!------------------------------Materials used------------------------------------->

                                                                                <?php
                                                                                if ($materials_used_amount > 0) {
                                                                                        ?>
                                                                                        <tr >
                                                                                                <td class="sub">MATERIALS USED</td>
                                                                                                <td><?= 'Rs. ' . number_format((float) $materials_used_amount, 2, '.', ''); ?></td>
                                                                                        </tr>
                                                                                <?php } ?>



                                                                                <?php
                                                                                $registration_fees = 0;
                                                                                if ($value->registration_fees == 1) {
                                                                                        $registration_fees = $value->registration_fees_amount;
                                                                                        ?>
                                                                                        <tr>

                                                                                                <td class="sub"> Registration Fees</td>
                                                                                                <td><?= 'Rs. ' . number_format((float) $registration_fees, 2, '.', ','); ?> </td>

                                                                                        </tr>
                                                                                <?php } ?>



                                                                                <!----------------------------Expenses------------------------------------------>




                                                                                <!----------------------------Discounts------------------------------------------>

                                                                               <?php
                                                                                foreach ($expenses as $each_expense) {
                                                                                        ?>
                                                                                        <tr >
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
                                                                                if ($discount_amount > 0) {
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td class="sub">DISCOUNTS</td>
                                                                                                <td><?= 'Rs ' . number_format((float) $discount_amount, 2, '.', ''); ?></td>

                                                                                        </tr>
                                                                                <?php } ?>



                                                                                



                                                                                <input type="hidden" name="total_amount_<?= $value->id ?>" id="total_amount" value="<?= $total_amount - $amount_paid ?>">
                                                                        <?php } ?>
                                                                </table>

                                                                <div class="row " style="margin-top: 40px;    margin-left: 5px;">
                                                                        <input type="hidden" name="patient" value="<?= $model->patient_id; ?>">
                                                                        <input type="hidden" name="branch_id" value="<?= $model->branch_id; ?>">

                                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                                <?= $form->field($model, 'status')->dropDownList(['' => '--Select--', '1' => 'Paid', '2' => 'Unpaid']); ?>
                                                                        </div>

                                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd unpaid'>

                                                                                <?php
                                                                                echo DatePicker::widget([
                                                                                    'model' => $model,
                                                                                    'form' => $form,
                                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                                    'attribute' => 'due_date',
                                                                                    'pluginOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format' => 'dd-mm-yyyy',
                                                                                    ]
                                                                                ]);
                                                                                ?>
                                                                        </div>

                                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd paid'>
                                                                                <?php $banks = \common\models\AccountHead::find()->where(['status' => 1])->all(); ?>   <?= $form1->field($model, 'payment_type')->dropDownList(ArrayHelper::map($banks, 'id', 'bank_name'), ['class' => 'form-control']) ?>
                                                                        </div>

                                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd paid'>
                                                                                <?= $form->field($model, 'reference_no')->textInput() ?>
                                                                                <p class="error" style="color:red;display:none">Reference No already exists</p>
                                                                        </div>

                                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd paid'>

                                                                                <?php
                                                                                echo DatePicker::widget([
                                                                                    'model' => $model,
                                                                                    'form' => $form,
                                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                                    'attribute' => 'payment_date',
                                                                                    'pluginOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format' => 'dd-mm-yyyy',
                                                                                    ]
                                                                                ]);
                                                                                ?>
                                                                        </div>

                                                                        <?= Html::submitButton('Pay', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;margin-right: 15px;']) ?>

                                                                </div>


                                                        </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>
                                                <?php
                                        } else {
                                                if (isset($model->patient_id) && $model->patient_id != '') {
                                                        echo '<p class="no-result">No results found !!</p>';
                                                }
                                        }
                                        ?>



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