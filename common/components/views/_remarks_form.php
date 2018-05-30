<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RemarksCategory;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;



$model_category = ArrayHelper::map(RemarksCategory::find()->where(['type' => $type, 'status' => 1])->all(), 'id', 'category');
?>

<?php $form_remark = ActiveForm::begin(['id' => 'add-remarks']); ?>

<div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'category')->dropDownList($model_category, ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'remarks_category']) ?>

        <a class="add-option-dropdown add-new" id="remarks_category-2" type="<?= $type ?>"> <div class="div-add-new">+ Add New </div></a>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'sub_category')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_remark->field($remark, 'type')->hiddenInput(['value' => $type])->label(false); ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_remark->field($remark, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

        <?php
        if (!$remark->isNewRecord) {
                $remark->date = date('d-m-Y', strtotime($remark->date));
        } else {
                $remark->date = date('d-m-Y');
        }
        echo DatePicker::widget([
            'model' => $remark,
            'form' => $form_remark,
            'type' => DatePicker::TYPE_INPUT,
            'attribute' => 'date',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy',
            ]
        ]);
        ?>

</div>
<?php if ($type == 2 || $type == 4) { ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <fieldset class="rating">
                        <legend class="control-label">Rating:</legend>
                        <input type="radio" id="star9" name="rating" value="9" onclick="postToController();"/><label for="star9" title="Excellent">9 stars</label>
                        <input type="radio" id="star8" name="rating" value="8" onclick="postToController();"/><label for="star8" title="Very Good">8 stars</label>
                        <input type="radio" id="star7" name="rating" value="7" onclick="postToController();"/><label for="star7" title="Satisfactory">7 stars</label>
                        <input type="radio" id="star6" name="rating" value="6" onclick="postToController();"/><label for="star6" title="Good">6 stars</label>
                        <input type="radio" id="star5" name="rating" value="5" onclick="postToController();"/><label for="star5" title="Average">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" onclick="postToController();"/><label for="star4" title="Unsatisfactory">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" onclick="postToController();"/><label for="star3" title="Bad">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" onclick="postToController();"/><label for="star2" title="Very Bad">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" onclick="postToController();"/><label for="star1" title="Very Poor">1 star</label>
                </fieldset>

                <?php echo $form_remark->field($remark, 'point')->hiddenInput(['value' => $type, 'id' => 'rating'])->label(false); ?>

        </div>
<?php } ?>
<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form_remark->field($remark, 'notes')->textarea(['rows' => 1]) ?>

</div>


<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>

        </div>
</div>
<?php ActiveForm::end(); ?>
<div class="row remarks-table">

        <?php
        Pjax::begin([
            'enablePushState' => false
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['id' => $model['id']];
            },
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                    'attribute' => 'category',
                    'value' => 'category0.category',
                    'filter' => ArrayHelper::map(RemarksCategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category'),
                ],
                'sub_category',
                'point',
                'notes:ntext',
                'date',
                    [
                    'attribute' => 'status',
                    'value' => function($model, $key, $index, $column) {
                            if ($model->status == '2') {
                                    return 'Closed';
                            } elseif ($model->status == '1') {
                                    return 'Active';
                            }
                    },
                    'filter' => [2 => 'Closed', 1 => 'Active'],
                ],
                    ['class' => 'yii\grid\ActionColumn',
                    'template' => '{status}',
                    'visibleButtons' => [
                        'status' => function ($model, $key, $index) {
                                return $model->status != '2' ? true : false;
                        }
                    ],
                    'buttons' => [
                        'status' => function ($url, $model) {

                                return Html::checkbox('status', false, ['class' => 'iswitch iswitch-secondary remarks-status', 'id' => $model->id]);
                        },
                    ],
                ],
            ],
        ]);
        Pjax::end();
        ?>

</div>


<style>
        .summary{
                display: none;
        }
        legend{
                border: none;
                font-size: 15px;
                margin-left: 7px;
                color: #777777;
                font-weight: bold;
        }
</style>



