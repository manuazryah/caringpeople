<?php

use yii\helpers\Html;

$service = common\models\Service::findOne($service);
?>


<div class="panel-group" id="accordion-test-2">
        <div class="panel panel-default collapse-patient-details">
                <div class="panel-heading collapse-patient-heading">
                        <h4 class="panel-title panel-default">
                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" class="collapsed">
                                        Service Details
                                </a>
                        </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse patient-details-content">
                        <div class="panel-body">
                                <div class="row patient-details-specific">
                                        <div class="col-md-6">

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service ID</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $service->service_id; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Duty Type</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?php
                                                                        if (isset($service->duty_type)) {
                                                                                if ($service->duty_type == 1) {
                                                                                        echo 'Hourly';
                                                                                } else if ($service->duty_type == 2) {
                                                                                        echo 'Visit';
                                                                                } else if ($service->duty_type == 3) {
                                                                                        echo 'Day';
                                                                                } else if ($service->duty_type == 4) {
                                                                                        echo 'Night';
                                                                                } else if ($service->duty_type == 5) {
                                                                                        echo 'Day & Night';
                                                                                }
                                                                        }
                                                                        ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Estimated Price</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $service->estimated_price; ?></span>
                                                        </div>
                                                </div>


                                        </div>
                                        <div class="col-md-6">

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <?php
                                                                $service_name = common\models\MasterServiceTypes::findOne($service->service);
                                                                $subservice_name = '';
                                                                if (isset($service->sub_service)) {
                                                                        $subservice = \common\models\SubServices::findOne($service->sub_service);
                                                                        $subservice_name = $subservice->sub_service;
                                                                }
                                                                ?>
                                                                <span><?= $service_name->service_name; ?> <?php if (isset($subservice_name) && $subservice_name != '') { ?>( <?= $subservice_name ?> )<?php } ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Staff Manager</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $service->staffManager->staff_name; ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<style>
        .collapse-patient-heading{
                background: #b4bec6 !important;
                padding: 10px !important;
                color: #FFF !important;
        } .collapse-patient-details{
                padding: 0px 9px !important;
                margin-top: 15px;
        }
        .collapse-patient-heading h4{
                /*                color: #FFF !important;*/
        }
        .patient-details-content label{
                color: #555;
                font-weight: bold;
        }
        .patient-details-specific .row{
                margin-left: 0px !important;;
        }.panel{
                border: none !important;
        }.panel .panel-heading>.panel-title {
                float: left;
                font-size: 17px;
                text-transform: uppercase;
                font-weight: bold;
                color: #b60d14;
        }
</style>
