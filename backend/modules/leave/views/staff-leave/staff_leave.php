<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Leave';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(['id' => 'leave-approval-submit']); ?>
<div class="modal-content add-more-schedules">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Leave Application</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">
                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php //$model->commencing_date = '2013-01-08'; ?>
                                        <?= $form->field($model, 'commencing_date')->input('date') ?>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'ending_date')->input('date') ?>
                                </div>

                        </div>

                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?= $form->field($model, 'admin_comment')->textarea(['rows' => 2]) ?>
                                </div>
                        </div>

                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'status')->dropDownList(['' => 'Select', '1' => 'Pending', '2' => 'Apptroved', '3' => 'Declined']) ?>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?= Html::submitButton('Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>

                                </div>
                        </div>

                        <input type="hidden" name="leave_id" value="<?= $model->id ?>"
                </div>
        </div>
</div>
<?php ActiveForm::end() ?>


<style>
        .add-more-schedules label{
                color: #000;
                font-weight: bold;
        } #add_schedule{
                float: right;
                margin-right: 55px;
                margin-top: 13px;
                width: 100px;
        }

</style>

