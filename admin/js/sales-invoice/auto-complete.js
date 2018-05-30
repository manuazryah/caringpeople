$.fn.select = function (options) {

        var mainId = "#" + options.id;
//    var listSelect = options.id + "-selected";
        var listSelect = 'autocomplete-item-selected';
//    var method_name = options.id + "-get-data";
        var method_name = options.method_name;
        return this.each(function () {
                /* alert('hi');
                 var $testElem = $(this);
                 var $testP = $testElem.find(".auto-search");
                 $testP.click(function () {
                 var $someP = $(this);
                 alert('hi');

                 });*/
                $(document).on('click keyup', mainId + ' .search-drop', function (e) {
//        $(mainId + ' .search-drop').click(function () {
                        if (e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) {

                                if ($(mainId).hasClass('active')) {
                                        $(mainId).removeClass("active");
                                        $(mainId + ' .serch-text').val('');
                                } else {
                                        if ($(mainId).find(".on").length > 0) {
                                                ///do something
                                        } else {

                                        }
                                        $.ajax({

                                                type: "POST",
                                                url: homeUrl + 'sales/sales-ajax/' + method_name,
                                                data: 'keyword=' + $(this).val(),
                                                success: function (data) {
                                                        $(mainId).addClass("active");
                                                        $(mainId + ' .search-resut-list').addClass("active-data");
                                                        $(mainId + ' .search-resut-list').html(data);
                                                        $(mainId + ' .serch-text').focus();
                                                        $(mainId + ' .search-resut-list li:first').addClass(listSelect);
                                                }
                                        });
                                }
                        }
                });

                $.extend($.expr[":"], {
                        "containsIN": function (elem, i, match, array) {
                                return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                        }
                });

                $(document).on('keyup', mainId + ' .serch-text', function () {
                        var search_val = $(this).val();
                        $(mainId + ' .search-resut-list li').removeClass('hide-list');
                        $(mainId + ' .search-resut-list li:not(:containsIN(' + search_val + '))').addClass('hide-list');


                        $(mainId + " .search-resut-list li:containsIN('" + search_val + "')").each(function () {
                                var regex = new RegExp(search_val, 'gi');
                                $(this).html($(this).text().replace(regex, "<span style='background-color: yellow;'>" + search_val + "</span>"));
                        });
                });

                $(document).on('keyup', mainId + ' .salesinvoicedetails-items', function () {
                        var search_val = $(this).val();
                        $(mainId + ' .search-resut-list li').removeClass('hide-list');
                        $(mainId + ' .search-resut-list li:not(:containsIN(' + search_val + '))').addClass('hide-list');


                        $(mainId + " .search-resut-list li:containsIN('" + search_val + "')").each(function () {
                                var regex = new RegExp(search_val, 'gi');
                                $(this).html($(this).text().replace(regex, "<span style='background-color: yellow;'>" + search_val + "</span>"));
                        });
                });

                var $activeUl = $(mainId + ' .search-resut-list:first'); // For keyboard arrows
                $(document).on('mouseenter', mainId + ' .search-resut-list > li', function () {
                        $(this).addClass(listSelect).siblings().removeClass(listSelect);
                        $activeUl = $(this).parent();
                });

                $(document).keydown(function (e) {

                        if ($(mainId).hasClass('active')) {
                                var direction, siblingsSelector;
                                if (e.which == 38) { // up
                                        direction = 'prev';
                                        siblingsSelector = ':not(:first-child)';
                                        $.fn.select.keyAction(direction, siblingsSelector, listSelect, mainId);
                                } else if (e.which == 40) { // down
                                        direction = 'next';
                                        siblingsSelector = ':not(:last-child)';
                                        $.fn.select.keyAction(direction, siblingsSelector, listSelect, mainId);
                                } else if (e.which == 13) {
                                        e.preventDefault();
                                        if ($('.selected').hasClass('hide-list')) {

                                        } else {
                                                $.fn.select.selectDataValue($(mainId + " ." + listSelect).attr("data-value"), $(mainId + " ." + listSelect).attr("data-id"), mainId);
                                        }

                                } else if (e.which == 27) {
                                        $(mainId).removeClass("active");
                                }
                        }

                });

                $(document).on('click', mainId + ' .search-resut-list > li', function () {
                        $.fn.select.selectDataValue($(this).attr("data-value"), $(this).attr("data-id"), mainId);
                });


                $(document).on("click", function ()
                {
                        $(mainId).removeClass("active");
                        $(mainId + ' .serch-text').val('');
                });
                $(mainId + ' .serch-text').click(function (event) {
                        event.stopPropagation();
                });

        });
};

$.fn.select.selectDataValue = function (val, id, mainId) {
        $(mainId + " .selected-data-name").attr("data_val", id);
        $(mainId + " .hideen-value").val(id);
        $(mainId + " .selected-data-name").val(val);
        $(mainId + " .selected-data-name").text(val);
        $(mainId).removeClass("active");
};

$.fn.select.keyAction = function (direction, siblingsSelector, listSelect, mainId) {
        if ($('.search-resut-list li').hasClass(listSelect)) {

                $activeUl = $(mainId + " ." + listSelect).parent();
        } else {

                var $activeUl = $(mainId + ' .search-resut-list:first');
        }

        $activeUl.find('.' + listSelect)[direction]().addClass(listSelect)
                .siblings(siblingsSelector).removeClass(listSelect);

        selectedli($activeUl, direction, siblingsSelector, listSelect, mainId);

        var TopPosition = 35;
        var index = $(mainId + " .search-resut-list li").index($(mainId + " .search-resut-list ." + listSelect));

        $(mainId + " .search-resut-list").animate({scrollTop: TopPosition * index}, 50);
};


function selectedli($activeUl, direction, siblingsSelector, listSelect, mainId) {
        if ($activeUl.find(mainId + ' .' + listSelect)[direction]().hasClass('hide-list')) {
                $activeUl.find(mainId + ' .' + listSelect)[direction]().addClass(listSelect)
                        .siblings(siblingsSelector).removeClass(listSelect);
                selectedli($(mainId + " ." + listSelect).parent(), direction, siblingsSelector);
        } else {
                return true;
        }
}

