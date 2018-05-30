<?php

use yii\helpers\Html;
?>

<html>

        <head>
                <title>Forgot Password</title>
                <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
        </head>

        <body>
                <div class="mail-body" style="margin: auto;width: 50%;border: 1px solid #9e9e9e;">
                        <div class="content" style="margin-left: 40px;">
                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/admin/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
                                <h2>Task Completed</h2>
                                <?php
                                $assigned_from = \common\models\StaffInfo::findOne($followup->assigned_from);
                                $assigned_to = \common\models\StaffInfo::findOne($followup->assigned_to);
                                ?>
                                <p>Hi <?= $assigned_from->staff_name ?>,</p>
                                <p>The task assigned to <?= $assigned_to->staff_name ?> is marked as completed.</p>
                        </div>
                </div>



        </body>
</html>