<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminPostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-posts-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Admin Posts</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //'id',
                                                'post_name',
                                                    [
                                                    'attribute' => 'admin',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->admin == 0 ? 'No' : 'Yes';
                                                    },
                                                    'filter' => [1 => 'Yes', 0 => 'No'],
                                                ],
                                                    [
                                                    'attribute' => 'masters',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->masters == 0 ? 'No' : 'Yes';
                                                    },
                                                    'filter' => [1 => 'Yes', 0 => 'No'],
                                                ],
                                                    [
                                                    'attribute' => 'enquiry',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->enquiry == 0 ? 'No' : 'Yes';
                                                    },
                                                    'filter' => [1 => 'Yes', 0 => 'No'],
                                                ],
                                                    [
                                                    'attribute' => 'service',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->service == 0 ? 'No' : 'Yes';
                                                    },
                                                    'filter' => [1 => 'Yes', 0 => 'No'],
                                                ],
                                                // 'status',
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


