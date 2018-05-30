<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StaffPayroll */

$this->title = ' Staff Payroll';
$this->params['breadcrumbs'][] = ['label' => 'Staff Payrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">

                                <div class="panel-body"><div class="staff-payroll-create">

                                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                        <div class="alert alert-success">
                                                                <button type="button" class="close" data-dismiss="alert">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        <span class="sr-only">Close</span>
                                                                </button>

                                                                <?= Yii::$app->session->getFlash('success') ?>
                                                        </div>
                                                <?php endif; ?>

                                                <?=
                                                $this->render('_form', [
                                                    'model' => $model,
                                                    'service_schedule_amount' => $service_schedule_amount,
                                                    'paid_amount' => $paid_amount,
                                                    'paided_details' => $paided_details,
                                                    'prev_date' => $prev_date,
                                                    'current_date' => $current_date
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

