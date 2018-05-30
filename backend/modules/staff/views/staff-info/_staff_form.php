<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if (Yii::$app->controller->action->id != 'editprofile') {
        $this->title = 'Staffs';
} else {
        $this->title = 'Update your Profile - ' . $model->staff_id;
}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <?php if (Yii::$app->controller->action->id != 'editprofile') { ?>
                                        <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>
                                <?php } ?>
                                <?php if (!$model->isNewRecord && Yii::$app->controller->action->id != 'editprofile') { ?>
                                        <div id="rEset"> <a href="javascript:;" id="<?= $model->id; ?>"  class="ResetPassword" style="padding: 14px;
                                                            font-size: 14px;
                                                            font-weight: bold;
                                                            text-decoration: none;
                                                            float: right;">Reset Password</a></div>

                                <?php } ?>
                                <?php if (Yii::$app->controller->action->id != 'editprofile') { ?>
                                        <?=
                                        $this->render('_main_menus', [
                                            'model' => $model,
                                        ])
                                        ?>
                                <?php } ?>
                                <div class="panel-body panel_body_background" >
                                        <?php if (Yii::$app->controller->action->id != 'editprofile') { ?>
                                                <div class="tab-content tab_data_margin">
                                                        <div class="tab-pane active" id="main-1">
                                                                <?=
                                                                $this->render('_sub_menu_1', [
                                                                ])
                                                                ?>

                                                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'add-staff-form']]); ?>
                                                                <div class="tab-content second-tab">
                                                                        <div class="tab-pane active" id="home-3">


                                                                                <?=
                                                                                $this->render('_form', [
                                                                                    'model' => $model,
                                                                                    'staff_edu' => $staff_edu,
                                                                                    'form' => $form,
                                                                                    'staff_interview_first' => $staff_interview_first,
                                                                                ])
                                                                                ?>

                                                                        </div>
                                                                        <div class="tab-pane" id="profile-3">

                                                                                <?=
                                                                                $this->render('_other_info_form', [
                                                                                    'model' => $other_info,
                                                                                    'staff_previous_employer' => $staff_previous_employer,
                                                                                    'form' => $form,
                                                                                    'staffinfo' => $model,
                                                                                    'staff_interview_second' => $staff_interview_second,
                                                                                ])
                                                                                ?>

                                                                        </div>

                                                                        <div class="tab-pane" id="profile-4">

                                                                                <?=
                                                                                $this->render('_staff_interview_info', [
                                                                                    'staff_previous_employer' => $staff_previous_employer,
                                                                                    'staff_interview_first' => $staff_interview_first,
                                                                                    'staff_interview_second' => $staff_interview_second,
                                                                                    'staff_interview_third' => $staff_interview_third,
                                                                                    'staff_family' => $staff_family,
                                                                                    'staffinfo' => $model,
                                                                                    'form' => $form,
                                                                                    'type' => 4,
                                                                                ])
                                                                                ?>
                                                                        </div>

                                                                        <div class="tab-pane" id="profile-5">

                                                                                <?=
                                                                                $this->render('salary_details', [
                                                                                    'staff_interview_first' => $staff_interview_first,
                                                                                    'staff_interview_second' => $staff_interview_second,
                                                                                    'staff_interview_third' => $staff_interview_third,
                                                                                    'staff_family' => $staff_family,
                                                                                    'staffinfo' => $model,
                                                                                    'staff_salary' => $staff_salary,
                                                                                    'form' => $form,
                                                                                ])
                                                                                ?>

                                                                        </div>
                                                                </div>
                                                                <?php ActiveForm::end(); ?>


                                                        </div>
                                                        <div class="tab-pane" id="main-2">
                                                                <?=
                                                                $this->render('_sub_menu_2', [
                                                                ])
                                                                ?>


                                                                <div class="tab-content second-tab">
                                                                        <div class="tab-pane active" id="home-12">
                                                                                <?=
                                                                                $this->render('remarks', [
                                                                                    'patient_info' => $model,
                                                                                    'type' => 4,
                                                                                ])
                                                                                ?>
                                                                        </div>
                                                                        <div class="tab-pane" id="profile-13">
                                                                                <?=
                                                                                $this->render('followups', [
                                                                                    'patient_info' => $model,
                                                                                    'type' => 4,
                                                                                ])
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                        </div>





                                                </div>
                                        <?php } else { ?>



                                                <?=
                                                $this->render('update', [
                                                    'model' => $model,
                                                    'staff_edu' => $staff_edu,
                                                ])
                                                ?>


                                        <?php } ?>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>





        $('.ResetPassword').on('click', function () {
                $('#user_id').val(this.id);
                $('#modal-reset').modal('show', {backdrop: 'static'});
        });
        $(document).on('submit', '#reset_password_form', function (e) {

                //$('#modal-reset').modal('hide');
                var newpassword = $('#new-password').val();
                var confirmpassword = $('#confirm-password').val();
                var userid = $('#user_id').val();
                if (newpassword === confirmpassword) {
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'staff/staff-info/reset-password',
                                data: {password: newpassword, id: userid},
                                success: function (data) {
                                        //  $(".ResetPassword").append("<div>hello world</div>");
                                        $("#rEset").after("<b>Hello</b>");
                                }

                        });
                } else {
                        $('#modal-reset').modal('show', {backdrop: 'static'});
                        $('div.mismatch_error').text("Password Mismatch");
                        e.preventDefault();
                }


        }
        );


</script>

<script>
        var submitted = false;
        $('#add-staff-form').submit(function () {
                submitted = true;
        });

        $('#add-staff-form').data('serialize', $('#add-staff-form').serialize());
        $(window).bind('beforeunload', function (e) {
                if ($('#add-staff-form').serialize() != $('#add-staff-form').data('serialize') && !submitted)
                        return true;
                else
                        e = null;
        });

</script>

