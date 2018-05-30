<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content add-more-schedules">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">View Schedule</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">
                        <form id="schedule-daily-rate-update" >

                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6">
                                                <?php
                                                $dddate = '';
                                                if (!empty($schedule)) {
                                                        $dddate = date('d-m-Y', strtotime($schedule->date));
                                                }
                                                ?>
                                                <label>Schedule Date :</label>  <?= $dddate; ?>
                                        </div>

                                        <div class="col-md-6">
                                                <?php
                                                $service = common\models\Service::findOne($schedule->service_id);
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
                                                $patient = common\models\PatientGeneral::findOne($schedule->patient_id);
                                                $patient_id = '';
                                                if (!empty($patient)) {
                                                        $patient_id = $patient->first_name;
                                                }
                                                ?>
                                                <label>Patient :</label>  <?= $patient_id; ?>
                                        </div>

                                        <div class="col-md-6">
                                                <?php
                                                $staff_detail = common\models\StaffInfo::findOne($schedule->staff);
                                                $staff = '';
                                                if (!empty($staff_detail)) {
                                                        $staff = $staff_detail->staff_name;
                                                }
                                                ?>
                                                <label>Staff :</label>  <?= $staff; ?>
                                        </div>

                                </div>

                                <input type="hidden" name="schedule_id" value="<?= $schedule->id ?>" id="schedule_id">


                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6">
                                                <label>Remarks from patient : </label>
                                        </div>
                                        <div class="col-md-6">
                                                <label>Remarks from manager : </label>
                                        </div>
                                </div>


                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6">
                                                <textarea id="page_body2" name="remarks_patient"><?= $schedule->remarks_from_patient; ?></textarea>
                                        </div>

                                        <div class="col-md-6">
                                                <textarea id="page_body1" name="remarks_manager"><?= $schedule->remarks_from_manager; ?></textarea>
                                        </div>
                                </div>


                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-12">
                                                <label>Remarks from staff : </label>
                                        </div>
                                </div>

                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-12">

                                                <textarea id="ckeditor1" name="remarks_staff">

                                                        <?php
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                if (!empty($schedule->remarks_from_staff)) {
                                                                        echo $schedule->remarks_from_staff;
                                                                } else {
                                                                        ?>
                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Notes (patient daignosis and findings) </h3>
                                                                        <?php
                                                                }
                                                        } else {

                                                                echo $schedule->remarks_from_staff;
                                                        }
                                                        ?>
                                                </textarea>
                                        </div>
                                </div>


                                <div class="row" style="margin-left: 0px;margin-top:10px;">
                                        <div class="col-md-12">
                                                <div class="col-md-3">
                                                        <label>Time In : </label>
                                                </div>
                                                <div class="col-md-3">
                                                        <?php if (Yii::$app->user->identity->post_id == '1') { ?>
                                                                <input type="text" id="time_in" name="time_in"  class="fields" value="<?= $schedule->time_in ?>" >
                                                                <?php
                                                        } else {

                                                                echo $schedule->time_in;
                                                        }
                                                        ?>
                                                </div>


                                                <div class="col-md-3">
                                                        <label>Time Out : </label>
                                                </div>
                                                <div class="col-md-3">
                                                        <?php if (Yii::$app->user->identity->post_id == '1') { ?>
                                                                <input type="text" id="time_in" name="time_out"  class="fields" value="<?= $schedule->time_out ?>" >
                                                                <?php
                                                        } else {
                                                                echo $schedule->time_out;
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>

                                <div class="row" style="margin-left: 0px; margin-top:10px;">
                                        <div class="col-md-12">
                                                <div class="col-md-3">
                                                        <label>Daily Rate Patient : </label>
                                                </div>
                                                <div class="col-md-3">
                                                        <?php if (Yii::$app->user->identity->post_id == '1') { ?>
                                                                <input type="text" id="rate_patient" name="rate_patient"  class="fields" value="<?= $schedule->patient_rate ?>" >
                                                                <?php
                                                        } else {
                                                                if (!empty($schedule->patient_rate)) {
                                                                        echo 'Rs.' . $schedule->patient_rate;
                                                                }
                                                        }
                                                        ?>
                                                </div>

                                                <div class="col-md-3">
                                                        <label>Daily Rate Staff : </label>
                                                </div>
                                                <div class="col-md-3">

                                                        <?php if (Yii::$app->user->identity->post_id == '1') {
                                                                ?>
                                                                <input type="text" id="rate" name="rate"  class="fields" value="<?= $schedule->rate ?>" >
                                                                <?php
                                                        } else {

                                                                if (!empty($schedule->rate)) {
                                                                        echo 'Rs.' . $schedule->rate;
                                                                }
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <?php if (Yii::$app->user->identity->post_id == '1') { ?>
                                        <div class="row" style="margin: 10px 5px 0px 0px;float: right;">
                                                <input type="submit" name="update_staff" value="Update" class="btn-primary">
                                        </div>
                                <?php } ?>
                        </form>


                </div>


        </div>


        <style>
                .add-more-schedules label{
                        color: #000;
                        font-weight: bold;
                } #add_schedule{
                        float: right;
                        margin-right: 55px;
                        margin-top: 13px;
                        width: 100px;
                }

        </style>
        <script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>

        <script type="text/javascript">
                CKEDITOR.addCss('h3{font-weight:bold;}');
                CKEDITOR.addCss('h3{text-decoration:underline;}');
                CKEDITOR.replace('ckeditor1',
                        {
                                toolbar: 'Basic', /* this does the magic */
                                height: '100px',
                        });

                CKEDITOR.replace('page_body1',
                        {
                                toolbar: 'Basic', /* this does the magic */
                                height: '100px',
                        });
                CKEDITOR.replace('page_body2',
                        {
                                toolbar: 'Basic', /* this does the magic */
                                height: '100px',
                        });</script>
</script>