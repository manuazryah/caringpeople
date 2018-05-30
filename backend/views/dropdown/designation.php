<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\MasterDesignations();
$form = ActiveForm::begin(['id' => 'submit-add-form']);
?>



<div class="modal-content" id="pop-form">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title pop-heading">Add Designation</h4>
        </div>

        <div class="modal-body">

                <div class="row">

                        <div class='col-md-6 col-sm-6 col-xs-12 left_padd' style="margin-left: 20px;">
                                <label class="control-label" for="uploadcategory-sub_category">Designation</label>
                                <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label(FALSE) ?>

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
