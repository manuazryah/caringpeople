<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\State;
use common\models\City;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Branch</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'branch_name',
                            'branch_code',
                            [
                                'attribute' => 'country',
                                'value' => 'country0.country_name',
                                'filter' => ArrayHelper::map(Country::find()->where(['status'=>'1'])->asArray()->all(), 'id', 'country_name'),
                            ],
                            [
                                'attribute' => 'state',
                                'value' => 'state0.state_name',
                                'filter' => ArrayHelper::map(State::find()->where(['status'=>'1'])->asArray()->all(), 'id', 'state_name'),
                            ],
                            [
                                'attribute' => 'city',
                                'value' => 'city0.city_name',
                                'filter' => ArrayHelper::map(City::find()->where(['status'=>'1'])->asArray()->all(), 'id', 'city_name'),
                            ],
                           
                            // 'city',
                            // 'contact_person_name',
                            // 'contact_person_number1',
                            // 'contact_person_number2',
                            // 'contact_person_email:email',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


