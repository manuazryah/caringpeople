<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-form form-inline">

	<?php $form = ActiveForm::begin(); ?>
	<?php $posts = \common\models\AdminPosts::find()->all(); ?>

	<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
		<?= $form->field($model, 'post_id')->dropDownList(ArrayHelper::map($posts, 'id', 'post_name'), ['prompt' => '--Select--']) ?>

	</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'employee_code')->textInput(['maxlength' => true]) ?>

	</div>
	<?php if ($model->isNewRecord) { ?>
	        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

	        </div>
	<?php } ?>
	<?php if ($model->isNewRecord) { ?>
	        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

			<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	        </div>
	<?php } ?>
	<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php $branches = Branch::find()->where(['status' => '1'])->all(); ?>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>

	</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
		<?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

	</div>

	<div class="form-group" style="float: right;">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
