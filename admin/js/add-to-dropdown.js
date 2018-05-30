/*
 * Created by   :- Manu K O
 * Created date :- 03-03-2017
 * purpose      :- To add common javascript
 */

$("document").ready(function () {

        /*
         * show add new form
         */

        $(document).on('click', '.add-option-dropdown', function (e) {
                var id_attr = $(this).attr('id');
                var type = id_attr.split('-');
                var cat_type = $(this).attr('type');
                if (type[1] == 7) {
                        var category = $('#contactcategory').val();
                } else if (type[1] == 1) {
                        var category = $('#patientenquirygeneralfirst-branch_id').val();
                } else if (type[1] == 9) {
                        var doctor = type[0].split('_');
                        var category = $('#hospital_' + doctor[1]).val();

                } else {
                        var category = '';

                }

                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'dropdown/showform',
                        data: {type: type[1], field_id: type[0], cat_type: cat_type, category: category},
                        success: function (data) {

                                $("#modal-pop-up").html(data);
                                $('#modal-6').modal('show', {backdrop: 'static'});

                        }
                });
        });
        /*
         * add new form submit
         */



        $(document).on('submit', '#submit-add-form', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                        type: 'POST',
                        url: homeUrl + 'dropdown/add',
                        data: data,
                        success: function (data) {

                                var res = $.parseJSON(data);
                                var newOption = $('<option value="' + res.result['id'] + '">' + res.result['name'] + '</option>');
                                $('#' + res.result['field_id']).append(newOption);
                                $('#' + res.result['field_id'] + ' option[value=' + res.result['id'] + ']').attr("selected", "selected");

                                if (res.result['type'] == '2') {
                                        var vals = $('#' + res.result['field_id']).val();
                                        $('#' + res.result['field_id']).select2('val', vals);
                                }
                                $('#modal-6').modal('hide');
                        }
                });
        });



        $(document).on('submit', '#add-remarks', function (e) {
                e.preventDefault();
                var remarks = $(this).serialize();
                $.ajax({

                        url: homeUrl + 'dropdown/addremarks',
                        type: "POST",
                        data: remarks,
                        success: function (data) {

                                $('#add-remarks')[0].reset();
                                var res = $.parseJSON(data);
                                $('.remarks-table table').append('<tr id="' + res.id + '"><td>' + res.UB + '</td>\n\
                                                                  <td>' + res.category + '</td>\n\
                                                                  <td>' + res.sub_category + '</td>\n\
                                                                  <td>' + res.point + '</td>\n\
                                                                  <td>' + res.notes + '</td>\n\
                                                                  <td>' + res.date + '</td>\n\
                                                                  <td>Active</td>\n\
                                                                  <td><input type="checkbox" class="iswitch iswitch-secondary remarks-status" id="' + res.id + '"></td></tr>');
                        }
                });


        });

        $(document).on('click', '.remarks-status', function (e) {
                var remark = $(this).attr('id');
                $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: 'remark_id=' + $(this).attr('id'),
                        url: homeUrl + 'dropdown/changeremarkstatus',
                        success: function (data) {
                                if (data == '1') {
                                        $('.remarks-table table tr#' + remark).remove();
                                }
                        }
                });
        });

        $('#staff_skills').change(function () {
                //  alert($('#staff_skills').val());
        });


         $('#size').change(function () {
                //var d = $('#size :selected').val();
                this.form.submit();

        });

});

function postToController() {
        for (i = 0; i < document.getElementsByName('rating').length; i++) {
                if (document.getElementsByName('rating')[i].checked == true) {
                        var ratingValue = document.getElementsByName('rating')[i].value;
                        break;
                }
        }
        $('#rating').val(ratingValue);
}