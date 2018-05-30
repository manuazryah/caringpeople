<?php

use yii\helpers\Html;
?>



<!--<ul class="nav nav-tabs nav-tabs-justified">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">Enquiry</span></a>
        </li>

                <li>
                        <a href="#home-2" data-toggle="tab"><span class="visible-xs"><i class="fa-info"></i></span>
                                <span class="hidden-xs span-font-size">Interview</span></a>
                </li>

        <li>
                <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-hospital-o"></i></span>
                        <span class="hidden-xs span-font-size">Other Information</span></a>
        </li>

        <li>
                <a href="#profile-4" data-toggle="tab"><span class="visible-xs"><i class="fa-info"></i></span>
                        <span class="hidden-xs span-font-size">Interview Information</span></a>
        </li>


</ul>-->

<ul class="nav nav-tabs">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o hidden-xs"></i></span>
                        <i class="fa-envelope-o"></i><span class="hidden-xs span-font-size">  ENQUIRY</span></a>
        </li>



        <li>
                <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-info hidden-xs"></i></span>
                        <i class="fa-info"></i> <span class="hidden-xs span-font-size"> OTHER INFORMATION</span></a>
        </li>

        <li>
                <a href="#profile-4" data-toggle="tab"><span class="visible-xs"><i class="linecons-pencil hidden-xs"></i></span>
                        <i class="linecons-pencil"></i><span class="hidden-xs span-font-size"> INTERVIEW INFORMATION</span></a>
        </li>


        <?php if (!$staff_enquiry->isNewRecord) { ?>
                <li>
                        <a href="#profile-12" data-toggle="tab"><span class="visible-xs"><i class="linecons-note hidden-xs"></i></span>
                                <i class="linecons-note"></i> <span class="hidden-xs span-font-size"> REMARKS</span></a>
                </li>

                <li>
                        <a href="#profile-13" data-toggle="tab"><span class="visible-xs"><i class="fa fa-tasks hidden-xs" ></i></span>
                                <i class="fa fa-tasks" aria-hidden="true"></i> <span class="hidden-xs span-font-size"> FOLLOWUPS</span></a>
                </li>
        <?php } ?>
</ul>



