<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LoginHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Login History';
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->user->identity->branch_id != '0') {
        $patients = common\models\PatientGeneral::find()->where(['status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id])->orderBy(['first_name' => SORT_ASC])->all();
        $staffs = common\models\StaffInfo::find()->where(['status' => 1, 'branch_id' => Yii::$app->user->identity->branch_id])->orderBy(['staff_name' => SORT_ASC])->all();
} else {
        $patients = common\models\PatientGeneral::find()->where(['status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
        $staffs = common\models\StaffInfo::find()->where(['status' => 1])->orderBy(['staff_name' => SORT_ASC])->all();
}
?>
<div class="login-history-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
<div style="float: right">
                                                <?php
                                                $_SESSION['page_size'] = $pagesize;
                                                ?>
                                                <?= Html::beginForm() ?>

                                                <label style="float: left">Show
                                                        <?= Html::dropDownList('size', $pagesize, ['20' => '20', '50' => '50', '100' => '100'], ['class' => 'page-size-dropdwn', 'id' => 'size']); ?>
                                                        Entries
                                                </label>
                                                <input type="hidden" name="page-hidden" value="<?= $pagesize ?>">

                                                <?= Html::endForm() ?>

                                        </div>
                                        <div style="clear:both"></div>

                                        <div class="table-responsive" style="border:none;">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            [
                                                            'attribute' => 'type',
                                                            'value' => function($model) {
                                                                    if ($model->type == 1) {
                                                                            return 'Staff';
                                                                    } else if ($model->type == 2) {
                                                                            return 'Patient';
                                                                    }
                                                            },
                                                            'filter' => ['1' => 'Staff', '2' => 'Patient'],
                                                        ],
                                                            [
                                                            'attribute' => 'staff_id',
                                                            'value' => function($model) {
                                                                    if (isset($model->staff_id)) {
                                                                            $staff = common\models\StaffInfo::findOne($model->staff_id);
                                                                            return $staff->staff_name;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'filter' => ArrayHelper::map($staffs, 'id', 'staff_name'),
                                                            'filterOptions' => array('id' => "staff_name_search"),
                                                        ],
                                                            [
                                                            'attribute' => 'patient_id',
                                                            'value' => function($model) {
                                                                    if (isset($model->patient_id)) {
                                                                            $patient = common\models\PatientGeneral::findOne($model->patient_id);
                                                                            return $patient->first_name;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'filter' => ArrayHelper::map($patients, 'id', 'first_name'),
                                                            'filterOptions' => array('id' => "patient_name_search"),
                                                        ],
                                                            [
                                                            'attribute' => 'logged_in',
                                                            'value' => function($model) {
                                                                    if (isset($model->logged_in)) {
                                                                            return $model->logged_in;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'filter' => DatePicker::widget([
                                                                'model' => $searchModel,
                                                                'name' => 'LoginHistorySearch[logged_in]',
                                                                'pluginOptions' => [
                                                                    'format' => 'dd-mm-yyyy',
                                                                    'autoclose' => true,
                                                                ]
                                                            ])
                                                        ],
                                                        // 'logged_out',
                                                        [
                                                            'attribute' => 'logged_out',
                                                            'value' => function($model) {
                                                                    if (isset($model->logged_out)) {
                                                                            return $model->logged_out;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'filter' => DatePicker::widget([
                                                                'model' => $searchModel,
                                                                'name' => 'LoginHistorySearch[logged_out]',
                                                                'pluginOptions' => [
                                                                    'format' => 'dd-mm-yyyy',
                                                                    'autoclose' => true,
                                                                ]
                                                            ])
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>



<script>
        $(document).ready(function () {
                $('#patient_name_search select').attr('id', 'patient_name');
                $('#staff_name_search select').attr('id', 'staff_name');
                $("#patient_name").select2({
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
