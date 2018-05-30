<?php

use yii\helpers\Html;
?>


<div class="panel-group" id="accordion-test-2">
        <div class="panel panel-default collapse-patient-details">
                <div class="panel-heading collapse-patient-heading">
                        <h4 class="panel-title panel-default">
                                <!--<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" class="collapsed">-->
                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2">
                                        Service Details
                                </a>
                        </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse in patient-details-content">
                        <div class="panel-body">
                                <div class="row patient-details-specific">
                                        <div class="col-md-6">
                                                <h4>Patient Details</h4>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Patient ID</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->patient_id; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Patient Name</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->first_name; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Gender</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?php
                                                                        if (isset($model->patient->gender)) {
                                                                                if ($model->patient->gender == 0) {
                                                                                        echo 'Male';
                                                                                } else if ($model->patient->gender == 1) {
                                                                                        echo 'Female';
                                                                                }
                                                                        }
                                                                        ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Age</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->age; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Conatct Number</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->contact_number; ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <h4>Service Details</h4>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service ID</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->service_id; ?> </span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service Required</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->service0->service_name; ?> </span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Staff Manager</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->staffManager->staff_name; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service From</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= date('d-m-Y', strtotime($model->from_date)) ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service To</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= date('d-m-Y', strtotime($model->to_date)) ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


