<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
?>
<div class="mkdf-content">
    <div class="mkdf-content-inner">
        <div class="container">
            <div class="mkdf-title mkdf-standard-type mkdf-preload-background mkdf-has-background mkdf-has-parallax-background mkdf-content-center-alignment mkdf-animation-no mkdf-title-image-not-responsive" style="color:#ffffff;;background-image:url(images/eroor.png);;height:385px;;border-bottom: none" data-height="385" data-background-width=&quot;1920&quot;>
                <div class="mkdf-title-image"><img src="<?= Yii::$app->homeUrl; ?>images/eroor.png" alt="&nbsp;" /> </div>
                <div class="mkdf-title-holder" style="height:385px;">
                    <div class="mkdf-container clearfix">
                    </div>
                    <div class="control-btn">
                        <?= Html::a('<span> BACK TO HOME</span>', ['site/index'], ['class' => 'btn hom-btn btn-left']) ?>
                        <?= Html::a('<span> CONTACT US</span>', ['site/contact'], ['class' => 'btn hom-btn btn-left']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
