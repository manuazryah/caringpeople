$(document).ready(function () {
    $(function () {
        loadajax();
    });
    $(function () {
        loadpayment();
    });
    $("#auto-complete1").select({
        id: "auto-complete1",
        method_name: "item-partner",
    });
    $(".glddtl-account_id").select2({
        //placeholder: 'Select your country...',
        allowClear: true
    }).on('select2-open', function ()
    {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
    $(".glddtl-account_idd").select2({
        //placeholder: 'Select your country...',
        allowClear: true
    }).on('select2-open', function ()
    {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
    $(document).on('change', '.glddtl-account_idd', function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var next_row_id = $('#next_item_id').val();
        var partner_id = $(this).val();
        var next = parseInt(next_row_id) + 1;
        if (paymentVoucherChange(current_row_id, next_row_id, partner_id)) {
            $("#auto-complete" + next).select({
                id: "auto-complete" + next,
                method_name: "item-partner",
            });
        }
    });
    $(document).on('change', '.glddtl-account_id', function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var next_row_id = $('#next_item_id').val();
        var account_type = $('#account-type').val();
        var partner_id = $(this).val();
        var next = parseInt(next_row_id) + 1;
        if (openingBalanceChange(current_row_id, next_row_id, partner_id, account_type)) {
            $("#auto-complete" + next).select({
                id: "auto-complete" + next,
                method_name: "item-partner",
            });
        }
    });
    $('#add-invoicee').on('click', '#del', function () {
        var bid = this.id; // button ID
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $(this).closest('tr').remove();
        calculateSubtotal();
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
            url: homeUrl + 'stock-ajax/add-another-row',
            success: function (data) {
                var res = $.parseJSON(data);
                console.log(res);
                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                $("#next_item_id").val(next);
                $('#business-partner-items-' + rowCount).removeClass("add-next");
                $('#glddtl-account_id-' + next).select2({
                    allowClear: true
                }).on('select2-open', function ()
                {
                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#auto-complete" + next).select({
                    id: "auto-complete" + next,
                    method_name: "item-partner",
                });
                e.preventDefault();
            }
        });
    });
    $(document).on('click', '#add_another_lines', function (e) {
        var rowCount = $('#add-invoicee >tbody >tr').length;
        var next_row_id = $('#next_item_id').val();
        var next = parseInt(next_row_id) + 1;
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: {next_row_id: next_row_id},
            url: homeUrl + 'stock-ajax/add-another-rows',
            success: function (data) {
                var res = $.parseJSON(data);
                console.log(res);
                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                $("#next_item_id").val(next);
                $('#business-partner-items-' + rowCount).removeClass("add-next");
                $('#glddtl-account_id-' + next).select2({
                    allowClear: true
                }).on('select2-open', function ()
                {
                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#auto-complete" + next).select({
                    id: "auto-complete" + next,
                    method_name: "item-partner",
                });
                e.preventDefault();
            }
        });
    });
    $(document).on('keyup', '.glddtl-debit_amount', function () {
        calculateSubtotal();
    });
    $(document).on('keyup', '.glddtl-credit_amount', function () {
        calculateSubtotal();
    });
//    $(document).on('blur', '#invoice_dates', function () {
//        loadajax();
//    });
    $(document).on('change', '#invoice_dates', function () {
        loadajax();
    });
    $(document).on('change', '#gldmst-voucher_type_id', function () {
        loadajax();
    });

    $(document).on('click', '.new-link-box', function (e) {
        var current_row_id = $(this).attr('row_id');
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: {row_id: current_row_id},
            url: homeUrl + 'stock-ajax/add-partner',
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
        var current_row_id = $('.current_row_id').attr('row_id');
        if (validatePartner() == 0) {
            var str = $(this).serialize();
            $.ajax({
                url: homeUrl + 'stock-ajax/update-partner',
                type: "POST",
                data: str,
                success: function (data) {
                    var res = $.parseJSON(data);
                    $(".partner_name").text(res.result['partner-name']);
                    $(".selected-data-name").attr("data_val", res.result['partner-id']);
                    $('#business-partner-items-' + current_row_id).val(res.result['partner-name']);
                    $('#salesreturninvoicedetails-busines_partner_code-' + current_row_id).val(res.result['partner-id']);
                    $("#salesreturninvoicedetails-busines_partner_code").val(res.result['partner-id']);
                    $('#modal-6').modal('hide');
                }
            });
            return false;
        } else {
            e.preventDefault();
        }
    });

    $(document).on('change', '#paymentmst-bp_code', function (e) {
        loadpayment();
    });

    $(document).on('change', '#checkbox-payall', function (e) {
        var first_row = $('#bill-receipt > tbody > tr:first').attr('id');
        var last_row = $('#bill-receipt > tbody > tr:last').attr('id');
        var num = 0;
        if ($(this).is(":checked")) {
            for (i = first_row; i <= last_row; i++) {
                var row_balance = $('#balance_' + i).text();
                $('#payed_amount-' + i).val(row_balance);
            }
        } else {
            for (i = first_row; i <= last_row; i++) {
                $('#payed_amount-' + i).val(num.toFixed(2));
            }
        }
        calculateTotal();
    });
    $(document).on('blur', '#paymentmst-amount', function (e) {
        $('.payed_amount').val('');
        $('.amount_paid_total').val('');
        $('#checkbox-payall').attr('checked', false);
    });
    $(document).on('keyup', '.payed_amount', function (e) {
        $('#checkbox-payall').attr('checked', false);
        calculateTotal();
    });
    $(document).on('keyup', '#paymentmst-tds_amount', function (e) {
        calculateNetTotal();
    });
    $(document).on('keyup', '#paymentmst-bank_charges', function (e) {
        calculateNetTotal();
    });
});
function loadpayment() {
    var idd = $('#paymentmst-bp_code').val();
    var journal_type = $('#journal-type').val();
    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {id: idd, type: journal_type},
        url: homeUrl + 'stock-ajax/select-payments',
        success: function (data) {
            $(".add-receipt-details").html(data);
            $('#paymentmst-due_amount').val($('.due_amount_total').val());
        }
    });
}
function calculateTotal() {
    var first_row = $('#bill-receipt > tbody > tr:first').attr('id');
    var last_row = $('#bill-receipt > tbody > tr:last').attr('id');
    var amount_paid_total = 0;
    for (i = first_row; i <= last_row; i++) {

        var paid = parseFloat($('#payed_amount-' + i).val());
        if (!paid) {
            paid = 0;
        }
        amount_paid_total += paid;
    }
    $('.amount_paid_total').val(addZeroes(amount_paid_total));
    $('#paymentmst-amount').val(addZeroes(amount_paid_total));
    var due_amount_tot = $('.due_amount_total').val();
    if (!due_amount_tot) {
        due_amount_tot = 0;
    }
    var balance = parseFloat(due_amount_tot) - parseFloat(amount_paid_total);
    $('#paymentmst-due_amount').val(addZeroes(balance));
    calculateNetTotal();
}
function calculateNetTotal() {
    var amount = parseFloat($('#paymentmst-amount').val());
    var tds_amount = parseFloat($('#paymentmst-tds_amount').val());
    var bank_charge = parseFloat($('#paymentmst-bank_charges').val());
    var journal_type = $('#journal-type').val();
    if (!amount) {
        amount = 0;
    }
    if (!tds_amount) {
        tds_amount = 0;
    }
    if (!bank_charge) {
        bank_charge = 0;
    }
    var net_amount = amount + tds_amount;
    if (journal_type == 0) {
        var total_amount = amount - bank_charge;
    } else {
        var total_amount = amount + bank_charge;
    }
    $('#paymentmst-net_amount').val(net_amount.toFixed(2));
    $('#paymentmst-total_amount').val(total_amount.toFixed(2));
}

function addZeroes(num) {
    var num = Number(num);
    if (String(num).split(".").length < 2 || String(num).split(".")[1].length <= 2) {
        num = num.toFixed(2);
    }
    return num;
}

function loadajax() {
    var stock_date = $('#invoice_dates').val();
    var voucher_type = $('#gldmst-voucher_type_id').val();
    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {stock_date: stock_date, voucher_type: voucher_type},
        url: homeUrl + 'stock-ajax/generate-document-no',
        success: function (data) {
            var res = $.parseJSON(data);
//            console.log(res);
            $('#paymentmst-document_no').val(res.result['document-no']);
            $('#gldmst-document_no').val(res.result['document-no']);
            $('#gldmst-financial_year_id').val(res.result['financial-year-id']);
            $('#gldmst-financial_year').val(res.result['financial-year']);
        }
    });
    $('#paid_through').select2({
        allowClear: true
    }).on('select2-open', function ()
    {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
}
function openingBalanceChange(current_row_id, next_row_id, partner_id, account_type) {
    var next = parseInt(next_row_id) + 1;
    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {partner_id: partner_id, next_row_id: next_row_id, account_type: account_type},
        url: homeUrl + 'stock-ajax/get-accounts',
        success: function (data) {
            var res = $.parseJSON(data);
            console.log(res);
            if ($('#business-partner-items-' + current_row_id).hasClass('add-next')) {
                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                $("#next_item_id").val(next);
                $('#business-partner-items-' + current_row_id).removeClass("add-next");
                $('#glddtl-account_id-' + next).select2({
                    allowClear: true
                }).on('select2-open', function ()
                {
                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
            }
            calculateSubtotal();
        }
    });
    return true;
}
function calculateSubtotal() {
    var row_count = $('#next_item_id').val();
    var debit_sub_total = 0;
    var credit_sub_total = 0;
    for (i = 1; i <= row_count; i++) {
        var debit_amount = $('#glddtl-debit_amount-' + i).val();
        var credit_amount = $('#glddtl-credit_amount-' + i).val();
        if (!debit_amount && debit_amount == '' || debit_amount == null) {
            debit_amount = 0;
        }
        if (!credit_amount && credit_amount == '' || credit_amount == null) {
            credit_amount = 0;
        }
        debit_sub_total = parseFloat(debit_sub_total) + parseFloat(debit_amount);
        credit_sub_total = parseFloat(credit_sub_total) + parseFloat(credit_amount);
    }
    $('#debit_sub_total').val(debit_sub_total.toFixed(2));
    $('#credit_sub_total').val(credit_sub_total.toFixed(2));
    $('#debit_sub_totals').text(debit_sub_total.toFixed(2));
    $('#credit_sub_totals').text(credit_sub_total.toFixed(2));
}

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

function paymentVoucherChange(current_row_id, next_row_id, partner_id) {
    var next = parseInt(next_row_id) + 1;
    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {partner_id: partner_id, next_row_id: next_row_id},
        url: homeUrl + 'stock-ajax/get-chartof-account',
        success: function (data) {
            var res = $.parseJSON(data);
            console.log(res);
            if ($('#business-partner-items-' + current_row_id).hasClass('add-next')) {
                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                $("#next_item_id").val(next);
                $('#business-partner-items-' + current_row_id).removeClass("add-next");
                $('#glddtl-account_id-' + next).select2({
                    allowClear: true
                }).on('select2-open', function ()
                {
                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
            }
            calculateSubtotal();
        }
    });
    return true;
}