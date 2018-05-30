<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use yii\db\Expression;

$this->title = 'Staff Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="attendance-create">


                                                <div class="attendance-form form-inline">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    //    "endDate" => (string) date('d/m/Y'),
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>

                                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                <?php $branch = Branch::Branch(); ?>
                                                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']); ?>
                                                        </div>





                                                        <div class='col-md-3 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div style="clear:both"></div>
                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($designations) && $designations != '') { ?>



                                                        <div class = "table-responsive">
                                                                <table class = "table table-striped">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>STAFF TYPE</th>
                                                                        <th>AMOUNT</th>
                                                                        <th></th>
                                                                        <?php
                                                                        ?>
                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $k = 0;
                                                                                $total_amount = 0;
                                                                                foreach ($designations as $value) {
                                                                                        $k++;
                                                                                         $staffs = StaffInfo::find()->where(['branch_id' => $model->rating])->andWhere(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $value->id])->all();
                                                                                        $amount = 0;
                                                                                        foreach ($staffs as $values) {
                                                                                                $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $values->id])->andWhere(['>=', 'date', date('Y-m-d', strtotime($model->date))])->andWhere(['<=', 'date', date('Y-m-d', strtotime($model->DOC))])->all();
                                                                                                foreach ($staff_schedules as $staff_schedules) {
                                                                                                        $amount += $staff_schedules->rate;
                                                                                                }
                                                                                        }
                                                                                        $total_amount += $amount;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>
                                                                                                <td><?= $value->title; ?></td>
                                                                                                <td><?= 'Rs. ' . $amount . '/-'; ?></td>
                                                                                                <td> <?php if ($amount > 0) { ?><button class="btn btn-info"><a target="_blank" href="<?= Yii::$app->homeUrl ?>attendance/attendance/viewdetails?from=<?= $model->date ?>&to=<?= $model->DOC ?>&type=<?= $value->id ?>&branch_id=<?= $model->rating ?>" style="color: #FFF">View Details</a></button><?php } ?></td>

                                                                                        </tr>
                                                                                <?php } ?>

                                                                                <tr>
                                                                                        <td colspan="2" style="    text-align: center;"><b>Total</b></td>
                                                                                        <td><b><?= 'Rs. ' . $total_amount . ' /-' ?></b></td>
                                                                                        <td></td>
                                                                                </tr>

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->date) && $model->date != '') {
                                                                echo '<p class="no-result">No results found !!</p>';
                                                        }
                                                }
                                                ?>



                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>

        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1 p{
                margin-left: 20px;
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>