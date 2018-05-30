/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

        if ($(window).width() < 900) {
                $("#side-menuss").removeClass("collapsed");
        } else {

                //   $("#side-menuss").addClass('collapsed');
        }


        /*
         -----------------PATIENT ENQUIRY GENERAL INFO FORM--------------
         */
        $('#referral_source_others').hide();
        $('#whatsapp_number').hide();
        $('#whatsapp_note').hide();
        $('#required_other_service').hide();
        $('#service_required').hide();



        /*
         *Change the label of incoming and missed field
         */
        $("#patientenquirygeneralfirst-contacted_source").change(function () {
                var contact_source = $("#patientenquirygeneralfirst-contacted_source option:selected").val();
                if (contact_source == 0) {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Incoming Number");
                } else if (contact_source == 1) {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Incoming Email Id");
                        $('#patientenquirygeneralfirst-incoming_missed').replaceWith($('<input/>', {'type': 'text', 'name': 'Other', 'class': 'form-control'}));
                } else {
                        $("label[for = patientenquirygeneralfirst-incoming_missed]").text("Contact Source Others");
                }
        });


        /*
         * Incoming number from other show/hide on update
         */

        if ($("#patientenquirygeneralfirst-incoming_missed option:selected").val() === 'Other')
                $('#incoming_missed_other').show();
        else
                $('#incoming_missed_other').hide();


        /*
         * Incoming number from other show/hide on create
         */

        $("#patientenquirygeneralfirst-incoming_missed").change(function () {
                if ($("#patientenquirygeneralfirst-incoming_missed option:selected").val() === 'Other')
                        $('#incoming_missed_other').show();
                else
                        $('#incoming_missed_other').hide();
        });


        /*
         * outgoing number from other show/hide on update
         */

        if ($("#patientenquirygeneralfirst-outgoing_number_from option:selected").val() === '1')
                $('#outgoing_number_from_other').show();
        else
                $('#outgoing_number_from_other').hide();


        /*
         * outgoing number from other show/hide on create
         */

        $("#patientenquirygeneralfirst-outgoing_number_from").change(function () {
                if ($("#patientenquirygeneralfirst-outgoing_number_from option:selected").val() === '1')
                        $('#outgoing_number_from_other').show();
                else
                        $('#outgoing_number_from_other').hide();
        });


        /*
         *  If referal source field value is other show referal source others field
         */

        $("#referral_source").change(function () {
                if ($("#referral_source option:selected").val() === '5')
                        $('#referral_source_others').show();
                else
                        $('#referral_source_others').hide();

        });

        /*
         *  If referal source field value is other show referal source others field on update
         */
        $referal_source = $("#referral_source option:selected").val();
        if ($referal_source === '5') {
                $('#referral_source_others').show();
        } else {
                $('#referral_source_others').hide();
        }

        /*
         *  If whatsapp_reply field value is yes show whatsapp_number field or if no show note field
         */

        $("#patientenquirygeneralsecond-whatsapp_reply").change(function () {
                if ($("#patientenquirygeneralsecond-whatsapp_reply option:selected").val() === '1') {
                        $('#whatsapp_number').show();
                        $('#whatsapp_note').hide();
                } else if ($("#patientenquirygeneralsecond-whatsapp_reply option:selected").val() === '0') {
                        $('#whatsapp_number').hide();
                        $('#whatsapp_note').show();
                }
        });

        /*
         *  If whatsapp_reply field value is yes show whatsapp_number field or if no show note field on update
         */

        $whatsapp_number = $("#patientenquirygeneralsecond-whatsapp_reply option:selected").val();
        if ($whatsapp_number === '1') {
                $('#whatsapp_number').show();
                $('#whatsapp_note').hide();
        } else if ($whatsapp_number === '0') {
                $('#whatsapp_number').hide();
                $('#whatsapp_note').show();
        }


        /* Other service note show/hide on selecting other service from required service*/
        $("#patientenquirygeneralsecond-required_service").change(function () {
                var required_service = $(this).val();
                if (jQuery.inArray("8", required_service) !== -1)
                        $('#required_other_service').show();
                else
                        $('#required_other_service').hide();


        });
        /* Other service note show/hide on update */
        var required_service = $("#patientenquirygeneralsecond-required_service").val();
        if (jQuery.inArray("8", required_service) !== -1)
                $('#required_other_service').show();
        else
                $('#required_other_service').hide();

        /*
         * service required other others field show/hide on update
         */

        $service_required = $("#patientenquirygeneralsecond-service_required").val();
        if ($service_required === '5') {
                $('#service_required').show();
        } else {
                $('#service_required').hide();
        }
        /*
         * service required other others field show/hide on create
         */

        $('#patientenquirygeneralsecond-service_required').change(function () {
                if ($(this).val() === '5') {
                        $('#service_required').show();
                } else {
                        $('#service_required').hide();
                }
        });




        $('#checkbox_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#patientenquirygeneralsecond-address").val();
                        var city = $("#patientenquirygeneralsecond-city").val();
                        var postal_code = $("#patientenquirygeneralsecond-zip_pc").val();
                        $("#patientenquiryhospitalfirst-person_address").val(address);
                        $("#patientenquiryhospitalfirst-person_city").val(city);
                        $("#patientenquiryhospitalfirst-person_postal_code").val(postal_code);
                }
                if (!this.checked) {
                        $("#patientenquiryhospitalfirst-person_address").val('');
                        $("#patientenquiryhospitalfirst-person_city").val('');
                        $("#patientenquiryhospitalfirst-person_postal_code").val('');
                }
        });






        /*
         -----------------PATIENT ENQUIRY GENERAL INFO FORM----------------------------
         */







        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */


        $('#diabetic_note').hide();
        $('#relationship_others').hide();


        /*
         *  Relationship show/hide on update
         */

        $relationship = $("#patientenquiryhospitalfirst-relationship option:selected").val();
        if ($relationship === '3') {
                $('#relationship_others').show();
        } else {
                $('#relationship_others').hide();
        }

        /*
         *  Relationship show/hide
         */

        $("#patientenquiryhospitalfirst-relationship").change(function () {
                if ($("#patientenquiryhospitalfirst-relationship option:selected").val() === '3')
                        $('#relationship_others').show();
                else
                        $('#relationship_others').hide();
        });



        /*
         * Diabetic note show/hide on diabetic change
         */

        $("#patientenquiryhospitalsecond-diabetic").change(function () {
                if ($(this).val() === '1')
                        $('#diabetic_note').show();
                else
                        $('#diabetic_note').hide();
        });

        /*
         * Diabetic note on update
         */

        if ($('#patientenquiryhospitalsecond-diabetic').val() === '1')
                $('#diabetic_note').show();
        else
                $('#diabetic_note').hide();

        /*
         * care currently provided service required other others field show/hide on update
         */

        if ($('#patientenquiryhospitalsecond-care_currently_provided').val() === '4')
                $('#care_currently_provided_others').show();
        else
                $('#care_currently_provided_others').hide();


        /*
         * care currently provided other others field show/hide on cretae
         */

        $('#patientenquiryhospitalsecond-care_currently_provided').change(function () {
                if ($(this).val() === '4') {
                        $('#care_currently_provided_others').show();
                } else {
                        $('#care_currently_provided_others').hide();
                }
        });

        /*
         * difficulty in movement others field show/hide on update
         */

        $difficulty_in_movement = $("#patientenquiryhospitalsecond-difficulty_in_movement").val();
        if ($difficulty_in_movement === '5') {
                $('#difficulty_in_movement_other').show();
        } else {
                $('#difficulty_in_movement_other').hide();
        }

        /*
         * difficulty in movement others field show/hide on create
         */
        $('#patientenquiryhospitalsecond-difficulty_in_movement').change(function () {
                if ($(this).val() === '5') {
                        $('#difficulty_in_movement_other').show();
                } else {
                        $('#difficulty_in_movement_other').hide();

                }
        });

        /*
         * care currently provided service required expected datre of dischargede on update
         */

        if ($('#patientenquiryhospitalsecond-care_currently_provided').val() === '3')
                $('#date_of_discharge').show();
        else
                $('#date_of_discharge').hide();


        /*
         * care currently provided service required expected datre of dischargede on create
         */

        $('#patientenquiryhospitalsecond-care_currently_provided').change(function () {
                if ($(this).val() === '3') {
                        $('#date_of_discharge').show();
                } else {
                        $('#date_of_discharge').hide();

                }
        });




        /*
         -----------------ENQUIRY HOSPITAL INFO FORM--------------
         */

        /*
         * select 2 widget for add hospital
         */
        $("#hospital_4").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#doctor_4").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        /*
         * list hospital on change of branch
         */
        $('#patientenquirygeneralfirst-branch_id').change(function () {
                var branch = $(this).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'ajax/hospitals',
                        success: function (data) {
                                $('.hospital').html(data);
                                $("#hospital_4").select2({
                                        allowClear: true
                                }).on('select2-open', function ()
                                {
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                });
                                $("#doctor_4").select2({
                                        allowClear: true
                                }).on('select2-open', function ()
                                {
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                });

                        }
                });

        });




        var scntDiv = $('#p_scents1');
        var i = $('#p_scents1 span').size() + 1;

        $('#addHosp').on('click', function () {
                var branch = $('#patientenquirygeneralfirst-branch_id').val();
                var count = i + 1;
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch, count: count},
                        url: homeUrl + 'ajax/patienthospitaldetails',
                        success: function (data) {

                                hideLoader();
                                if (data == '1') {
                                        alert('Please select branch');
                                } else {
                                        $(data).appendTo(scntDiv);
                                        $('#hospital_' + count).select2({
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        $('#doctor_' + count).select2({
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        i++;
                                        return false;
                                }

                        }
                });

        });

        $('#p_scents1').on('click', '.remScnt', function () {

                if (i > 2) {
                        $(this).parents('span').remove();
                        i--;
                }
                if (this.hasAttribute("val")) {
                        var valu = $(this).attr('val');
                        $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                        var value = $('#delete_port_vals').val();
                }
                return false;
        });



        $(document).on('change', '.hospital', function (e) {
                var hospital = $(this).val();

                var id = $(this).attr('id');
                var idd = id.split('_');
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {hospital: hospital},
                        url: homeUrl + 'ajax/doctors',
                        success: function (data) {

                                if (data == 0) {
                                        //  alert('Failed to Load data, please try again error:1001');
                                } else {
                                        $("#doctor_" + idd[1]).html(data);
                                }
                                hideLoader();
                        }
                });
        });




        /*
         * patient module if address same
         */

        $('#address_id').on('change', function (e) {
                if (this.checked) {
                        var address = $("#patientgeneral-present_address").val();
                        var landmark = $("#patientgeneral-landmark").val();
                        var pincode = $("#patientgeneral-pin_code").val();
                        var contact_number = $("#patientgeneral-contact_number").val();
                        var email = $("#patientgeneral-email").val();
                        $("#patientguardiandetails-permanent_address").val(address);
                        $("#patientguardiandetails-landmark").val(landmark);
                        $("#patientguardiandetails-pincode").val(pincode);
                        $("#patientguardiandetails-contact_number").val(contact_number);
                        $("#patientguardiandetails-email").val(email);
                }
                if (!this.checked) {
                        $("#patientguardiandetails-permanent_address").val('');
                        $("#patientguardiandetails-landmark").val('');
                        $("#patientguardiandetails-pincode").val('');
                        $("#patientguardiandetails-contact_number").val('');
                        $("#patientguardiandetails-email").val('');
                }
        });

        $("#patientenquirygeneralsecond-required_service").select2({
                placeholder: 'Choose Services',
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        /////////////////////////------------------  ---------------------/////////////////////////

               $('.patient-enquiry-img-remove').on('click', function (e) {
                var data = $(this).attr('id');
                var datas = data.split("-");
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1]},
                        url: homeUrl + 'ajax/patientenquiryremove',
                        success: function (data) {
                                $('#' + datas[2]).remove();
                        }
                });
        });


     $('.patient-img-remove').on('click', function (e) {
                var data = $(this).attr('id');
                var datas = data.split("-");
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: datas[0], name: datas[1]},
                        url: homeUrl + 'ajax/patientremove',
                        success: function (data) {
                                $('#ss_' + datas[2]).remove();
                        }
                });
        });



       $('#enquirer_1').click(function () {
                $('.enquirer_1').toggle();
                $('#enquirer_1').hide();

        });

        $('#enquirer_2').click(function () {
                $('.enquirer_2').toggle();
                $('#enquirer_2').hide();
        });

         $('#close_1').click(function () {
                $('#patientenquirygeneralsecond-caller_name_1').val('');
                $('#patientenquirygeneralsecond-caller_gender_1').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_1').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_2').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_3').val('');
                $('#patientenquirygeneralsecond-address_1').val('');
                $('#patientenquirygeneralsecond-city_1').val('');
                $('#patientenquirygeneralsecond-zip_pc_1').val('');
                $('#patientenquirygeneralsecond-email_1').val('');
                $('#patientenquirygeneralsecond-email_2').val('');

                $('#patientguardiandetails-first_name_1').val('');
                $('#patientguardiandetails-last_name_1').val('');
                $('#patientguardiandetails-gender_1').val('');
                $('#patientguardiandetails-religion_1').val('');
                $('#patientguardiandetails-nationality_1').val('');
                $('#patientguardiandetails-occupatiion_1').val('');
                $('#patientguardiandetails-permanent_address_1').val('');
                $('#patientguardiandetails-pincode_1').val('');
                $('#patientguardiandetails-landmark_1').val('');
                $('#patientguardiandetails-contact_number_1').val('');
                $('#patientguardiandetails-email_1').val('');

                $('.enquirer_1').hide();
                $('#enquirer_1').show();
        });

        $('#close_2').click(function () {

                $('#patientenquirygeneralsecond-caller_name_2').val('');
                $('#patientenquirygeneralsecond-caller_gender_2').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_4').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_5').val('');
                $('#patientenquirygeneralsecond-mobile_number_alt_6').val('');
                $('#patientenquirygeneralsecond-address_2').val('');
                $('#patientenquirygeneralsecond-city_2').val('');
                $('#patientenquirygeneralsecond-zip_pc_2').val('');
                $('#patientenquirygeneralsecond-email_3').val('');
                $('#patientenquirygeneralsecond-email_4').val('');

                $('#patientguardiandetails-first_name_2').val('');
                $('#patientguardiandetails-last_name_2').val('');
                $('#patientguardiandetails-gender_2').val('');
                $('#patientguardiandetails-religion_2').val('');
                $('#patientguardiandetails-nationality_2').val('');
                $('#patientguardiandetails-occupatiion_2').val('');
                $('#patientguardiandetails-permanent_address_2').val('');
                $('#patientguardiandetails-pincode_2').val('');
                $('#patientguardiandetails-landmark_2').val('');
                $('#patientguardiandetails-contact_number_2').val('');
                $('#patientguardiandetails-email_2').val('');

                $('.enquirer_2').hide();
                $('#enquirer_2').show();
        });


      $('.missing-files').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var type = $(this).attr('type');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {id: id, type: type},
                        url: homeUrl + 'ajax/checking',
                        success: function (data) {
                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});
                        }
                });

        });

});
