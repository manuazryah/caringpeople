<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AppAssetHome;
use common\models\NotificationViewStatus;

AppAssetHome::register($this);
$new_notifications = NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->orderBy(['id' => SORT_DESC])->all();
?>
<?php $this->beginPage()
?>

<!DOCTYPE html>
<html lang="en">


        <!-- Mirrored from templates.scriptsbundle.com/logistic-pro/demo/logistic-pro/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Sep 2016 15:24:06 GMT -->
        <head>
                <title>Caringpeople</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <!--                <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                                <link href="css/style.css" rel="stylesheet" type="text/css"/>
                                <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
                                <script src="js/jquery-1.11.0.min.js"></script>
                                <script src="js/jquery.js"></script>
                                <script src="js/bootstrap.min.js"></script>-->
                <script src="https://use.fontawesome.com/2853c84fb5.js"></script>
                <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>
                <link rel="icon" type="image/ico" href="<?= Yii::$app->homeUrl; ?>images/microlabs.favicon.ico">
                <script type="text/javascript">
                        var homeUrl = '<?= Yii::$app->homeUrl; ?>';
                        //var basePath = "<?= Yii::$app->basePath; ?>";
                </script>
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
                <style>
                        body{
                                text-transform: uppercase;
                        }
                        input,textarea,select{
                                text-transform: uppercase;
                        }
                </style>
        </head>
        <body>
                <section id="header">
                        <a href="<?= Yii::$app->homeUrl; ?>site/staff" class="img-responsive">
                                <?php echo Html::img('@web/images/logos/logo-1.png', $options = ['width' => '300px', 'style' => 'display: block;
    margin: 0 auto;']) ?>
                        </a>

                </section>
                <section id="heading-box">

                        <div class="navbar">
                                <div class="dropdown">
                                        <button class="dropbtn">
                                                <span style="color: white;" class="icon-bar"><i class="fa fa-bars" aria-hidden="true"></i></button>
                                        <div class="dropdown-content">
                                                <a href="<?= Yii::$app->homeUrl; ?>home/schedules">View Schedules</a>
                                                <a href="<?= Yii::$app->homeUrl; ?>home/leave">Leave Application</a>
                                                <a href="<?= Yii::$app->homeUrl; ?>home/view-leave">Leave Status</a>
                                                <a href="<?= Yii::$app->homeUrl; ?>home/tasks">My Tasks</a>
                                                <a href="<?= Yii::$app->homeUrl; ?>home/profile">View Profile</a>

                                        </div>
                                </div>

                                <button  id="notification">
                                        <a href="<?= Yii::$app->homeUrl; ?>home/index"><i class="fa fa-globe" aria-hidden="true"></i> <?php if (count($new_notifications) > 0) { ?><div class="badge-1"></div><?php } ?></a>
                                </button>

                                <button>
                                        <a href="<?= Yii::$app->homeUrl; ?>home/logout"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                </button>
                        </div>
                </section>
                <?php $this->beginBody() ?>


                <?= $content ?>




                <?php $this->endBody() ?>

                <section id="footr-bar"><p>Copyright © Caringpeople</p></section>
        </body>

        <div class="modal fade" id="modal-6">
                <div class="modal-dialog" id="modal-pop-up">

                </div>
        </div>
</html>
<?php $this->endPage() ?>
