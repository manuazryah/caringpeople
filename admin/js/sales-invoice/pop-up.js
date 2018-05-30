/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    /*
     * on click of the Add new partner link
     * return pop up form for add new bussinesss partner
     */

    $(document).on('click', '.new-link-box', function (e) {
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: 'partner-type=' + $(this).attr('partner-type'),
            url: homeUrl + 'sales/sales-ajax/add-partner',
            success: function (data) {
                $("#modal-pop-up").html(data);
                $('#modal-6').modal('show', {backdrop: 'static'});
                e.preventDefault();
            }
        });
    });

    /*
     * on submit of the form add new bissiness partner
     * @parameeter type,partner_code,name,phone,email
     * return new partner added into bussiness partner field
     */

    $(document).on('submit', '#submit-add-partner', function (e) {

        if (validatePartner() == 0) {
            var str = $(this).serialize();
            $.ajax({
                url: homeUrl + 'sales/sales-ajax/update-partner',
                type: "POST",
                data: str,
                success: function (data) {
                    var res = $.parseJSON(data);
                    $(".partner_name").text(res.result['partner-name']);
                    $("#salesinvoicedetails-busines_partner_code").val(res.result['partner-id']);
                    $('#modal-6').modal('hide');
                }
            });
            return false;
        } else {
            e.preventDefault();
        }
    });

    /*
     * on click of the Add new item link
     * return pop up form for add new item
     */

    $(document).on('click', '.item-pop-up-link', function (e) {
        var row_id = $(this).attr('id');
        var id = row_id.split('-');
        var bill_type = $("#bill_type").val();
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: {row_id: id[1], bill_type: bill_type},
            url: homeUrl + 'sales/sales-ajax/add-new-item',
            success: function (data) {
                $("#modal-pop-up").html(data);
                $('#modal-6').modal('show', {backdrop: 'static'});
            }
        });
    });

    /*
     * on submit of the form add new bissiness partner
     * @parameeter type,partner_code,name,phone,email
     * return new partner added into bussiness partner field
     */

    $(document).on('submit', '#submit-add-new-item', function (e) {
        var current_row_id = $('.current_row_id').attr('id').match(/\d+/);
        if (validateNewItem() == 0) {
            var item_codee = $("#sales_item_code").val();
            var str = $(this).serialize();
            $.ajax({
                type: 'POST',
                cache: false,
                data: {item_code: item_codee},
                url: homeUrl + 'sales/sales-ajax/sku',
                success: function (data) {
                    if (data == 0) {
                        if ($("#sales_item_code").parent().next(".validation").length == 0) // only add if not added
                        {
                            $("#sales_item_code").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This Code is Already Used</div>");
                        }
                        $('#sales_item_code').focus();
                    } else {

                        console.log(str);
                        $.ajax({
                            url: homeUrl + 'sales/sales-ajax/save-new-item',
                            type: "POST",
                            data: str,
                            success: function (data) {
                                var res = $.parseJSON(data);
                                console.log(res);
                                if (res.result['item_type'] == 1) {
                                    $('#salesinvoicedetails-items-' + current_row_id).val(res.result['item_name']);
                                    $('#salesinvoicedetails-item-code-' + current_row_id).val(res.result['item_id']);
                                    $('#sales-uom-' + current_row_id).val(res.result['UOM']);
                                    $('#salesinvoicedetails-tax-value-' + current_row_id).val(res.result['tax_value']);
                                    $('#salesinvoicedetails-tax-type-' + current_row_id).val(res.result['tax_type']);
                                    $('#salesinvoicedetails-qty-' + current_row_id).val(1);
                                    $("#salesinvoicedetails-rate-" + current_row_id).val(res.result['rate']);
                                    var iddd = '#salesinvoicedetails-tax-' + current_row_id;
                                    $("" + iddd + " option[value='" + res.result['tax_id'] + "']").prop('selected', true);
                                    if ($('#salesinvoicedetails-qty-' + current_row_id).val() != "" && $("#salesinvoicedetails-rate-" + current_row_id).val() != "") {
                                        lineTotalAmount(current_row_id);
                                    }
                                    $('#modal-6').modal('hide');
                                } else {
                                    $('#modal-6').modal('hide');
                                    alert('No Stock Available for this item');
                                }
                            }
                        });
                    }
                }
            });
            return false;
        } else {
            e.preventDefault();
        }
    });

    /*
     * on click of change invoice number
     * return pop up form for add new invoice number
     */

    $(document).on('click', '.sales-invoive-no-change', function (e) {
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: 'invoice-type=' + $(this).attr('invoice-type'),
            url: homeUrl + 'sales/sales-ajax/change-invoice-number',
            success: function (data) {
                $("#modal-pop-up").html(data);
                $('#modal-6').modal('show', {backdrop: 'static'});
                e.preventDefault();

            }
        });
    });

    /*
     * on submit of the form add new invoice number
     * @parameeter prefix,serial_no
     * return new invoice number to invoice number field
     */

    $(document).on('submit', '#submit-change-invoice-number', function (e) {

        if (validateInvoiceNumber() == 0) {
            var str = $(this).serialize();
            $.ajax({
                url: homeUrl + 'sales/sales-ajax/add-invoice-number',
                type: "POST",
                data: str,
                success: function (data) {
                    if (data == 1) {
                        $('.invoice-err').modal('show');
                    } else {
                        var res = $.parseJSON(data);
                        $("#salesreturninvoicemaster-sales_invoice_number").val(res.result['prefix'] + '-' + res.result['serial-no']);
                        $('#modal-6').modal('hide');
                    }
                }
            });
            return false;
        } else {
            e.preventDefault();
        }
    });

    $(document).on('change', '#sales_item_tax', function (e) {
        var tax = $(this).val();
        $.ajax({
            type: 'POST',
            cache: false,
            data: {tax_id: tax},
            url: homeUrl + 'sales/sales-ajax/hsn',
            success: function (data) {
                $('#sales_item_hsn').html(data);
            }
        });
    });

});

/*
 * validate new invoice number generate form
 * return 0 if validation true otherwise return 1
 */

function validateInvoiceNumber() {

    if (!$('#invoice_prefix').val()) {
        if ($("#invoice_prefix").parent().next(".invoice-validation").length == 0) // only add if not added
        {
            $("#invoice_prefix").parent().after("<div class='invoice-validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#invoice_prefix').focus();
        var validate = 1;
    } else {
        $("#invoice_prefix").parent().next(".invoice-validation").remove(); // remove it
        var validate = 0;
    }

    if (!$('#invoice_next_no').val()) {
        if ($("#invoice_next_no").parent().next(".invoice-validation").length == 0) // only add if not added
        {
            $("#invoice_next_no").parent().after("<div class='invoice-validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#invoice_next_no').focus();
        var validates = 1;
    } else {
        $("#invoice_next_no").parent().next(".invoice-validation").remove(); // remove it
        var validates = 0;
    }
    if (validate != "1" && validates != "1") {
        var validated = 0;
    } else {
        var validated = 1;
    }
    return validated;
}

/*
 * validate business partner form
 * return 0 if validation true otherwise return 1
 */

function validatePartner() {

    if (!$('#bussiness_partner_code').val()) {
        if ($("#bussiness_partner_code").parent().next(".validation").length == 0) // only add if not added
        {
            $("#bussiness_partner_code").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#bussiness_partner_code').focus();
        var valid = 1;
    } else {
        $("#bussiness_partner_code").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#bussiness_partner_name').val()) {
        if ($("#bussiness_partner_name").parent().next(".validation").length == 0) // only add if not added
        {
            $("#bussiness_partner_name").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#bussiness_partner_name').focus();
        var valid = 1;
    } else {
        $("#bussiness_partner_name").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    return valid;
}

/*
 * validate new invoice number generate form
 * return 0 if validation true otherwise return 1
 */

function validateNewItem() {

    if (!$('#sales_item_code').val()) {
        if ($("#sales_item_code").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_code").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_code').focus();
        var valid = 1;
    } else {
        $("#sales_item_code").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#sales_item_name').val()) {
        if ($("#sales_item_name").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_name").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_name').focus();
        var valid = 1;
    } else {
        $("#sales_item_name").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#sales_item_tax').val()) {
        if ($("#sales_item_tax").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_tax").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_tax').focus();
        var valid = 1;
    } else {
        $("#sales_item_tax").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#sales_item_base_unit').val()) {
        if ($("#sales_item_base_unit").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_base_unit").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_base_unit').focus();
        var valid = 1;
    } else {
        $("#sales_item_base_unit").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#sales_item_retail_price').val()) {
        if ($("#sales_item_retail_price").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_retail_price").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_retail_price').focus();
        var valid = 1;
    } else {
        $("#sales_item_retail_price").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    if (!$('#sales_item_purchase_price').val()) {
        if ($("#sales_item_purchase_price").parent().next(".validation").length == 0) // only add if not added
        {
            $("#sales_item_purchase_price").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required</div>");
        }
        $('#sales_item_purchase_price').focus();
        var valid = 1;
    } else {
        $("#sales_item_purchase_price").parent().next(".validation").remove(); // remove it
        var valid = 0;
    }
    return valid;
}


