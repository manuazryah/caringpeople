<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ContactSubcategory;

/* @var $this yii\web\View */
/* @var $model common\models\ContactDirectory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contact Directories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Contact Directory</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="contact-directory-view">
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
                                                        //'id',
                                                            [
                                                            'attribute' => 'category_type',
                                                            'value' => $model->categoryType->category_name,
                                                        ],
                                                            [
                                                            'attribute' => 'subcategory_type',
                                                            'value' => function($data) {

                                                                    return ContactSubcategory::findOne($data->subcategory_type)->sub_category;
                                                            },
                                                        ],
                                                        'name',
                                                        'email_1:email',
                                                        'email_2:email',
                                                        'phone_1',
                                                        'phone_2',
                                                        'designation',
                                                        'company_name',
                                                            [
                                                            'attribute' => 'references',
                                                            'value' => function($model) {
                                                                    if ($model->references == 0)
                                                                            return 'Internet';
                                                                    elseif ($model->references == 1)
                                                                            return 'Care and care';
                                                                    elseif ($model->references == 2)
                                                                            return 'Guardian Angel';
                                                                    elseif ($model->references == 3)
                                                                            return 'Caremark';
                                                                    elseif ($model->references == 4)
                                                                            return 'Cancure';
                                                                    else
                                                                            return $model->references;
                                                            },
                                                        ],
                                                        'remarks:ntext',
                                                    /* 'field_1',
                                                      'field_2',
                                                      'CB',
                                                      'UB',
                                                      'DOC',
                                                      'DOU', */
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


