<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Pending Followups ';
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
								<?php foreach ($pending_followups as $pending_followup) { ?>
									<tr class="unread">


										<td class="col-subject ">


											<?= Html::a($pending_followup->content, ['site/pending-followups?id=' . $pending_followup->id], ['class' => '']) ?>




										</td>

										<td class="col-time">
											<?php
											if ($notifications->date == date('Y-m-d')) {
												echo "Today";
											} else {
												echo date("d", strtotime($pending_followup->date)) . ', ' . date("F", strtotime($pending_followup->date)) . ' ' . date("Y", strtotime($pending_followup->date));
											}
											?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>