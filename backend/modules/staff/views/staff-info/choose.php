<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use common\models\StaffInfoUploads;
use kartik\export\ExportMenu;

//AppsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Staffs';
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias(Yii::$app->params['uploadPath']);
$branch = Branch::branch();
$designations = \common\models\MasterDesignations::designationlist();
if (isset(Yii::$app->request->queryParams)) {
        $branch_id = Yii::$app->request->queryParams['branch'];

        $gender = Yii::$app->request->queryParams['gender'];
        if ($gender == 0 && $gender != '') {
                $staffs = \common\models\StaffInfo::find()->where(['status' => 1, 'post_id' => 5, 'gender' => 0, 'branch_id' => $branch_id])->orderBy(['staff_name' => S0RT_ASC])->all();
        } else
        if ($gender == 1 && $gender != '') {
                $staffs = \common\models\StaffInfo::find()->where(['status' => 1, 'post_id' => 5, 'gender' => 1, 'branch_id' => $branch_id])->orderBy(['staff_name' => S0RT_ASC])->all();
        } else {
                $staffs = \common\models\StaffInfo::find()->where(['status' => 1, 'post_id' => 5, 'branch_id' => $branch_id])->orderBy(['staff_name' => S0RT_ASC])->all();
        }
}
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						'staff_id',
						[
                                                    'attribute' => 'staff_name',
                                                    'filter' => ArrayHelper::map($staffs, 'staff_name', 'staff_name'),
                                                    'filterOptions' => array('id' => "staff_name_search"),
                                                ],
						'contact_no',
						    [
						    'attribute' => 'designation',
						    'value' => function($model, $key, $index, $column) {
							    return $model->designation($model->designation);
						    },
						    'filter' => ArrayHelper::map(\common\models\MasterDesignations::designationlist(), 'id', 'title'),
						],
						    [
						    'attribute' => 'years_of_experience',
						    'header' => 'Experience',
						],
						    
						'average_point',
						    [
						    'header' => 'Work Status',
						    'attribute' => 'working_status',
						    'value' => function($model, $key, $index, $column) {
							    if ($model->working_status == '0') {
								    return 'Bench';
							    } else if ($model->working_status == '1') {
								    return 'On Duty';
							    }
						    },
						    'filter' => [0 => 'Bench', 1 => 'On Duty'],
						],
						    ['class' => 'yii\grid\ActionColumn',
						    'template' => '{staff_choose}',
						    'buttons' => [
							'staff_choose' => function ($url, $model) {

								return Html::radio('staff_choose', false, ['class' => 'cbr cbr-primary', 'id' => $model->id, 'value' => $model->id]);
							},
						    ],
						],
					    ],
					]);
					?>


                                        <form id="searchChooseStaff">
                                               <?php
                                                if (isset($service) && $service != '') {
                                                        $service_id = $service;
                                                } else if (isset($schedule) && $schedule != '') {
                                                        $sschedule = \common\models\ServiceSchedule::findOne($schedule);
                                                        $service_id = $sschedule->service_id;
                                                }
                                                $service_detail = \common\models\Service::findOne($service_id);
                                                if ($service_detail->duty_type == 5 && $service_detail->day_night_staff == 2 && $replace_or_new == 2) {
                                                        ?>
                                                        <div class="col-md-2" style="float:right;">
                                                                <select class="form-control" id="select-day-night-staff"  required="" >
                                                                        <option value="">Choose Staff</option>
                                                                        <option value="1">Day Staff</option>
                                                                        <option value="2">Night Staff</option>
                                                                </select>
                                                        </div>
                                                <?php } ?>
                                                <input type="hidden" name="service_id" id="service_id" value="<?= $service; ?>"/>
                                                <input type="hidden" name="schedule_id" id="schedule_id" value="<?= $schedule; ?>"/>
                                                <input type="hidden" name="replace_or_new" id="replace_or_new" value="<?= $replace_or_new; ?>"/>
                                                <input type="hidden" name="type" id="type" value="<?= $type; ?>"/>
                                                <input type="hidden" name="choosed_staff" id="choosed_staff"/>
                                                <div class="modal-footer result-buttons" >
                                                        <button type="submit" class="btn btn-success waves-effect" >Continue</button>

                                                </div>
                                        </form>

                                </div>
                        </div>
                </div>
        </div>
</div>





<script>
        $(document).ready(function () {
                $('#staff_skills_search select').attr('id', 'skills_search');
                $('#staff_name_search select').attr('id', 'staff_name');
                $("#skills_search").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

        });
</script>