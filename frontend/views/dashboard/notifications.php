<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Notifications ';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->staff_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">

                                <div class="panel-body">
                                        <div class="employee-create">
                                                <table class="table mail-table">
                                                        <tbody>
                                                                <?php
                                                                $notification = \common\models\Invoice::find()->where(['status' => 2, 'patient_id' => Yii::$app->session['patient_id'], 'view' => 0])->orderBy(['id' => SORT_DESC])->limit(10)->all();
                                                                $notification1 = common\models\Invoice::find()->where(['<', 'due_date', date('Y-m-d')])->andWhere(['status' => 2, 'patient_id' => Yii::$app->session['patient_id'], 'view' => 2])->orderBy(['id' => SORT_DESC])->limit(10)->all();
                                                                $notifications = array_merge($notification, $notification1);
                                                                foreach ($notifications as $notifications) {
                                                                        ?>

                                                                        <tr class="unread">
                                                                                <td class="col-subject ">
                                                                                        <?php
                                                                                        $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $notifications->id);
                                                                                        echo Html::a('Payment (Rs. ' . $notifications->amount . ') pending', ['dashboard/invoicebill?id=' . $id], ['class' => ''])
                                                                                        ?>
                                                                                </td>

                                                                                <td class="col-time">
                                                                                        <?= date('d-m-Y', strtotime($notifications->due_date)) ?>
                                                                                </td>
                                                                        </tr>

                                                                        <?php
                                                                }
                                                                ?>
                                                        </tbody>
                                                </table>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>