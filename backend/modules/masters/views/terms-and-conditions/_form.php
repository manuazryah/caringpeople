<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TermsAndConditions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terms-and-conditions-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'type')->dropDownList(['' => '--Select--', '1' => 'Patient Enquiry', '2' => 'Patient', '3' => 'Staff Enquiry', '4' => 'Staff']) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'note')->textarea(['rows' => 2]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>


<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

        CKEDITOR.replace('termsandconditions-note',
                {
                        toolbar: 'Basic', /* this does the magic */
                        //       height: '100px',

                });
</script>