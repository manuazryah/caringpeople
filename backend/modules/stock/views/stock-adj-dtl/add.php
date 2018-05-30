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

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Stock Adjustments';
$this->params['breadcrumbs'][] = ['label' => ' Pre-Funding', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .form-group {
                margin-bottom: 0px;
        }
</style>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">

                        <div class="panel-heading">
                                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . '</b>' ?></h2>
                                <div class="diplay-amount"><i class="fa fa-inr" aria-hidden="true"></i> <span id="total-order-amount">00.00</span></div>
                        </div>
                        <?php //Pjax::begin();        ?>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Stock</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="modal fade" id="modal-6">
                                        <div class="modal-dialog" id="modal-pop-up">

                                        </div>
                                </div>
                                <?php
                                $form = ActiveForm::begin();
                                ?>
                                <?php $items = ArrayHelper::map(ItemMaster::findAll(['status' => 1]), 'id', 'item_name'); ?>
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

                                        <input type="hidden" id="stockinvoicemaster-amount" class="form-control" name="StockInvoiceMaster[amount]" readonly="" aria-invalid="false">

                                        <div class="sales-invoice-master-create">
                                                <div class="sales-invoice-master-form form-inline">
                                                        <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                        <div class="col-md-4">
                                                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Date</label></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <?php
                                                                                $model_stock_master->document_date = date('d/m/Y');
                                                                                ?>


                                                                                <?php
                                                                                echo DatePicker::widget([
                                                                                    'model' => $model_stock_master,
                                                                                    'form' => $form,
                                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                                    'attribute' => 'document_date',
                                                                                    'pluginOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format' => 'dd-mm-yyyy',
                                                                                    ]
                                                                                ]);
                                                                                ?>

                                                                        </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <div class="col-md-4">
                                                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Reference</label></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <?= $form->field($model_stock_master, 'reference')->textInput(['maxlength' => true])->label(FALSE) ?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                        <div class="col-md-4">
                                                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Transaction</label></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <?= $form->field($model_stock_master, 'transaction')->dropDownList(['0' => 'Opening', '1' => 'Addition', '2' => 'Deduction'])->label(FALSE) ?>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <div class="col-md-4">
                                                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Document No</label></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <?= $form->field($model_stock_master, 'document_no')->textInput(['maxlength' => true])->label(FALSE) ?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <hr class="billing-hr">

                                <div class="table-responsive form-control-new" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true" style="overflow: visible;">
                                        <?php
                                        $items = ItemMaster::find()->where(['status' => 1])->all();
                                        ?>
                                        <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="add-invoicee">
                                                <thead>
                                                        <tr>
                                                                <th data-priority="3" style="width: 24%;">Item</th>
                                                                <th data-priority="6" style="">Qty</th>
                                                                <th data-priority="6" style="">Unit Cost</th>
                                                                <th data-priority="6" style="">Total Cost</th>
                                                                <th data-priority="1" style="width: 1%;"></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                <input type="hidden" value="1" name="next_item_id" id="next_item_id"/>
                                                <tr class="filter" id="item-row-1">
                                                        <td>
                                                                <div class="form-group field-stockadjdtl-item_code has-success">
                                                                        <select id="stockadjdtl-item_code-1" class="form-control stockadjdtl-item_code add-next" name="StockAdjDtlItemId[1]" aria-invalid="false">
                                                                                <option value="">-Choose a Item-</option>
                                                                                <?php foreach ($items as $value) { ?>
                                                                                        <option value="<?= $value->id ?>"><?= $value->item_name ?></option>
                                                                                <?php }
                                                                                ?>
                                                                        </select>

                                                                        <div class="help-block"></div>
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <div class="form-group field-stockadjdtl-qty has-success">
                                                                        <input type="number" id="stockadjdtl-qty-1" class="form-control stockadjdtl-qty" name="StockAdjDtlQty[1]" placeholder="Qty" min="1" aria-invalid="false" autocomplete="off">
                                                                        <div class="help-block"></div>
                                                                </div>
                                                                <div class="stock-check" id="stock-check-1" style="display:none;">
                                                                        <p style="text-align: center;font-weight: bold;color: black;">Stock :<span class="stock-exist" id="stock-exist-1"></span></p>
                                                                </div>
                                                                <input type="hidden" value=""  class="form-control" id="sales-qty-count-1" name="sales_qty_count[1]" readonly/>
                                                        </td>
                                                        <td>
                                                                <div class="form-group field-stockadjdtl-item_cost has-success">
                                                                        <input type="text" id="stockadjdtl-item_cost-1" class="form-control stockadjdtl-item_cost" name="StockAdjDtlItenCost[1]" aria-invalid="false">
                                                                        <div class="help-block"></div>
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <div class="form-group field-stockadjdtl-item_cost has-success">
                                                                        <input type="text" id="stockadjdtl-item_total-1" class="form-control stockadjdtl-item_total" name="StockAdjDtlTotal[1]" aria-invalid="false" readonly>
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
                                                                <th data-priority="3" style="width: 24%;">Item Total</th>
                                                                <th data-priority="6" style=""></th>
                                                                <th data-priority="6" style=""></th>
                                                                <th data-priority="6" style=""><input type="text" id="sub_total" class="amount-receipt-1" name="sub_total" style="width: 100%;" readonly/></th>
                                                                <th data-priority="1" style="width: 1%;"></th>
                                                        </tr>
                                                </thead>
                                        </table>
                                </div>
                                <a href="" id="add_another_line"><i class="fa fa-plus" aria-hidden="true"></i> Add Another Line</a>
                                <hr class="billing-hr">

                                <div style="float:right;">
                                        <?= Html::submitButton('Save & Approve', ['class' => 'btn btn-secondary', 'name' => 'save-approve', 'value' => 'save-approve', 'style' => 'padding: 7px 25px 7px 25px;margin-top: 18px;']) ?>
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-secondary', 'name' => 'save', 'value' => 'save', 'style' => 'padding: 7px 25px 7px 25px;margin-top: 18px;']) ?>
                                        <?= Html::a('Discard', ['add'], ['class' => 'btn btn-gray btn-reset', 'style' => 'margin-top: 15px;']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>



                        </div>
                        <?php //Pjax::end();                                    ?>
                </div>
        </div>
</div>
<style>
        .filter{
                background-color: #b9c7a7;
        }
</style>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2/select2.min.js"></script>
<!-- Imported scripts on this page -->
<script src="<?= Yii::$app->homeUrl ?>js/inputmask/jquery.inputmask.bundle.js"></script>
<script>
        $(document).ready(function () {
                $(".stockadjdtl-item_code").select2({
                        //placeholder: 'Select your country...',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $(document).on('change', '.stockadjdtl-item_code', function (e) {
                        var flag = 0;
                        var count = 0;
                        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                        var next_row_id = $('#next_item_id').val();
                        var item_id = $(this).val();
                        var transaction = $('#stockadjmst-transaction').val();
                        if (transaction == 2) {
                                var row_count = $('#next_item_id').val();
                                if (row_count > 1) {
                                        for (i = 1; i <= row_count; i++) {
                                                var item_val = $('#stockadjdtl-item_code-' + i).val();
                                                if (item_val == item_id) {
                                                        count = count + 1;
                                                }
                                        }
                                        if (item_id != '') {
                                                if (count > 1) {
                                                        flag = 1;
                                                } else {
                                                        flag = 0;
                                                }
                                        } else {
                                                $('#sales-qty-count-' + current_row_id).val('');
                                                $('#stock-check-' + current_row_id).css('display', 'none');
                                                $("#stock-check-" + current_row_id + " span").text('');
                                                $('#stockadjdtl-qty-' + current_row_id).val('');
                                                $("#stockadjdtl-item_cost-" + current_row_id).val('');
                                                $('#stockadjdtl-item_total-' + current_row_id).val('');
                                                e.preventDefault();
                                        }
                                }
                        }
                        if (flag == 0) {
                                stockChange(item_id, current_row_id, next_row_id);
                        } else {
                                alert('This Item is already Choosed');
                                $('#sales-qty-count-' + current_row_id).val('');
                                $('#stock-check-' + current_row_id).css('display', 'none');
                                $("#stock-check-" + current_row_id + " span").text('');
                                $('#stockadjdtl-qty-' + current_row_id).val('');
                                $("#stockadjdtl-item_cost-" + current_row_id).val('');
                                $('#stockadjdtl-item_total-' + current_row_id).val('');
                                $("#stockadjdtl-item_code-" + current_row_id).select2('val', '');
                                e.preventDefault();
                        }
                });

                $('#add-invoicee').on('click', '#del', function () {
                        var bid = this.id; // button ID
                        var trid = $(this).closest('tr').attr('id'); // table row ID
                        $(this).closest('tr').remove();
                        calculateSubtotal();
                });
                $(document).on('keyup mouseup', '.stockadjdtl-qty', function () {
                        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                        var qty = $('#stockadjdtl-qty-' + current_row_id).val();
                        var rate = $('#stockadjdtl-item_cost-' + current_row_id).val();
                        var transaction = $('#stockadjmst-transaction').val();
                        if (qty != "" && rate != "") {
                                if (transaction == 2) {
                                        var data = $('#sales-qty-count-' + current_row_id).val();
                                        if (parseInt(qty) > parseInt(data)) {
                                                $('#stockadjdtl-qty-' + current_row_id).val(data);
                                                alert(' Quantity exeeds the Available Stock.');
                                        }
                                }
                                lineTotalAmount(current_row_id);
                        }
                });
                $(document).on('keyup', '.stockadjdtl-item_cost', function () {
                        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                        var qty = $('#stockadjdtl-qty-' + current_row_id).val();
                        var rate = $('#stockadjdtl-item_cost-' + current_row_id).val();
                        if (qty != "" && rate != "") {
                                lineTotalAmount(current_row_id);
                        }
                });
                $(document).on('click', '#add_another_line', function (e) {
                        var rowCount = $('#add-invoicee >tbody >tr').length;
                        var next_row_id = $('#next_item_id').val();
                        var next = parseInt(next_row_id) + 1;
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                async: false,
                                data: {next_row_id: next_row_id},
                                url: '<?= Yii::$app->homeUrl; ?>stock/stock-adj-dtl/add-another-row',
                                success: function (data) {
                                        var res = $.parseJSON(data);
                                        console.log(res);
                                        $('#add-invoicee tr:last').after(res.result['next_row_html']);
                                        $("#next_item_id").val(next);
                                        $('.stockadjdtl-qty').attr('type', 'number');
                                        $('.stockadjdtl-qty').attr('min', 1);
                                        $('#stockadjdtl-item_code-' + rowCount).removeClass("add-next");
                                        $('#stockadjdtl-item_code-' + next).select2({
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        e.preventDefault();
                                }
                        });
                });
        });
        function stockChange(item_id, current_row_id, next_row_id) {
                var next = parseInt(next_row_id) + 1;
                var transaction = $('#stockadjmst-transaction').val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: {item_id: item_id, next_row_id: next_row_id, transaction: transaction},
                        url: '<?= Yii::$app->homeUrl; ?>stock/stock-adj-dtl/get-items',
                        success: function (data) {
                                var res = $.parseJSON(data);
                                console.log(res);
                                if (data != 1) {
                                        $('#stockadjdtl-qty-' + current_row_id).val(1);
                                        $("#stockadjdtl-item_cost-" + current_row_id).val(res.result['item_rate']);
                                        if ($('#stockadjdtl-qty-' + current_row_id).val() != "" && $("#stockadjdtl-item_cost-" + current_row_id).val() != "") {
                                                lineTotalAmount(current_row_id);
                                        }
                                        if ($('#stockadjdtl-item_code-' + current_row_id).hasClass('add-next')) {
                                                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                                                $("#next_item_id").val(next);
                                                $('.stockadjdtl-qty').attr('type', 'number');
                                                $('.stockadjdtl-qty').attr('min', 1);
                                                if (transaction == 2) {
                                                        $('#sales-qty-count-' + current_row_id).val(res.result['existing_stock']);
                                                        $('#stock-check-' + current_row_id).css('display', 'block');
                                                        $("#stock-check-" + current_row_id + " span").text(res.result['existing_stock']);
                                                } else {
                                                        $('#sales-qty-count-' + current_row_id).val('');
                                                        $('#stock-check-' + current_row_id).css('display', 'none');
                                                        $("#stock-check-" + current_row_id + " span").text('');
                                                }
                                                $('#stockadjdtl-item_code-' + current_row_id).removeClass("add-next");
                                                $('#stockadjdtl-item_code-' + next).select2({
                                                        allowClear: true
                                                }).on('select2-open', function ()
                                                {
                                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                });
                                        }
                                } else {
                                        $('#sales-qty-count-' + current_row_id).val('');
                                        $('#stock-check-' + current_row_id).css('display', 'none');
                                        $("#stock-check-" + current_row_id + " span").text('');
                                        $('#stockadjdtl-qty-' + current_row_id).val('');
                                        $("#stockadjdtl-item_cost-" + current_row_id).val('');
                                        $('#stockadjdtl-item_total-' + current_row_id).val('');
                                        $("#stockadjdtl-item_code-" + current_row_id).select2('val', '');
                                }
                                calculateSubtotal();
                        }
                });
                return true;
        }
        function lineTotalAmount(current_row_id) {
                var qty = $('#stockadjdtl-qty-' + current_row_id).val();
                var rate = $('#stockadjdtl-item_cost-' + current_row_id).val();
                total_amount = parseFloat(qty) * parseFloat(rate);
                $('#stockadjdtl-item_total-' + current_row_id).val(total_amount.toFixed(2));
                calculateSubtotal();
        }
        function calculateSubtotal() {

                var row_count = $('#next_item_id').val();
                var sub_total = 0;
                for (i = 1; i <= row_count; i++) {
                        var amount = $('#stockadjdtl-item_total-' + i).val();
                        if (!amount && amount == '' || amount == null) {

                                amount = 0;
                        }
                        sub_total = parseFloat(sub_total) + parseFloat(amount);
                }
                $('#sub_total').val(sub_total.toFixed(2));
                $('#total-order-amount').text(sub_total.toFixed(2));
        }
</script>

<style>
        .field-stockadjmst-document_date label{
                display: none;
        }

</style>