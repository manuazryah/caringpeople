<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;

$model = new common\models\RemarksCategory();
?>


<div class="modal-content">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel">Staff Search Form</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">
                        <form id="schedulestaffSearch">
                                <fieldset class="col-sm-12" style="background: #eee;border: 1px solid #ccc; border-radius: 5px;padding: 5px;margin-bottom: 10px;">

                                        <div class="col-sm-12">
                                                <div class="col-sm-4">
                                                        <div class="form-group">
                                                                <label for="specialization">Designation</label>
                                                                <div class="form-line">
                                                                        <?php $designation = ArrayHelper::map(MasterDesignations::find()->where(['status' => 1])->all(), 'id', 'title'); ?>
                                                                        <?= Html::dropDownList('designation', null, $designation, ['prompt' => '--Select-', 'class' => 'form-control', 'id' => 'search-designation']); ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="col-sm-4">
                                                        <div class="form-group">
                                                                <label for="experience">Experience</label>
                                                                <div class="form-line">
                                                                        <?php $experience = Yii::$app->SetValues->Experience(); ?>
                                                                        <?= Html::dropDownList('experience', null, $experience, ['prompt' => '--Select-', 'class' => 'form-control', 'id' => 'experience']); ?>
                                                                </div>
                                                        </div>
                                                </div>


                                                <div class="col-sm-4">
                                                        <div class="form-group">
                                                                <label for="skill">Skill</label>
                                                                <div class="form-line">
                                                                        <?php $skills = ArrayHelper::map(common\models\StaffExperienceList::find()->where(['category' => 2, 'status' => 1])->all(), 'id', 'title'); ?>
                                                                        <?= Html::dropDownList('skills', null, $skills, ['prompt' => '--Select-', 'class' => 'form-control', 'id' => 'skills']); ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-3">
                                                        <div class="form-group">
                                                                <input type="checkbox" name="include_onduty_staff" id="include_onduty_staff" class="filled-in chk-col-orange">
                                                                <label for="include_onduty_staff">Include On-Duty staff</label>
                                                        </div>
                                                </div>
                                        </div>
                                        <input type="hidden" name="service_id" id="service_id" value="<?= $service_id; ?>">
                                        <div class="col-sm-12 text-center">

                                                <button type="submit" class="btn btn-primary waves-effect btnFilterStaff">Search</button>&nbsp;&nbsp;
                                                <input type="reset" class="btn btn-danger waves-effect btnReset" id="Resetbtn">
                                                <!--<input type='button' class="btn btn-danger waves-effect btnReset" id='reset' value='Reset' />-->
                                        </div>
                                        <div class="clearfix"></div><br>
                                </fieldset>
                        </form>




                        </br>
                        <form id="searchChooseStaff">
                                <div class="col-sm-12">

                                        <div class="table-responsive staff-results">



                                        </div>
                                </div>
                                <div class="modal-footer result-buttons" style="display: none;">
                                        <button type="submit" class="btn btn-success waves-effect" >Continue</button>
                                        <button type="button" class="btn btn-danger waves-effect pull-left" data-dismiss="modal">Cancel</button>
                                </div>
                        </form>

                </div>
        </div>


</div>

