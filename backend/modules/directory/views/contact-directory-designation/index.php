<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactDirectoryDesignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Directory Designations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-directory-designation-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        'designation',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    if ($model->status == '0') {
                                                                            return 'Disabled';
                                                                    } elseif ($model->status == '1') {
                                                                            return 'Enabled';
                                                                    }
                                                            },
                                                            'filter' => [0 => 'Disabled', 1 => 'Enabled'],
                                                        ],
                                                        // 'DOC',
                                                        // 'DOU',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{update}{delete}',
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 small-forms">
                                                <div class="header-small-forms">
                                                        <?php if ($model->isNewRecord) { ?>
                                                                <h4>Add Contact Directory Designation</h4>
                                                        <?php } else { ?>
                                                                <h4>Update Designation : <?= $model->designation; ?></h4>
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


