<?php

use yii\helpers\Html;

//var_dump($model);
//exit;
?>

<div class="col-md-12 notify-box" id="<?= $model->id ?>">
        <h5><?= $model->followup_notes; ?>
        </h5>
        <?php $assigned_from = common\models\StaffInfo::findOne($model->assigned_from); ?>
        <h6>Assigned Fromm : <?= $assigned_from->staff_name ?></h6>
        <p style = "margin-top: 10px;"><?= date('d-M-Y', strtotime($model->followup_date)) ?></p>

        <a title="Click here to close this task">  <input type="checkbox" id="<?= $model->id ?>" class="iswitch iswitch-secondary followup-status" name="status" value="1" style="float: right"></a>


</div>


