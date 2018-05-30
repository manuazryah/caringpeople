/*
 * Created by   :- Sabitha
 * Created date :- 22-06-2017
 */



$("document").ready(function () {

//--------------------------------------------------------------Staff and patient Report------------------------------------------//
        $("#report-staff").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#report-patient").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });



        $('#report-branch').change(function () {
                var branch = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'report/staffs',
                        success: function (data) {
                                $('#report-staff').html(data);
                                hideLoader();
                        }
                });
        });



        $('#report-patient-branch').change(function () {
                var branch = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'report/patients',
                        success: function (data) {
                                $('#report-patient').html(data);
                                hideLoader();
                        }
                });
        });


        $('#report-patient').change(function () {
                var patient = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {patient: patient},
                        url: homeUrl + 'report/services',
                        success: function (data) {
                                if (data != 0) {
                                        $('.report-services').show();
                                        $('#report-services').html(data);
                                }
                                hideLoader();
                        }
                });
        });


        $('.report-service-patient').change(function () {
                var patient = $(this).val();
                showLoader();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {patient: patient},
                        url: homeUrl + 'report/servicesall',
                        success: function (data) {
                                if (data != 0) {
                                        $('#report-services-services').html(data);
                                }
                                hideLoader();
                        }
                });
        });




//--------------------------------------------------------------Staff and patient Report------------------------------------------//


//--------------------------------------------------------------Staff Payment------------------------------------------//

        $("#staffpayroll-staff_id").select2({
                allowClear: true
        }).on('select2-open', function ()
        {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $('#staffpayroll-branch_id').change(function () {
                ListStaffs();
        });
        $('#staffpayroll-date_from').change(function () {
                ListStaffs();
        });
        $('#staffpayroll-date_to').change(function () {
                ListStaffs();
        });





//--------------------------------------------------------------Staff Payment------------------------------------------//


});



function ListStaffs() {
        var branch = $('#staffpayroll-branch_id').val();
        var date_from = $('#staffpayroll-date_from').val();
        var date_to = $('#staffpayroll-date_to').val();
        $.ajax({
                type: 'POST',
                cache: false,
                data: {branch: branch, date_from: date_from, date_to: date_to},
                url: homeUrl + 'accounts/staff-payroll/staffs',
                success: function (data) {

                        $('#staffpayroll-staff_id').html(data);
                }
        });
}