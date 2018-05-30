<?php

use yii\helpers\Html;
?>


<!--
<ul class="nav nav-tabs nav-tabs-justified">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">Start A Service</span></a>
        </li>

        <li>
                <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups?type_id=<?= $model->id; ?>&type=5&service=setvice" <?php if (!$model->id && $model->id == '') { ?> data-toggle="tab" <?php } ?>><span class="visible-xs"><i class="fa-hospital-o"></i></span>
                        <span class="hidden-xs span-font-size">Followups</span></a>
        </li>


</ul>-->



<ul class="nav nav-tabs">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o hidden-xs"></i></span>
                        <i class="fa-envelope-o"></i><span class="hidden-xs span-font-size">Start A Service</span></a>
        </li>
        <?php
        if (!$model->isNewRecord) {
                ?>

                 <li>
                        <a href="#home-7" data-toggle="tab"><span class="visible-xs"><i class="fa fa-minus-circle hidden-xs"></i></span>
                                <i class="fa fa-minus-circle"></i><span class="hidden-xs span-font-size">Discounts</span></a>
                </li>

            <?php if ($model->proforma_sent == 2) { ?>
                <li>
                        <a href="#home-5" data-toggle="tab"><span class="visible-xs"><i class="fa-user hidden-xs"></i></span>
                                <i class="fa-user"></i><span class="hidden-xs span-font-size">Schedules</span></a>
                </li>
            <?php } ?>

                <li>
                        <a href="#home-6" data-toggle="tab"><span class="visible-xs"><i class="fa fa-book hidden-xs"></i></span>
                                <i class="fa fa-book"></i><span class="hidden-xs span-font-size">Assessment</span></a>
                </li>

                


                <li>
                        <a href="#home-12" data-toggle="tab"><span class="visible-xs"><i class="linecons-note hidden-xs"></i></span>
                                <i class="linecons-note"></i><span class="hidden-xs span-font-size">REMARKS</span></a>
                </li>

                <li>
                        <a href="#profile-13" data-toggle="tab"><span class="visible-xs"><i class="fa fa-tasks hidden-xs"></i></span>
                                <i class="fa fa-tasks"></i> <span class="hidden-xs span-font-size">  FOLLOWUPS</span></a>
                </li>
        <?php }
        ?>



</ul>