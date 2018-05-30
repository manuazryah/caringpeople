<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\StaffInfo;
use common\models\Service;
use common\models\ServiceSchedule;

$this->title = 'Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="attendance-create">


                                                <div class="attendance-form form-inline">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    //   "endDate" => (string) date('d/m/Y'),
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?php $branch = Branch::Branch();
                                                                ?>
                                                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--', 'id' => 'report-patient-branch']); ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?php
                                                                if (isset($model->rating)) {
                                                                        $patients = \common\models\PatientGeneral::find()->where(['branch_id' => $model->rating, 'status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
                                                                } else {
                                                                        $patients = [];
                                                                }
                                                                ?>
                                                                <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'first_name'), ['prompt' => '--Select--', 'id' => 'report-patient']) ?>
                                                        </div>

                                                        <?php
                                                        $style = 'display:none;';
                                                        if (isset($model->patient_id)) {
                                                                $services = Service::find()->where(['patient_id' => $model->patient_id])->all();
                                                                if (count($services) > 1)
                                                                        $style = 'display:show;';
                                                        } else {
                                                                $services = [];
                                                        }

                                                        $list = ArrayHelper::map($services, 'id', 'service_id');
                                                        $data = ['0' => 'All'];
                                                        $list = $data + $list;
                                                        ?>

                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd report-services' style="<?= $style ?>">

                                                                <?= $form->field($model, 'service_id')->dropDownList($list, ['prompt' => '--Select--', 'id' => 'report-services']); ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div style="clear:both"></div>

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($report) && $report != '') { ?>

                                                        <p class="counts1">
                                                                Patient : <span><?php
                                                                        if (isset($model->patient_id) && $model->patient_id != '') {
                                                                                $patient_detail = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                                echo $patient_detail->first_name;
                                                                        }
                                                                        ?></span>
                                                        </p>

                                                        <div class="row" style="margin:10px 0px 0px 0px;">

                                                                <?php
                                                                $from = date('Y-m-d', strtotime($model->date));
                                                                $to = date('Y-m-d', strtotime($model->DOC));
                                                                $m = 0;
                                                                foreach ($patient_services as $patient_services) {
                                                                        $m++;
                                                                        $schedule = Service::findOne($patient_services->service_id);
                                                                        $total_schedules = ServiceSchedule::find()->where(['service_id' => $patient_services->service_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->count();
                                                                        $total_completed_schedules = ServiceSchedule::find()->where(['service_id' => $patient_services->service_id, 'status' => 2])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->count();
                                                                        ?>
                                                                        <div class="col-md-4 col-sm-6 col-xs-12 left_padd service_detail">
                                                                                <span class="counts">
                                                                                        Service    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <label class="label-1"> : </label> &nbsp;<span> <?= $schedule->service_id; ?><br></span>
                                                                                        Total Schedules &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <label> : </label> &nbsp;<span> <?= $total_schedules; ?>  <br></span>
                                                                                        Completed Schedules  <label> : </label> &nbsp;<span><?= $total_completed_schedules ?> <br>
                                                                                        </span>

                                                                                </span>

                                                                        </div>
                                                                <?php } ?>

                                                        </div>


                                                        <div class = "table-responsive">
                                                                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>DATE</th>
                                                                        <th>SERVICE</th>
                                                                        <th>STAFF</th>
                                                                        <th>REMARKS</th>
                                                                        <th>TIME IN</th>
                                                                        <th>TIME OUT</th>
                                                                        <th>RATE</th>
                                                                        <th>STATUS</th>


                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $k = 0;
                                                                                foreach ($report as $value) {
                                                                                        $k++;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>

                                                                                                <td><?= date('d-m-Y', strtotime($value->date)) ?></td>

                                                                                                <?php $service = Service::findOne($value->service_id) ?>
                                                                                                <td><?= $service->service_id ?></td>

                                                                                                <td><?php
                                                                                                        if (isset($value->staff) && $value->staff != '') {
                                                                                                                $staff = StaffInfo::findOne($value->staff);
                                                                                                                echo $staff->staff_name;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->remarks_from_manager) && $value->remarks_from_manager != '') {
                                                                                                                echo $value->remarks_from_manager;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->time_in) && $value->time_in != '') {
                                                                                                                echo $value->time_in;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->time_out) && $value->time_out != '') {
                                                                                                                echo $value->time_out;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->patient_rate) && $value->patient_rate != '') {
                                                                                                                echo $value->patient_rate;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td><?php if ($value->status == 2) { ?>
                                                                                                                <i class="fa fa-check present" aria-hidden="true"></i>
                                                                                                                <?php
                                                                                                        } else {
                                                                                                                if ($value->status == 1) {
                                                                                                                        $status = 'Pending';
                                                                                                                } else if ($value->status == 3) {
                                                                                                                        $status = 'Interrupted';
                                                                                                                } else if ($value->status == 4) {
                                                                                                                        $status = 'Cancelled';
                                                                                                                } else {
                                                                                                                        $status = '';
                                                                                                                }
                                                                                                                ?>
                                                                                                                <a title="<?= $status ?>"><i class="fa fa-times absent" aria-hidden="true"></i></a>
                                                                                                        <?php } ?>
                                                                                                </td>

                                                                                        </tr>
                                                                                <?php } ?>

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->patient_id) && $model->patient_id != '') {
                                                                echo '<p class="no-result">No results found !!</p>';
                                                        }
                                                }
                                                ?>


                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .form-control{
                border: none;
        }.table-responsive{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }#example-1_filter{
                display: none;
        }
        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1{
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }.label-1{
                margin-left: 48px;
        }
</style>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.min.js"></script>

<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
        $(document).ready(function ($)
        {
                $("#example-1").dataTable({
                        aLengthMenu: [
                                [20, 50, 100, -1], [20, 50, 100, "All"]
                        ]
                });
        });
</script>

<?php

function divadjust($k) {
        if ($k % 3 == 0) {
                echo '</div><div class="row">';
        }
        return;
}
?>