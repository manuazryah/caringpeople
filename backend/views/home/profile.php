<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Employee;
use common\models\Doctor;
use common\models\PlacePro;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
?>

<section id="login-box">
        <div class="container">
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 col-sm-6 shadow">
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">Profile</h3>
                                <?php if (isset($model->staff_id) && $model->staff_id != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b> Staff Id</b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->staff_id ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->username) && $model->username != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>     Username</b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->username ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->staff_name) && $model->staff_name != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>     Name</b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->staff_name ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->gender) && $model->gender != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>    Gender</b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php
                                                        if ($model->gender == 0) {
                                                                echo 'Male';
                                                        } else {
                                                                echo 'Female';
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                <?php } ?>



                                <?php if (isset($model->permanent_address) && $model->permanent_address != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>       Address</b>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->permanent_address ?>
                                                </div>

                                        </div>
                                <?php } ?>

                                <?php if (isset($model->present_contact_no) && $model->present_contact_no != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>  Conatct No</b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->present_contact_no ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->email) && $model->email != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>   Email </b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?= $model->email ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->religion) && $model->religion != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>   Religion </b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php $religion = \common\models\Religion::findOne($model->religion) ?>
                                                        <?= $religion->religion ?>
                                                </div>
                                        </div>
                                <?php } ?>

                                <?php if (isset($model->caste) && $model->caste != '') { ?>
                                        <div class="row prof-view">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <b>   Caste </b>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php $caste = \common\models\Caste::findOne($model->caste) ?>
                                                        <?= $caste->caste ?>
                                                </div>
                                        </div>
                                <?php } ?>




                        </div>
                        <div class="col-md-3"></div>
                </div>
        </div>
</section>
<style>
        .visiting_time{
                margin-left: 18px;
                width: 30%;
                padding: 6px;
                border-radius: 5px;
        }
        .fa-globe:before {
                content: "\f0ac";
                font-size: 20px;
        }
        .form-doctor-control{
                margin-left: 20px !important;
                width:65% !important;
        }
        .prof-view{
                margin-bottom: 20px;
        }

</style>




