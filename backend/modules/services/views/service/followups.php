<?php

use yii\helpers\Html;
use common\components\FollowupsWidget;
use yii\grid\GridView;
?>

<div class="patient-enquiry-general-first-form form-inline">
        <?= FollowupsWidget::widget(['type_id' => $patient_info->id, 'type' => $type]); ?>
</div>