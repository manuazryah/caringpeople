<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Followups;
use common\models\AdminUsers;
use yii\helpers\ArrayHelper;
use common\models\NotificationViewStatus;
use common\models\PendingFollowups;
use yii\db\Expression;
use yii\widgets\ActiveForm;

AppAsset::register($this);
//Yii::$app->Followups->PendingFollowups();
$pending_followups = PendingFollowups::find()->where(new Expression('FIND_IN_SET(:assigned_to, assigned_to)'))->addParams([':assigned_to' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->orderBy(['date' => SORT_DESC])->all();

$new_notifications = NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->orderBy(['id' => SORT_DESC])->all();
$limit_notifications = NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->limit(3)->orderBy(['id' => SORT_DESC])->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="description" content="Caring People Admin Panel" />
                <meta name="author" content="" />
                <title>Caring People</title>
                <link rel="icon" href="<?= Yii::$app->homeUrl; ?>images/f-logo.png" sizes="40x40" />
                <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>
                <script type="text/javascript">
                        var homeUrl = '<?= Yii::$app->homeUrl; ?>';
                        //var basePath = "<?= Yii::$app->basePath; ?>";
                </script>
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
        </head>
        <body>
                <?php $this->beginBody() ?>

                <div class="page-container">
                        <div class="sidebar-menu toggle-others collapsed"  id="side-menuss">
                                <div class="sidebar-menu-inner">
                                        <header class="logo-env">
                                                <div class="logo">
                                                        <a href="<?= Yii::$app->homeUrl; ?>site/index" class="logo-expanded">
                                                                <?php echo Html::img('@web/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
                                                        </a>

                                                        <a href="<?= Yii::$app->homeUrl; ?>site/index" class="logo-collapsed">
                                                                <img src="<?= Yii::$app->homeUrl; ?>images/logos/logo-collapsed.png" width="40" alt="" />
                                                        </a>
                                                </div>

                                                <div class="mobile-menu-toggle visible-xs">
                                                        <a href="#" data-toggle="user-info-menu">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-success"><?= count($new_notifications); ?></span>
                                                        </a>

                                                        <a href="#" data-toggle="mobile-menu">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </div>



                                        </header>


                                        <?php if (Yii::$app->session['post']['admin'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="linecons-cog"></i>
                                                                        <span class="title">Administrator</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Access Powers', ['/admin/admin-posts/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['staffs'] == 1 || Yii::$app->session['post']['staff_payroll'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa-user"></i>
                                                                        <span class="title">Staff</span>
                                                                </a>
                                                                <ul>
                                                                        <?php if (Yii::$app->session['post']['staffs'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Staff Enquiry ', ['/staff/staff-enquiry/index'], ['class' => 'title']) ?>
                                                                                </li>

                                                                                <li>
                                                                                        <?= Html::a('Staff', ['/staff/staff-info/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>

                                                                        <?php if (Yii::$app->session['post']['staff_payroll'] == 1) { ?>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <i class="entypo-flow-parallel"></i>
                                                                                                <span class="title">Staff Payroll</span>
                                                                                        </a>
                                                                                        <ul>
                                                                                                <li>
                                                                                                        <?= Html::a('Payroll ', ['/accounts/staff-payroll/create'], ['class' => 'title']) ?>
                                                                                                </li>

                                                                                                <li>
                                                                                                        <?= Html::a('Payroll Report', ['/accounts/staff-payroll/index'], ['class' => 'title']) ?>
                                                                                                </li>

                                                                                        </ul>
                                                                                </li>
                                                                        <?php } ?>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['enquiry'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-medkit"></i>
                                                                        <span class="title">Patients</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Patient Enquiry', ['/patient/patient-enquiry-general-first/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Patients', ['/patient/patient-information/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['service'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="">
                                                                        <i class="fa fa-shield"></i>
                                                                        <span class="title">Services</span>
                                                                </a>
                                                                <ul>
                                                                        <?php if (Yii::$app->session['post']['service'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Service', ['/services/service/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['materials'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Materials', ['/sales/sales-invoice-details/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['sub_services'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Sub Services', ['/masters/sub-services/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['rate_card'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Rate Card', ['/masters/rate-card/index'], ['class' => 'title']) ?>
                                                                                </li>

                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['service_recycle_bin'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Service Recycle Bin', ['/services/service-bin/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>


                                        <?php
                                        if (Yii::$app->session['post']['invoice'] == 1 || Yii::$app->session['post']['account_head'] == 1 || Yii::$app->session['post']['expenses'] == 1) {
                                                ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-inr"></i>
                                                                        <span class="title">Finance</span>
                                                                </a>
                                                                <ul>
                                                                        <?php if (Yii::$app->session['post']['invoice'] == 1) { ?>

                                                                                <li>
                                                                                        <?= Html::a('Invoice', ['/invoice/invoice/index'], ['class' => 'title']) ?>
                                                                                </li>

                                                                        <?php } ?>

                                                                        <?php if (Yii::$app->session['post']['expenses'] == 1) { ?>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <i class="entypo-flow-parallel"></i>
                                                                                                <span class="title">Expenses</span>
                                                                                        </a>
                                                                                        <ul>
                                                                                                <li>
                                                                                                        <?= Html::a('Expense Type', ['/expenses/expense-type/index'], ['class' => 'title']) ?>
                                                                                                </li>

                                                                                                <li>
                                                                                                        <?= Html::a('Expenses', ['/expenses/expenses/index'], ['class' => 'title']) ?>
                                                                                                </li>

                                                                                        </ul>
                                                                                </li>

                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['account_head'] == 1) { ?>

                                                                                <li>
                                                                                        <?= Html::a('Account Head', ['/accounts/account-head/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>





                                                                </ul>
                                                        </li>

                                                </ul>

                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['attendance'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa-check"></i>
                                                                        <span class="title">Attendance</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Attendance ', ['/attendance/attendance/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>



                                        <?php if (Yii::$app->session['post']['reports'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa-book"></i>
                                                                        <span class="title">Reports</span>
                                                                </a>
                                                                <ul>


                                                                        <li>
                                                                                <?= Html::a('Office Staff Attendance Report ', ['/reports/reports/report'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Other Staff Attendance Report ', ['/reports/reports/staffattendance'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Patient Service Report ', ['/reports/reports/patientreport'], ['class' => 'title']) ?>
                                                                        </li>


                                                                        <li>
                                                                                <?= Html::a('Staff Report ', ['/reports/reports/oncallstaff'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Patient Report ', ['/reports/reports/report-patient'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Day Book ', ['/accounts/accounts/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['inventory'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-suitcase"></i>
                                                                        <span class="title">Inventory</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Inventory Master', ['/product/item-master/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Purchase', ['/sales/purchase-invoice-details/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                        <li>
                                                                                <a href="#">
                                                                                        <i class="entypo-flow-parallel"></i>
                                                                                        <span class="title">Stock</span>
                                                                                </a>
                                                                                <ul>
                                                                                        <li>
                                                                                                <?= Html::a('Stock Report', ['/stock/stock-view/index'], ['class' => 'title']) ?>
                                                                                        </li>
                                                                                        <li>
                                                                                                <?= Html::a('Stock Adjustment', ['/stock/stock-adj-dtl/index'], ['class' => 'title']) ?>
                                                                                        </li>

                                                                                </ul>
                                                                        </li>

                                                                        <li>
                                                                                <a href="#">
                                                                                        <i class="entypo-flow-parallel"></i>
                                                                                        <span class="title">Masters</span>
                                                                                </a>
                                                                                <ul>
                                                                                        <li>
                                                                                                <?= Html::a('Suppliers', ['/masters/business-partner/index'], ['class' => 'title']) ?>
                                                                                        </li>
                                                                                        <li>
                                                                                                <?= Html::a('Tax', ['/masters/tax/index'], ['class' => 'title']) ?>
                                                                                        </li>

                                                                                </ul>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>

                                        <?php } ?>



                                        <?php if (Yii::$app->session['post']['leave_approval'] == 1) { ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-external-link"></i>
                                                                        <span class="title">Leave</span>
                                                                </a>

                                                                <ul>

                                                                        <li>
                                                                                <?= Html::a('Staff Leave', ['/leave/staff-leave/index'], ['class' => 'title']) ?>
                                                                        </li>



                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['contact_directory'] == 1) { ?>


                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-folder-open"></i>
                                                                        <span class="title">Contact Directory</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Contact Categories', ['/directory/contact-category-types/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Contact SubCategories', ['/directory/contact-subcategory/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Contact Directories', ['/directory/contact-directory/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>


                                        <?php if (Yii::$app->session['post']['login_history'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-sign-in"></i>
                                                                        <span class="title">Login History</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Login History', ['/admin/login-history/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>


                                        <?php if (Yii::$app->session['post']['website_enquiries'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa fa-comments-o"></i>
                                                                        <span class="title">Website Enquiries</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Website Enquiries', ['/contact/contact-us/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php if (Yii::$app->session['post']['masters'] == 1) { ?>

                                                <ul id="main-menu" class="main-menu">
                                                        <li>
                                                                <a href="#">
                                                                        <i class="fa-database"></i>
                                                                        <span class="title">Masters</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Country', ['/masters/country/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('State', ['/masters/state/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('City', ['/masters/city/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Religion', ['/masters/religion/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Caste', ['/masters/caste/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Nationality', ['/masters/nationality/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Referral Sources', ['/masters/referral-source/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Relationships', ['/masters/master-relationships/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Branches', ['/masters/branch/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Leave Types', ['/masters/master-leave-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Designations', ['/masters/master-designations/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Followups Category', ['/masters/followup-sub-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Master Service Types', ['/masters/master-service-types/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Master Service History Types', ['/masters/master-history-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Skills', ['/masters/staff-experience-list/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Remarks Category', ['/remarks/remarks-category/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Uploads Category', ['/masters/upload-category/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Timings', ['/masters/timing/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Terms and Conditions', ['/masters/terms-and-conditions/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>





                                </div>

                        </div>

                        <div class="main-content">
                                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                                        <!-- Left links for user info navbar -->
                                        <ul class="user-info-menu left-links list-inline list-unstyled">

                                                <li class="hidden-sm hidden-xs">
                                                        <a href="#" data-toggle="sidebar" id="clicks">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </li>



                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-purple"><?= count($new_notifications) ?></span>
                                                        </a>

                                                        <ul class="dropdown-menu notifications">
                                                                <li class="top">
                                                                        <p class="small">
                                                                                <a href="#" class="pull-right">Mark all Read</a>
                                                                                You have <strong><?= count($new_notifications) ?></strong> new notifications.
                                                                        </p>
                                                                </li>

                                                                <li>
                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                                                                <?php
                                                                                if (!empty($limit_notifications)) {
                                                                                        foreach ($limit_notifications as $new_notification) {
                                                                                                ?>
                                                                                                <li class="active notification-success">
                                                        <!--													<a href="<?= $new_notification->notifiaction_type_id == 1 ? '/update-service/' . $new_notification->id : '' ?>">
                                                                                                                <i class="fa-envelope"></i>

                                                                                                                <span class="line">
                                                                                                                                                                                <strong>Followup Enquiry</strong>
                                                                                                                </span>

                                                                                                                <span class="line small time limit-text">
                                                                                                        <?php
//															$text = strlen($notification->followup_notes) > 100 ? substr($notification->followup_notes, 0, 100) . '&hellip;' : $notification->followup_notes;
                                                                                                        echo $new_notification->content;
                                                                                                        ?>
                                                                                                                </span>
                                                                                                                <span class="line small time "><strong>Date:</strong><?= ' ' . $new_notification->date ?></span>
                                                                                                        </a>-->
                                                                                                        <?= Html::a('<i class="fa-envelope"></i>

														<span class="line">

														</span>

														<span class="line small time limit-text">' . $new_notification->content . '</span>
														<span class="line small time "><strong>Date:</strong> ' . $new_notification->date, ['/site/notifications?id=' . $new_notification->id], ['class' => '']) ?>
                                                                                                </li>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>


                                                                        </ul>
                                                                </li>

                                                                <li class="external">
                                                                        <?= Html::a('<span>View all notifications</span> <i class="fa-link-ext"></i>', ['/site/notifications'], ['class' => '']) ?>

                                                                </li>
                                                        </ul>
                                                </li>
                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-flag-o"></i>
                                                                <span class="badge " style="background-color: red"><?= count($pending_followups) ?></span>
                                                        </a>

                                                        <ul class="dropdown-menu notifications">
                                                                <li class="top">
                                                                        <p class="small">
                                                                                <a href="#" class="pull-right">Mark all Read</a>
                                                                                <strong><?= count($pending_followups) ?></strong> Pending Followups.
                                                                        </p>
                                                                </li>

                                                                <li>
                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                                                                <?php
                                                                                if (!empty($pending_followups)) {
                                                                                        foreach ($pending_followups as $pending_followup) {
                                                                                                ?>
                                                                                                <li class="active notification-success">
                                                        <!--													<a href="<?= $new_notification->notifiaction_type_id == 1 ? '/update-service/' . $new_notification->id : '' ?>">
                                                                                                                <i class="fa-envelope"></i>

                                                                                                                <span class="line">
                                                                                                                                                                                <strong>Followup Enquiry</strong>
                                                                                                                </span>

                                                                                                                <span class="line small time limit-text">
                                                                                                        <?php
//															$text = strlen($notification->followup_notes) > 100 ? substr($notification->followup_notes, 0, 100) . '&hellip;' : $notification->followup_notes;
                                                                                                        echo $new_notification->content;
                                                                                                        ?>
                                                                                                                </span>
                                                                                                                <span class="line small time "><strong>Date:</strong><?= ' ' . $new_notification->date ?></span>
                                                                                                        </a>-->
                                                                                                        <?= Html::a('<i class="fa-envelope"></i>

														<span class="line">

														</span>

														<span class="line small time limit-text">' . $pending_followup->content . '</span>
														<span class="line small time "><strong>Date:</strong> ' . $pending_followup->date, ['/site/pending-followups?id=' . $pending_followup->id], ['class' => '']) ?>
                                                                                                </li>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>


                                                                        </ul>
                                                                </li>

                                                                <li class="external">
                                                                        <?= Html::a('<span>View all pending Followups</span> <i class="fa-link-ext"></i>', ['/site/pending-followups'], ['class' => '']) ?>

                                                                </li>
                                                        </ul>
                                                </li>

                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Tasks">
                                                                <i class="linecons-calendar"></i>
                                                        </a>

                                                        <ul class="dropdown-menu notifications">
                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/index" style="line-height: 3"> My Followups</a>
                                                                </li>

                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups" style="line-height: 3"> Add Followups</a>
                                                                </li>

                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/viewrelated" style="line-height: 3">My Related Followups</a>
                                                                </li>

                                                        </ul>
                                                </li>


                                        </ul>


                                        <!-- Right links for user info navbar -->
                                        <ul class="user-info-menu right-links list-inline list-unstyled">


                                                <li class="dropdown user-profile">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <img src="<?= Yii::$app->homeUrl; ?>images/themes/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                                                                <span>
                                                                        <?= Yii::$app->user->identity->username ?>
                                                                        <i class="fa-angle-down"></i>
                                                                </span>
                                                        </a>

                                                        <ul class="dropdown-menu user-profile-menu list-unstyled">

                                                                <li>
                                                                        <?= Html::a('<i class="fa-wrench"></i>Change Password', ['/admin/admin-users/change-password?data=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->id)], ['class' => 'title']) ?>
                                                                        </									li>
                                                                <li>
                                                                        <?= Html::a('<i class="fa-pencil"></i>Edit Profile', ['/staff/staff-info/editprofile?data=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->id)], ['class' => 'title']) ?>
                                                                </li>

                                                                <?php
                                                                echo '<li class="last">'
                                                                . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                                . Html::submitButton(
                                                                        '<i class="fa-lock"></i> Logout', ['class' => 'btn logout_btn']
                                                                ) . '</a>'
                                                                . Html::endForm()
                                                                . '</li>';
                                                                ?>


                                                        </ul>
                                                </li>



                                        </ul>

                                </nav>


                                <?= $content; ?>



                                <footer class="main-footer sticky footer-type-1">

                                        <div class="footer-inner">

                                                <!-- Add your copyright text here -->
                                                <div class="footer-text">
                                                        &copy; <?= Html::encode(date('Y')) ?>
                                                        <strong>Caring</strong>
                                                        People <a href="#" target="_blank"></a>
                                                </div>


                                                <div class="go-up">

                                                        <a href="#" rel="go-top">
                                                                <i class="fa-angle-up"></i>
                                                        </a>

                                                </div>

                                        </div>

                                </footer>




                        </div>


                        <div id="chat" class="fixed"><!-- start: Chat Section -->

                                <div class="chat-inner">


                                        <h2 class="chat-header">
                                                <a  href="#" class="chat-close" data-toggle="chat">
                                                        <i class="fa-plus-circle rotate-45deg"></i>
                                                </a>

                                                Chat
                                                <span class="badge badge-success is-hidden">0</span>
                                        </h2>

                                        <script type="text/javascript">
                                                // Here is just a sample how to open chat conversation box
                                                jQuery(document).ready(function ($)
                                                {
                                                        var $chat_conversation = $(".chat-conversation");

                                                        $(".chat-group a").on('click', function (ev)
                                                        {
                                                                ev.preventDefault();

                                                                $chat_conversation.toggleClass('is-open');

                                                                $(".chat-conversation textarea").trigger('autosize.resize').focus();
                                                        });

                                                        $(".conversation-close").on('click', function (ev)
                                                        {
                                                                ev.preventDefault();
                                                                $chat_conversation.removeClass('is-open');
                                                        });
                                                });</script>


                                        <div class="chat-group">
                                                <strong>Favorites</strong>

                                                <a href="#"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                                                <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                                        </div>


                                        <div class="chat-group">
                                                <strong>Work</strong>

                                                <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                                        </div>


                                        <div class="chat-group">
                                                <strong>Other</strong>

                                                <a href="#"><span class="user-status is-online"></span> <em>Dennis E. Johnson</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Stuart A. Shire</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Janet I. Matas</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Mindy A. Smith</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Herman S. Foltz</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Gregory E. Robie</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Nellie T. Foreman</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>William R. Miller</em></a>
                                                <a href="#"><span class="user-status is-idle"></span> <em>Vivian J. Hall</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Melinda A. Anderson</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Gary M. Mooneyham</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Robert C. Medina</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Dylan C. Bernal</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Marc P. Sanborn</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Kenneth M. Rochester</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Rachael D. Carpenter</em></a>
                                        </div>

                                </div>

                                <!-- conversation template -->
                                <div class="chat-conversation">

                                        <div class="conversation-header">
                                                <a href="#" class="conversation-close">
                                                        &times;
                                                </a>

                                                <span class="user-status is-online"></span>
                                                <span class="display-name">Arlind Nushi</span>
                                                <small>Online</small>
                                        </div>

                                        <ul class="conversation-body">
                                                <li>
                                                        <span class="user">Arlind Nushi</span>
                                                        <span class="time">09:00</span>
                                                        <p>Are you here?</p>
                                                </li>
                                                <li class="odd">
                                                        <span class="user">Brandon S. Young</span>
                                                        <span class="time">09:25</span>
                                                        <p>This message is pre-queued.</p>
                                                </li>
                                                <li>
                                                        <span class="user">Brandon S. Young</span>
                                                        <span class="time">09:26</span>
                                                        <p>Whohoo!</p>
                                                </li>
                                                <li class="odd">
                                                        <span class="user">Arlind Nushi</span>
                                                        <span class="time">09:27</span>
                                                        <p>Do you like it?</p>
                                                </li>
                                        </ul>

                                        <div class="chat-textarea">
                                                <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                                        </div>

                                </div>

                                <!-- end: Chat Section -->
                        </div>

                </div>

                <div class="footer-sticked-chat"><!-- Start: Footer Sticked Chat -->

                        <script type="text/javascript">
                                function showLoader() {
                                        $('.page-loading-overlay').removeClass('loaded');
                                }
                                function hideLoader() {
                                        $('.page-loading-overlay').addClass('loaded');
                                }
                                function toggleSampleChatWindow()
                                {
                                        var $chat_win = jQuery("#sample-chat-window");

                                        $chat_win.toggleClass('open');

                                        if ($chat_win.hasClass('open'))
                                        {
                                                var $messages = $chat_win.find('.ps-scrollbar');

                                                if ($.isFunction($.fn.perfectScrollbar))
                                                {
                                                        $messages.perfectScrollbar('destroy');

                                                        setTimeout(function () {
                                                                $messages.perfectScrollbar();
                                                                $chat_win.find('.form-control').focus();
                                                        }, 300);
                                                }
                                        }

                                        jQuery("#sample-chat-window form").on('submit', function (ev)
                                        {
                                                ev.preventDefault();
                                        });
                                }

                                jQuery(document).ready(function ($)
                                {

                                        $(".footer-sticked-chat .chat-user, .other-conversations-list a").on('click', function (ev)
                                        {
                                                ev.preventDefault();
                                                toggleSampleChatWindow();
                                        });

                                        $(".mobile-chat-toggle").on('click', function (ev)
                                        {
                                                ev.preventDefault();

                                                $(".footer-sticked-chat").toggleClass('mobile-is-visible');
                                        });
                                });</script>



                        <a href="#" class="mobile-chat-toggle">
                                <i class="linecons-comment"></i>
                                <span class="num">6</span>
                                <span class="badge badge-purple">4</span>
                        </a>

                        <!-- End: Footer Sticked Chat -->
                </div>

                <!-- Page Loading Overlay -->
                <div class="page-loading-overlay loaded">
                        <div class="loader-2"></div>
                </div>

                <?php $this->endBody() ?>
                <script type="text/javascript">
                        jQuery(document).ready(function ($)
                        {
                                if ($("#clicks").click(function () {
                                        if ($("#side-menuss").hasClass("collapsed")) {


                                                $('#main-menu>li>ul').css('display', '');

                                                //$('sidebar-menu >main-menu>expanded>ul').style("expanded");
                                        }
                                }))
                                        ;

                        });</script>
        </body>

</html>

<!------------------------------------------------------ popup---------------------------------------------------->
<div class="modal fade" id="modal-6">
        <div class="modal-dialog" id="modal-pop-up">

        </div>
</div>
<!---------------------------------staff password reset-------------------------->
<div class="modal" id="modal-reset">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form id="reset_password_form">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Reset Password</h4>
                                </div>

                                <div class="modal-body">
                                        <div class="row">
                                                <input type="hidden" id="user_id" value="">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <input type="text" class="form-control some_class" id="new-password" name="new-password" required="required" placeholder="New Password">
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <input type="text" class="form-control some_class" id="confirm-password" name="confirm-password" required="required" placeholder="Confirm Password">
                                                                <div class="mismatch_error" style="color: rgba(255, 0, 0, 0.78);"></div>
                                                        </div>

                                                </div>
                                        </div>








                                </div>

                                <div class="modal-footer">
                                        <!--                                        <button type="button" class="btn btn-info" id="addFollowupsubmit">Submit</button>-->
                                        <input  type="submit" class="btn btn-info" value="Submit">
                                </div>
                        </form>
                </div>
        </div>
</div>


<!---------------------------------------------Terms and conditions-------------------------------------------->

<div class="modal fade" id="modal-7">
        <div class="modal-dialog">
                <div class="modal-content" style="background: #eee;">

                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" style="font-weight: bold">Terms and Conditions</h4>
                        </div>

                        <div class="modal-body" style="height:535px;overflow-y: auto">
                                Loading...
                        </div>

                        <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                </div>
        </div>
</div>

<!--------------------------------------------Schedule choose stsff---------------------------------------------->


<div class="modal fade custom-width" id="modal-2">
        <div class="modal-dialog" style="width: 50%;" id="modal-2-pop-up">

        </div>
</div>


<!-------------------------------------------- adds chedule rate (cofirm to close)------------------------------->
<div class="modal fade" id="modal-4" data-backdrop="static">
        <div class="modal-dialog" id="modal-4-pop-up">

        </div>
</div>


<div class="modal fade" id="modal-5" data-backdrop="static">
        <div class="modal-dialog" id="modal-5-pop-up">
                <?php $form = ActiveForm::begin(['action' => 'services/service/todayschedules']); ?>
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Choose Branch</h4>
                        </div>

                        <div class="modal-body">

                                <div class="row">
                                        <div class="col-md-6">
                                                <label>Select Branch</label>
                                        </div>
                                        <div class="col-md-6">
                                                <?php $branch = \common\models\Branch::Branch(); ?>
                                                <select name="branch" id="branch" class="form-control" required="">

                                                        <option value="0">All</option>
                                                        <?php foreach ($branch as $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->branch_name ?></option>
                                                        <?php }
                                                        ?>
                                                </select>
                                        </div>

                                </div>

                        </div>


                        <div class="modal-footer">

                                <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
</div>


<div class="modal fade" id="modal-8" data-backdrop="static">
        <div class="modal-dialog" id="modal-8-pop-up">

                <div class="modal-content add-more-schedules">
                        <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal">Ã—</button>
                                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Previous Schedules</h4>
                        </div>
                        <div class="modal-body">
                                <?php
                                $act = Yii::$app->homeUrl . 'services/service/todayschedules';
                                $form1 = ActiveForm::begin(['action' => $act]);
                                ?>
                                <div class="row">

                                        <div class="col-md-6">
                                                <label>Select Date</label>
                                        </div>
                                        <div class="col-md-6">
                                                <input type="date" name="date" id="date" class="form-control" required="" value="<?php echo date("Y-m-d"); ?>">
                                        </div>

                                        <?php
                                        $branch = \common\models\Branch::Branch();
                                        $user = Yii::$app->user->identity->branch_id;
                                        if ($user == 0) {
                                                ?>
                                                <div class="col-md-6">
                                                        <label>Select Branch</label>
                                                </div>
                                                <div class="col-md-6">

                                                        <select name="branch" id="branch" class="form-control" required="">

                                                                <option value="0">All</option>
                                                                <?php foreach ($branch as $value) { ?>
                                                                        <option value="<?= $value->id ?>"><?= $value->branch_name ?></option>
                                                                <?php }
                                                                ?>
                                                        </select>
                                                <?php } else { ?>
                                                        <input type="text" name="branch" value="<?= $user ?>" style="display:none">
                                                <?php } ?>
                                        </div>

                                </div>

                                <div class="row">
                                        <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">
                                </div>
                                <?php ActiveForm::end(); ?>

                        </div>


                </div>

        </div>
</div>


<?php $this->endPage() ?>
