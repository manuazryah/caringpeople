<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = $model->patient->first_name;
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
                                                <p>
							<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
							<?=
							Html::a('Delete', ['delete', 'id' => $model->id], [
							    'class' => 'btn btn-danger',
							    'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							    ],
							])
							?>
                                                </p>

						<?=
						DetailView::widget([
						    'model' => $model,
						    'attributes' => [
							'service_id',
							    [
							    'attribute' => 'patient_id',
							    'value' => $model->patient->first_name,
							],
							    [
							    'attribute' => 'service',
							    'value' => $model->service0->service_name,
							],
							    [
							    'attribute' => 'staff_type',
							    'value' => function($model) {
								    if ($model->staff_type == 1)
									    return "Registered Nurse";
								    elseif ($model->staff_type == 2)
									    return "Care Assistant";
								    elseif ($model->staff_type == 3)
									    return "Doctor";
								    else
									    return "";
							    },
							],
							    [
							    'attribute' => 'duty_type',
							    'value' => function($model) {
								    if ($model->duty_type == '1') {
									    return 'Day';
								    } else if ($model->duty_type == '2') {
									    return 'Night';
								    } else if ($model->duty_type == '3') {
									    return 'Day & Night';
								    }
							    },
							    'filter' => [1 => 'Day', 2 => 'Night', 3 => 'Day & Night'],
							],
							    [
							    'attribute' => 'staff_id',
							    'value' => function($model) {
								    if ($model->duty_type == 1) {
									    $staff = StaffInfo::findOne($model->day_staff);
									    return $staff->staff_name;
								    } elseif ($model->duty_type == 2) {
									    $staff = StaffInfo::findOne($model->night_staff);
									    return $staff->staff_name;
								    } elseif ($model->duty_type == 3) {
									    $staff = StaffInfo::findOne($model->day_staff);
									    $staff1 = StaffInfo::findOne($model->night_staff);
									    return 'D-' . $staff->staff_name . ', N-' . $staff1->staff_name;
								    }
							    }
							],
							    [
							    'attribute' => 'staff_manager',
							    'value' => function($model) {
								    $staff = StaffInfo::findOne($model->staff_manager);
								    return $staff->staff_name;
							    }
							],
							//'staff_manager',
							'from_date',
							'to_date',
							'estimated_price_per_day',
							'estimated_price',
							'staff_advance_payment',
							'patient_advance_payment',
							    [
							    'attribute' => 'status',
							    'value' => function($model) {
								    if ($model->status == 1)
									    return "Enabled";
								    elseif ($model->status == 0)
									    return "Disabled";
								    else
									    return "";
							    },
							],
						    ],
						])
						?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


