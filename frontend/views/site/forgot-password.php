<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>



<div class="mkdf-content" id="contact">
        <div class="mkdf-content-inner">

                <div class="mkdf-full-width">
                        <div class="mkdf-full-width-inner">
                                <div class="vc_row wpb_row vc_row-fluid mkdf-section vc_custom_1453798679731 mkdf-content-aligment-left mkdf-grid-section" style="">
                                        <div class="clearfix mkdf-section-inner">
                                                <div class="mkdf-section-inner-margin clearfix">

                                                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-8 vc_col-md-12">
                                                                <div class="vc_column-inner ">
                                                                        <div class="wpb_wrapper">



                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                        <div class="wpb_wrapper">
                                                                                                <h2></h2>

                                                                                        </div>
                                                                                </div>


                                                                                <div data-original-height="35" class="vc_empty_space" style="height: 35px"><span class="vc_empty_space_inner"></span></div>
                                                                                <div class="screen-reader-response"></div>
                                                                                <div id="logbox">
                                                                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                                                                <div class="alert alert-danger">
                                                                                                        <button type="button" class="close" data-dismiss="alert">

                                                                                                        </button>
                                                                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                                                                </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                                                                <div class="alert alert-success">
                                                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                                                        </button>

                                                                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                                                                </div>
                                                                                        <?php endif; ?>
                                                                                        <?php
                                                                                        $form = ActiveForm::begin(['options' => ['class' => 'modal-content animate']]);
                                                                                        ?>


                                                                                        <div class="container login-field">
                                                                                                <label><b>Email/Username</b></label>
                                                                                                <input type="text" id="employee-user_name" name="User[username]" autofocus="true" required="">
                                                                                                <button type="submit"  style="margin-top: 18px;width:25%;float: right;">Submit</button>

                                                                                        </div>

                                                                                        <?php ActiveForm::end(); ?>
                                                                                </div>
                                                                                <!--</div>-->
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- close div.content_inner -->
</div>

