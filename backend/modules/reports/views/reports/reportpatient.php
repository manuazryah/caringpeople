<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\StaffInfo;
use common\models\Service;
use common\models\ServiceSchedule;
use kartik\export\ExportMenu;
use yii\helpers\Url;

$this->title = 'Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="attendance-create">


                                                <div class="attendance-form form-inline">
                                                        <?php
                                                        $form = ActiveForm::begin([
                                                                    'method' => 'get',
                                                        ]);
                                                        ?>
                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    //   "endDate" => (string) date('d/m/Y'),
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>

                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?php $branch = Branch::Branch();
                                                                ?>
                                                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']); ?>
                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div style="clear:both"></div>

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($dataProvider) && $dataProvider != '') { ?>




                                                        <div class="row" style="margin:10px 0px 0px 0px;">

                                                                <?php
                                                                $from = date('Y-m-d', strtotime($model->date));
                                                                $to = date('Y-m-d', strtotime($model->DOC));
                                                                ?>

                                                        </div>


                                                        <div class = "table-responsive">
                                                                <?php
                                                                $gridColumns = [
                                                                        ['class' => 'yii\grid\SerialColumn'],
                                                                     'patient_id',
                                                                    'first_name',
                                                                        [
                                                                        'header' => 'Amount',
                                                                        'value' => function($model) use ($from, $to) {
                                                                                return $model->total($from, $to, $model->id);
                                                                        },
                                                                        'filter' => '',
                                                                    ],
                                                                        ['class' => 'yii\grid\ActionColumn',
                                                                        'template' => '{print}',
                                                                        'buttons' => [
                                                                            //view button
                                                                            'print' => function ($url, $model) {
                                                                                    return Html::a('View Details', $url, [
                                                                                                'title' => Yii::t('app', 'print'),
                                                                                                'class' => 'btn btn-info',
                                                                                                'target' => '_blank',
                                                                                                'style' => 'color:#fff',
                                                                                    ]);
                                                                            },
                                                                        ],
                                                                        'urlCreator' => function($action, $model) use ($from, $to) {
                                                                                if ($action === 'print') {
                                                                                        $url = Url::to(['reports/servicedetails', 'from' => $from, 'to' => $to, 'patient' => $model->id]);
                                                                                        return $url;
                                                                                }
                                                                        }
                                                                    ],
                                                                ];
                                                                if (Yii::$app->user->identity->post_id == '1') {
                                                                        echo ExportMenu::widget([
                                                                            'dataProvider' => $dataProvider,
                                                                            'columns' => $gridColumns,
                                                                        ]);
                                                                }
                                                                echo \kartik\grid\GridView::widget([
                                                                    'dataProvider' => $dataProvider,
                                                                    'filterModel' => $searchModel,
                                                                    'columns' => $gridColumns,
                                                                ]);
                                                                ?>
                                                        </div>

                                                        <?php
                                                }
                                                ?>


                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .form-control{
                border: none;
        }.table-responsive{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }#example-1_filter{
                display: none;
        }
        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1{
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }.label-1{
                margin-left: 48px;
        }
</style>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.min.js"></script>

<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
        $(document).ready(function ($)
        {
                $("#example-1").dataTable({
                        aLengthMenu: [
                                [20, 50, 100, -1], [20, 50, 100, "All"]
                        ]
                });
        });
</script>

<?php

function divadjust($k) {
        if ($k % 3 == 0) {
                echo '</div><div class="row">';
        }
        return;
}
?>