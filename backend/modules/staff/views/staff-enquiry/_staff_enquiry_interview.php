<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">



        <h4 style="color:#000;font-style: italic;">Family Details</h4>
        <hr class="enquiry-hr"/>

        <div id="staff_family">

                <input type="hidden" id="delete_port_vals_family"  name="delete_port_vals_family" value="">
                <?php
                if (!empty($staff_family)) {
                        foreach ($staff_family as $family) {
                                unset($relationship);
                                $relationship = $family->relationship;
                                ?>
                                <span>
                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                                        <label class="control-label" for="">Name</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][name][]" value="<?= $family->name; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                                        <label class="control-label" for="">Relationship</label>
                                                        <?php $relations = \common\models\MasterRelationships::find()->where(['status' => 1])->all(); ?>
                                                        <?=
                                                        Html::dropDownList('updatee[' . $family->id . '][relationship][]', $relationship, ArrayHelper::map($relations, 'id', 'title'), ['class' => 'form-control', 'prompt' => ' --Select--', 'id' => 'family_relationships_1']);
                                                        ?>

                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                                        <label class="control-label" for="">Job</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][job][]"  value="<?= $family->job; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                                        <label class="control-label" for="">Mobile No</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][mobile_no][]" value="<?= $family->mobile_no; ?>">
                                                </div>
                                        </div>

                                        <div class="col-md-1 col-sm-6 col-xs-12 left_padd">
                                                <a id="remFamily" val="<?= $family->id; ?>" class="btn btn-icon btn-red remFamily" style="margin-top: 15px;"><i class="fa-remove"></i></a>
                                        </div>
                                </span>
                                <?php
                        }
                }
                ?>



                <span>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                        <label class="control-label" for="">Name</label>
                                        <input type="text" class="form-control" name="createfamily[name][]">
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                        <label class="control-label" for="">Relationship</label>
                                        <?php $relations = \common\models\MasterRelationships::find()->where(['status' => 1])->all(); ?>
                                        <?= Html::dropDownList('createfamily[relationship][]', null, ArrayHelper::map($relations, 'id', 'title'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'family_relationships_1']);
                                        ?>
                                        <a class="add-option-dropdown add-new" id="family_relationships_1-10" style="margin-top:0px;"> <div class="div-add-new">+ Add New</div></a>

                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                        <label class="control-label" for="">Job</label>
                                        <input type="text" class="form-control" name="createfamily[job][]">
                                </div>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                        <label class="control-label" for="">Mobile No</label>
                                        <input type="text" class="form-control" name="createfamily[mobile_no][]">
                                </div>
                        </div>

                </span>
        </div>

        <div class="row">
                <div class="col-md-6"> <a id="add_Staff_family" class="btn btn-blue btn-icon btn-icon-standalone Staff_family" ><i class="fa-plus"></i><span> Add Family Details</span></a>
                </div>
        </div>

        <h4 style="color:#000;font-style: italic;">Bank Details</h4>
        <hr class = "enquiry-hr"/>
        <div class = 'col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($staff_interview_third, 'bank_ac_no')->textInput(['maxlength' => true])
                                        ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_third, 'bank_ac_hodername')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_ifsc')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both">

        </div>





        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_required')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_received')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interest_level')->dropDownList(['' => '--Select--', '1' => 'High', '2' => 'No Interest', '3' => 'Medium']) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->expected_date_of_joining = date('d-m-Y', strtotime($staff_interview_third->expected_date_of_joining));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'expected_date_of_joining',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'form_filled', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interview_notes')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interviewed_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->interviewed_date = date('d-m-Y', strtotime($staff_interview_third->interviewed_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'interviewed_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div style="clear:both"></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_first, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='3' style='color: #3c4ba1;text-decoration: underline;'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>



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

<style>
        .cbr-inline{ margin-top: 10px; }
        .lang_check{text-align: center;color: #000;}
        .languages .col-md-3{height: 65px;}
        .languages{margin-left: 0px;margin-right: 0px;}
        .lang_check label{font-weight: bold}

</style>
