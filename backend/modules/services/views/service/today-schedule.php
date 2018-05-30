<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = "Today's Schedules";
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Service</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="service-view">

                                                <div class="table-responsive">

                                                        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">


                                                                <thead>
                                                                        <tr>
                                                                                <?php if (Yii::$app->session['post']['id'] != '5') { ?>
                                                                                        <th style="width:10px;">No</th>
                                                                                        <th>Service ID</th>
                                                                                        <th>Date</th>
                                                                                        <th>Staff on duty</th>
                                                                                        <th>Remarks from patient</th>
                                                                                        <th>Staff Rating</th>
                                                                                        <th>Status</th>
                                                                                <?php } else { ?>
                                                                                        <th style="width:10px;">No</th>
                                                                                        <th>Service ID</th>
                                                                                        <th>Date</th>
                                                                                        <th>Remarks from staff</th>
                                                                                <?php } ?>
                                                                        </tr>
                                                                </thead>


                                                                <tbody>

                                                                        <?php
                                                                        $p = 0;

                                                                        foreach ($services as $value1) {

                                                                                $service_schedules = \common\models\ServiceSchedule::find()->where(['date' => $date_now, 'status' => 1, 'service_id' => $value1->id])->all();
                                                                                foreach ($service_schedules as $value) {
                                                                                        $p++;
                                                                                        ?>
                                                                                        <?php if (Yii::$app->session['post']['id'] != '5') { ?>

                                                                                                <tr  id="<?= $value->id; ?>" style="text-align:center" >

                                                                                                        <td><?= $p; ?></td>


                                                                                                        <td><h5 class="service_name"><?= $value1->service_id ?></h5>
                                                                                                                <?php
                                                                                                                $patient = common\models\PatientGeneral::findOne($value1->patient_id);
                                                                                                                echo'(' . $patient->first_name . ')';
                                                                                                                ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <?php
                                                                                                                if (isset($value->date) && $value->date != '' && $value->date != '1970-01-01') {
                                                                                                                        $date = date('d-m-Y', strtotime($value->date));
                                                                                                                } else {
                                                                                                                        $date = '';
                                                                                                                }
                                                                                                                echo DatePicker::widget([
                                                                                                                    'name' => 'date',
                                                                                                                    'id' => 'schedule_date-' . $value->id,
                                                                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                                                                    'value' => $date,
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose' => true,
                                                                                                                        'format' => 'dd-mm-yyyy',
                                                                                                                    ],
                                                                                                                    'options' => [
                                                                                                                        'class' => 'schedule-update-date ' . $class . '',
                                                                                                                    ]
                                                                                                                ]);
                                                                                                                ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <?php
                                                                                                                if (isset($value->staff)) {
                                                                                                                        $staff = StaffInfo::findOne($value->staff);
                                                                                                                        $staff_on_duty = $staff->staff_name;
                                                                                                                } else {
                                                                                                                        $staff_on_duty = '';
                                                                                                                }
                                                                                                                if (isset($value->status) && $value->status != '') {
                                                                                                                        if ($value->status == 2) {
                                                                                                                                $stat = 1;
                                                                                                                        } else {
                                                                                                                                $stat = 0;
                                                                                                                        }
                                                                                                                } else {
                                                                                                                        $stat = 0;
                                                                                                                }
                                                                                                                ?>

                                                                                                                <input type="text" val='<?= $value->staff ?>' value="<?= $staff_on_duty; ?>" name="staff_on_duty" class="form-control staff_duty_<?= $value->service_id; ?>_<?= $stat ?>  <?= $class ?>" id="staff_on_duty_<?= $value->id ?>" readonly="true">
                                                                                                                <?php if ($staff_on_duty != '') { ?> <a id="<?= $value->id ?>" title="Remove Staff" style="cursor:pointer" class="remove-staff"><i class="fa fa-times absent" aria-hidden="true" style="color:red"></i></a>  <a target="_blank"  href="<?= Yii::$app->homeUrl ?>/staff/staff-info/choose?branch=<?= $value1->branch_id; ?>&&gender=<?= $value1->gender_preference; ?>&&service=<?= $value1->id; ?>&&type=2&&schedule=<?= $value->id; ?>&&replace=1" id="<?= $value->id; ?>" type="1"  class="staff-allotment <?= $class1 ?>">Replace staff</a><?php } else { ?>
                                                                                                                        <a target="_blank"  href="<?= Yii::$app->homeUrl ?>/staff/staff-info/choose?branch=<?= $value1->branch_id; ?>&&gender=<?= $value1->gender_preference; ?>&&service=<?= $value1->id; ?>&&type=2&&schedule=<?= $value->id; ?>&&replace=0" id="<?= $value->id; ?>" type="2" class="staff-allotment">Add staff</a>
                                                                                                                <?php } ?>
                                                                                                        </td>


                                                                                                        <td>

                                                                                                                <textarea class="form-control schedule-update <?= $class ?>" name="remarks_from_patient" id="remarks_from_patient-<?= $value->id; ?>">
                                                                                                                        <?php
                                                                                                                        if (isset($value->remarks_from_patient) && $value->remarks_from_patient != '') {
                                                                                                                                echo $value->remarks_from_patient;
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                </textarea>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <select class="form-control schedule-rating <?= $class ?>" id="<?= $value->id; ?>">
                                                                                                                        <option value="">-Select Rating-</option>
                                                                                                                        <option value="9" <?php
                                                                                                                        if ($value->rating == '9') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Excellent</option>
                                                                                                                        <option value="8" <?php
                                                                                                                        if ($value->rating == '8') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Very Good</option>
                                                                                                                        <option value="7" <?php
                                                                                                                        if ($value->rating == '7') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Satisfactory</option>
                                                                                                                        <option value="6" <?php
                                                                                                                        if ($value->rating == '6') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Good</option>
                                                                                                                        <option value="5" <?php
                                                                                                                        if ($value->rating == '5') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Average</option>
                                                                                                                        <option value="4" <?php
                                                                                                                        if ($value->rating == '4') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Unsatisfactory</option>
                                                                                                                        <option value="3" <?php
                                                                                                                        if ($value->rating == '3') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Bad</option>
                                                                                                                        <option value="2" <?php
                                                                                                                        if ($value->rating == '2') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Very Bad</option>
                                                                                                                        <option value="1" <?php
                                                                                                                        if ($value->rating == '1') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Very Poor</option>
                                                                                                                </select>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <select name="status" id="status_<?= $value->id; ?>" class="form-control schedule-update status-update <?= $class ?>">

                                                                                                                        <option value="1" <?php
                                                                                                                        if ($value->status == '1') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Pending</option>

                                                                                                                        <option value="2" <?php
                                                                                                                        if ($value->status == '2') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Completed</option>
                                                                                                                        <option value="3" <?php
                                                                                                                        if ($value->status == '3') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Interrupted</option>
                                                                                                                        <option value="4" <?php
                                                                                                                        if ($value->status == '4') {
                                                                                                                                echo 'selected';
                                                                                                                        }
                                                                                                                        ?>>Cancelled</option>
                                                                                                                </select>
                                                                                                        </td>


                                                                                                </tr>
                                                                                        <?php } else {
                                                                                                ?>
                                                                                                <tr  id="<?= $value->id; ?>" style="text-align:center">
                                                                                                        <td><?= $p; ?></td>

                                                                                                        <td><h5 class="service_name"><?= $value1->service_id ?></h5>
                                                                                                                <?php
                                                                                                                $patient = common\models\PatientGeneral::findOne($value1->patient_id);
                                                                                                                echo'(' . $patient->first_name . ')';
                                                                                                                ?>
                                                                                                        </td>

                                                                                                        <td><?php
                                                                                                                if (isset($value->date) && $value->date != '') {
                                                                                                                        $date = date('d-m-Y', strtotime($value->date));
                                                                                                                } else {
                                                                                                                        $date = '';
                                                                                                                }
                                                                                                                echo DatePicker::widget([
                                                                                                                    'name' => 'date',
                                                                                                                    'id' => 'schedule_date-' . $value->id,
                                                                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                                                                    'value' => $date,
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose' => true,
                                                                                                                        'format' => 'dd-mm-yyyy',
                                                                                                                    ],
                                                                                                                    'options' => [
                                                                                                                        'style' => 'pointer-events:none',
                                                                                                                    ]
                                                                                                                ]);
                                                                                                                ?>
                                                                                                        </td>

                                                                                                        <td class="sas">

                                                                                                               <button class="btn btn-gray" style="margin: 15px 0px 0px 30px;float: left;"><a id="<?= $value->id ?>" class="remarks_Staff"><?php if (!isset($value->remarks_from_staff) && $value->remarks_from_staff == '') { ?> Add Remarks<?php } else { ?> View Remarks<?php } ?></a></button>
                                                                                                        </td>

                                                                                                </tr>

                                                                                                <?php
                                                                                        }
                                                                                }
                                                                        }
                                                                        ?>
                                                                </tbody>


                                                        </table>


                                                </div>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>




<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replaceClass = 'remarks_staff';

</script>

<style>
        .form-control{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .staff-allotment{
                float:right;
                color:#0e62c7;
                cursor: pointer;
        }
        table td{
                padding: 0 !important;
        }
        table td .sorting_1{
                text-align: center !important;
        }
        #example-1_filter{
                display: none;
        }.dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }.sorting_1{
                text-align: center;
        }.completed{
                background-color: #f6eeee !important;
                pointer-events: none;
        }.completed-admin{
                background-color: #f6eeee !important;
        }
        .hide-class{
                display: none !important;
        }.view_schedule{
                pointer-events: auto;
                cursor: pointer;
                color: #000!important;
        }.service_name{
                font-weight: bold;
                color: #008cbd;
                text-align: left;
                text-transform: uppercase;
                margin-left: 10px;
        }
        .cke_contents{
                height:210px !important;
        }.remove-staff{
                float: right;
                top: -30px;
                right: 10px;
                position: relative;
        }


</style>