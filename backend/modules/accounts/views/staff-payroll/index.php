<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;

$staffs = StaffInfo::Liststaffs();

$year = \common\models\StaffPayroll::Liststaffs();

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffPayrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payroll Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-payroll-index">

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
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //   'id',
                                                [
                                                    'attribute' => 'staff_id',
                                                    'value' => 'staff.staff_name',
                                                    'filter' => ArrayHelper::map($staffs, 'id', 'staff_name'),
                                                    'filterOptions' => array('id' => "staff_name_search"),
                                                ],
                                                    [
                                                    'header' => 'Date',
                                                    'attribute' => 'date_from',
                                                    'value' => function($model) {
                                                            return date('d-m-Y', strtotime($model->date_from)) . ' - ' . date('d-m-Y', strtotime($model->date_to));
                                                    }
                                                ],
                                                    [
                                                    'attribute' => 'type',
                                                    'value' => function($model) {
                                                            if ($model->type == 1) {
                                                                    return 'Advance';
                                                            } else if ($model->type == 2) {
                                                                    return 'Full Payment';
                                                            }
                                                    },
                                                    'filter' => [1 => 'Advanced', 2 => 'Full Payment'],
                                                ],
                                                'amount',
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('#staff_name_search select').attr('id', 'staff_name');
                $('#year_search select').attr('id', 'year');
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

