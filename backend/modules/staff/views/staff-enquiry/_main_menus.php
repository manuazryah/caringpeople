<?php

use yii\helpers\Html;
?>



<ul class="nav nav-tabs">
        <li class="active">
                <a href="#main-1" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o hidden-xs"></i></span>
                        <i class="fa-envelope-o"></i><span class="hidden-xs span-font-size"> INFORMATION</span></a>
        </li>
        <?php if (!$model->isNewRecord) { ?>
                <li>
                        <a href="#main-2" data-toggle="tab"><span class="visible-xs"><i class="fa fa-history hidden-xs"></i></span>
                                <i class="fa fa-history"></i> <span class="hidden-xs span-font-size">  HISTORY</span></a>
                </li>
        <?php } ?>
</ul>