<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Leave';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-leave-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<?= Html::a('<i class="fa-th-list"></i><span>Apply</span>', ['leave'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						//'id',
						//'employee_id',
						[
						    'attribute' => 'no_of_days',
						    'value' => function($model) {
							    if ($model->no_of_days == 1)
								    return $model->no_of_days . ' day';
							    else
								    return $model->no_of_days . ' days';
						    }
						],
						    [
						    'attribute' => 'leave_type',
						    'value' => function($model) {
							    return $model->leaveType->type;
						    }
						],
						'commencing_date',
						'admin_comment:ntext',
						    [
						    'attribute' => 'status',
						    'value' => function($model) {
							    if ($model->status == 1)
								    return "Pending";
							    elseif ($model->status == 2)
								    return "Approved";
							    elseif ($model->status == 3)
								    return "Declined";
							    else
								    return "";
						    },
						    'filter' => [1 => 'Pending', 2 => 'Approved', 3 => 'Declined'],
						],
						//'ending_date',
						// 'purpose:ntext',
						// 'status',
						// 'CB',
						// 'DOC',
						['class' => 'yii\grid\ActionColumn',
						    'template' => '{update}{view}',
						    'visibleButtons' => [
							'update' => function ($model) {
								return $model->status == '2' ? false : true;
							}
						    ],
						],
					    ],
					]);
					?>
				</div>
                        </div>
                </div>
        </div>
</div>