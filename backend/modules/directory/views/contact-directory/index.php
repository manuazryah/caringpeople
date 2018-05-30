<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ContactCategoryTypes;
use common\models\ContactSubcategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactDirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Directories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-directory-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Contact Directory</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
<div style="float: right">
                                                <?php
                                                $_SESSION['page_size'] = $pagesize;
                                                ?>
                                                <?= Html::beginForm() ?>

                                                <label style="float: left">Show
                                                        <?= Html::dropDownList('size', $pagesize, ['20' => '20', '50' => '50', '100' => '100'], ['class' => 'page-size-dropdwn', 'id' => 'size']); ?>
                                                        Entries
                                                </label>
                                                <input type="hidden" name="page-hidden" value="<?= $pagesize ?>">

                                                <?= Html::endForm() ?>

                                        </div>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //'id',
                                                [
                                                    'attribute' => 'category_type',
                                                    'value' => 'categoryType.category_name',
                                                    'filterOptions' => ['id' => 'cat_type'],
                                                    'filter' => ArrayHelper::map(ContactCategoryTypes::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category_name'),
                                                    'filterOptions' => array('id' => "contact_categorytype_search"),
                                                ],
                                                    [
                                                    'attribute' => 'subcategory_type',
                                                    'filterOptions' => ['id' => 'sub_cat_type'],
                                                    'value' => function($data) {

                                                            return ContactSubcategory::findOne($data->subcategory_type)->sub_category;
                                                    },
                                                    'filter' => common\models\ContactDirectory::subcategory($searchModel->category_type),
                                                    'filterOptions' => array('id' => "contact_subcategorytype_search"),
                                                ],
                                                'name',
                                                'email_1:email',
                                                //'email_2:email',
                                                'phone_1',
                                                // 'phone_2',
                                                // 'designation',
                                                ['attribute' => 'designation',
                                                    'value' => 'designationType.designation',
                                                    'filter' => ArrayHelper::map(common\models\ContactDirectoryDesignation::find()->where(['status' => '1'])->asArray()->all(), 'id', 'designation'),
                                                    'filterOptions' => array('id' => "contact_designation_search"),
                                                ],
                                                // 'company_name',
                                                // 'references',
                                                // 'remarks:ntext',
                                                // 'field_1',
                                                // 'field_2',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn',
                                                    'visibleButtons' => [
                                                        'delete' => function ($model, $key, $index) {
                                                                return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                        }
                                                    ],],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        table.table tr td:last-child {
                width: 20px!important;
        }
</style>

<script>

        $(document).ready(function () {
                $('#contact_categorytype_search select').attr('id', 'contact_categorytype');
                $('#contact_subcategorytype_search select').attr('id', 'contact_subcategorytype');
                $('#contact_designation_search select').attr('id', 'contact_designation');

                $("#contact_categorytype").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#contact_subcategorytype").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#contact_designation").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>
