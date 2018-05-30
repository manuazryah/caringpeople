<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminUsers;
use common\models\Country;
use common\models\State;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = $model->city_name;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage City</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="city-view">
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
//                                                        'id',
                                                            [
                                                            'attribute' => 'country_id',
                                                            'value' => call_user_func(function($model) {
                                                                            return Country::findOne($model->country_id)->country_name;
                                                                    }, $model),
                                                        ],
                                                            [
                                                            'attribute' => 'state_id',
                                                            'value' => call_user_func(function($model) {
                                                                            return State::findOne($model->state_id)->state_name;
                                                                    }, $model),
                                                        ],
                                                        'city_name',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => call_user_func(function($model) {
                                                                            if ($model->status == 1) {
                                                                                    return 'ENABLED';
                                                                            } else {
                                                                                    return 'DISABLED';
                                                                            }
                                                                    }, $model),
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


