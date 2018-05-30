<?php

use yii\helpers\Html;
use common\components\FollowupsWidget;
use yii\grid\GridView;

$this->title = 'Add Followups';
?>



<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body panel_body_background">
                                        <div class="patient-enquiry-general-first-form form-inline">
                                                <?= FollowupsWidget::widget(['type_id' => $type_id, 'type' => $type]); ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>