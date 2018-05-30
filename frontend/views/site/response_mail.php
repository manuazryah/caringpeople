<?php

use yii\helpers\Html;
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
                                        <?php //echo Html::img('@web/admin/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
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
                                    <p>Dear ,</p>


                                    <p>Thank you so much for your inquiry into our services. We pride ourselves in providing the very best care and we look forward to the opportunity of working with you.</p>


                                    <p>Caring People is a unique company specializing as an in-home service provider. We are a professional team designed to provide a unique "all-in-one" service to our clients. We are dedicated to offer quality, ethical and professional services.</p>



                                    <p>All of our caregivers are all employees of Caring People and they are all carefully screened, undergo throughout background checks.</p>



                                    <p>The services we provide include Nursing Care, Doctor Visit, Physiotherapy, Bystander or Caregiver Service and Companion Care.In addition, we offer free in-home consultations and custom-designed payment plans.</p>



                                    <p>Prior to starting services, we like to do a consultation to make certain that your needs and our services are a match, and to make certain that all other referrals or resources that need to be utilized are tapped.</p>



                                    <p>Please feel free to call us with any questions or clarifications.</p>


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
                    <tr>
                        <td>
                            <div class="replay-footer"  style="text-align: justify;padding-right: 50px;padding-left: 50px;">
                                <hr style="border: 2px solid #9E9E9E;">
                                <p>1 Attachment</p>
                                <div class="row" style="display: inline-block;background-color: rgba(158, 158, 158, 0.39);padding: 10px 25px 10px 0px;">
                                    <div style="float: left;">
                                        <?php echo Html::img('http://' . Yii::$app->request->serverName . '/images/f-logo.png', $options = ['width' => '20px']) ?>
                                        <?php //echo Html::img('@web/images/f-logo.png', $options = ['width' => '20px']) ?>
                                    </div>
                                    <div style="float: left;">
                                        <!--<a href="<?php // Yii::$app->homeUrl;    ?>images/caring_peopl.jpg" download>Caring People</a>-->
                                        <a href="http://<?= Yii::$app->request->serverName; ?>/images/caring_peopl.jpg" download>Caring People</a>
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