<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content add-more-schedules">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Add Schedules</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">
                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <?php
                                        $patient_name = '';
                                        $patient = common\models\PatientGeneral::findOne($service->patient_id);
                                        if (!empty($patient)) {
                                                $patient_name = $patient->first_name;
                                        }
                                        ?>
                                        <label>Patient: </label> <?= $patient_name; ?>
                                </div>
                                <div class="col-md-6">
                                        <?php
                                        $duty_type = '';
                                        $label = '';
                                        if (isset($service->duty_type)) {
                                                if ($service->duty_type == 1) {
                                                        $duty_type = 'Hourly';
                                                        $label = 'Hours';
                                                } else if ($service->duty_type == 2) {
                                                        $duty_type = 'Visit';
                                                        $label = 'No.of visits';
                                                } else if ($service->duty_type == 3) {
                                                        $duty_type = 'Day';
                                                        $label = 'Days';
                                                } else if ($service->duty_type == 4) {
                                                        $duty_type = 'Night';
                                                        $label = 'Days';
                                                } else if ($service->duty_type == 5) {
                                                        $duty_type = 'Day & Night';
                                                        $label = 'Days';
                                                }
                                        }
                                        ?>
                                        <label>Duty Type : </label> <?= $duty_type; ?>
                                </div>


                        </div>


                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <?php
                                        $frequency = '';
                                        $count = '';
                                        if (isset($service->frequency)) {
                                                if ($service->frequency == 1) {
                                                        $frequency = 'Daily';
                                                        $count = 'days';
                                                } else if ($service->frequency == 2) {
                                                        $frequency = 'Weekely';
                                                        $count = 'weeks';
                                                } else if ($service->frequency == 3) {
                                                        $frequency = 'Monthly';
                                                        $count = 'months';
                                                }
                                        }
                                        ?>
                                        <label>Frequency : </label> <?= $frequency; ?>
                                </div>

                                <div class="col-md-6">
                                        <label> No:of <?= $count ?> : </label> <?= $service->days; ?>
                                </div>
                        </div>


                        <?php if (isset($service->hours) && $service->hours != '') { ?>
                                <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6">
                                                <label><?= $label ?> : </label> <?= $service->hours; ?>
                                        </div>
                                </div>
                        <?php } ?>


                        <br>
                        <div class="row" style="margin-left: 0px;">
                                <form id="add-schedules">

                                        <input type="hidden" id="service_id" name="service_id" value="<?= $service->id ?>">
                                        <input type="hidden" id="patient_id" name="patient_id" value="<?= $service->patient_id ?>">
                                        <input type="hidden" id="duty_type" name="duty_type" value="<?= $service->duty_type ?>">
                                        <input type="hidden" id="frequency" name="frequency" value="<?= $service->frequency ?>">
                                        <input type="hidden" id="hours" name="hours" value="<?= $service->hours ?>">
                                        <input type="hidden" id="days" name="days" value="<?= $service->days ?>">

                                        <div class="row" style="margin-left: 0px;">
                                                <div class="col-md-6">
                                                        <label>How many more schedules you wish to add?     </label>
                                                </div>
                                                <div class="col-md-6">
                                                        <input type="text" name="no_of_days" id="no_of_days" required>
                                                </div>
                                        </div>

                                       <div class="row" style="margin: 10px 0px 0px 15px;">
                                                <div class="col-md-6">
                                                </div>
                                                <div class="col-md-6">
                                                        <input type="checkbox" name="change_price" id="chnage_price">  Change in estimated price
                                                </div>
                                        </div>



                                        <div class="row">
                                                <input type="submit" name="add_schedule" id="add_schedule" value="Add" class="btn btn-primary">
                                        </div>

                                </form>
                        </div>

                </div>
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
