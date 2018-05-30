<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;

$branch = Branch::branch();

/* @var $this yii\web\View */
/* @var $searchModel common\models\RateCardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rate Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-card-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Rate Card</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                // 'id',
                                                //service_id
                                                ['attribute' => 'service_id',
                                                    'value' => 'service.service_name',
                                                    'filter' => yii\helpers\ArrayHelper::map(\common\models\MasterServiceTypes::find()->where(['status' => 1])->asArray()->all(), 'id', 'service_name'),
                                                ],
                                                    ['attribute' => 'sub_service',
                                                    'value' => 'subservice.sub_service',
                                                    'filter' => yii\helpers\ArrayHelper::map(\common\models\SubServices::find()->where(['status' => 1])->asArray()->all(), 'id', 'sub_service'),
                                                ],
                                                'rate_card_name',
                                                'rate_per_hour',
                                                'rate_per_visit',
                                                'rate_per_day',
                                                'rate_per_night',
                                                'rate_per_day_night',
                                                // 'period_from',
                                                // 'period_to',
//                                                [
//                                                    'attribute' => 'status',
//                                                    'value' => function($model, $key, $index, $column) {
//                                                            return $model->status == 0 ? 'Disabled' : 'Enabled';
//                                                    },
//                                                    'filter' => [1 => 'Enabled', 0 => 'Disabled'],
//                                                ],
                                                [
                                                    'attribute' => 'branch_id',
                                                    'value' => function($data) {
                                                            return Branch::findOne($data->branch_id)->branch_name;
                                                    },
                                                    'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                                ],
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
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


