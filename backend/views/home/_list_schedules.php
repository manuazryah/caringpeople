<?php

use yii\helpers\Html;

//var_dump($model);
//exit;
?>

<div class="col-md-12 notify-box">
        <h5>Service Id  : <b><?= $model->service->service_id; ?> </b></h5>
        <?php $patient = common\models\PatientGeneral::findOne($model->patient_id) ?>
        <h5>Date : <?= date('d-m-Y', strtotime($model->date)) ?></h5>
        <h5>Patient  : <?= $patient->first_name; ?> </h5>
        <!--<button class="btn btn-gray" style="margin: 15px 0px 0px 30px;float: left;">-->
        <a id="<?= $model->id ?>"  class="remarks_Staff remarks"><?php if (!isset($model->remarks_from_staff) && $model->remarks_from_staff == '') { ?> Add Remarks<?php } else { ?> View Remarks<?php } ?></a>
        <!--</button>-->

</div>


