<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\ContactDirectory();
$form = ActiveForm::begin(['id' => 'submit-add-form']);
?>



<div class="modal-content" id="pop-form">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title pop-heading">Add Contact Directory</h4>
        </div>

        <div class="modal-body">
                <?php
                $category = common\models\ContactSubcategory::findOne($category);
                $model->category_type = $category->category_id;
                $model->subcategory_type = $category;
                $model->designation = 13;
                ?>

                <div class="row">
                        <div class='col-md-6 col-sm-6 col-xs-12 left_padd' style="margin-left: 20px;display: none;">    <?= $form->field($model, 'category_type')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd' style="margin-left: 20px;display: none;">    <?= $form->field($model, 'subcategory_type')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd' style="margin-left: 20px;display: none;">    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-6 col-sm-6 col-xs-12 left_padd' style="margin-left: 20px;">    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <input type="hidden" name="type" id="type" value="<?= $type; ?>">
                        <input type="hidden" name="field_id" id="field_id" value="<?= $field_id; ?>">

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success pop-submit-btn']) ?>

                        </div>
                </div>

        </div>



</div>

<?php ActiveForm::end(); ?>
