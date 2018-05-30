<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\StaffInfo;

if ($type == '1') {
        $patient = common\models\PatientGeneral::findOne($assigned_to);
        $name = $patient->first_name;
} else {
        $staff = StaffInfo::findOne($assigned_to);
        $name = $staff->staff_name;
}

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
?>

<html>
        <head>
                <style>
                        .main-content p{
                                line-height: 1.8;
                        }
                        .body{
                                font-family: Open Sans !important;
                        }
                </style>
        </head>
        <body>
                <div style="/* margin: 20px 200px 0px 300px; */border: 1px solid #9E9E9E;">
                        <table border ="0"  class="main-tabl" border="0">
                                <thead>
                                        <tr>
                                                <th style="width:100%">
                                                        <div class="header" style="padding-bottom: 40px;">
                                                                <div class="main-header">
                                                                        <div class="main-header-left" style="float: left;padding-left: 40px;">
                                                                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/admin/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
                                                                                <?php //echo Html::img('@web/admin/images/logos/logo-1.png', $options = ['width' => '200px'])    ?>
                                                                        </div>
                                                                        <div class="main-header-right" style="float: right;padding-right: 50px;padding-top: 24px;">
                                                                                <span style="color: #13a8b0;">info@caringpeople.in</span>
                                                                        </div>
                                                                </div>
                                                                <br/>
                                                        </div>
                                                </th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                                <td style="width:100%">
                                                        <div class="replay-content" style="text-align: justify;padding-right: 50px;padding-left: 50px;">
                                                                <hr style="border: 2px solid #9E9E9E;">
                                                                <div class="main-content">
                                                                        <p>Dear <?= $name; ?>,</p>


                                                                        <p>A new task is assigned to <?= $name; ?>. Please visit your profile for view more details</p>


                                                                        <p>Thank you,</p>
                                                                </div>
                                                                <p><b>Caring People</b></p>
                                                                <div class="reply-address" style="font-size: 12px;">
                                                                        <p><b>Helpline Numbers :</b>  India : +91 90 20 599 599 , International  : 00 44 74459 68106</p>

<!--                                    <p>India : +91 90 20 599 599</p>

                                    <p>International  : 00 44 74459 68106</p>-->

                                                                        <p><a href="www.caringpeople.in" style="color: #13a8b0;">www.caringpeople.in</a><p>
                                                                        <div class="row">
                                                                                <div style="float: left">
                                                                                        <p style="color: #13a8b0;">KERALA</p>
                                                                                        <p>Caring People</p>
                                                                                        <p>Door No. 5 ,DD Vyapar Bhavan</p>
                                                                                        <p>K P Vallon Road</p>
                                                                                        <p>Kadavanthara</p>
                                                                                        <p>Cochin 68 20 20</p>
                                                                                        <p>Kerala</p>
                                                                                        <p>Ph: 0484 40 33 505</p>
                                                                                </div>
                                                                                <div style="float: right">
                                                                                        <p style="color: #13a8b0;">MUMBAI</p>
                                                                                        <p>Caring People</p>
                                                                                        <p>Shop No 16,</p>
                                                                                        <p>Brindavan Co-operative Housing Society Ltd,</p>
                                                                                        <p>Evershine Nagar,</p>
                                                                                        <p>Malad West</p>
                                                                                        <p>Mumbai-400064</p>
                                                                                        <p>Ph:022 40 111 351</p>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </td>
                                        </tr>
                                </tbody>
                        </table>
                </div>
        </body>
</html>