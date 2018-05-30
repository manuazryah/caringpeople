<form action="" id="submit-add-new-item">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add New Item</h4>
        </div>

        <div class="modal-body">

            <div class="row pop-up-row" >

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-2" class="control-label">SKU(Item Code)</label>

                        <input type="text" class="form-control" id="sales_item_code" name="sales_item_code" data-validate="required,item_code">
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-3" class="control-label">Name</label>

                        <input type="text" class="form-control" id="sales_item_name" name="sales_item_name">
                    </div>

                </div>
            </div>

            <div class="row pop-up-row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-1" class="control-label">Type</label>

                        <select class="form-control" name="sales_item_type" id="sales_item_type">
                            <option value="0">Cost</option>
                            <option value="1">Service</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-5" class="control-label">Tax</label>

                        <select id="sales_item_tax" class="form-control" name="sales_item_tax">
                            <option value="">-Choose Tax-</option>
                            <?php foreach ($tax as $value) { ?>
                                <option value="<?= $value->id ?>"><?= $value->name ?></option>
                            <?php }
                            ?>
                        </select>

                    </div>

                </div>

            </div>

            <div class="row pop-up-row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-5" class="control-label">Hsn</label>

                        <select id="sales_item_hsn" class="form-control" name="sales_item_hsn">
                            <option value="">-Choose Hsn-</option>
                        </select>

                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-1" class="control-label">Base Unit</label>

                        <select id="sales_item_base_unit" class="form-control" name="sales_item_base_unit">
                            <option value="">-Choose Tax-</option>
                            <?php foreach ($base_unit as $unit) { ?>
                                <option value="<?= $unit->id ?>"><?= $unit->name ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                </div>

            </div>
            <div class="row pop-up-row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-5" class="control-label">Retail Price</label>

                        <input type="text" class="form-control" id="sales_item_retail_price" name="sales_item_retail_price">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-5" class="control-label">Purchase Price</label>

                        <input type="text" class="form-control" id="sales_item_purchase_price" name="sales_item_purchase_price">

                    </div>

                </div>

            </div>

        </div>
        <input type="hidden" id="current-row-<?= $row_id ?>" class="current_row_id"/>
        <input type="hidden" value="<?= $bill_type ?>" name="bill_types" id="bill_types"/>

        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </div>
</form>