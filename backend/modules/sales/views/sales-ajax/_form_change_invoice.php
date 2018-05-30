<form action="" id="submit-change-invoice-number">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Invoice Number</h4>
        </div>

        <div class="modal-body">
            <div class="row" style="background-color: white !important;">
                <div class="col-md-12 invoice-err" style="display: none;">
                    <p  style="margin-bottom: 20px;color:red;">This invoice number is already used. Please try another.</p>
                </div>
            </div>

            <div class="row">

                <div class="col-md-5">

                    <div class="form-group">
                        <label for="field-6" class="control-label">Prefix</label>

                        <input type="text" class="form-control" id="invoice_prefix" name="invoice_prefix" value="<?= $prefixx ?>">
                    </div>

                </div>
                <div class="col-md-2" style="margin-top: 22px;">
                    <div class="form-group">
                        <input type="text" class="form-control" value="-" disabled style="text-align: center;">
                    </div>

                </div>

                <div class="col-md-5">

                    <div class="form-group">
                        <label for="field-7" class="control-label">Next Number</label>

                        <input type="text" class="form-control" id="invoice_next_no" name="invoice_next_no" value="<?= $sequence_num ?>">
                    </div>

                </div>
            </div>


        </div>
        <input type="hidden" value="<?= $invoive_type ?>" name="sales_invoice_type"/>

        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </div>
</form>