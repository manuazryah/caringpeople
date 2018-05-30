<tr class="filter" id="item-row-<?= $next ?>">
    <td>
        <div class="form-group field-stockadjdtl-item_code has-success">
            <select id="stockadjdtl-item_code-<?= $next ?>" class="form-control stockadjdtl-item_code add-next" name="StockAdjDtlItemId[<?= $next ?>]" aria-invalid="false">
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
            <input type="number" id="stockadjdtl-qty-<?= $next ?>" class="form-control stockadjdtl-qty" name="StockAdjDtlQty[<?= $next ?>]" placeholder="Qty" min="1" aria-invalid="false" autocomplete="off">
            <div class="help-block"></div>
        </div>
        <div class="stock-check" id="stock-check-<?= $next ?>" style="display:none;">
            <p style="text-align: center;font-weight: bold;color: black;">Stock :<span class="stock-exist" id="stock-exist-<?= $next ?>"></span></p>
        </div>
        <input type="hidden" value=""  class="form-control" id="sales-qty-count-<?= $next ?>" name="sales_qty_count[<?= $next ?>]" readonly/>
    </td>
    <td>
        <div class="form-group field-stockadjdtl-item_cost has-success">
            <input type="text" id="stockadjdtl-item_cost-<?= $next ?>" class="form-control stockadjdtl-item_cost" name="StockAdjDtlItenCost[<?= $next ?>]" aria-invalid="false">
            <div class="help-block"></div>
        </div>
    </td>
    <td>
        <div class="form-group field-stockadjdtl-item_cost has-success">
            <input type="text" id="stockadjdtl-item_total-<?= $next ?>" class="form-control stockadjdtl-item_total" name="StockAdjDtlTotal[<?= $next ?>]" aria-invalid="false" readonly>
            <div class="help-block"></div>
        </div>
    </td>
    <td>
        <a id="del" class="" ><i class="fa fa-times sales-invoice-delete"></i></a>
    </td>


</tr>