<?php

use yii\helpers\Html;

$sstart_date = date('Y') . '-' . date('m') . '-01';
$eend_date = date('Y') . '-' . date('m') . '-31';
?>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/fonts/meteocons/css/meteocons.css">

<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/xenon-widgets.js"></script>


<?php
$sales_masters = \common\models\SalesInvoiceMaster::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
$purchase_masters = \common\models\PurchaseInvoiceMaster::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();

$sale_max = \common\models\SalesInvoiceMaster::find()->orderBy(['sales_invoice_date' => SORT_DESC])->one();

if (!empty($sale_max)) {
        $sale_date = date("Y-m-d", strtotime($sale_max->sales_invoice_date));
        $sale_amounts = (new \yii\db\Query())
                ->select(['SUM(CASE WHEN status = 1 THEN order_amount ELSE 0 END) as sale_order_amount,SUM(CASE WHEN status = 1 THEN amount_payed ELSE 0 END) as sale_amount_payed,SUM(CASE WHEN status = 1 THEN due_amount ELSE 0 END) as sale_due_amount'])
                ->from('sales_invoice_master')
                ->where(['date(sales_invoice_date)' => $sale_date])
                ->all();
} else {
        $sale_amounts[0] = array('sale_order_amount' => 0, 'sale_amount_payed' => 0, 'sale_due_amount' => 0);
        $sale_date = date("Y-m-d");
}
$purchase_max = \common\models\PurchaseInvoiceMaster::find()->orderBy(['sales_invoice_date' => SORT_DESC])->one();
if (!empty($purchase_max)) {
        $purchase_date = date("Y-m-d", strtotime($purchase_max->sales_invoice_date));
        $purchase_amounts = (new \yii\db\Query())
                ->select(['SUM(CASE WHEN status = 1 THEN order_amount ELSE 0 END) as purchase_order_amount,SUM(CASE WHEN status = 1 THEN amount_payed ELSE 0 END) as purchase_amount_payed,SUM(CASE WHEN status = 1 THEN due_amount ELSE 0 END) as purchase_due_amount'])
                ->from('purchase_invoice_master')
                ->where(['date(sales_invoice_date)' => $purchase_date])
                ->all();
} else {
        $purchase_amounts[0] = array('purchase_order_amount' => 0, 'purchase_amount_payed' => 0, 'purchase_due_amount' => 0);
        $purchase_date = date("Y-m-d");
}

if (Yii::$app->user->identity->branch_id != '0') {
        $invoices = \common\models\Invoice::find()->where(['branch_id' => Yii::$app->user->identity->branch_id, 'status' => 1])->orderBy(['DOC' => SORT_DESC])->one();
        $invoice_paid_date = date("d-M-Y", strtotime($invoices->DOC));
        $invoices = \common\models\Invoice::find()->where(['DOC' => $invoices->DOC, 'status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id,])->sum('amount');
} else {
        $invoices = \common\models\Invoice::find()->where(['status' => 1])->orderBy(['DOC' => SORT_DESC])->one();
        $invoice_paid_date = date("d-M-Y", strtotime($invoices->DOC));
        $invoices = \common\models\Invoice::find()->where(['DOC' => $invoices->DOC, 'status' => 1])->sum('amount');
}



if (Yii::$app->user->identity->branch_id != '0') {
        $invoices_unpaid = \common\models\Invoice::find()->where(['branch_id' => Yii::$app->user->identity->branch_id, 'status' => 2])->orderBy(['DOC' => SORT_DESC])->one();
        $invoices_unpaid_date = date("d-M-Y", strtotime($invoices_unpaid->DOC));
        $over_due_amount = \common\models\Invoice::find()->where(['DOC' => $invoices_unpaid->DOC, 'status' => 2, 'branch_id' => Yii::$app->user->identity->branch_id,])->sum('amount');
        $total_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['branch_id' => Yii::$app->user->identity->branch_id])->andWhere(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $converted_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['branch_id' => Yii::$app->user->identity->branch_id, 'proceed' => 1])->andWhere(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $dropped_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['branch_id' => Yii::$app->user->identity->branch_id, 'status' => 3])->andWhere(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $pending_enquiries = $total_enquiries - $converted_enquiries - $dropped_enquiries;
} else {
        $invoices_unpaid = \common\models\Invoice::find()->where(['status' => 2])->orderBy(['DOC' => SORT_DESC])->one();
        $invoices_unpaid_date = date("d-M-Y", strtotime($invoices_unpaid->DOC));
        $over_due_amount = \common\models\Invoice::find()->where(['DOC' => $invoices_unpaid->DOC, 'status' => 2])->sum('amount');
        $total_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $converted_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['proceed' => 1])->andWhere(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $dropped_enquiries = common\models\PatientEnquiryGeneralFirst::find()->where(['status' => 3, 'proceed' => 0])->andWhere(['>=', 'DOC', $sstart_date])->andWhere(['<=', 'DOC', $eend_date])->count();
        $pending_enquiries = $total_enquiries - $converted_enquiries - $dropped_enquiries;
}
?>


<div class="row">

        <div class="col-sm-3">

                <div class="xe-widget xe-counter" >
                        <div class="xe-icon">
                                <i class="fa fa-medkit"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $patients ?></strong>
                                <span>Patients</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" >
                        <div class="xe-icon">
                                <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $staffs ?></strong>
                                <span>Staffs Total</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="<?= $services ?>" data-duration="4" data-easing="true">
                        <div class="xe-icon">
                                <i class="fa fa-shield"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num">0</strong>
                                <span>Live Services</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">
                <a href="<?= Yii::$app->homeUrl ?>services/service/index">
                        <div class="xe-widget xe-counter xe-counter-red"  >
                                <div class="xe-icon">
                                        <i class="linecons-lightbulb"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"></strong>
                                        <span>Today Schedules</span>
                                </div>
                        </div>
                </a>

        </div>





        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" >
                        <div class="xe-icon">
                                <i class="linecons-mail"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $total_enquiries ?></strong>
                                <span>Patient Enquiries</span>
                                <span> (<?= date('F') ?>)</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter" >
                        <div class="xe-icon">
                                <i class="fa fa-check-square-o"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $converted_enquiries ?></strong>
                                <span>Converted Enquiries</span>
                                <span> (<?= date('F') ?>)</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-red">
                        <div class="xe-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $pending_enquiries ?></strong>
                                <span>Pending Enquiries</span>
                                <span> (<?= date('F') ?>)</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-info">
                        <div class="xe-icon">
                                <i class="fa fa-times-circle"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $dropped_enquiries ?></strong>
                                <span>Dropped Enquiries</span>
                                <span> (<?= date('F') ?>)</span>
                        </div>
                </div>


        </div>


        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-blue"  >
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-money"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= sprintf('%0.2f', $invoices) ?></strong>
                                        <span>Total Invoice Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>

                                <span></span>
                                <strong><?= $invoice_paid_date ?></strong>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">
                <a href="<?= Yii::$app->homeUrl ?>services/service/index">
                        <div class="xe-widget xe-counter-block xe-counter-block-red">
                                <div class="xe-upper">

                                        <div class="xe-icon">
                                                <i class="fa-life-ring"></i>
                                        </div>
                                        <div class="xe-label">
                                                <strong class="num"><?= sprintf('%0.2f', $over_due_amount) ?></strong>
                                                <span> Over Due Amount</span>
                                        </div>

                                </div>
                                <div class="xe-lower">
                                        <div class="border"></div>

                                        <span></span>
                                        <a href="<?= Yii::$app->homeUrl ?>invoice/invoice/index"><strong>View</strong></a>
                                </div>
                        </div>
                </a>

        </div>


        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block">
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= sprintf('%0.2f', $sale_amounts['sale_order_amount']) ?></strong>
                                        <span>Total Materials Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>

                                <span></span>
                                <strong><?= date("d-M-Y", strtotime($sale_date)) ?></strong>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-purple">
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= sprintf('%0.2f', $purchase_amounts['purchase_order_amount']) ?></strong>
                                        <span>Total Purchase Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>
                                <strong><?= date("d-M-Y", strtotime($purchase_date)) ?></strong>
                        </div>
                </div>

        </div>







        <div class="col-sm-6">



                <!-- Tweets -->
                <div class="xe-widget xe-status-update" data-auto-switch="5">
                        <div class="xe-header">
                                <div class="xe-icon">
                                        <i class="fa fa-tasks"></i>
                                </div>
                                <div class="xe-nav">
                                        <a href="#" class="xe-prev">
                                                <i class="fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="xe-next">
                                                <i class="fa-angle-right"></i>
                                        </a>
                                </div>
                        </div>
                        <div class="xe-body">

                                <ul class="list-unstyled">


                                        <?php
                                        $e = 0;
                                        if (!empty($tasks)) {
                                                foreach ($tasks as $value) {
                                                        $e++;
                                                        ?>
                                                        <li class="<?= $e == 1 ? 'active' : '' ?>">
                                                                <span class="status-date"><?= date('d F Y H:i:s', strtotime($value->followup_date)) ?></span>
                                                                <p><?= substr($value->followup_notes, 0, 100); ?></p>
                                                        </li>
                                                        <?php
                                                }
                                        } else {
                                                echo '<li class="active">No tasks Assigned</li>';
                                        }
                                        ?>
                                </ul>

                        </div>
                        <div class="xe-footer">
                                <a href="<?= Yii::$app->homeUrl ?>followup/followups/index">
                                        <i class="fa-retweet"></i>
                                        My Tasks
                                </a>
                        </div>
                </div>

        </div>



        <div class="col-sm-6">

                <div class="xe-widget xe-status-update xe-status-update-google-plus" data-auto-switch="0">
                        <div class="xe-header">
                                <div class="xe-icon">
                                        <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="xe-nav">
                                        <a href="#" class="xe-prev">
                                                <i class="fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="xe-next">
                                                <i class="fa-angle-right"></i>
                                        </a>
                                </div>
                        </div>
                        <div class="xe-body">

                                <ul class="list-unstyled">
                                        <?php
                                        $e = 0;
                                        if (!empty($pending_tasks)) {
                                                foreach ($pending_tasks as $value) {
                                                        $e++;
                                                        ?>
                                                        <li class="<?= $e == 1 ? 'active' : '' ?>">
                                                                <span class="status-date"><?= date('d F Y H:i:s', strtotime($value->followup_date)) ?></span>
                                                                <p><?= substr($value->followup_notes, 0, 100); ?></p>
                                                        </li>
                                                        <?php
                                                }
                                        } else {
                                                echo '<li class="active">No Pending Tasks</li>';
                                        }
                                        ?>
                                </ul>

                        </div>
                        <div class="xe-footer">
                                <a href="<?= Yii::$app->homeUrl ?>followup/followups/index">
                                        <i class="fa-retweet"></i>
                                        My Pending Tasks
                                </a>
                        </div>
                </div>

        </div>



        <div class="row row-style" style="margin:0">
                <div class="col-sm-6">
                        <?php
                        if (Yii::$app->user->identity->branch_id != '0') {
                                $services = \common\models\Service::find()->where(['status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id])->limit(5)->orderBy(['id' => SORT_DESC])->all();
                        } else {
                                $services = \common\models\Service::find()->where(['status' => 1])->limit(5)->orderBy(['id' => SORT_DESC])->all();
                        }
                        ?>

                        <div class="panel panel-default" style="height: 450px;">
                                <div class="panel-heading">
                                        Services
                                </div>

                                <div style="min-height: 210px;" class="table-responsive">
                                        <table class="table" >
                                                <thead>
                                                        <tr style="text-align: center;">
                                                                <th>#</th>
                                                                <th width="">Service ID</th>
                                                                <th width="">Patient ID</th>
                                                                <th width="">Service</th>
                                                                <th width="">Duty Type</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        if (!empty($services)) {
                                                                $f = 0;
                                                                foreach ($services as $services) {
                                                                        $f++;
                                                                        ?>
                                                                        <tr style="text-align:left;" >
                                                                                <td><?= $f ?></td>
                                                                                <td><?= $services->service_id ?> </td>
                                                                                <td><?= $services->patient->first_name ?></td>
                                                                                <td><?= $services->service0->service_name ?></td>
                                                                                <td><?php
                                                                                        if ($services->duty_type == '1') {
                                                                                                echo 'Hourly';
                                                                                        } else if ($services->duty_type == '2') {
                                                                                                echo 'Visit';
                                                                                        } else if ($services->duty_type == '3') {
                                                                                                echo 'Day';
                                                                                        } else if ($services->duty_type == '4') {
                                                                                                echo 'Night';
                                                                                        } else if ($services->duty_type == '5') {
                                                                                                echo 'Day & Night';
                                                                                        }
                                                                                        ?></td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                        } else {
                                                                echo '<tr><td colspan="4" style="text-align:center">No Services</td></tr>';
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['services/service/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>
                <div class="col-sm-6">

                        <div class="panel panel-default" style="height: 450px;">
                                <div class="panel-heading">
                                        Today Schedules
                                </div>

                                <?php
                                if (Yii::$app->user->identity->branch_id != '0') {
                                        $services = \common\models\Service::find()->where(['status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id])->limit(10)->orderBy(['id' => SORT_DESC])->all();
                                } else {
                                        $services = \common\models\Service::find()->where(['status' => 1])->limit(10)->orderBy(['id' => SORT_DESC])->all();
                                }
                                ?>
                                <div  style="min-height: 210px;" class="table-responsive">
                                        <table class="table">
                                                <thead>
                                                        <tr style="text-align: center;">
                                                                <th width="">#</th>
                                                                <th width="">Service ID</th>
                                                                <th width="">Date</th>
                                                                <th width="">Staff</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        if (!empty($services)) {
                                                                $s = 0;
                                                                foreach ($services as $services) {
                                                                        $schedules = \common\models\ServiceSchedule::find()->where(['service_id' => $services->id])->all();

                                                                        foreach ($schedules as $schedules) {
                                                                                if ($schedules->date == date('Y-m-d')) {
                                                                                        $s++;
                                                                                        if ($s <= 5) {
                                                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<a href="<?= Yii::$app->homeUrl; ?>sales/purchase-invoice-details/view?id=<?= $purchase_master->id ?>">-->
                                                                                                <tr style="text-align:left;">
                                                                                                        <td><?= $s ?> </td>
                                                                                                        <?php
                                                                                                        $service = \common\models\Service::findOne($schedules->service_id);
                                                                                                        ?>
                                                                                                        <td><?= $service->service_id ?></td>
                                                                                                        <td>
                                                                                                                <?=
                                                                                                                date('d-m-Y', strtotime($schedules->date));
                                                                                                                ?>
                                                                                                        </td>
                                                                                                        <?php $staff = \common\models\StaffInfo::findOne($schedules->staff) ?>
                                                                                                        <td><?= $staff->staff_name;
                                                                                                        ?></td>
                                                                                                </tr>
                                                                                                <!--</a>-->
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                        }
                                                                }
                                                        } else {
                                                                echo '<tr><td colspan="4" style="text-align:center">No Schedules Today</td></tr>';
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['services/service/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>
        </div>





</div>