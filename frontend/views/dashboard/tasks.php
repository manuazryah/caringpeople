<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Tasks ';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
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
                                                                $services = \common\models\Service::find()->where(['status' => 1, 'patient_id' => Yii::$app->session['patient_id']])->all();
                                                                $service = array();
                                                                foreach ($services as $services) {
                                                                        $service[] = $services->id;
                                                                }
                                                                $last_date_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -20  days'));
                                                                $tasks = \common\models\Followups::find()->where(['>=', 'followup_date', $last_date_time])->andWhere(['<=', 'followup_date', date('Y-m-d H:i:s')])->andWhere(['status' => 0, 'view' => 0, 'releated_notification_patient' => 1])->andWhere(['IN', 'type_id', $service])->orderBy(['id' => SORT_DESC])->all();

                                                                foreach ($tasks as $notifications) {
                                                                        ?>

                                                                        <tr class="unread">
                                                                                <td class="col-subject ">
                                                                                        <?= $notifications->followup_notes ?>
                                                                                </td>

                                                                                <td class="col-time">
                                                                                        <?= date('d-m-Y', strtotime($notifications->followup_date)) ?>
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