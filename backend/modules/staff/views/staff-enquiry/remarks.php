<?php

use yii\helpers\Html;
use common\components\RemarksWidget;
use yii\grid\GridView;
?>

<div class="patient-enquiry-general-first-form form-inline">
        <?= RemarksWidget::widget(['type_id' => $patient_info->id, 'type' => $type]); ?>
</div>
