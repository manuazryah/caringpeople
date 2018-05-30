<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use kartik\date\DatePicker;
use common\models\AccountHead;

Branch::Branch();

/* @var $this yii\web\View */
/* @var $model common\models\StaffPayroll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-payroll-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>          <?php
                if (isset($model->date_from)) {
                        $model->date_from = date('d-m-Y', strtotime($model->date_from));
                } else {
                        $model->date_from = date('d-m-Y');
                }
                echo DatePicker::widget([
                    'model' => $model,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'date_from',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>          <?php
                if (isset($model->date_to)) {
                        $model->date_to = date('d-m-Y', strtotime($model->date_to));
                } else {
                        $model->date_to = date('d-m-Y');
                }
                echo DatePicker::widget([
                    'model' => $model,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'date_to',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php $branch = Branch::branch(); ?>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php
                if (!$model->isNewRecord) {
                        $staff = common\models\StaffInfo::find()->where(['branch_id' => $model->branch_id, 'status' => 1, 'post_id' => 5])->orderBy(['staff_name' => SORT_ASC])->all();
                } else {
                        $staff = [];
                }
                ?>
                <?= $form->field($model, 'staff_id')->dropDownList(ArrayHelper::map($staff, 'id', 'staff_name'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12' >
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px; margin-left: 45px;', 'name' => 'get_amount']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

        <!-------------------------------------------------------------staff choosee form end-------------------------------------->


        <div style="clear:both"></div>


        <!----------------------------------------------------------On submit of first form-------------------------------------->

        <?php
        if (isset($model->date_from) && isset($model->branch_id)) {
                //------------------------------------------------show previous payment Details---------------------------------------//

                if (!empty($paided_details) && $paided_details != '') {
                        $k = 0;
                        ?>
                        <div class="table">
                                <label>Previous Payment Details</label>
                                <span>( <?= date('d-m-Y', strtotime($prev_date)) . ' - ' . date('d-m-Y', strtotime($current_date)) ?> )</span>
                                <table class="table table-bordered table-striped" style="width:85%">
                                        <thead>
                                        <th>NO</th>
                                        <th>DATE</th>
                                        <th>TYPE</th>
                                        <th>AMOUNT</th>
                                        <th>PAYMENT DATE</th>
                                        </thead>
                                        <tbody>
                                                <?php
                                                foreach ($paided_details as $paided_details) {
                                                        $k++;
                                                        ?>
                                                        <tr>
                                                                <td><?= $k; ?></td>
                                                                <?php
                                                                $from = date('d-m-Y', strtotime($paided_details->date_from));
                                                                $to = date('d-m-Y', strtotime($paided_details->date_to));
                                                                ?>
                                                                <td><?= $from . ' - ' . $to ?></td>
                                                                <td><?php
                                                                        if ($paided_details->type = 1) {
                                                                                echo 'Advance';
                                                                        } else {
                                                                                echo 'Payment';
                                                                        }
                                                                        ?></td>
                                                                <td><?= 'Rs ' . $paided_details->amount ?></td>
                                                                <td><?php
                                                                        if (isset($paided_details->payment_date) && $paided_details->payment_date != '0000-00-00') {
                                                                                echo date('d-m-Y', strtotime($paided_details->payment_date));
                                                                        }
                                                                        ?>
                                                                </td>

                                                        </tr>
                                                <?php } ?>
                                        </tbody>

                                </table>
                        </div>
                <?php } ?>


                <!--------------------------------------------cash payment---------------------------------------->

                <?php $form1 = ActiveForm::begin(['id' => 'pay-payroll']); ?>

                <div class="row table">
                        <div class="row">
                                <label>Payment Details</label>
                        </div>


                        <div class="row">
                                <div class="col-md-2"> Total Amount to be paid </div> <div class="col-md-4"> : <span><?= 'Rs ' . $service_schedule_amount; ?> /-</span></div><br>
                                <div class="col-md-2">  Total Amount paid </div> <div class="col-md-4"> : <span><?php
                                                if (!empty($paided_details)) {
                                                        echo 'Rs ' . $paid_amount;
                                                } else {
                                                        echo 'Rs 0';
                                                }
                                                ?> /-</span></div><br>
                                <div class="col-md-2"> Due Amount  </div> <div class="col-md-4"> : <span> Rs .<?= $due_amount = $service_schedule_amount - $paid_amount; ?> /-</span></div><br>

                        </div>
                </div>


                <?php if ($due_amount > 0) { ?>
                        <div class="row payment">
                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form1->field($model, 'date_from')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form1->field($model, 'date_to')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form1->field($model, 'staff_id')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form1->field($model, 'branch_id')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form1->field($model, 'type')->dropDownList(['' => '--Select--', '1' => 'Advance', '2' => 'Full Payment']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form1->field($model, 'amount')->textInput(['maxlength' => true]) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?php $banks = AccountHead::find()->where(['status' => 1])->all(); ?>   <?= $form1->field($model, 'bank')->dropDownList(ArrayHelper::map($banks, 'id', 'bank_name'), ['class' => 'form-control']) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form1->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>
                                </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?php
                                        echo DatePicker::widget([
                                            'model' => $model,
                                            'form' => $form1,
                                            'type' => DatePicker::TYPE_INPUT,
                                            'attribute' => 'payment_date',
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy',
                                            ]
                                        ]);
                                        ?>
                                </div>
                                <div class='col-md-2 col-sm-6 col-xs-12' >
                                        <div class="form-group">
                                                <?= Html::submitButton('Pay', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'name' => 'submit_amount']) ?>
                                        </div>
                                </div>

                        </div>
                        <?php
                } else {
                        echo '<p style="color:red">** No due amount on this month</p>';
                }
                ?>
                <?php ActiveForm::end();
                ?>
                <?php
        }
        ?>
</div>








<style>
        .ui-datepicker-calendar {
                display: none;
        }.table label{
                color: #000;
                font-weight: bold;
                font-size: 15px;
                text-decoration: underline;
                margin-bottom: 15px;
        } .table .row{
                margin-left: 20px;
                line-height: 25px;
        }.table .row span{
                color: #000;
                font-weight: bold;
        }.payment{
                margin-left: 15px;
        }

</style>


