<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Add Daily Rate</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">



                        <form id="schedule-daily-rate" >

                                <input type="hidden" name="scheduleid" id="scheduleid" value="<?= $schedule_id ?>">
                                <input type="hidden" name="status" id="status" value="<?= $status ?>">
                                <?php
                                $service_schedule = common\models\ServiceSchedule::findOne($schedule_id);
                                $service = common\models\Service::findOne($service_schedule->service_id);
                                ?>
                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6">
                                                <?php
                                                $dddate = '';
                                                if (!empty($service_schedule)) {
                                                        $dddate = date('d-m-Y', strtotime($service_schedule->date));
                                                }
                                                ?>
                                                <label>Schedule Date :</label>  <?= $dddate; ?>
                                        </div>

                                        <div class="col-md-6">
                                                <?php
                                                $service_id = '';
                                                if (!empty($service)) {
                                                        $service_id = $service->service_id;
                                                }
                                                ?>
                                                <label>Service :</label>  <?= $service_id; ?>
                                        </div>



                                </div>

                                <div class="row" style="margin-left: 0px;">


                                        <div class="col-md-6">
                                                <?php
                                                $patient = common\models\PatientGeneral::findOne($service_schedule->patient_id);
                                                $patient_id = '';
                                                if (!empty($patient)) {
                                                        $patient_id = $patient->first_name;
                                                }
                                                ?>
                                                <label>Patient :</label>  <?= $patient_id; ?>
                                        </div>

                                        <div class="col-md-6">
                                                <?php
                                                $staff_detail = common\models\StaffInfo::findOne($service_schedule->staff);
                                                $staff = '';
                                                if (!empty($staff_detail)) {
                                                        $staff = $staff_detail->staff_name;
                                                }
                                                ?>
                                                <label>Staff :</label>  <?= $staff; ?>
                                        </div>

                                </div>


                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Staff :</label>
                                                </div>

                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">

                                                <textarea id="ckeditor" class="remarks_staff" name="remarks_staff">
                                                        <?php
                                                        if (Yii::$app->user->identity->post_id == '1' && !empty($schedule->remarks_from_staff)) {
                                                                echo $schedule->remarks_from_staff;
                                                        } else {
                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Notes (patient daignosis and findings) </h3>
                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Prescription   </h3>
                                                        <?php } ?>
                                                </textarea>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Patient :</label>
                                                </div>

                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Manager :</label>
                                                </div>

                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">


                                                <textarea  class="fields" name="remarks_patient" id="remarks_patient"><?php
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                echo $schedule->remarks_from_patient;
                                                        }
                                                        ?></textarea>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea  class="fields" name="remarks_manager" id="page_body"><?php
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                echo $schedule->remarks_from_manager;
                                                        }
                                                        ?></textarea>
                                        </div>


                                </div>







                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-3">
                                                        <label>Time In :</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="time" id="time_in" name="time_in"  class="fields" <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->time_in ?>" <?php } ?>>
                                                </div>


                                                <div class="col-md-3">
                                                        <label>Time Out :</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="time" id="time_out" name="time_out"  class="fields" <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->time_out ?>" <?php } ?>>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <?php
                                                $patient_rate = 0;
                                                $previous_rate = \common\models\ServiceSchedule::find()->where(['<', 'id', $schedule_id])->andWhere(['service_id' => $service_schedule->service_id])->orderBy(['id' => SORT_DESC])->limit(1)->one();
                                                if (Yii::$app->user->identity->post_id == '1') {
                                                        if (isset($schedule->patient_rate) && $schedule->patient_rate != 0) {
                                                                $patient_rate = $schedule->patient_rate;
                                                        } else {
                                                                $patient_rate = $previous_rate->patient_rate;
                                                        }
                                                } else {
                                                        $patient_rate = $previous_rate->patient_rate;
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                        <label>Daily Rate Patient:</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="text" id="rate_patient" name="rate_patient"  class="fields" value="<?= $patient_rate ?>" >
                                                </div>


                                                <div class="col-md-3">
                                                        <label>Daily Rate Staff:</label>
                                                </div>

                                                <?php
                                                $rate = 0;
                                                if (Yii::$app->user->identity->post_id == '1') {
                                                        if (isset($schedule->rate) && $schedule->rate != 0) {
                                                                $rate = $schedule->rate;
                                                        } else {
                                                                $rate = $previous_rate->rate;
                                                        }
                                                } else {
                                                        $rate = $previous_rate->rate;
                                                }
                                                ?>

                                                <div class="col-md-3">
                                                        <input type="text" id="rate" name="rate"  class="fields"  value="<?= $rate ?>">
                                                </div>
                                        </div>
                                </div>

                                <?php if ($service->co_worker == '1') { ?>
                                        <div class="row">
                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="col-md-4">
                                                                <label>Co-worker:</label>
                                                        </div>
                                                        <?php
                                                        $co_worker = common\models\StaffInfo::find()->where(['<>', 'post_id', '5'])->andWhere(['<>', 'post_id', '1'])->andWhere(['status' => 1, 'branch_id' => $service->branch_id])->all();
                                                        ?>
                                                        <div class="col-md-8">
                                                                <?= Html::dropDownList('co_worker', null, ArrayHelper::map($co_worker, 'id', 'staff_name'), ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'oc_worker', 'style' => 'border: 1px solid #a9a9a9;']); ?>
                                                        </div>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if ($status != 2) { ?>

                                        <div class="row" style="margin: 0;">

                                                <div class="col-md-6">
                                                        <input type="checkbox" name="change_price" id="chnage_price">  Change in estimated price
                                                </div>
                                        </div>
                                <?php } ?>


                                <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">

                                <!--<button type="button" class="btn btn-info" data-dismiss="modal" style="float: right;margin-top: 20px;">Continue</button>-->
                        </form>
                </div>
        </div>


</div>


<style>
        .fields{
                width:100%;
        }
        .row{
                margin-bottom: 10px;
        }

</style>




<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replace('ckeditor',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',

                });
        CKEDITOR.replace('page_body',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',
                });
        CKEDITOR.replace('remarks_patient',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',
                });</script>

