<?php
/* @var $this yii\web\View */

use common\models\TermsAndConditions;

$terms = TermsAndConditions::find()->where(['type' => $id])->all();
?>


<ul>
        <?php foreach ($terms as $value) { ?>
                <li><?= $value->note; ?></li>
        <?php }
        ?>
</ul>