/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {


        /*
         * Purpose   :- On change of country dropdown
         * parameter :- country_id
         * return   :- The list of states depends on the country_id
         */

        $('.country-change').change(function () {

                var country_id = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {country_id: country_id},
                        url: homeUrl + 'ajax/state',
                        success: function (data) {

                                if (data == 0) {
                                        alert('Failed to Load data, please try again error:1001');
                                } else {
                                        $(".state-change").html(data);
                                }
                                hideLoader();
                        }
                });
        });

        /*
         * Purpose   :- On change of state dropdown
         * parameter :- state_id
         * return   :- The list of district depends on the state_id
         */

        $('.state-change').change(function () {
                if ($(this).hasClass('no-city')) {

                } else {
                        var state_id = $(this).val();
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {state_id: state_id},
                                url: homeUrl + 'ajax/city',
                                success: function (data) {
                                        if (data == 0) {
                                                alert('Failed to Load data, please try again error:1002');
                                        } else {
                                                $(".city-change").html(data);
                                        }
                                        hideLoader();
                                }
                        });
                }
        });




        /*
         * Purpose   :- On change of religion dropdown
         * parameter :- religion
         * return   :- The list of caste depends on the religion
         */

        $('.religion-change').change(function () {
                var religion = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {religion: religion},
                        url: homeUrl + 'ajax/religion',
                        success: function (data) {

                                if (data == 0) {
                                        alert('Failed to Load data, please try again error:1001');
                                } else {
                                        $(".caste-change").html(data);
                                }
                                hideLoader();
                        }
                });
        });



        /*
         * Purpose   :- On change of email field in enquiry form(email duplication check)
         * parameter :- email
         * return   :- if email exists.then show the error message.
         */


        $('#enquiry-email').change(function () {
                var email = $(this).val();
                if (email != '') {

                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {email: email},
                                url: homeUrl + 'ajax/email',
                                success: function (data) {
                                        if (data == 0) {
                                                $('#email_check').hide();
                                        } else if (data == 1) {
                                                $('#email_check').show();
                                                $("#email_check a").attr("href", homeUrl + 'enquiry/enquiry/index?email=' + email);

                                        } else {
                                                $('#email_check').show();
                                                $("#email_check a").attr("href", homeUrl + 'view-enquiry/' + data);
                                        }

                                }
                        });
                } else {
                        $('#email_check').hide();
                }

        });
        /*
         * On attendance entry user ca enter numbers only
         */
        $('.number_only').keypress(function () {
                return event.charCode >= 48 && event.charCode <= 57;
        });

        /*
         * Purpose   :- On change of contact category dropdown
         * parameter :- category
         * return   :- The list of contactsubcategory depends on the category
         */

        $('.contact_category_change').change(function () {

                var category = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {category: category},
                        url: homeUrl + 'ajax/contactcategory',
                        success: function (data) {

                                if (data == 0) {
                                        alert('Failed to Load data, please try again error:1001');
                                } else {
                                        $(".subcategory-change").html(data);
                                }
                                hideLoader();
                        }
                });
        });



       



});
