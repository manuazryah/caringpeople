<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

if ($type != 2) {
        $form = ActiveForm::begin(['id' => 'submit-add-rate-card']);
        $model = new common\models\RateCard();
} else {
        $form = ActiveForm::begin(['id' => 'submit-update-rate-card']);
        $model = common\models\RateCard::find()->where(['service_id' => $service, 'branch_id' => $branch, 'status' => 1])->one();
}
?>



<div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <?php if ($type != 2) { ?>
                        <h4 class="modal-title">Add Rate Card</h4>
                <?php } else { ?>
                        <h4 class="modal-title">Update Rate Card</h4>
                <?php } ?>
        </div>

        <div class="modal-body">

                <div class="row">
                        <?php
                        $model->branch_id = $branch;
                        $services = \common\models\MasterServiceTypes::find()->where(['id' => $service])->all();
                        ?>

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' >    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map($services, 'id', 'service_name')) ?>

                        </div>
                        <?php
                        if (isset($sub_service) && $sub_service != '') {
                                $sub_services = \common\models\SubServices::find()->where(['id' => $sub_service])->all();
                                ?>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_service')->dropDownList(ArrayHelper::map($sub_services, 'id', 'sub_service')) ?>

                                </div>
                                <?php
                        } else {
                                ?>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display: none;">    <?= $form->field($model, 'sub_service')->dropDownList(['0' => '--select--']) ?>

                                </div>
                                <?php
                        }
                        ?>

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_card_name')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_hour')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_visit')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_day')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_night')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate_per_day_night')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'branch_id')->textInput(['maxlength' => true]) ?>

                        </div>

                        <input type="hidden" name="service" value="<?= $service; ?>">
                        <input type="hidden" name="branch" value="<?= $branch; ?>">

                </div>

        </div>


        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
</div>

<?php ActiveForm::end(); ?>
