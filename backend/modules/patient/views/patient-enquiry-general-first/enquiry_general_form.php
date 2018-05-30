<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\OutgoingNumbers;
use kartik\date\DatePicker;
use common\models\ReferralSource;

/* @var $this yii\web\View */
/* @var $patient_info common\models\PatientEnquiryGeneralFirst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-general-first-form form-inline">

        <h4 class="h4-labels">Enquiry Details</h4>
        <hr class="enquiry-hr"/>

        <?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_info, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'contacted_source')->dropDownList(['' => '--Select Contact Source--', '0' => 'Phone', '1' => 'Email', '2' => 'Others']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquirygeneralfirst-contacted_date">
                        <label class="control-label" for="patientenquirygeneralfirst-contacted_date">Contacted Date</label>
                        <?php
                        if (!$patient_info->isNewRecord) {
                                $patient_info->contacted_date = date('d-M-Y h:i', strtotime($patient_info->contacted_date));
                        } else {
                                $patient_info->contacted_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'PatientEnquiryGeneralFirst[contacted_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $patient_info->contacted_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>



                </div>
        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="contact_source">    <?php $outgoing_numbers = OutgoingNumbers::find()->where(['status' => '1'])->orderBy('id DESC')->all() ?>   <?= $form->field($patient_info, 'incoming_missed')->dropDownList(ArrayHelper::map($outgoing_numbers, 'phone_number', 'phone_number'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='incoming_missed_other'>    <?= $form->field($patient_info, 'incoming_missed_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?php $outgoing_numbers = OutgoingNumbers::find()->where(['status' => '1'])->orderBy('id DESC')->all() ?>   <?= $form->field($patient_info, 'outgoing_number_from')->dropDownList(ArrayHelper::map($outgoing_numbers, 'id', 'phone_number'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='outgoing_number_from_other'>    <?= $form->field($patient_info, 'outgoing_number_from_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquirygeneralfirst-outgoing_call_date">
                        <label class="control-label" for="patientenquirygeneralfirst-outgoing_call_date">Outgoing Call Date</label>
                        <?php
                        if (!$patient_info->isNewRecord) {
                                $patient_info->outgoing_call_date = date('d-M-Y h:i', strtotime($patient_info->outgoing_call_date));
                        } else {
                                $patient_info->outgoing_call_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'PatientEnquiryGeneralFirst[outgoing_call_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $patient_info->outgoing_call_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>


        </div><div style="clear:both"></div>

        <h4 class="h4-labels">Enquirer Details</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'caller_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'caller_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?php $referral_source = ReferralSource::find()->where(['status' => 1])->all(); ?>  <?= $form->field($patient_info, 'referral_source')->dropDownList(ArrayHelper::map($referral_source, 'id', 'title'), ['prompt' => '--Select--', 'id' => 'referral_source']) ?>
                <a class="add-option-dropdown add-new" id="referral_source-11" type="<?= $type ?>"> <div class="add-new-label">+ Add New</div></a>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="referral_source_others">    <?= $form->field($patient_info, 'referral_source_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'zip_pc')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email')->textInput(['class' => 'form-control',]); ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email1')->textInput(['maxlength' => true]) ?>

        </div><div style="clear:both"></div>


        <div class="row" style="margin:0;float: right">
                <a class="btn btn-blue btn-icon btn-icon-standalone" id="enquirer_1" style="<?php if (isset($patient_info_second->caller_name_1) && $patient_info_second->caller_name_1 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Enquirer</span></a>

        </div>

        <div class="row enquirer_1" style="margin: 0;<?php if (isset($patient_info_second->caller_name_1) && $patient_info_second->caller_name_1 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">
                <span class="inquiry">
                        <h4 class="h4-labels" style="position: relative;">Enquirer Details 1<a id="close_1" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a></h4>
                        <hr class="enquiry-hr"/>
                </span>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'caller_name_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'caller_gender_1')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_3')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'address_1')->textarea(['rows' => 6]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'city_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'zip_pc_1')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email_1')->textInput(['class' => 'form-control',]); ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email_2')->textInput(['maxlength' => true]) ?>

                </div><div style="clear:both"></div>

                <div class="row" style="margin:0;float: right">
                        <a class="btn btn-blue btn-icon btn-icon-standalone" id="enquirer_2" style="<?php if (isset($patient_info_second->caller_name_2) && $patient_info_second->caller_name_2 != '') { ?> display:none; <?php } else { ?> display:show; <?php } ?>"><i class="fa-plus"></i><span>Add New Enquirer</span></a>

                </div>

        </div>

        <div class="row enquirer_2" style="margin: 0;<?php if (isset($patient_info_second->caller_name_2) && $patient_info_second->caller_name_2 != '') { ?> display:show; <?php } else { ?> display:none; <?php } ?>">

                <span class="inquiry">
                        <h4 class="h4-labels" style="position: relative;">Enquirer Details 2<a id="close_2" class="btn btn-icon btn-red remove-enquirer"><i class="fa-remove"></i></a></h4>
                        <hr class="enquiry-hr"/>
                </span>


                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'caller_name_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'caller_gender_2')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_4')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_5')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'mobile_number_alt_6')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'address_2')->textarea(['rows' => 6]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'city_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'zip_pc_2')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email_3')->textInput(['class' => 'form-control',]); ?>

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email_4')->textInput(['maxlength' => true]) ?>

                </div><div style="clear:both"></div>
                <a id="enquirer_2">Add New</a>

        </div>


        <div style="margin-top:35px;">
                <h4 class="h4-labels">Service Details</h4>
                <hr class="enquiry-hr"/>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$patient_info_second->isNewRecord && $patient_info_second->required_service != '') {

                                $patient_info_second->required_service = explode(',', $patient_info_second->required_service);
                        }
                        ?>
                        <?= $form->field($patient_info_second, 'required_service')->dropDownList(['1' => 'Doctor Visit', '2' => 'Nursing Care', '3' => 'Physiotherapy', '4' => 'Helath Checkup', '5' => 'Caregiver', '6' => 'Lab', '7' => 'Equipment', '8' => 'Other', '9' => 'General Enquiry', '10' => 'Wrong Number '], ['multiple' => 'multiple']) ?>
                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='required_other_service'>    <?= $form->field($patient_info_second, 'required_service_other')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="service_required">    <?= $form->field($patient_info_second, 'service_required_other')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$patient_info_second->isNewRecord) {
                                $patient_info_second->expected_date_of_service = date('d-m-Y', strtotime($patient_info_second->expected_date_of_service));
                        } else {
                                $patient_info_second->expected_date_of_service = date('d-m-Y');
                        }
                        echo DatePicker::widget([
                            'model' => $patient_info_second,
                            'form' => $form,
                            'type' => DatePicker::TYPE_INPUT,
                            'attribute' => 'expected_date_of_service',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'how_long_service_required')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'whatsapp_reply')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='whatsapp_number'>    <?= $form->field($patient_info_second, 'whatsapp_number')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='whatsapp_note'>    <?= $form->field($patient_info_second, 'whatsapp_note')->textarea(['rows' => 1]) ?>

                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'priority')->dropDownList(['' => '--Select--', '1' => 'Hot', '2' => 'Warm', '3' => 'Cold']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_info, 'status')->dropDownList(['1' => 'Active', '2' => 'Pending', '3' => 'Close', '4' => 'Home/Hospital Visit']) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'quotation_details')->textarea(['rows' => 2]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'notes')->textarea(['rows' => 2]) ?>

                </div>

                <div style="clear:both"></div>

                <div id = "p_attach">
                        <input type = "hidden" id = "delete_port_vals" name = "delete_port_vals" value = "">
                        <h4 style = "color:#000;font-style: italic;">Attachments</h4>
                        <hr class = "enquiry-hr"/>


                        <span>
                                <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'>
                                        <div class = "form-group field-staffperviousemployer-hospital_address">
                                                <label class = "control-label">Attachment</label>
                                                <input type = "file" name = "creates[file][]">

                                        </div>
                                </div>
                                <?php
                                $rand = rand();
                                $uploads_type = common\models\UploadCategory::find()->where(['status' => 1])->all();
                                ?>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Attachment Name</label>
                                                <?= Html::dropDownList('creates[file_name][]', null, ArrayHelper::map($uploads_type, 'id', 'sub_category'), ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'atachment_' . $rand]); ?>
                                                <a class="add-option-dropdown add-new" id="atachment_<?= $rand ?>-5" style="margin-top:0px;"><div class="div-add-new"> + Add New </div></a>

                                        </div>
                                </div>


                                <div style="clear:both"></div>
                        </span>
                        <br/>
                </div>

                <div class="row" style="margin:0">
                        <div class="col-md-6">
                                <a id="addAttach" class="btn btn-blue btn-icon btn-icon-standalone addAttach" ><i class="fa-plus"></i><span> Add More Attachments</span></a>
                        </div>
                </div>

        </div>
        <div style="clear:both"></div>


        <?php if (!$patient_info->isNewRecord) { ?>
                <br/>

                <div class="row">
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient-enquiry/' . $patient_info->id;

                        if (count(glob("{$path}/*")) > 0) {
                                echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Uploaded Files</h4>";

                                $k = 0;
                                foreach (glob("{$path}/*") as $file) {
                                        $k++;
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nmees = explode('.', $img_nmee);
                                        ?>

                                        <div class = "col-md-2 img-box" id="<?= $k; ?>">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/patient-enquiry/' . $patient_info->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                <a  title="Delete" class="patient-enquiry-img-remove" id="<?= $patient_info->id . "-" . $img_nmee . "-" . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                }
                        }
                        ?>
                </div>

        <?php } ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_info, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='1' style='color: #3c4ba1;text-decoration: underline;'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>

        </div>
</div>
<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?php if ($patient_info->isNewRecord) { ?>
                        <?= Html::submitButton($patient_info->isNewRecord ? 'Create' : 'Update', ['class' => $patient_info->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button_1']) ?>
                        <?php
                } else {
                        ?>
                        <?= Html::submitButton($patient_info->isNewRecord ? 'Create' : 'Update', ['class' => $patient_info->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button', 'name' => 'update_button']) ?>
                        <?php if (!$patient_info->isNewRecord && $patient_info->status != 3) { ?>
                                <?= Html::submitButton('Proceed to Patient', ['class' => 'btn btn-primary', 'style' => 'margin-top: 18px;height: 36px; width: auto;', 'name' => 'patinet_info']) ?>
                                <?php
                        }
                }
                ?>
        </div>
</div>


<style>
        .form-inline .control-label{
                min-height: 35px;
        }.remove-enquirer{
                position: absolute;
                right: 0px;
                margin-bottom: 0px;
                top: -10px;
        }
</style>

<script>
        $(document).ready(function () {
                $("#referral_source").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>

