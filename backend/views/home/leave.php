<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Employee;
use common\models\Doctor;
use common\models\PlacePro;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
?>

<section id="login-box">
        <div class="container">
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 shadow">
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">Leave Application</h3>
                                <?php
                                $form = ActiveForm::begin(['action' => 'leave', 'method' => 'post',]);
                                ?>

                                <?php
                                $pro_id = Yii::$app->session['pro']['id'];
                                ?>
                                <input type="hidden" name="pro_id" id="pro_id" value="<?= $pro_id ?>"/>
                                <input type="hidden" name="place_id" id="place_id" value=""/>
                                <?=
                                DatePicker::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'commencing_date',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>
                                <?=
                                DatePicker::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'ending_date',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>
                                <div>
                                        <?php
                                        $types = \common\models\MasterLeaveType::find()->where(['status' => 1])->all();
                                        ?>
                                        <?= $form->field($model, 'leave_type')->dropDownList(ArrayHelper::map($types, 'id', 'type'), ['class' => 'form-control form-doctor-control', 'prompt' => '--Select--']) ?>
                                </div>

                                <div>
                                        <?= $form->field($model, 'purpose')->textInput() ?>
                                </div>

                                <div>
                                        <?= Html::submitButton('Submit', ['class' => 'micro-submit']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col-md-3"></div>
                </div>
        </div>
</section>
<style>
        .visiting_time{
                margin-left: 18px;
                width: 30%;
                padding: 6px;
                border-radius: 5px;
        }
        .fa-globe:before {
                content: "\f0ac";
                font-size: 20px;
        }
        .form-doctor-control{
                margin-left: 20px !important;
                width:65% !important;
        }

</style>




