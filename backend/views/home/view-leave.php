
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Doctor;
use common\models\Location;
use common\models\Pro;
?>
<style>
        .fa-ban:before {
                content: "\f05e";
                font-size: 20px;
        }
</style>
<section id="login-box">
        <div class="container">
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 shadow">
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">Leave Status</h3>
                                <?php
                                if (!empty($model)) {
                                        ?>
                                        <?php foreach ($model as $value) { ?>
                                                <section id="notification">
                                                        <div class="container">
                                                                <div class="row">
                                                                        <div class="col-md-12 notify-box">
                                                                                <table>
                                                                                        <tr>
                                                                                                <td>Staff Name</td>
                                                                                                <td>:</td>
                                                                                                <td><?= common\models\StaffInfo::findOne($value->employee_id)->staff_name; ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Leave From</td>
                                                                                                <td>:</td>
                                                                                                <td><?= date('d-m-Y', strtotime($value->commencing_date)); ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Leave To</td>
                                                                                                <td>:</td>
                                                                                                <td><?= date('d-m-Y', strtotime($value->ending_date)); ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Number of Days</td>
                                                                                                <td>:</td>
                                                                                                <td><?= $value->no_of_days; ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Nature of Leave</td>
                                                                                                <td>:</td>
                                                                                                <td><?= $value->leave_type; ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Purpose</td>
                                                                                                <td>:</td>
                                                                                                <td><?= $value->purpose; ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Leave Application Date</td>
                                                                                                <td>:</td>
                                                                                                <td><?= date('d-m-Y', strtotime($value->DOC)); ?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        if ($value->admin_comment != '') {
                                                                                                ?>
                                                                                                <tr>
                                                                                                        <td style="font-weight:bold;">Comments</td>
                                                                                                        <td></td>
                                                                                                        <td><span  style="font-weight:bold;"><?= $value->admin_comment; ?></span></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                        }
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td colspan="3">
                                                                                                        <?php if ($value->status == 1) { ?>
                                                                                                                <button class="btn-pending">Pending</button>
                                                                                                                <!--<span style="float:right;"><i class="fa fa-clock-o status-pending" aria-hidden="true"></i></span>-->
                                                                                                        <?php }
                                                                                                        ?>
                                                                                                        <?php if ($value->status == 2) { ?>
                                                                                                                <button class="btn-approved">Approved</button>
                                                                                                                <!--<span style="float:right;"><i class="fa fa-check status-approve" aria-hidden="true"></i></span>-->
                                                                                                        <?php }
                                                                                                        ?>
                                                                                                        <?php if ($value->status == 3) { ?>
                                                                                                                <button class="btn-rejected">Rejected</button>
                                                                                                                <!--<span style="float:right;"><i class="fa fa-times status-reject" aria-hidden="true"></i></span>-->
                                                                                                        <?php }
                                                                                                        ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                </table>

                                                                        </div>
                                                                </div>
                                                        </div>
                                                </section>
                                                <?php
                                        }
                                }
                                ?>
                        </div>
                        <div class="col-md-3"></div>
                </div>
        </div>
</section>

<style>
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                border: 1px solid #ddd;
                text-align: center;
        }
        .fa-globe:before {
                content: "\f0ac";
                font-size: 20px;
        }
        .btn-pending{
                background-color: orange;
                margin: 11px 0px;
                float: right;
                color: white;
        }
        .btn-approved{
                background-color: green;
                margin: 11px 0px;
                float: right;
                color: white;
        }
        .btn-rejected{
                background-color: red;
                margin: 11px 0px;
                float: right;
                color: white;
        }

</style>
