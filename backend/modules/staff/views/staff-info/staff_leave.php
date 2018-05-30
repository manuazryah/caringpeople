<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = 'Staff Leave Details';
$this->params['breadcrumbs'][] = ['label' => 'Staff Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$staff_detail = common\models\StaffInfo::findOne($staff);

if (!empty($today)) {
        $detail = "Today  $staff_detail->staff_name is on leave";
} else if ($staff_detail->working_status == 0) {
        $detail = "Today  $staff_detail->staff_name is on bench";
} else {
        $detail = "Today  $staff_detail->staff_name is on duty ";
}
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">

                                <div class="panel-body">
                                        <div class="patient-enquiry-general-first-view">
                                                <p style="color: #000;font-style: italic"><span style="color: red">* </span> <?= $detail ?></p>
                                                <ul class="nav nav-tabs">
                                                        <li class="active">
                                                                <a href="#upcoming" data-toggle="tab">
                                                                        <span class="visible-xs"><i class="fa-home"></i></span>
                                                                        <span class="hidden-xs">Upcoming Leaves</span>
                                                                </a>
                                                        </li>

                                                        <li>
                                                                <a href="#previous" data-toggle="tab">
                                                                        <span class="visible-xs"><i class="fa-user"></i></span>
                                                                        <span class="hidden-xs">Previous Leaves</span>
                                                                </a>
                                                        </li>

                                                </ul>

                                                <div class="tab-content">
                                                        <div class="tab-pane active" id="upcoming">

                                                                <div>
                                                                        <?php
                                                                        if (!empty($upcoming_leaves)) {
                                                                                ?>

                                                                                <table class="table table-bordered table-striped">
                                                                                        <thead>
                                                                                        <th>No</th>
                                                                                        <th>Date</th>
                                                                                        <th>Leave</th>
                                                                                        <th>Status</th>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $l = 0;
                                                                                        foreach ($upcoming_leaves as $upcoming_leaves) {
                                                                                                $l++;
                                                                                                ?>
                                                                                                <tr>
                                                                                                        <td><?= $l ?></td>
                                                                                                        <td><?= date('d-m-Y', strtotime($upcoming_leaves->commencing_date)) ?></td>
                                                                                                        <td><?php
                                                                                                                $leave = common\models\MasterLeaveType::findOne($upcoming_leaves->leave_type);
                                                                                                                echo $leave->type;
                                                                                                                ?></td>
                                                                                                        <td><?php
                                                                                                                if ($upcoming_leaves->status == 1) {
                                                                                                                        echo "Pending";
                                                                                                                } elseif ($upcoming_leaves->status == 2) {
                                                                                                                        echo "<span style='color:green'>Approved</span>";
                                                                                                                } elseif ($upcoming_leaves->status == 3) {
                                                                                                                        echo "Declined";
                                                                                                                } else {
                                                                                                                        echo "";
                                                                                                                }
                                                                                                                ?></td>
                                                                                                </tr>
                                                                                        <?php } ?>

                                                                                </table>

                                                                                <?php
                                                                        } else {
                                                                                echo '<p style="color:red;text-align:center">No Upcoming leaves !!</p>';
                                                                        }
                                                                        ?>
                                                                </div>

                                                        </div>
                                                        <div class="tab-pane" id="previous">
                                                                <?php
                                                                if (!empty($staff_previous_leaves)) {
                                                                        ?>

                                                                        <table class="table table-bordered table-striped">
                                                                                <thead>
                                                                                <th>No</th>
                                                                                <th>Date</th>
                                                                                <th>Leave</th>
                                                                                <th>Status</th>
                                                                                </thead>
                                                                                <?php
                                                                                $l = 0;
                                                                                foreach ($staff_previous_leaves as $staff_previous_leaves) {
                                                                                        $l++;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $l ?></td>
                                                                                                <td><?= date('d-m-Y', strtotime($staff_previous_leaves->commencing_date)) ?></td>
                                                                                                <td><?php
                                                                                                        $leave = common\models\MasterLeaveType::findOne($staff_previous_leaves->leave_type);
                                                                                                        echo $leave->type;
                                                                                                        ?></td>
                                                                                                <td><?php
                                                                                                        if ($staff_previous_leaves->status == 1) {
                                                                                                                echo "Pending";
                                                                                                        } elseif ($staff_previous_leaves->status == 2) {
                                                                                                                echo "<span style='color:green'>Approved</span>";
                                                                                                        } elseif ($staff_previous_leaves->status == 3) {
                                                                                                                echo "Declined";
                                                                                                        } else {
                                                                                                                echo "";
                                                                                                        }
                                                                                                        ?></td>
                                                                                        </tr>
                                                                                <?php } ?>

                                                                        </table>

                                                                        <?php
                                                                } else {
                                                                        echo '<p style="color:red;text-align:center">No Previous leaves !!</p>';
                                                                }
                                                                ?>
                                                        </div>

                                                </div>






                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
