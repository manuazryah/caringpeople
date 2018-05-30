<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Day Book';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <div class="row" style="margin-left: 0px;border-bottom: 2px solid rgba(39, 41, 42, 0.46);">
                                                <div class="col-md-6">

                                                        <?= $this->render('_search', ['model' => $searchModel, 'from' => $from, 'to' => $to]) ?>

                                                </div>
                                        </div>


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>





                                        <div class="table-responsive" style="border:none;">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'showFooter' => TRUE,
                                                    'footerRowOptions' => ['style' => 'font-weight:bold'],
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        //  'id',
                                                        //'branch_id',
                                                        [
                                                            'attribute' => 'branch_id',
                                                            'value' => function($model) {
                                                                    $branch = common\models\Branch::findOne($model->branch_id);
                                                                    return $branch->branch_name;
                                                            },
                                                            'filter' => \yii\helpers\ArrayHelper::map(common\models\Branch::find()->where(['status' => 1])->andWhere(['<>', 'id', 0])->all(), 'id', 'branch_name')
                                                        ],
                                                            [
                                                            'attribute' => 'reference_type',
                                                            'value' => function($model) {
                                                                    if ($model->reference_type == 1) {
                                                                            return 'Staff Payroll';
                                                                    } else if ($model->reference_type == 2) {
                                                                            return 'Purchase';
                                                                    } else if ($model->reference_type == 3) {
                                                                            return 'Patient Bill';
                                                                    } else if ($model->reference_type == 4) {
                                                                            return 'Patient Bill (Refund)';
                                                                    }
                                                            },
                                                            'filter' => [1 => 'Staff Payroll', 2 => 'Purchase', 3 => 'Patient Bill'],
                                                        ],
//                                'debited_to_credited_by',
                                                        // 'type',
                                                        [
                                                            'attribute' => 'amount',
                                                            'header' => 'Debit',
                                                            'value' => function($model) {
                                                                    if ($model->type == 1) {
                                                                            return Yii::$app->NumToWord->NumberFormat($model->amount);
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            //  'footer' => \common\models\Accounts::debitTotal($dataProvider->models, 'amount'),
                                                            'footer' => Yii::$app->NumToWord->NumberFormat(\common\models\Accounts::debitTotal($dataProvider->models, 'amount')),
                                                        ],
                                                            [
                                                            'attribute' => 'amount',
                                                            'header' => 'Credit',
                                                            'value' => function($model) {
                                                                    if ($model->type == 2) {
                                                                            return Yii::$app->NumToWord->NumberFormat($model->amount);
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                            'footer' => Yii::$app->NumToWord->NumberFormat(\common\models\Accounts::creditTotal($dataProvider->models, 'amount')),
                                                        ],
                                                    // 'purpose',
                                                    // 'payment_type',
                                                    // 'amount',
                                                    // 'payment_date',
                                                    // 'CB',
                                                    // 'UB',
                                                    // 'DOC',
                                                    // 'DOU',
                                                    //['class' => 'yii\grid\ActionColumn'],
                                                    ],
                                                ]);
                                                ?>
                                        </div>




                                        <div class="row">
                                                <div class="col-md-6"></div>
                                                <?php $credit = \common\models\Accounts::creditTotal($dataProvider->models, 'amount'); ?>
                                                <?php $debit = \common\models\Accounts::debitTotal($dataProvider->models, 'amount'); ?>
                                                <?php $bal = $credit - $debit ?>

                                                <div class="col-md-6">
                                                        <div class="col-md-3 tot">
                                                                <b>Balance  : </b>
                                                        </div>
                                                        <div class="col-md-3 tot">
                                                                <b> <?php echo Yii::$app->NumToWord->NumberFormat($bal); ?></b>
                                                        </div>

                                                </div>

                                        </div>




                                </div>
                        </div>
                </div>
        </div>
</div>

<style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
                border: 1px solid #eee;
        }.filters{
                display: none;
        }.tot{
                font-weight: bold !important;
                color: #000;
                text-align: right;
        }
</style>


