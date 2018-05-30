<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use kartik\datetime\DateTimePicker;
use common\components\DropdownWidget;
use common\models\ItemMaster;
use common\models\Tax;
use common\models\Salesman;
use kartik\date\DatePicker;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Purchase Invoice';
$this->params['breadcrumbs'][] = ['label' => ' Pre-Funding', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        form .form-group.has-success .form-control:focus {
                border-color: #ffffff;
        }
        .form-group {
                margin-bottom: 0px;
        }
</style>
<script>
        $(document).ready(function () {
                var report_id = '<?php echo $report_id ?>';
                if (report_id != '') {
                        window.open('<?= Yii::$app->homeUrl ?>sales/purchase-invoice-details/report?id=' + report_id, 'print_popup', 'width=1200,height=500');
                }
        });
</script>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . '</b>' ?></h2>
                                <div class="diplay-amount"><i class="fa fa-inr" aria-hidden="true"></i> <span id="total-order-amount">00.00</span></div>
                        </div>
                        <?php //Pjax::begin();         ?>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Invoice</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="modal fade" id="modal-6">
                                        <div class="modal-dialog" id="modal-pop-up">

                                        </div>
                                </div>
                                <?php $form = ActiveForm::begin(); ?>
                                <?php
                                $default_partner = [];
                                ?>
                                <div class="panel-body">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>

                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>

                                        <input type="hidden" id="purchaseinvoicemaster-amount" class="form-control" name="PurchaseInvoiceMaster[amount]" readonly="" aria-invalid="false">

                                        <div class="sales-invoice-master-create">
                                                <div class="sales-invoice-master-form form-inline">

                                                        <div class='col-md-2 col-sm-6 col-xs-12'>
                                                                <?php $branch = Branch::branch(); ?>   <?= $form->field($model_purchase_master, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>

                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12' style="padding-left: 0px;">

                                                                <?php
                                                                $partner_datas = \common\models\BusinessPartner::find()->where(['type' => 1])->all();
                                                                ?>
                                                                <?=
                                                                $form->field($model_purchase_master, 'busines_partner_code')->dropDownList(
                                                                        ArrayHelper::map($partner_datas, 'id', 'name'), ['prompt' => '--Select--'])
                                                                ?>

                                                        </div>

                                                        <div class='col-md-3 col-sm-6 col-xs-12' style="display:none">


                                                        </div>

                                                        <?php
                                                        $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 2])->one();
                                                        $sales_invoice_number = $serial_no->prefix . '-' . $serial_no->sequence_no;
                                                        $new_invoice_number = $this->context->generateInvoice($serial_no->prefix, $serial_no->sequence_no);
                                                        $model_purchase_master->sales_invoice_number = $new_invoice_number;
                                                        ?>
                                                        <div class='col-md-2 col-sm-6 col-xs-12'>
                                                                <div class="form-group field-salesinvoicemaster-sales_invoice_number">
                                                                        <label class="control-label" for="purchaseinvoicemaster-sales_invoice_number">Invoice Number</label>
                                                                        <input type="text" id="salesinvoicemaster-sales_invoice_number" class="form-control" name="PurchaseInvoiceMaster[purchase_invoice_number]" value=""  maxlength="50" aria-invalid="false">
                                                                        <!--<div class="sales-invoive-no-change" id="sales-invoive-no-change" invoice-type="2"><a href="" id="sales-invoive-no-text">Change Invoice Number</a></div>-->
                                                                        <div class="help-block"></div>
                                                                </div>
                                                                <input type="hidden" value="2" name="transaction_id"/>
                                                        </div>

                                                        <input type="hidden" value="2" name="invoice_transaction_id" id="invoice_transaction_id"/>

                                                        <?php
                                                        date_default_timezone_set('Asia/Kolkata');
                                                        $current_date = date("d-m-Y h:i");
                                                        ?>
                                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                                                <label class="control-label control-label1" for="formation-date" >Invoice Date</label>
                                                                <input type="text" id="invoice_dates" class="form-control"  data-mask="datetime"name="purchase_invoice_date" value="<?= $current_date ?>"/>
                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_purchase_master, 'reference')->textInput(['maxlength' => true]) ?>

                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_purchase_master, 'payment')->dropDownList(ArrayHelper::map(\common\models\AccountHead::find()->where(['status' => 1])->all(), 'id', 'bank_name'), ['prompt' => '--Select--']) ?>

                                                        </div>

                                                </div>
                                        </div>
                                </div>

                                <hr class="billing-hr">

                                <div class="table-responsive form-control-new" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true" style="overflow: visible;">
                                        <?php
                                        $items = ArrayHelper::map(ItemMaster::find()->where(['status' => 1])->all(), 'SKU', 'SKU');
                                        ?>
                                        <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="add-invoicee">
                                                <thead>
                                                        <tr>
                                                                <th data-priority="3">Item</th>
                                                                <th data-priority="6" style="width: 10%;">Qty</th>
                                                                <!--<th data-priority="6" style="width: 5%;">UOM</th>-->
                                                                <th data-priority="6" style="width: 8%;">RATE</th>
                                                                <th data-priority="6" style="width: 12%;">Discount</th>
                                <!--                                <th data-priority="6">Discount %</th>
                                                                <th data-priority="6">Discount Amount</th>-->
                                                                <!--<th data-priority="6" style="width: 10%;">Tax %</th>-->
                                                                <th data-priority="6" style="width: 14%;">Tax</th>
                                                                <th data-priority="6" style="width: 8%;">Amount</th>
                                                                <th data-priority="1" style="width: 1%;"></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                <input type="hidden" value="1" name="next_item_id" id="next_item_id"/>
                                                <input type="hidden" value="3" name="bill-type" id="bill_type"/>
                                                <tr class="filter" id="item-row-1">
                                                        <?php
                                                        $items = ItemMaster::find()->where(['status' => 1])->all();
                                                        ?>
                                                        <td>
                                                                <div class="form-group field-salesinvoicedetails-item_code has-success">

                                                                        <input type="hidden" value="" placeholder="" class="form-control salesinvoicedetails-item_code hideen-value" id="salesinvoicedetails-item-code-1" name="SalesInvoiceDetailsItem[1]" readonly/>

                                                                        <select id="salesinvoicedetails-items-1" class="form-control selected-data-name salesinvoicedetails-items add-next" name="SalesInvoiceDetailsItem[1]" aria-invalid="false">
                                                                                <option value="">-Choose a Item-</option>
                                                                                <?php foreach ($items as $value) { ?>
                                                                                        <option value="<?= $value->id ?>"><?= $value->item_name ?></option>
                                                                                <?php }
                                                                                ?>
                                                                        </select>

                                                                </div>
                                                        </td>

                                                        <td>
                                                                <div class="form-group field-salesinvoicedetails-qty has-success">

                                                                        <input type="number" id="salesinvoicedetails-qty-1" class="form-control salesinvoicedetails-qty" name="SalesInvoiceDetailsQty[1]" placeholder="Qty" min="1" aria-invalid="false" autocomplete="off" style="display:inline-block;width:75% ! important;">
                                                                        <span id="sale-uom-1" style="float:right;padding: 8px 10px 0px 0px;"></span>
                                                                        <div class="help-block"></div>
                                                                </div>
                                                                <input type="hidden" value="" placeholder="UOM" class="form-control" id="sales-uom-1" name="sales-uom[1]" readonly/>
                                                        </td>
                                                        <!--<input type="hidden" value="" placeholder="" class="form-control" id="tax-type-1" name="tax-type[1]" readonly/>-->
                            <!--                            <td>
                                                            <span id="sale-uom-1"></span>
                                                            <input type="hidden" value="" placeholder="UOM" class="form-control" id="sales-uom-1" name="sales-uom[1]" readonly/>
                                                        <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)                      ?>
                                                        </td>-->
                                                        <td>
                                                                <div class="form-group field-salesinvoicedetails-rate has-success">
                                                                        <input type="number" id="salesinvoicedetails-rate-1" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[1]" placeholder="RATE" step="0.01" aria-invalid="false" autocomplete="off" >
                                                                        <!--<input type="text" id="salesinvoicedetails-rate-1" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[1]" placeholder="RATE" aria-invalid="false" autocomplete="off">-->

                                                                        <div class="help-block"></div>
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <div class="form-group field-salesinvoicedetails-discount_percentage has-success">
                                                                        <div class="row">
                                                                                <div class="col-md-6" style="padding-right:0px;">
                                                                                        <input type="text" id="salesinvoicedetails-discount-1" class="form-control salesinvoicedetails-discount" name="SalesInvoiceDetailsDiscountValue[1]" value="0" aria-invalid="false" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-md-6" style="padding-left:0px;">
                                                                                        <select id="salesinvoicedetails-discount-type-1" class="form-control salesinvoicedetails-discount-type" name="SalesInvoiceDetailsDiscountType[1]">
                                                                                                <option value="0"> Rs </option>
                                                                                                <option value="1"> % </option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="help-block"></div>
                                                                </div>
                                                        </td>
                                                        <?php
                                                        $taxes = Tax::findAll(['status' => 1]);
                                                        ?>
                                                        <td>
                                                                <div class="form-group field-salesinvoicedetails-tax has-success">

                                                                        <select id="salesinvoicedetails-tax-1" class="form-control salesinvoicedetails-tax" name="SalesInvoiceDetailsTax[1]" aria-invalid="false">
                                                                                <option value="">Slelect a Tax</option>
                                                                                <?php
                                                                                foreach ($taxes as $tax) {
                                                                                        if ($tax->type == 0) {
                                                                                                $type = '%';
                                                                                        } else {
                                                                                                $type = 'Rs';
                                                                                        }
                                                                                        ?>
                                                                                        <option value="<?= $tax->id ?>"><?= $tax->name . ' - ' . $tax->value . ' ' . $type ?></option>
                                                                                <?php }
                                                                                ?>
                                                                        </select>

                                                                        <div class="help-block"></div>
                                                                </div>
                                                        </td>
                                                <input type="hidden" value="" placeholder="" class="form-control" id="salesinvoicedetails-tax-type-1" name="salesinvoicedetails-tax-type[1]" readonly/>
                                                <input type="hidden" value="" placeholder="" class="form-control" id="salesinvoicedetails-tax-value-1" name="salesinvoicedetails-tax-value[1]" readonly/>
                                                <td>

                                                        <div class="form-group field-salesinvoicedetails-line_total has-success">

                                                                <input type="text" id="salesinvoicedetails-line_total-1" class="form-control salesinvoicedetails-line_total" name="SalesInvoiceDetailsLineTotal[1]" placeholder="Amount" aria-invalid="false" autocomplete="off">

                                                                <div class="help-block"></div>
                                                        </div>
                                                </td>
                                                <td>
                                                        <a id="del" class="" ><i class="fa fa-times sales-invoice-delete"></i></a>
                                                </td>


                                                </tr>

                                                </tbody>
                                        </table>
                                        <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="add-invoicee">
                                                <thead>
                                                        <tr>
                                                                <th data-priority="3">Item Total</th>
                                                                <th data-priority="6" style="width: 10%;"><input type="text" id="qty_total" class="amount-receipt-1" name="qty_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="6" style="width: 8%;"><input type="hidden" id="sub_total" class="amount-receipt-1" name="sub_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="6" style="width: 12%;"><input type="text" id="discount_sub_total" class="amount-receipt-1"  name="discount_sub_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="6" style="width: 14%;"><input type="text" id="tax_sub_total" class="amount-receipt-1"  name="tax_sub_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="6" style="width: 8%;"><input type="text" id="order_sub_total" class="amount-receipt-1"  name="order_sub_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="1" style="width: 1%;"></th>
                                                        </tr>
                                                <input type="hidden" id="amount_without_tax" class="amount-receipt-1" name="amount_without_tax" style="width: 100%;" readonly/>
                                                </thead>
                                        </table>

                                </div>
                                <a href="" id="add_another_line"><i class="fa fa-plus" aria-hidden="true"></i> Add Another Line</a>
                                <hr class="billing-hr">
                                <div class="panel-body">
                                        <div class="sales-invoice-master-create">
                                                <div class="sales-invoice-master-form form-inline">

                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_purchase_master, 'general_terms')->textarea(['rows' => '6']) ?>
                                                        </div>


                                                        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                                                                <table cellspacing="0" class="table table-small-font table-bordered table-striped" style="float:right;text-align: left;">
                                                                <!--<table style="float:right;text-align: left;">-->
                                                                        <tr style="display:none">
                                                                                <td>Round off</td>
                                                                                <td><input type="text" id="round_of" class="amount-receipt"  name="round_of" style="width: 100%;" autocomplete="off" value="<?= sprintf('%0.2f', 0); ?>"/></td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                                <td>Cash</td>
                                                                                <td><input type="text" id="cash_amount" class="amount-receipt"  name="cash_amount" style="width: 100%;" autocomplete="off" value="<?= sprintf('%0.2f', 0); ?>"/></td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                                <td>Card</td>
                                                                                <td><input type="text" id="card_amount" class="amount-receipt"  name="card_amount" style="width: 100%;" autocomplete="off" value="<?= sprintf('%0.2f', 0); ?>"/></td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td>Amount Paid</td>
                                                                                <td><input type="text" id="payed_amount" class="amount-receipt"  name="payed_amount" style="width: 100%;border:none" readonly/></td></td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                                <td>Balance</td>
                                                                                <td><input type="text" id="balance" class="amount-receipt"  name="balance" style="width: 100%;" readonly/></td>
                                                                                <!--<td><span id="balance"></span></td>-->
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                                <td>Due Date</td>
                                                                                <td>
                                                                                        <?php
                                                                                        echo DatePicker::widget([
                                                                                            'model' => $model_purchase_master,
                                                                                            'form' => $form,
                                                                                            'type' => DatePicker::TYPE_INPUT,
                                                                                            'attribute' => 'due_date',
                                                                                            'pluginOptions' => [
                                                                                                'autoclose' => true,
                                                                                                'format' => 'dd-mm-yyyy',
                                                                                            ]
                                                                                        ]);
                                                                                        ?>
                                                                                </td>
                                                                        </tr>
                                                                </table>
                                                        </div>

                                                </div>
                                        </div>
                                </div>

                                <div style="float:right;">
                                        <?php // Html::submitButton('Save & Print', ['class' => 'btn btn-secondary', 'name' => 'save-print', 'value' => 'save-print'])  ?>
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-secondary', 'name' => 'save', 'value' => 'save']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>



                        </div>
                        <?php //Pjax::end();                                    ?>
                </div>
        </div>
</div>
<!--<div class="modal fade" id="add-sub">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Dynamic Content</h4>
            </div>

            <div class="modal-body">

                Content is loading...

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info">Save changes</button>
            </div>
        </div>
    </div>

</div>-->
<style>
        .filter{
                background-color: #b9c7a7;
        }
</style>
<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>js/sales-invoice/auto-complete.js"></script>
<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>js/sales-invoice/invoice.js"></script>

<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>js/sales-invoice/pop-up.js"></script>
<!-- Imported scripts on this page -->
<script src="<?= Yii::$app->homeUrl ?>js/inputmask/jquery.inputmask.bundle.js"></script>
<script>
        $(document).ready(function () {

                $("#purchaseinvoicemaster-busines_partner_code").select2({
                        //placeholder: 'Select your country...',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });


                $(".salesinvoicedetails-items").select2({
                        //placeholder: 'Select your country...',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#auto-complete").select({
                        id: "auto-complete",
                        method_name: "get-supplier",
                });
                $("#auto-complete1").select({
                        id: "auto-complete1",
                        method_name: "get-autocomplte-items",
                });
                $(document).on('submit', '#w0', function (e) {
                        if (validateInvoice() == 0) {

                        } else {
                                e.preventDefault();
                        }
                });


        });
        function validateInvoice() {
                if (!$('#salesinvoicemaster-sales_invoice_number').val()) {
                        if ($("#salesinvoicemaster-sales_invoice_number").parent().next(".validation").length == 0) // only add if not added
                        {
                                $("#salesinvoicemaster-sales_invoice_number").parent().after("<div class='validation' style='font-size: 11px;color:red;'>Invoice Number cannot be blank.</div>");
                        }
                        $('#salesinvoicemaster-sales_invoice_number').focus();
                        var valid = 1;
                } else {
                        $("#salesinvoicemaster-sales_invoice_number").parent().next(".validation").remove(); // remove it
                        var valid = 0;
                }
                return valid;
        }
</script>

<style>
        .field-purchaseinvoicemaster-due_date label{
                display: none;
        }
</style>