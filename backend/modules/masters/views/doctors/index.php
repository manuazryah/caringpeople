<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        'name',
                                                        //  'hospital',
                                                        ['attribute' => 'hospital',
                                                            'value' => 'h.hospital_name',
                                                            'filter' => ArrayHelper::map(common\models\Hospital::find()->where(['status' => '1'])->asArray()->all(), 'id', 'hospital_name'),],
                                                        'department',
                                                        'mobille',
                                                        'email:email',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    return $model->status == 0 ? 'Disabled' : 'Enabled';
                                                            },
                                                            'filter' => [1 => 'Enabled', 0 => 'Disabled'],
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

                                        <div class="col-md-5 col-sm-6 col-xs-12 small-forms">
                                                <div class="header-small-forms">
                                                        <?php if ($model->isNewRecord) { ?>
                                                                <h4>Add Doctor</h4>
                                                        <?php } else { ?>
                                                                <h4>Update Doctor : <?= $model->name; ?></h4>
                                                        <?php } ?>
                                                </div>

                                                <div class="small-forms-form">
                                                        <?=
                                                        $this->render('_form', [
                                                            'model' => $model,
                                                        ])
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


