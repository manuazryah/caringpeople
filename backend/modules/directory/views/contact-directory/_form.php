<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ContactCategoryTypes;
use common\models\ContactSubcategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ContactDirectory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-directory-form form-inline padng_left">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        $categories = ContactCategoryTypes::find()->where(['status' => 1])->all();
                        ?>
                        <?=
                                $form->field($model, 'category_type')
                                ->dropDownList(ArrayHelper::map($categories, 'id', 'category_name'), [
                                    'class' => 'form-control contact_category_change',
                                    'id' => 'contactcategory',
                                    'prompt' => '--select contact type--'
                                        ]
                                )
                        ?>
                        <a class="add-option-dropdown add-new" id="contactcategory-6" > + Add New</a>
                </div>
                <?php
                if (!$model->isNewRecord) {
                        $category = ContactSubcategory::find()->where(['category_id' => $model->category_type, 'status' => '1'])->all();
                } else {
                        $category = [];
                }
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'subcategory_type')->dropDownList(ArrayHelper::map($category, 'id', 'sub_category'), ['prompt' => '--Select--', 'class' => 'form-control subcategory-change', 'id' => 'contactsubcategory']); ?>

                        <a class="add-option-dropdown add-new" id="contactsubcategory-7" > + Add New</a>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <a class="add-option-dropdown add-new" id="contactsubcategory-99" style="visibility: hidden;"> + Add New</a>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'designation')->dropDownList(ArrayHelper::map(common\models\ContactDirectoryDesignation::find()->where(['status' => 1])->all(), 'id', 'designation'), ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'contactdesignation']); ?>

                        <a class="add-option-dropdown add-new" id="contactdesignation-8" > + Add New</a>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                        <a class="add-option-dropdown add-new" id="contactsubcategory-99" style="visibility: hidden;"> + Add New</a>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'references')->dropDownList(['' => '--Select--', '0' => 'Internet', '1' => 'Care and care', '2' => 'Guardian Angel', '3' => 'Caremark', '4' => 'Cancure', '6' => 'Dont Know', '5' => 'Other'], ['id' => 'referral_source']) ?>
                        <div class="div-add-new" style="margin-top: -20px;"><a class="add-option-dropdown add-new" id="referral_source-11" style="margin-top:0px;"> + Add New</a></div>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'remarks')->textarea(['rows' => 2]) ?>

                </div>

        </div>

        <div class="row" style="margin: 0;">

                <span class="inquiry">
                        <h4 class="h4-labels" style="position: relative;">Notes</h4>
                        <hr class="enquiry-hr"/>
                </span>
                <div class='col-md-9 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes_1')->textarea(['rows' => 4]) ?>

                </div>

                <?php
                if (isset($model->notes_1_added) && $model->notes_1_added != '') {
                        $added_by = common\models\StaffInfo::findOne($model->notes_1_added);
                        if (isset($added_by)) {

                                $added_details = $added_by->staff_name . ' ( ' . date('d-m-Y h:i:s', strtotime($model->notes_1_time)) . ' )';
                        }
                        ?>
                        <p style="margin-top: 55px;">Created by :  <b><?= $added_details ?></b></p>
                <?php } ?>
        </div>


        <div class="row" style="margin:0;float: right">
                <a class="btn btn-blue btn-icon btn-icon-standalone" id="notes_1" style="<?php if (isset($model->notes_2) && $model->notes_2 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Notes</span></a>

        </div>

        <div class="row notes_1" style="margin: 0;<?php if (isset($model->notes_1) && $model->notes_1 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">
                <div class='col-md-9 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes_2')->textarea(['rows' => 4]) ?><a id="close_note_1" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a>
                </div>

                <?php
                if (isset($model->notes_2_added) && $model->notes_2_added != '') {
                        $added_by = common\models\StaffInfo::findOne($model->notes_2_added);
                        if (isset($added_by)) {

                                $added_details = $added_by->staff_name . ' ( ' . date('d-m-Y h:i:s', strtotime($model->notes_2_time)) . ' )';
                        }
                        ?>
                        <p style="margin-top: 55px;">Created by :  <b><?= $added_details ?></b></p>
                <?php } ?>

                <div class="row" style="margin:0;float: right">
                        <a class="btn btn-blue btn-icon btn-icon-standalone" id="notes_2" style="<?php if (isset($model->notes_3) && $model->notes_3 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Notes</span></a>
                </div>

        </div>


        <div class="row notes_2" style="margin: 0;<?php if (isset($model->notes_3) && $model->notes_3 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">
                <div class='col-md-9 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes_3')->textarea(['rows' => 4]) ?><a id="close_note_2" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a>
                </div>

                <?php
                if (isset($model->notes_3_added) && $model->notes_3_added != '') {
                        $added_by = common\models\StaffInfo::findOne($model->notes_3_added);
                        if (isset($added_by)) {

                                $added_details = $added_by->staff_name . ' ( ' . date('d-m-Y h:i:s', strtotime($model->notes_3_time)) . ' )';
                        }
                        ?>
                        <p style="margin-top: 55px;">Created by :  <b><?= $added_details ?></b></p>
                <?php } ?>

        </div>



        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>

<script>
        $(document).ready(function () {
                $("#referral_source").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });



                $('#notes_1').click(function () {
                        $('.notes_1').toggle();
                        $('#notes_1').hide();

                });

                $('#notes_2').click(function () {
                        $('.notes_2').toggle();
                        $('#notes_2').hide();
                });

                $('#close_note_1').click(function () {
                        $('#contactdirectory-notes_2').val('');

                        $('.notes_1').hide();
                        $('#notes_1').show();
                });

                $('#close_note_2').click(function () {
                        $('#contactdirectory-notes_3').val('');
                        $('.notes_2').hide();
                        $('#notes_2').show();
                });

        });
</script>

<style>
        .remove-enquirer{
                position: absolute;
                right: 0px;
                margin-bottom: 0px;
                top: -10px;
                margin-top: 10px;
        }
</style>