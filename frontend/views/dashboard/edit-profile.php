<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPosts */
Pjax::begin();
$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Admin Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
        .patient-detail-view{
                margin-left: 0px;
                color: #000;
                line-height: 50px;
        } .patient-detail-view .row label{
                font-weight: bold;
        }
</style>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="admin-posts-create">
                                                <div class="">
                                                        <label style="color:#000;font-weight: bold;text-transform: uppercase;"><b>Patient Id  :  <?= $model->patient_id ?></b></label>

                                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                                <div class="alert alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                <span class="sr-only">Close</span>
                                                                        </button>
                                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                                <div class="alert alert-success">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                <span class="sr-only">Close</span>
                                                                        </button>

                                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <div class="row disp_image">

                                                                <?php
                                                                if ($model->patient_image != '') {
                                                                        ?>
                                                                        <img src="<?= Yii::$app->homeUrl . 'uploads/patient/' . $model->id . '/patient_image.' . $model->patient_image; ?> " style="float: right"/>
                                                                <?php }
                                                                ?>
                                                        </div>

                                                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                                                        <div class="row patient-detail-view">
                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                        <div class="row ">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Patient Name</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->first_name . ' ' . $model->last_name; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Age</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->age; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Weight</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->weight; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Present Address</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->present_address; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Landmark</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->landmark; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Email</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->email; ?></span>
                                                                                </div>
                                                                        </div>
                                                                </div>

                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Gender</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?php
                                                                                                if ($model->gender == 1) {
                                                                                                        echo 'Male';
                                                                                                } else if ($model->gender == 1) {
                                                                                                        echo 'Female';
                                                                                                }
                                                                                                ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">DOB</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= date('d-m-Y', strtotime($model->dob)); ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Blood Group</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->blood_group; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Pin Code</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->pin_code; ?></span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <label for="patient_name">Contact Number</label>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-xs 12">
                                                                                        <span><?= $model->contact_number; ?></span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<?php Pjax::end(); ?>

<style>
        .disp_image img{
                width: 80px;
                height: 80px;
                float: right;
                border-radius: 40px;
        }
</style>