<tr class="filter" id="item-row-<?= $next ?>">

        <td>
                <div class="form-group field-salesinvoicedetails-item_code has-success">


                        <?php
                        $items = common\models\ItemMaster::find()->where(['status' => 1])->all();
                        ?>
                        <select id="salesinvoicedetails-items-<?= $next ?>" class="form-control selected-data-name salesinvoicedetails-items add-next" name="SalesInvoiceDetailsItem[<?= $next ?>]" aria-invalid="false">
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
                <div class="form-group field-salesinvoicedetails-qty has-success">

                        <input type="text" id="salesinvoicedetails-qty-<?= $next ?>" class="form-control salesinvoicedetails-qty" name="SalesInvoiceDetailsQty[<?= $next ?>]" placeholder="Qty" aria-invalid="false" autocomplete="off" style="display:inline-block;width:75% ! important;">
                        <span id="sale-uom-<?= $next ?>" style="float:right;padding: 8px 10px 0px 0px;"></span>
                        <input type="hidden" value="" placeholder="UOM" class="form-control" id="sales-uom-<?= $next ?>" name="sales-uom[<?= $next ?>]" readonly/>
                        <input type="hidden" value=""  class="form-control" id="sales-qty-count-<?= $next ?>" name="sales_qty_count[1]" readonly/>
                        <div class="help-block"></div>
                </div>
                <div class="stock-check" id="stock-check-<?= $next ?>" style="display:none;">
                        <p style="text-align: center;font-weight: bold;color: black;">Stock :<span class="stock-exist" id="stock-exist-<?= $next ?>"></span></p>
                </div>
        </td>
        <!--<input type="hidden" value="" placeholder="" class="form-control" id="tax-type-<?= $next ?>" name="tax-type" readonly/>-->
    <!--    <td>
            <span id="sale-uom-<?= $next ?>"></span>
            <input type="hidden" value="" placeholder="UOM" class="form-control" id="sales-uom-<?= $next ?>" name="sales-uom[<?= $next ?>]" readonly/>
        <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)        ?>
        </td>-->
        <td>
                <div class="form-group field-salesinvoicedetails-rate has-success">
                        <input type="number" id="salesinvoicedetails-rate-<?= $next ?>" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[<?= $next ?>]" placeholder="RATE" step="0.01" aria-invalid="false" autocomplete="off" >
                                    <!--<input type="text" id="salesinvoicedetails-rate-<?php // $next      ?>" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[<?php // $next      ?>]" placeholder="RATE" aria-invalid="false" autocomplete="off">-->

                        <div class="help-block"></div>
                </div>
        </td>
        <td>
                <div class="form-group field-salesinvoicedetails-discount_percentage has-success">
                        <div class="row">
                                <div class="col-md-6" style="padding-right:0px;">
                                        <input type="text" id="salesinvoicedetails-discount-<?= $next ?>" class="form-control salesinvoicedetails-discount" name="SalesInvoiceDetailsDiscountValue[<?= $next ?>]" value="0" aria-invalid="false" autocomplete="off">
                                </div>
                                <div class="col-md-6" style="padding-left:0px;">
                                        <select id="salesinvoicedetails-discount-type-<?= $next ?>" class="form-control salesinvoicedetails-discount-type" name="SalesInvoiceDetailsDiscountType[<?= $next ?>]">
                                                <option value="0"> Rs </option>
                                                <option value="1"> % </option>
                                        </select>
                                </div>
                        </div>
                        <div class="help-block"></div>
                </div>
        </td>
        <!--<td>
            <div class="form-group field-salesinvoicedetails-discount_percentage has-success">

                <input type="text" id="salesinvoicedetails-discount_percentage-<?= $next ?>" class="form-control salesinvoicedetails-discount_percentage" name="SalesInvoiceDetailsDiscount[<?= $next ?>]" placeholder="Discount %" aria-invalid="false">

                <div class="help-block"></div>
            </div>
        </td>
        <td>
            <div class="form-group field-salesinvoicedetails-discount_amount has-success">

                <input type="text" id="salesinvoicedetails-discount_amount-<?= $next ?>" class="form-control salesinvoicedetails-discount_amount" name="SalesInvoiceDetailsAmount[<?= $next ?>]" placeholder="Discount Amount" aria-invalid="false">

                <div class="help-block"></div>
            </div>
        </td>-->
        <!--<td>
            <div class="form-group field-salesinvoicedetails-tax_percentage has-success">

                <input type="text" id="salesinvoicedetails-tax_percentage-<?= $next ?>" class="form-control salesinvoicedetails-tax_percentage" name="SalesInvoiceDetailsTaxPercentage[<?= $next ?>]" readonly="" placeholder="Tax" aria-invalid="false">

                <div class="help-block"></div>
            </div>
        </td>-->
        <td>
                <div class="form-group field-salesinvoicedetails-tax has-success">

                        <select id="salesinvoicedetails-tax-<?= $next ?>" class="form-control salesinvoicedetails-tax" name="SalesInvoiceDetailsTax[<?= $next ?>]" aria-invalid="false">
                                <option value="">-Choose Tax-</option>
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
<input type="hidden" value="" placeholder="" class="form-control" id="salesinvoicedetails-tax-type-<?= $next ?>" name="salesinvoicedetails-tax-type[<?= $next ?>]" readonly/>
<input type="hidden" value="" placeholder="" class="form-control" id="salesinvoicedetails-tax-value-<?= $next ?>" name="salesinvoicedetails-tax-value[<?= $next ?>]" readonly/>
<td>
        <div class="form-group field-salesinvoicedetails-line_total has-success">

                <input type="text" id="salesinvoicedetails-line_total-<?= $next ?>" class="form-control salesinvoicedetails-line_total" name="SalesInvoiceDetailsLineTotal[<?= $next ?>]" placeholder="Amount" aria-invalid="false" autocomplete="off">

                <div class="help-block"></div>
        </div>
</td>
<td>
        <a id="del" class="" ><i class="fa fa-times sales-invoice-delete"></i></a>
</td>
</tr>