<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staffs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>
<?php if (!$staff_enquiry->isNewRecord) { ?>
                                        <a href="javascript:;" id="3_<?= $staff_enquiry->id; ?>"  class="btn btn-primary btn-single btn-sm Addfollowup" style="height: 36px;padding: 8px;">Add Followups</a>
                                <?php } ?>
                                <?=
                                $this->render('_menus', [
                                    'model' => $staff_enquiry,
                                    
                                ])
                                ?>
                                <div class="panel-body panel_body_background" >
                                        <?php
                                        $form = ActiveForm::begin();
                                        ?>
                                        <div class="tab-content tab_data_margin" >

                                                <div class="tab-pane active" id="home-3">

                                                        <?=
                                                        $this->render('_form', [
                                                            'staff_enquiry' => $staff_enquiry,
                                                            'form' => $form,
                                                        ])
                                                        ?>

                                                </div>

                                                


                                        </div>
                                        <div class='col-md-12 col-sm-6 col-xs-12' >
                                                <div class="form-group" >
                                                        <?= Html::submitButton($staff_enquiry->isNewRecord ? 'Create' : 'Update', ['class' => $staff_enquiry->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                                                        <?php
                                                        if (!$staff_enquiry->isNewRecord && $staff_enquiry->proceed != 1) {
                                                                echo Html::submitButton('Proceed to Staff', ['name' => 'proceed', 'class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:125px;']);
                                                        }
                                                        ?>
                                                </div>
                                        </div>



                                        <?php ActiveForm::end(); ?>




                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        $('#form_button').click(function (e) { // using click function
                // on contact form submit button
                e.preventDefault();  // stop form from submitting right away

                var error = false;

                $(this).find('.required').each(function () {
                        if ($(this).val().length < 1) {
                                error = true;
                        }
                });
                if (error == false) {

                        var Id = $('.tab-pane.active').attr('id');
                        $('#'.Id).removeClass('active');
                        $('#home-3').addClass('active');  // you submit form
                        $("#w0").submit();
                }
                if (!error) {
                        return true;
                }

        });


</script>


