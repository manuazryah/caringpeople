<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\MasterDesignations;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $posts = \common\models\AdminPosts::find()->orderBy(['post_name' => SORT_ASC])->all(); ?>

<div class="staff-info-form form-inline">

        <?php if (!$model->isNewRecord) { ?>
                <div class="row">
                        <div class="col-md-8">
                                <h4 class="h4-labels"></h4>

                        </div>
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $staff_enquiry->id;
                        if (count(glob("{$path}/*")) > 0) {
                                foreach (glob("{$path}/*") as $file) {
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nam = explode('.', $img_nmee);

                                        if ($img_nam[0] == 'Profile Image') {
                                                ?>
                                                <div class="col-md-4 disp-image" id="patient_image">
                                                        <img src="<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . $img_nmee ?>"/>
                                                </div>

                                                <?php
                                        }
                                }
                        }
                        ?>

                </div>
        <?php } ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'age')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_enquiry->isNewRecord) {
                        $staff_enquiry->dob = date('d-m-Y', strtotime($staff_enquiry->dob));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_enquiry,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'dob',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'height')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'weight')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($staff_enquiry, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['prompt' => '--Select--', 'class' => 'form-control','id' => 'staffenqudesination']) ?>
                <?php //$form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant'])  ?>
 <div class="div-add-new" style="margin-top: -20px;"><a class="add-option-dropdown add-new" id="staffenqudesination<?= $rand ?>-12" style="margin-top:0px;"> + Add New</a></div>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'address')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'notes')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="agreement_copy_other">    <?= $form->field($staff_enquiry, 'agreement_copy_other')->textInput(['maxlength' => true]) ?>

        </div>

        

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'status')->dropDownList(['1' => 'Active', '2' => 'Closed']) ?>

        </div><?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_enquiry, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>

      <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>

                <?php
                $timing = \common\models\Timing::find()->where(['status' => 1])->all();
                if (!$model->isNewRecord) {
                        if (isset($staff_edu->timing) && $staff_edu->timing != '') {
                                $staff_edu->timing = explode(',', $staff_edu->timing);
                        }
                }
                ?>
                <?= $form->field($staff_edu, 'timing')->dropDownList(ArrayHelper::map($timing, 'id', 'timing'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'timing']) ?>
                <a class="add-option-dropdown add-new" id="timing-14"> <div class="div-add-new">+ Add New Timing</div></a>
        </div>


     <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                $districts = \common\models\Districts::find()->where(['status' => 1])->all();
                if (!$staff_enquiry->isNewRecord) {
                        if (isset($staff_enquiry->area_interested) && $staff_enquiry->area_interested != '') {
                                $staff_enquiry->area_interested = explode(',', $staff_enquiry->area_interested);
                        }
                }
                ?>
                <?= $form->field($staff_enquiry, 'area_interested')->dropDownList(ArrayHelper::map($districts, 'id', 'district'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'district']) ?>


        </div>
  


    <div class="clearfix"></div>
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
                
        </div>


        <div class="row">
                <div class="col-md-6">
                        <a id="addAttach" class="btn btn-blue btn-icon btn-icon-standalone addAttach" ><i class="fa-plus"></i><span> Add More Attachments</span></a>
                </div>
        </div>




        <?php if (!$staff_enquiry->isNewRecord) { ?>
                <br/>

                <div class="row">
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $staff_enquiry->id;

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
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                <a  title="Delete" class="staff-enqiry-img-remove" id="<?= $staff_enquiry->id . "-" . $img_nmee . "-" . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                }
                        }
                        ?>
                </div>

        <?php } ?>
</div>



<style>
        .img_data {
                margin-top: 16px;
        }
        a{
                color: #3c4ba1;
        }
</style>

<div class='row' style="margin-left: 0">
        <div class="form-group" >
                <?= Html::submitButton($staff_enquiry->isNewRecord ? 'Create' : 'Update', ['class' => $staff_enquiry->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                <?php
                if ((!$staff_enquiry->isNewRecord) && $staff_enquiry->proceed != 1) {
                        echo Html::submitButton('Proceed to Staff', ['name' => 'proceed', 'class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:125px;']);
                }
                ?>
        </div>
</div>

<script>
        $(document).ready(function () {
                $("#timing").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

               $("#district").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

        });
</script>
