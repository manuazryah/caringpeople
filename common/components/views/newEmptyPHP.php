<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RemarksCategory;
use yii\grid\GridView;

$model = new \common\models\Remarks;
$model_category = ArrayHelper::map(RemarksCategory::find()->where(['type' => $type, 'status' => 1])->all(), 'id', 'category');
?>

<input type="hidden" name="type" value="<?= $type ?>">
<input type="hidden" name="type_id" value="<?= $type_id ?>">

<div class="col-md-3 col-sm-6 col-xs-12 left_padd">
        <div class="form-group field-remarks-category required">
                <label class="control-label" for="remarks-category">Category</label>
                <select id="remarks-category" class="form-control" name="Remarks[category]" aria-required="true" aria-invalid="true">
                        <option value="">--Select--</option>
                        <option value="6">Duty Request</option>
                        <option value="7">Leave Request</option>
                        <option value="8">Followup</option>
                        <option value="9">Compalints </option>
                        <option value="10">Account Related </option>
                </select>
        </div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12 left_padd">
        <div class="form-group field-remarks-sub_category">
                <label class="control-label" for="remarks-sub_category">Sub Category</label>
                <input type="text" id="remarks-sub_category" class="form-control" name="remarks-sub_category" maxlength="200" aria-invalid="false">
        </div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12 left_padd">
        <div class="form-group field-remarks-remark_type">
                <label class="control-label" for="remarks-remark_type">Remark Type</label>
                <select id="remarks-remark_type" class="form-control" name="Remarks[remark_type]" aria-invalid="false">
                        <option value="">--Select--</option>
                        <option value="1">Good</option>
                        <option value="0">Bad</option>
                </select>

        </div>
</div>

<div class="col-md-12 col-sm-6 col-xs-12 left_padd">
        <div class="form-group field-remarks-notes">
                <label class="control-label" for="remarks-notes">Notes</label>
                <textarea id="remarks-notes" class="form-control" name="Remarks[notes]" rows="1" aria-invalid="false"></textarea>
        </div>
</div>






<div class="row">
        <?php if ($model->isNewRecord && $dataProvider != '' && $dataProvider->getTotalCount() > 0) { ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                            'attribute' => 'category',
                            'value' => 'category0.category',
                            'filter' => ArrayHelper::map(RemarksCategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category'),
                        ],
                        'sub_category',
                            [
                            'attribute' => 'remark_type',
                            'value' => function($model, $key, $index, $column) {
                                    if ($model->remark_type == '1') {
                                            return 'Good';
                                    } elseif ($model->remark_type == '0') {
                                            return 'Bad';
                                    }
                            },
                            'filter' => [1 => 'Good', 0 => 'Bad'],
                        ],
                        'notes:ntext',
                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}'],
                    ],
                ]);
                ?>
        <?php } ?>
</div>


<script>
        $(document).ready(function () {
                $("#remarks-point").find("option").eq(0).remove();
        });

</script>

<style>
        .summary{
                display: none;
        }
</style>


