<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <?= Html::a('<i class="fa-th-list"></i><span> Add Expenses</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                        <p style="float: right">
                                                <b style="color: #000;font-size: 14px;margin-right: 10px"> Total expense : <i class="fa fa-inr" aria-hidden="true"></i>  <?= $sum ?> /-</b>
                                        </p>

                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    ['attribute' => 'expense_type',
                                                    'value' => 'expenseType.type',
                                                    'filter' => ArrayHelper::map(\common\models\ExpenseType::find()->where(['status' => '1'])->asArray()->all(), 'id', 'type'),
                                                ],
                                                'expense_subtype',
                                                'amount',
                                                    ['attribute' => 'date',
                                                    'value' => function ($model) {
                                                            return date("d-m-Y", strtotime($model->date));
                                                    },
                                                    'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'date', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
                                                ],
                                                    ['class' => 'yii\grid\ActionColumn',
                                                    'template' => '{update}{delete}'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


