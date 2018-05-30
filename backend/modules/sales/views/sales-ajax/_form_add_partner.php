<form action="" id="submit-add-partner">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Bussiness Partner</h4>
        </div>

        <div class="modal-body">

            <div class="row pop-up-row">
                <!--                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Type</label>

                                        <select class="form-control" name="bussiness_partner_type" id="bussiness_partner_type">
                                            <option value="">Select Partner Type</option>
                                            <option value="0">Customer</option>
                                            <option value="1">Supplier</option>
                                        </select>
                                    </div>

                                </div>-->

                <?php
                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 5])->one();
                $new_partner_code = $this->context->generatePartner($serial_no->prefix, $serial_no->sequence_no);
                ?>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-2" class="control-label">Business Partner Code</label>

                        <input type="text" class="form-control" id="bussiness_partner_code" name="bussiness_partner_code" data-validate="required,partner_code" value="<?= $new_partner_code ?>" readonly>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-3" class="control-label">Name</label>

                        <input type="text" class="form-control" id="bussiness_partner_name" name="bussiness_partner_name">
                    </div>

                </div>
            </div>

            <div class="row pop-up-row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-4" class="control-label">Phone</label>

                        <input type="text" class="form-control" id="bussiness_partner_phone" name="bussiness_partner_phone">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="field-5" class="control-label">Email</label>

                        <input type="text" class="form-control" id="bussiness_partner_email" name="bussiness_partner_email">
                    </div>

                </div>

            </div>

        </div>
        <input type="hidden" value="<?= $partner_type ?>" name="partner_type"/>

        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </div>
</form>