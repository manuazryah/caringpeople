/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $.extend($.expr[":"], {
        "containsIN": function (elem, i, match, array) {
            return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });


    $(document).on('keyup', '#serch-text', function () {
        var search_val = $(this).val();
        $('#search-resut-list li').removeClass('hide-list');
        $('#search-resut-list li:not(:containsIN(' + search_val + '))').addClass('hide-list');


        $("#search-resut-list li:containsIN('" + search_val + "')").each(function () {
            var regex = new RegExp(search_val, 'gi');
            $(this).html($(this).text().replace(regex, "<span style='background-color: yellow;'>" + search_val + "</span>"));
        });
    });


    $(document).on('click', '.search-drop', function () {
        if ($('#auto-complete').hasClass('active')) {
            $("#auto-complete").removeClass("active");
            $('#serch-text').val('');
        } else {
            $.ajax({

                type: "POST",
                url: homeUrl + 'sales/sales-ajax/item-partner',
                data: 'keyword=' + $(this).val(),
                success: function (data) {
                    $("#auto-complete").addClass("active");
                    $("#search-resut-list").html(data);
                    $('#serch-text').focus();
                    $('#search-resut-list li:first').addClass('selected');
                }
            });
        }
    });


    var $activeUl = $('#search-resut-list:first'); // For keyboard arrows
    $(document).on('mouseenter', '#search-resut-list > li', function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        $activeUl = $(this).parent();
    });


    $(document).keydown(function (e) {
        if ($('#auto-complete').hasClass('active')) {
            var direction, siblingsSelector;
            if (e.which == 38) { // up
                direction = 'prev';
                siblingsSelector = ':not(:first-child)';
                keyAction(direction, siblingsSelector);
            } else if (e.which == 40) { // down
                direction = 'next';
                siblingsSelector = ':not(:last-child)';
                keyAction(direction, siblingsSelector);
            } else if (e.which == 13) {
                e.preventDefault();
                if ($('.selected').hasClass('hide-list')) {

                } else {
                    selectPartner($(".selected").attr("data-value"), $(".selected").attr("data-id"));
                }

            } else if (e.which == 27) {
                $("#auto-complete").removeClass("active");
            }
        }

    });



    $(document).on('click', '#search-resut-list > li', function () {
        selectPartner($(this).attr("data-value"), $(this).attr("data-id"));
    });


    $(document).on("click", function ()
    {
        $("#auto-complete").removeClass("active");
        $('#serch-text').val('');
    });
    $('#serch-text').click(function (event) {
        event.stopPropagation();
    });

}
);

function keyAction(direction, siblingsSelector) {

    if ($('#search-resut-list > li').hasClass('selected')) {
        $activeUl = $(".selected").parent();
    } else {
        var $activeUl = $('#search-resut-list:first');
    }
    selectedli($activeUl, direction, siblingsSelector);


    $activeUl.find('.selected')[direction]().addClass('selected')
            .siblings(siblingsSelector).removeClass('selected');
    var contactTopPosition = $(".selected").position().top;
    $("#search-resut-list").animate({scrollTop: contactTopPosition});
}


function selectedli($activeUl, direction, siblingsSelector) {
    if ($activeUl.find('.selected')[direction]().hasClass('hide-list')) {
        $activeUl.find('.selected')[direction]().addClass('selected')
                .siblings(siblingsSelector).removeClass('selected');
        selectedli($(".selected").parent(), direction, siblingsSelector);
    } else {
        return;
    }
}

//To select Partner name
function selectPartner(val, id) {
    $("#partner_name").text(val);
    $("#salesinvoicedetails-busines_partner_code").val(id);
    $("#auto-complete").removeClass("active");
}

