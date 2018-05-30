<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\FollowupsWidget;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use common\models\FollowupType;

$followup_subtype = ArrayHelper::map(FollowupSubType::find()->where(['type_id' => $type, 'status' => 1])->all(), 'id', 'sub_type');
$followuptype = ArrayHelper::map(FollowupType::find()->all(), 'id', 'type');
$form_followup = ActiveForm::begin(['id' => 'add-followup', 'options' => ['enctype' => 'multipart/form-data']]);
if ($type != '') {
        ?>
        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_followup->field($model, 'type')->hiddenInput(['value' => $type])->label(false); ?>
        </div>

<?php } else { ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?= $form_followup->field($model, 'type')->dropDownList($followuptype, ['prompt' => '--Select--', 'class' => 'form-control followup_type']) ?>
        </div>
<?php } ?>

<div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_followup->field($model, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

</div>

<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'sub_type')->dropDownList($followup_subtype, ['prompt' => '--Select--', 'class' => 'form-control sub_type', 'id' => 'sub_type']) ?>
        <a class="add-option-dropdown add-new" id="sub_type-3" type="<?= $type ?>"><div class="added"> + Add New</div></a>
</div>

<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
        <div class="form-group field-followups-followupdate">
                <label class="control-label" for="followups-followupdate">Followup Date</label>
                <?php
                echo DateTimePicker::widget([
                    'name' => 'Followups[followup_date]',
                    'id' => 'Followup_date',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'value' => date('d-M-Y h:i'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy hh:ii'
                    ]
                ]);
                ?>



        </div>

</div>


<?php
$all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
$data = ArrayHelper::map($all_users, 'id', 'namepost');
if ($type == '5') {
        $service = common\models\Service::findOne($type_id);
        $data = Yii::$app->Followups->Assigned($service);
}
?>

<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'assigned_to')->dropDownList($data, ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'create-assigned_to']) ?>

</div>

<div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_followup->field($model, 'assigned_to_type')->hiddenInput(['id' => 'assigned_to_type'])->label(false); ?>

</div>


<?php
$user = StaffInfo::findOne(Yii::$app->user->identity->id);
$model->assigned_from = $user->staff_name;
?>
<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'assigned_from')->textInput(['maxlength' => true, 'readonly' => true]) ?>

</div>

<?php
$related_staff = Yii::$app->Followups->Relatedstaffs($type, $type_id);
if ($type == 5) {
        $model->related_staffs = Yii::$app->Followups->Selectedstaffs($type, $type_id);
} else if ($type == 1) {
        $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
        $related_staff = ArrayHelper::map($all_users, 'id', 'namepost');
}
?>
<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'attachments')->fileInput(['maxlength' => true]) ?>

</div>
<?php if ($type == 5) { ?>

        <div class="row">
                <div class='col-md-8 col-sm-6 col-xs-12 left_padd'>          <?= $form_followup->field($model, 'related_staffs')->dropDownList($related_staff, ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'create-related_staffs', 'multiple' => 'multiple']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>          <?= $form_followup->field($model, 'releated_notification_patient')->checkbox(); ?>


                </div>
        </div>
<?php } ?>

<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'followup_notes')->textArea(['rows' => 2, 'style' => 'border: 1px solid #eee;']) ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'repeated')->checkBox(['id' => 'repeated_followups']); ?>

</div>
<div id="repeated-fields">
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="repeated-types">    <?= $form_followup->field($model, 'repeated_type')->dropDownList(['' => '--Select--', '4' => 'Every Day', '1' => 'Specific Dates', '2' => 'Specific Days of week', '3' => 'Specific Days of month'], ['id' => 'repeated-option']) ?>

        </div>



        <!----------------------------Specific date------------------------------------->
        <div class="col-md-12 option1 col-sm-6 col-xs-12 left_padd" style="display: none;">

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd text-items'>
                        <div class="form-group field-followups-date">
                                <label class="control-label" for="reminder-remind_days">Select Date</label>
                                <input type="datetime-local" id="reminder-remind_days1" class="form-control remind_days1" name="date[remind_days1][]">
                        </div>
                </div>

                <div class="col-md-3" style="margin-top: 15px;">
                        <a class="btn btn-blue btn-icon btn-icon-standalone add-items" ><i class="fa-plus"></i><span>Add More Dates</span></a>

                </div>
        </div>

        <!----------------------------Specific days of week------------------------------------->

        <?php
        $days = Yii::$app->Followups->Days();
        ?>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd option2' style="display: none;">
                <div class="form-group field-followups-date">
                        <label class="control-label" for="reminder-remind_days">Select Day</label>
                        <?= Html::dropDownList('create[specific-days]', null, $days, ['class' => 'form-control', 'id' => 'specific-days', 'multiple' => 'multiple']); ?>
                </div>
        </div>


        <!----------------------------Specific days of week------------------------------------->

        <?php
        $dates = Yii::$app->Followups->Dates();
        ?>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd option3' style="display: none;">
                <div class="form-group field-followups-date">
                        <label class="control-label" for="reminder-remind_days">Select Date</label>
                        <?= Html::dropDownList('create[specific-dates-month]', null, $dates, ['class' => 'form-control', 'id' => 'specific-dates-month', 'multiple' => 'multiple']); ?>
                </div>
        </div>

</div>




<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>

        </div>
</div>



<?php ActiveForm::end(); ?>


<div class="row followups-table">
        <div class="col-md-12">
                <a target="_blank" href="<?= Yii::$app->homeUrl ?>followup/followups/repeated?typeid=<?= $type_id ?> && type=<?= $type; ?>" class="btn btn-success" style="float: right">Repeated Followups</a>

        </div>
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
                    'attribute' => 'sub_type',
                    'value' => 'to0.sub_type',
                    'filter' => ArrayHelper::map(FollowupSubType::find()->where(['status' => '1'])->asArray()->all(), 'id', 'sub_type'),
                ],
                'followup_date',
                'followup_notes',
                    ['attribute' => 'assigned_to',
                    'value' => 'assigned0.staff_name',
                    'filter' => ArrayHelper::map(StaffInfo::find()->where(['status' => '1', 'post_id' => 5])->asArray()->all(), 'id', 'staff_name'),
                ],
                    ['attribute' => 'assigned_from',
                    'value' => 'assignedfrom0.staff_name',
                //'filter' => ArrayHelper::map(StaffInfo::find()->where(['status' => '1', 'post_id' => 5])->asArray()->all(), 'id', 'staff_name'),
                ],
                    ['attribute' => 'related_staffs',
                    'value' => function($model, $key, $index, $column) {
                            return $model->Relatedstaffs($model->related_staffs);
                    },
                ],
                    [
                    'attribute' => 'status',
                    'value' => function($model, $key, $index, $column) {
                            if ($model->status == '0') {
                                    return 'Active';
                            } elseif ($model->status == '1') {
                                    return 'Closed';
                            }
                    },
                    'filter' => [0 => 'Active', 1 => 'Closed'],
                ],


                     [
                    'attribute' => 'CB',
                    'header' => 'Added By',
                    'value' => function($model) {
                            if (isset($model->CB)) {
                                    $added_by = StaffInfo::findOne($model->CB);
                                    if (isset($added_by)) {
                                            if (isset($model->DOC))
                                                    return $added_by->staff_name . ' (' . date('d-m-Y H:i:s', strtotime($model->DOC)) . ' )';
                                            else
                                                    return $added_by->staff_name;
                                    }
                            } else {
                                    return '';
                            }
                    },
                ],               

                    ['class' => 'yii\grid\ActionColumn',
                    'template' => '{status}',
                    'visibleButtons' => [
                        'status' => function ($model, $key, $index) {
                                return $model->status != '1' ? true : false;
                        }
                    ],
                    'buttons' => [
                        'status' => function ($url, $model) {

                                return Html::checkbox('status', false, ['class' => 'iswitch iswitch-secondary followup-status', 'id' => $model->id]);
                        },
                    ],
                ],
            ],
        ]);
        Pjax::end();
        ?>

</div>




<style>
        .left_padd{
                min-height: 100px;
        }#repeatedfollowups-followup_notes:focus{
                border:1px solid #eee!important;
        }
</style>












