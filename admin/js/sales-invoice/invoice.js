/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var globalJsonVar;

$(document).ready(function () {

        $(document).on('keydown', '.salesinvoicedetails-qty,.salesinvoicedetails-rate,.salesinvoicedetails-discount,.salesinvoicedetails-line_total,.salesinvoicedetails-item_comment,#round_of,#cash_amount,#card_amount,#payed_amount,#balance,#due-date,#salesinvoicemaster-reference,#invoice_dates,#salesinvoicemaster-sales_invoice_number,#salesinvoicemaster-salesman,#salesreturninvoicemaster-sales_invoice_number,#salesreturninvoicemaster-reference,#qty_total,#discount_sub_total,#tax_sub_total,#order_sub_total,#purchaseinvoicemaster-salesman,#purchaseinvoicemaster-reference', function (event) {
                if (event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                }
        });
        $(document).on('keydown', '.selected-data-name', function (event) {
                if (event.keyCode == 13) {
                        if ($(this).closest(".auto-complete-item").hasClass('active')) {

                        } else {
                                event.preventDefault();
                                return false;
                        }

                }
        });
        //$(document).on('.salesinvoicedetails-items', function (e) {
        $(document).on('keydown.autocomplete', '.salesinvoicedetails-items', function (e) {

//    $(".salesinvoicedetails-items").autocomplete({
                $(this).autocomplete({
                        source: function (request, response) {
                                $.ajax({
                                        type: 'POST',
                                        cache: false,
                                        data: {item: request.term},
                                        url: homeUrl + 'sales/sales-ajax/item-names',
//                url: '<?= Yii::$app->homeUrl; ?>sales/sales-invoice-details/item-names',
                                        success: function (data) {
                                                var obj = jQuery.parseJSON(data);
                                                response(obj);
                                        }
                                });
                        },
                        select: function (e, ui) {
                                e.preventDefault() // <--- Prevent the value from being inserted.
                                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                                $("#salesinvoicedetails-item-code-" + current_row_id).val(ui.item.value);
                                $(this).val(ui.item.label);
                        },
                        minLength: 1
                });
        });
        /*
         * on chnage of the itemcode
         * parameter item_id
         * return base unit and tax depends on the item
         */

        // $(document).on('DOMSubtreeModified', '.salesinvoicedetails-items', function (e) {
        $(document).on('change', '.salesinvoicedetails-items', function (e) {
                if ($(this).text() != '') {
                        var flag = 0;
                        var count = 0;
                        var bill_type = $('#bill_type').val();
                        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                        var next_row_id = $('#next_item_id').val();
                        var item_id = $(this).val();
                        var next = parseInt(next_row_id) + 1;
                        if (bill_type == 1 || bill_type == 4) {
                                var method_name = 'get-autocomplte-itemss';
                                var row_count = $('#next_item_id').val();
                                if (row_count > 1) {
                                        for (i = 1; i <= row_count; i++) {
                                                var item_val = $('#salesinvoicedetails-items-' + i).val();

                                                if (item_val == item_id) {
                                                        count = count + 1;
                                                }
                                        }
                                        if (count > 1) {
                                                flag = 1;
                                        } else {
                                                flag = 0;
                                        }
                                }
                        } else {
                                var method_name = 'get-autocomplte-items';
                        }
                        if (flag == 0) {
                                if (itemChange(item_id, current_row_id, next_row_id)) {
                                        $("#auto-complete" + next).select({
                                                id: "auto-complete" + next,
                                                method_name: method_name,
                                        });
                                }
                        } else {
                                alert('This Item is already Choosed');
                                $('#salesinvoicedetails-items-' + current_row_id).attr('data_val', '');
//                                $('#salesinvoicedetails-items-' + current_row_id).text('');
                                $('#salesinvoicedetails-items-' + current_row_id).val('');
                                $('#salesinvoicedetails-item-code-' + current_row_id).val('');
                                e.preventDefault();
                        }


                }
        });
        /*
         * on keyup of the quantity
         * @parameter quantity,UOM
         * @return total amount
         */

        $(document).on('keyup mouseup', '.salesinvoicedetails-qty', function () {
//    $('.salesinvoicedetails-qty').keyup(function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                var bill_type = $('#bill_type').val();
                if (qty != "" && rate != "") {
                        if (bill_type == 1 || bill_type == 4) {
                                var data = $('#sales-qty-count-' + current_row_id).val();
                                if (parseInt(qty) > parseInt(data)) {
                                        $('#salesinvoicedetails-qty-' + current_row_id).val(data);
                                        alert(' Quantity exeeds the Available Stock.');
                                }
                        }
                        lineTotalAmount(current_row_id);
                }
        });
        /*
         * on keyup of the quantity
         * @parameter quantity,rate
         * @return total amount
         */
        $(document).on('keyup', '.salesinvoicedetails-discount_percentage', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                var tax_type = $('#tax-type-' + current_row_id).val();
                var tax = $('#salesinvoicedetails-tax_percentage-' + current_row_id).val();
                var percentage = $('#salesinvoicedetails-discount_percentage-' + current_row_id).val();
                if (qty != "" && rate != "") {
                        var amount = qty * rate;
                        var discount_amount = (amount * percentage) / 100;
                        $('#salesinvoicedetails-discount_amount-' + current_row_id).val(discount_amount);
                        lineTotalAmount(current_row_id);
                }

        });
        $(document).on('keyup', '.salesinvoicedetails-discount', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                if (qty != "" && rate != "") {
                        lineTotalAmount(current_row_id);
                }

        });
        $(document).on('change', '.salesinvoicedetails-discount-type', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                if (qty != "" && rate != "") {
                        lineTotalAmount(current_row_id);
                }

        });
        /*
         * on keyup of the quantity
         * @parameter quantity,rate
         * @return total amount
         */
        $(document).on('keyup', '.salesinvoicedetails-discount_amount', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                if (qty != "" && rate != "" && item != "") {
                        lineTotalAmount(current_row_id);
                }

        });
        /*
         * on keyup of the rate
         * @parameter quantity,rate
         * @return total amount
         */
        $(document).on('keyup mouseup', '.salesinvoicedetails-rate', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                if (qty != "" && item != "") {
                        lineTotalAmount(current_row_id);
                }

        });
        $(document).on('keyup', '#cash_amount', function () {
                balanceCalculation();
        });
        $(document).on('keyup', '#card_amount', function () {
                balanceCalculation();
        });
        $(document).on('keyup', '#round_of', function () {
                balanceCalculation();
        });
        $('#add-invoicee').on('click', '#del', function () {
                var bid = this.id; // button ID
                var trid = $(this).closest('tr').attr('id'); // table row ID
                $(this).closest('tr').remove();
                calculateSubtotal();
        });
        $(document).on('change', '.salesinvoicedetails-tax', function () {
                var current_row_id = $(this).attr('id').match(/\d+/); // 123456
                var tax_idd = $('#salesinvoicedetails-tax-' + current_row_id).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: {tax_id: tax_idd},
                        url: homeUrl + 'sales/sales-ajax/tax-details',
                        success: function (data) {
                                var res = $.parseJSON(data);
                                console.log(res);
                                $('#salesinvoicedetails-tax-type-' + current_row_id).val(res.result['tax-type']);
                                $('#salesinvoicedetails-tax-value-' + current_row_id).val(res.result['tax-value']);
                                var iddd = '#salesinvoicedetails-tax-' + current_row_id;
                                $("" + iddd + " option[value='" + res.result['tax_id'] + "']").prop('selected', true);
                                var item = $('#salesinvoicedetails-item-code-' + current_row_id).val();
                                var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
                                var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
                                if (qty != "" && rate != "" && item != "") {
                                        lineTotalAmount(current_row_id);
                                }
                        }
                });
        });
        /*
         * on click of the Add another line
         * return new line at the end of table
         */

        $(document).on('click', '#add_another_line', function (e) {
                var rowCount = $('#add-invoicee >tbody >tr').length;
                var next_row_id = $('#next_item_id').val();
                var next = parseInt(next_row_id) + 1;
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: {next_row_id: next_row_id},
                        url: homeUrl + 'sales/sales-ajax/add-another-row',
                        success: function (data) {
                                var res = $.parseJSON(data);
                                console.log(res);
//                if ($('#salesinvoicedetails-items-' + current_row_id).hasClass('add-next')) {
                                $('#add-invoicee tr:last').after(res.result['next_row_html']);
                                $("#next_item_id").val(next);
                                $('.salesinvoicedetails-qty').attr('type', 'number');
                                $('.salesinvoicedetails-qty').attr('min', 1);
                                $('#salesinvoicedetails-items-' + rowCount).removeClass("add-next");
                                $('#salesinvoicedetails-items-' + next).select2({
                                        allowClear: true
                                }).on('select2-open', function ()
                                {
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                });
                                $("#auto-complete" + next).select({
                                        id: "auto-complete" + next,
                                        method_name: "get-autocomplte-items",
                                });
                                e.preventDefault();
//                }
                        }
                });
        });
//    $(document).on('blur', '#sales_item_code', function () {
//        var item_codee = $(this).val();
//        $.ajax({
//            type: 'POST',
//            cache: false,
//            data: {item_code: item_codee},
//            url: homeUrl + 'sales/sales-ajax/sku',
//            success: function (data) {
//                alert(data);
//                if (data == 0) {
//                    if ($("#sales_item_code").parent().next(".validation").length == 0) // only add if not added
//                    {
//                        $("#sales_item_code").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This Code is Already Used</div>");
//                    }
//                    $('#sales_item_code').focus();
//                }
//            }
//        });
//    });
});
//To select Partner name
function selectPartner(val) {
        $("#salesinvoicedetails-busines_partner_code").val(val);
        $("#suggesstion-box").hide();
}

function balanceCalculation() {
        var order_amount = $('#order_sub_total').val();
        if (order_amount && order_amount != "") {
                var cash_amount = $('#cash_amount').val();
                var card_amount = $('#card_amount').val();
                var round_of_amount = $('#round_of').val();
                if (!cash_amount && cash_amount == '') {
                        cash_amount = 0;
                }
                if (!card_amount && card_amount == '') {
                        card_amount = 0;
                }
                if (!round_of_amount && round_of_amount == '') {
                        round_of_amount = 0;
                }
                var order_balance = order_amount - (parseFloat(cash_amount) + parseFloat(card_amount) + parseFloat(round_of_amount));
                var paid_amount = parseFloat(cash_amount) + parseFloat(card_amount);
                $('#payed_amount').val(paid_amount.toFixed(2));
                $('#balance').val(order_balance.toFixed(2));
        }
}

function itemChange(item_id, current_row_id, next_row_id) {
        var next = parseInt(next_row_id) + 1;
        var bill_type = $('#bill_type').val();
        $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {item_id: item_id, next_row_id: next_row_id, bill_type: bill_type},
                url: homeUrl + 'sales/sales-ajax/item-details',
                success: function (data) {
                        if (data != 1) {

                                var res = $.parseJSON(data);
                                console.log(res);
                                $('#salesinvoicedetails-item-comment-' + current_row_id).css('display', 'block');
                                $('#sales-uom-' + current_row_id).val(res.result['UOM']);
                                $('#sale-uom-' + current_row_id).text(res.result['UOM']);
                                $('#salesinvoicedetails-tax-value-' + current_row_id).val(res.result['tax-amount']);
                                $('#salesinvoicedetails-tax-type-' + current_row_id).val(res.result['tax_type']);
                                $('#salesinvoicedetails-qty-' + current_row_id).val(1);
                                if (bill_type == 1 || bill_type == 4) {
                                        if (res.result['item-type'] == 0) {
                                                $('#sales-qty-count-' + current_row_id).val(res.result['existing_stock']);
                                                $('#stock-check-' + current_row_id).css('display', 'block');
                                                $("#stock-check-" + current_row_id + " span").text(res.result['existing_stock']);
                                        }
                                }
                                $("#salesinvoicedetails-rate-" + current_row_id).val(res.result['item_rate']);
                                var iddd = '#salesinvoicedetails-tax-' + current_row_id;
                                $("" + iddd + " option[value='" + res.result['tax_id'] + "']").prop('selected', true);
                                if ($('#salesinvoicedetails-qty-' + current_row_id).val() != "" && $("#salesinvoicedetails-rate-" + current_row_id).val() != "") {
                                        lineTotalAmount(current_row_id);
                                }
                                if ($('#salesinvoicedetails-items-' + current_row_id).hasClass('add-next')) {
                                        $('#add-invoicee tr:last').after(res.result['next_row_html']);
                                        $("#next_item_id").val(next);
                                        $('.salesinvoicedetails-qty').attr('type', 'number');
                                        $('.salesinvoicedetails-qty').attr('min', 1);
                                        $('#salesinvoicedetails-items-' + current_row_id).removeClass("add-next");
                                        $('#salesinvoicedetails-items-' + next).select2({
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                }
                        } else {
                                $('#salesinvoicedetails-items-' + current_row_id).attr('data_val', '');
                                $('#salesinvoicedetails-items-' + current_row_id).text('');
                                $('#salesinvoicedetails-items-' + current_row_id).val('');
                                $('#salesinvoicedetails-item-code-' + current_row_id).val('');
                                $('#salesinvoicedetails-item-comment-' + current_row_id).css('display', 'none');
                                $('#stock-check-' + current_row_id).css('display', 'none');
                                $('#stock-exist-' + current_row_id).css('display', 'none');
                                $('#sales-uom-' + current_row_id).val('');
                                $('#sale-uom-' + current_row_id).text('');
                                $('#salesinvoicedetails-tax-value-' + current_row_id).val('');
                                $('#salesinvoicedetails-tax-type-' + current_row_id).val('');
                                $('#salesinvoicedetails-qty-' + current_row_id).val('');
                                $('#sales-qty-count-' + current_row_id).val('');
                                $("#salesinvoicedetails-rate-" + current_row_id).val('');
                                $("#salesinvoicedetails-tax-" + current_row_id).val('');
                                $("#salesinvoicedetails-line_total-" + current_row_id).val('');
                                calculateSubtotal();
                                alert('No Stock Available for this item');
                        }

                }
        });
        return true;
}


function Rate(base_unit, current_row_id) {

        $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {base_unit: base_unit},
                url: homeUrl + 'sales/sales-ajax/rate',
                success: function (data) {
                        $("#salesinvoicedetails-rate-" + current_row_id).val(data);
                }
        });
}

function lineTotalAmount(current_row_id) {
        var tax_amount = 0;
        var discount_amount = 0;
        var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
        var tax_type = $('#salesinvoicedetails-tax-type-' + current_row_id).val();
        var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
        var tax = $('#salesinvoicedetails-tax-value-' + current_row_id).val();
        var discount = $('#salesinvoicedetails-discount-' + current_row_id).val();
        var discount_type = $('#salesinvoicedetails-discount-type-' + current_row_id).val();

        var amount = qty * rate;
        if (discount != "") {

                if (discount_type == 0) {
                        var discount_amount = discount;
                } else {
                        var discount_amount = (amount * discount) / 100;
                }
        }
        if (qty != "" && rate != "") {
                if (tax_type == 1) {
                        var tax_amount = tax;
                } else {
                        var total = (qty * rate) - discount_amount;
                        var tax_amount = (total * tax) / 100;
                }

        }

        var grand_total = (parseFloat(amount) + parseFloat(tax_amount)) - parseFloat(discount_amount);
        $('#salesinvoicedetails-line_total-' + current_row_id).val(grand_total.toFixed(2));
        calculateSubtotal();
}
function calculateSubtotal() {

        var row_count = $('#next_item_id').val();
        var sub_total = 0;
        var tax_sub_total = 0;
        var order_sub_total = 0;
        var discount_sub_total = 0;
        var rate_sub_total = 0;
        var qty_total = 0;
        var discount_amount = 0;
        for (i = 1; i <= row_count; i++) {
                var qty = $('#salesinvoicedetails-qty-' + i).val();
                var tax_type = $('#salesinvoicedetails-tax-type-' + i).val();
                var rate = $('#salesinvoicedetails-rate-' + i).val();
                var discount = $('#salesinvoicedetails-discount-' + i).val();
                var discount_type = $('#salesinvoicedetails-discount-type-' + i).val();

                var amount = qty * rate;
                if (discount != "") {
                        if (discount_type == 0) {
                                var discount_amount = discount;
                        } else {
                                var discount_amount = (amount * discount) / 100;
                        }
                }
                var tax = $('#salesinvoicedetails-tax-value-' + i).val();
                if (qty && qty != "" && rate && rate != "") {

                        if (tax_type == 1) {
                                var tax_amount = tax;
                                var total = amount - discount_amount;
                        } else {
                                var total = amount - discount_amount;
                                var tax_amount = (total * tax) / 100;
                        }

                        var grand_total = (parseFloat(amount)) + parseFloat(tax_amount) - parseFloat(discount_amount);
                        $('#salesinvoicedetails-line_total-' + i).val(grand_total.toFixed(2));
                        qty_total = parseFloat(qty_total) + parseFloat(qty);
                        sub_total = parseFloat(sub_total) + parseFloat(total);
                        rate_sub_total = parseFloat(rate_sub_total) + parseFloat(amount);
                        tax_sub_total = parseFloat(tax_sub_total) + parseFloat(tax_amount);
                        order_sub_total = parseFloat(order_sub_total) + parseFloat(grand_total);
                        discount_sub_total = parseFloat(discount_sub_total) + parseFloat(discount_amount);
                }

        }
        $('#sub_total').val(rate_sub_total.toFixed(2));
        $('#qty_total').val(qty_total.toFixed(2));
        $('#amount_without_tax').val(sub_total.toFixed(2));
        $('#tax_sub_total').val(tax_sub_total.toFixed(2));
        $('#discount_sub_total').val(discount_sub_total.toFixed(2));
        $('#order_sub_total').val(order_sub_total.toFixed(2));
        $('#salesinvoicemaster-amount').val(sub_total.toFixed(2));
        $('#salesreturninvoicemaster-amount').val(sub_total.toFixed(2));
        $('#purchaseinvoicemaster-amount').val(sub_total.toFixed(2));
        $('#total-order-amount').text(order_sub_total.toFixed(2));
        $('#cash_amount').val(order_sub_total.toFixed(2));
        balanceCalculation();
}
function addZeroes(num) {
        var num = Number(num);
        if (String(num).split(".").length < 2 || String(num).split(".")[1].length <= 2) {
                num = num.toFixed(2);
        }
        return num;
}

//function loadajax() {
//    $.ajax({
//        type: 'POST',
//        cache: false,
//        async: false,
//        data: {},
//        url: homeUrl + 'sales/sales-ajax/get-stock',
//        success: function (data) {
//            globalJsonVar = data;
//        }
//    });
//}

