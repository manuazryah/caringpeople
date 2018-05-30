<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">

        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

                <title>Caringpeople</title>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/jquery.js'></script>
                <script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/jquery-migrate.min.js'></script>
                <style type="text/css">
                        img.wp-smiley,
                        img.emoji {
                                display: inline !important;
                                border: none !important;
                                box-shadow: none !important;
                                height: 1em !important;
                                width: 1em !important;
                                margin: 0 .07em !important;
                                vertical-align: -0.1em !important;
                                background: none !important;
                                padding: 0 !important;
                        }
                        a{text-decoration: none;}
                </style>
                <link rel='stylesheet' id='contact-form-7-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
                <link rel='stylesheet' id='rs-plugin-settings-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/css/settings.css' type='text/css' media='all' />
                <link rel='stylesheet' id='wellspring_mikado_modules_plugins-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/plugins.min.css' type='text/css' media='all' />
                <link rel='stylesheet' id='mkdf_font_elegant-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/elegant-icons/style.min.css' type='text/css' media='all' />
                <link rel='stylesheet' id='mkdf_linear_icons-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/linear-icons/style.css' type='text/css' media='all' />
                <link rel='stylesheet' id='wellspring_mikado_modules-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/modules.min.css' type='text/css' media='all' />
                <style id='wellspring_mikado_modules-inline-css' type='text/css'>
                        @media only screen and (min-width: 1024px) and (max-width: 1550px) {
                                .page-id-2608 .vc_hidden-md {
                                        display: none !important;
                                }
                                .page-id-2608 .mkdf-landing-two-cols .vc_col-md-6 {
                                        width: 50%;
                                }
                        }

                        @media only screen and (max-width: 1550px) {
                                .page-id-2608 .mkdf-landing-two-cols .mkdf-landing-col-padding {
                                        padding: 0 0 0 5%;
                                }
                        }
                </style>
                <link rel='stylesheet' id='wellspring_mikado_style_dynamic-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/style_dynamic.css' type='text/css' media='all' />
                <link rel='stylesheet' id='wellspring_mikado_modules_responsive-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/modules-responsive.min.css' type='text/css' media='all' />
                <link rel='stylesheet' id='js_composer_front-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />
                <style type="text/css">
                        /* generated in /www/sites/wellspring.mikado-themes.com/files/html/wp-content/themes/wellspring/functions.php wellspring_mikado_page_padding function */

                        .page-id-5 .mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner,
                        .page-id-5 .mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner {
                                padding: 0;
                        }
                        /* generated in /www/sites/wellspring.mikado-themes.com/files/html/wp-content/themes/wellspring/framework/modules/header/filter-functions.php wellspring_mikado_get_top_bar_styles function */

                        .page-id-5 .mkdf-top-bar {
                                background-color: #13a8b0;
                        }
                </style>
                <meta name="generator" content="Powered by Slider Revolution 5.1.6 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
                <link rel="icon" href="<?= Yii::$app->homeUrl; ?>images/f-logo.png" sizes="40x40" />
                <style type="text/css" data-type="vc_shortcodes-custom-css">
                        a{
                                text-decoration: none;
                        }
                        .vc_custom_1453371194200 {
                                padding-top: 40px !important;
                        }

                        .vc_custom_1453372762504 {
                                padding-top: 40px !important;
                                padding-bottom: 40px !important;
                        }

                        .vc_custom_1453372912921 {
                                /*border-top-width: 1px !important;*/
                                border-right-width: 0px !important;
                                border-bottom-width: 0px !important;
                                border-left-width: 0px !important;
                                padding-top: 121px !important;
                                padding-bottom: 129px !important;
                                background-color: #fafafa !important;
                                border-left-color: #f2f2f2 !important;
                                border-left-style: solid !important;
                                border-right-color: #f2f2f2 !important;
                                border-right-style: solid !important;
                                border-top-color: #f2f2f2 !important;
                                border-top-style: solid !important;
                                border-bottom-color: #f2f2f2 !important;
                                border-bottom-style: solid !important;
                        }

                        .vc_custom_1453373153343 {
                                padding-top: 121px !important;
                                padding-bottom: 155px !important;
                                background-image: url(<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/parallax-1bc58.jpg?id=78) !important;
                        }

                        .vc_custom_1453373235263 {
                                padding-top: 40px !important;
                                padding-bottom: 40px !important;
                        }

                        .vc_custom_1453982497008 {
                                border-top-width: 0px !important;
                                border-right-width: 0px !important;
                                border-bottom-width: 1px !important;
                                border-left-width: 0px !important;
                                padding-top: 140px !important;
                                padding-bottom: 122px !important;
                                background-color: #fafafa !important;
                                border-left-color: #f2f2f2 !important;
                                border-left-style: solid !important;
                                border-right-color: #f2f2f2 !important;
                                border-right-style: solid !important;
                                border-top-color: #f2f2f2 !important;
                                border-top-style: solid !important;
                                border-bottom-color: #f2f2f2 !important;
                                border-bottom-style: solid !important;
                        }

                        .vc_custom_1454074360719 {
                                padding-top: 121px !important;
                        }

                        .vc_custom_1454074655624 {
                                padding-top: 75px !important;
                                padding-bottom: 90px !important;
                        }

                        .vc_custom_1453373935072 {
                                padding-top: 123px !important;
                                padding-bottom: 147px !important;
                        }

                        .vc_custom_1454930627059 {
                                border-top-width: 1px !important;
                                border-right-width: 0px !important;
                                border-bottom-width: 0px !important;
                                border-left-width: 0px !important;
                                padding-top: 130px !important;
                                padding-bottom: 110px !important;
                                background-color: #fafafa !important;
                                border-left-color: #f2f2f2 !important;
                                border-left-style: solid !important;
                                border-right-color: #f2f2f2 !important;
                                border-right-style: solid !important;
                                border-top-color: #f2f2f2 !important;
                                border-top-style: solid !important;
                                border-bottom-color: #f2f2f2 !important;
                                border-bottom-style: solid !important;
                        }
                </style>
                <noscript>
                <style type="text/css">
                        .wpb_animate_when_almost_visible {
                                opacity: 1;
                        }
                </style>
                </noscript>
                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/wfmi-style.css">
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
                <link href="<?= Yii::$app->homeUrl; ?>css/style.css" rel="stylesheet" />
                <link href="<?= Yii::$app->homeUrl; ?>css/responsive.css" rel="stylesheet" type="text/css"/>
        </head>

        <body class="home page page-id-5 page-template page-template-full-width page-template-full-width-php mkdf-bmi-calculator-1.0 mkd-core-1.0 wellspring-ver-1.0 mkdf-smooth-scroll  mkdf-ajax mkdf-grid-1300 mkdf-blog-installed mkdf-bbpress-installed mkdf-header-standard mkdf-sticky-header-on-scroll-down-up mkdf-default-mobile-header mkdf-sticky-up-mobile-header mkdf-dropdown-default mkdf-top-bar-light mkdf-search-dropdown mkdf-side-menu-slide-with-content mkdf-width-470 wpb-js-composer js-comp-ver-4.10 vc_responsive">

                <!------------------------selector-div----------------------------------->
                <a id="btnright" href="javascript:void(0);" class="btn-close in">How Do I Start&nbsp;<i class="fa fa-question"></i>
                        <img class="help-box-arrow" src="<?= Yii::$app->homeUrl; ?>images/help-box-arrow.png"/>
                </a>

                <div id="style-selector" class="text-center" style="display: none;right: 0px;">
                    <!--<img class="help-box-arrow" src="images/help-box-arrow.png"/>-->


                        <div class="help-box">
                                <h5 class="title align-left title-big">IT REALLY IS AS SIMPLE AS A B C</h5>
                                <div class="style-selector-wrapper">
                                        <!--<h5 class="title">Choose Layout</h5>-->
                                        <!--                                        <a class="btn-gray active" href="index.php">Wide</a> <a class="btn-gray" href="http://codelayers.net/templates/hasta/construction/boxed/index.php">Boxed</a>
                                                                                <div class="clearfix"></div>-->
                                        <!--                    <h5 class="title align-left">IT REALLY IS AS SIMPLE AS A B C</h5>-->
                                        <div class="scrol-box">
                                                <ol class="alpha-list bg-pattrens-list">
                                                        <li><span>A</span><p>Phone us and have a chat about the type of Care and Support you would require. We are happy to give advice and to talkto you through the many options available to you.</p></li>
                                                        <li><span>B</span>We will visit you so we can get to know you and talk about all the little details that are important to you.</li>
                                                        <li class="last"><span>C</span>We will set up your care and support plan and will introduce your care workers. We will make sure everyone knows exactly what you want. We will make sure that is exactly what you get by supporting and supervising the people who provide your care.</li>
                                                </ol>
                                                <div class="row">
                                                        <h5 class="title-big">CALL US TODAY ON +91 90 20 599 599</h5>
                                                        <div class="col-md-12">
                                                                <!--<div role="form" class="wpcf7" id="wpcf7-f140-o2" lang="en-US" dir="ltr">-->
                                                                <div class="screen-reader-response"></div>
                                                                <?= Html::beginForm(['site/contacts'], 'post', ['class' => 'wpcf7-form']) ?>
                                                                <div class="col-md-6">
                                                                        <p><span class="wpcf7-form-control-wrap YourLocation"><select name="Location" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Location">Location</option><option value="Kerala">Kerala</option><option value="Mumbai">Mumbai</option></select></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="first-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name"></span> </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <p><span class="wpcf7-form-control-wrap PhoneNumber"><input type="tel" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Phone"></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email"></span> </p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <p><span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span> </p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <p><?= Html::submitButton('SEND', ['class' => 'wpcf7-form-control contact-submit-btn', 'name' => 'contact-send']) ?></p>
                                                                </div>
                                                                <?= Html::endForm() ?>
                                                                <!--</div>-->
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <!------------------------selector-div-end----------------------------------->


                <section class="mkdf-side-menu right">
                        <div class="mkdf-close-side-menu-holder">
                                <div class="mkdf-close-side-menu-holder-inner">
                                        <a href="#" target="_self" class="mkdf-close-side-menu">
                                                <span aria-hidden="true" class="icon_close"></span>
                                        </a>
                                </div>
                        </div>
                        <div id="text-11" class="widget mkdf-sidearea widget_text">
                                <div class="textwidget">
                                        <div data-original-height="25" class="vc_empty_space" style="height: 25px"><span class="vc_empty_space_inner"></span></div>

                                        <a href="<?= Yii::$app->homeUrl; ?>site/index">
                                                <img width="auto" height="100%" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                                        </a>
                                        <div data-original-height="10" class="vc_empty_space" style="height: 10px"><span class="vc_empty_space_inner"></span></div>
                                        <br/>

                                        <div class="vc_row wpb_row vc_row-fluid mkdf-section vc_custom_1455028506356 mkdf-content-aligment-left" style="">
                                                <div class="clearfix mkdf-full-section-inner">
                                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner ">
                                                                        <div class="wpb_wrapper">
                                                                                <div class="mkdf-tabs mkdf-horizontal mkdf-tab-text-icon clearfix">
                                                                                        <ul class="mkdf-tabs-nav">
                                                                                                <li>
                                                                                                        <a href="#Log-in">
                                                                                                                <span class="mkdf-icon-frame"></span>
                                                                                                                <span class="mkdf-tab-text-after-icon">
                                                                                                                        Log In					</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="#Register">
                                                                                                                <span class="mkdf-icon-frame"></span>
                                                                                                                <span class="mkdf-tab-text-after-icon">
                                                                                                                        Register					</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                        </ul>
                                                                                        <div class="mkdf-tab-container" id="Log-in" data-icon-pack="linear_icons" data-icon-html="&lt;i class=&quot;mkdf-icon-linear-icon lnr lnr-shirt &quot; &gt;&lt;/i&gt;">
                                                                                                <?php
                                                                                                $model = new \common\models\LoginForm();
                                                                                                $action = Yii::$app->homeUrl . 'site/login';
                                                                                                $form = ActiveForm::begin(['action' => $action, 'options' => ['class' => 'modal-content animate']]);
                                                                                                ?>

                                                                                                <div class="container login-field">
                                                                                                        <label><b>Username</b></label>
                                                                                                        <?= $form->field($model, 'username')->textInput(['class' => '', 'placeholder' => 'Enter Username'])->label(FALSE); ?>

                                                                                                        <label><b>Password</b></label>
                                                                                                        <?= $form->field($model, 'password')->passwordInput(['class' => '', 'placeholder' => 'Enter Password'])->label(FALSE) ?>

                                                                                                        <button type="submit">Login</button>
                                                                                                        <span class="psw"><a href="<?= Yii::$app->homeUrl ?>site/forgot">Forgot password?</a>
                                                                                                </div>

                                                                                                <?php ActiveForm::end(); ?>
                                                                                        </div>

                                                                                        <div class="mkdf-tab-container" id="Register" data-icon-pack="linear_icons" data-icon-html="&lt;i class=&quot;mkdf-icon-linear-icon lnr lnr-smile &quot; &gt;&lt;/i&gt;">
                                                                                                <div data-original-height="10" class="vc_empty_space" style="height: 10px"><span class="vc_empty_space_inner"></span></div>
                                                                                                <div id="logbox">
                                                                                                        <?php
                                                                                                        $act = Yii::$app->homeUrl . 'site/sign-up';
                                                                                                        $form = ActiveForm::begin(['action' => $act, 'options' => ['class' => 'animate', 'id' => 'signup']]);
                                                                                                        ?>
                                                                                                        <div class="container register-field">
                                                                                                                <!--<h1>create an account</h1>-->
                                                                                                                <input name="patient_id" type="text" placeholder="Enter Your Patient ID"  autofocus="autofocus" required="required" class="input pass"/>
                                                                                                                <input name="contact_no" type="text" placeholder="Enter Your Contact Number / Email ID" required="required" class="input pass"/>
                                                                                                                <input type="submit" value="Sign me up!" class="inputButton" name="sign_up"/>
                                                                                                                <div class="text-center">
                                                                                                                        already have an account? <a href="<?= Yii::$app->homeUrl ?>/site/login" id="login_id">login</a>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                        <?php ActiveForm::end(); ?>
                                                                                                </div>
                                                                                        </div>



                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                </div>
                        </div>
                </section>

                <div class="mkdf-wrapper">
                        <div class="mkdf-wrapper-inner">

                                <div class="mkdf-top-bar">
                                        <div class="mkdf-grid">
                                                <div class="mkdf-vertical-align-containers mkdf-66-33">
                                                        <div class="mkdf-position-left mkdf-top-bar-widget-area">
                                                                <div class="mkdf-position-left-inner mkdf-top-bar-widget-area-inner">
                                                                        <div id="text-6" class="widget widget_text mkdf-top-bar-widget">
                                                                                <div class="mkdf-top-bar-widget-inner">
                                                                                        <div class="textwidget">
                                                                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                        </div>
                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> Mon - Sat 10.00 - 17.00</p>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                        <div id="text-7" class="widget widget_text mkdf-top-bar-widget">
                                                                                <div class="mkdf-top-bar-widget-inner">
                                                                                        <div class="textwidget">
                                                                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                        <i class="mkdf-icon-linear-icon lnr " style="color:#ffffff;font-size:15px;margin-top: -4px"><img src="<?= Yii::$app->homeUrl; ?>images/international-phn-icon.png"/></i> </div>
                                                                                                        </div>
                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> +44 7445 968106 </p>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div id="text-7" class="widget widget_text mkdf-top-bar-widget">
                                                                                <div class="mkdf-top-bar-widget-inner">
                                                                                        <div class="textwidget">
                                                                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-phone-handset  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                        </div>
                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600;"> +91 90 20 599 599 </p>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                        <div id="text-8" class="widget widget_text mkdf-top-bar-widget">
                                                                                <div class="mkdf-top-bar-widget-inner">
                                                                                        <div class="textwidget">
                                                                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                        </div>
                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> info@caringpeople.in</p>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="mkdf-position-right mkdf-top-bar-widget-area">
                                                                <div class="mkdf-position-right-inner mkdf-top-bar-widget-area-inner">
                                                                        <!--                                    <div id="text-9" class="widget widget_text mkdf-top-bar-widget"><div class="mkdf-top-bar-widget-inner">			<div class="textwidget"><div id="icl_lang_sel_widget-3" class="widget widget_icl_lang_sel_widget mkdf-top-bar-widget" style="position: static; padding-right: 0;"><div class="mkdf-top-bar-widget-inner"><div id="lang_sel"><ul><li><a href="#" class="lang_sel_sel icl-en">English</a> <ul><li class="icl-fr"><a href="#">French</a></li><li class="icl-de"><a href="#">German</a></li><li class="icl-it"><a href="#">Italian</a></li></ul></li></ul></div></div></div></div>
                                                                                                                    </div></div>-->
                                                                        <div id="text-10" class="widget widget_text mkdf-top-bar-widget">
                                                                                <div class="mkdf-top-bar-widget-inner">
                                                                                        <div class="textwidget">
                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 7px 7px 0 0" data-color="#ffffff">
                                                                                                        <a href="https://twitter.com/" target="_blank">

                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_twitter_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                                                                        </a>
                                                                                                </span>

                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                                                        <a href="https://www.facebook.com/" target="_blank">

                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_facebook_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                                                                        </a>
                                                                                                </span>

                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                                                        <a href="https://www.linkedin.com/" target="_blank">

                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_linkedin_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                                                                        </a>
                                                                                                </span>

                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 0 0 0" data-color="#ffffff">
                                                                                                        <a href="https://vimeo.com/" target="_blank">

                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_vimeo_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                                                                        </a>
                                                                                                </span>

                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <header class="mkdf-page-header">
                                        <?php $action = Yii::$app->controller->action->id; // controller action id  ?>
                                        <div class="mkdf-menu-area">
                                                <div class="mkdf-grid">
                                                        <div class="mkdf-vertical-align-containers">
                                                                <div class="mkdf-position-left">
                                                                        <div class="mkdf-position-left-inner">

                                                                                <div class="mkdf-logo-wrapper">
                                                                                        <a href="<?= Yii::$app->homeUrl; ?>site/index" style="height: 60px;">
                                                                                                <img height="88" width="358" class="mkdf-normal-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                                                                                                <img height="88" width="358" class="mkdf-dark-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="dark logo" /> <img height="88" width="358" class="mkdf-light-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="light logo" /> </a>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                                <div class="mkdf-position-right">
                                                                        <div class="mkdf-position-right-inner">

                                                                                <nav class="mkdf-main-menu mkdf-drop-down mkdf-default-nav">
                                                                                        <ul id="menu-top-menu" class="clearfix">
                                                                                                <li id="nav-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children has_sub narrow <?php if ($action == 'index') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="plus"></span></span>', ['site/index'], ['class' => 'current']) ?></li>
                                                                                                <li id="nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub wide <?php if ($action == 'about') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">About Us</span></span><span class="plus"></span></span>', ['site/about'], ['class' => '']) ?></li>

                                                                                                <?php
                                                                                                if ($action == 'doctor-visit' || $action == 'nursing-care' || $action == 'caregive' || $action == 'laboratory' || $action == 'pharmacy' || $action == 'equipment-hire' || $action == 'doctor-visit') {
                                                                                                        $active = 'mkdf-active-item';
                                                                                                } else {
                                                                                                        $active = '';
                                                                                                }
                                                                                                ?>

                                                                                                <li id="nav-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= $active; ?>"><a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span class="item_text">Services</span></span><span class="plus"></span></span></a>
                                                                                                        <div class="second ">
                                                                                                                <div class="inner">
                                                                                                                        <ul>
                                                                                                                                <li id="nav-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Doctor Visit</span></span><span class="plus"></span></span>', ['services/doctor-visit'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Nursing Care</span></span><span class="plus"></span></span>', ['services/nursing-care'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Caregiving Services (24<span style="font-size: 14px;">&#10005;</span>7)</span></span><span class="plus"></span></span>', ['services/caregiver'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Physiotherapy </span></span><span class="plus"></span></span>', ['services/physiotherapy'], ['class' => '']) ?></li>


<!--<li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment-hire'], ['class' => ''])                                                                                                                          ?></li>-->
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Health Check-up</span></span><span class="plus"></span></span>', ['services/health-check-up'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Air Ambulance</span></span><span class="plus"></span></span>', ['services/air-ambulance'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Ambulance</span></span><span class="plus"></span></span>', ['services/ambulance'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Psychologist</span></span><span class="plus"></span></span>', ['services/councelling-psychologist'], ['class' => '']) ?></li>

                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Pharmacy</span></span><span class="plus"></span></span>', ['services/mobile-pharmacy'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Laboratory</span></span><span class="plus"></span></span>', ['services/laboratory'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Dietitian</span></span><span class="plus"></span></span>', ['services/dietitian'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Speech Therapy</span></span><span class="plus"></span></span>', ['services/speech-therapy'], ['class' => '']) ?></li>
                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Other Services</span></span><span class="plus"></span></span>', ['services/other-services'], ['class' => '']) ?></li>
                                                                                                                                <!--
                                                                                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Software(Use it If Needed)</span></span><span class="plus"></span></span>', ['services/software'], ['class' => ''])                                                                                                                ?></li>
                                                                                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Your Welfare</span></span><span class="plus"></span></span>', ['services/welfare'], ['class' => ''])                                                                                                                ?></li>
                                                                                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Meals On Wheels</span></span><span class="plus"></span></span>', ['services/meals-on-wheels'], ['class' => ''])                                                                                                                ?></li>
                                                                                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Handyman Service</span></span><span class="plus"></span></span>', ['services/handyman-service'], ['class' => ''])                                                                                                                ?></li>
                                                                                                                                                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Hairdressing Service</span></span><span class="plus"></span></span>', ['services/mobile-hairdressing-service'], ['class' => ''])                                                                                                                ?></li>-->
                                                                                                                        </ul>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </li>
                                                                                                <li id="nav-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'testimonial') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="plus"></span></span>', ['site/testimonial'], ['class' => '']) ?></li>
                                                                                                <li id="nav-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'feedback') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="plus"></span></span>', ['site/feedback'], ['class' => '']) ?></li>
                                                                                                <li id="nav-menu-item-501" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'gallery') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="plus"></span></span>', ['site/gallery'], ['class' => '']) ?></li>
                                                                                                <li id="nav-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'contact') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="plus"></span></span>', ['site/contact'], ['class' => '']) ?></li>
                                                                                        </ul>
                                                                                </nav>

                                                                                <div class="mkdf-main-menu-widget-area">
                                                                                        <div class="mkdf-main-menu-widget-area-inner">
                                                                                                <div id="mkdf_side_area_opener-2" class="widget widget_mkdf_side_area_opener mkdf-right-from-main-menu-widget">
                                                                                                        <div class="mkdf-right-from-main-menu-widget-inner">
                                                                                                                <a href="javascript:void(0)" class=" mkdf-side-menu-button-opener large " onclick="JavaScript: return false;">
                                                                                                                        <span aria-hidden="true">LogIn</span> </a>

                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>

                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="mkdf-sticky-header">
                                                <div class="mkdf-sticky-holder">
                                                        <div class="mkdf-grid">
                                                                <div class=" mkdf-vertical-align-containers">
                                                                        <div class="mkdf-position-left">
                                                                                <div class="mkdf-position-left-inner">

                                                                                        <div class="mkdf-logo-wrapper">
                                                                                                <a href="<?= Yii::$app->homeUrl; ?>site/index" style="height: 44px;">
                                                                                                        <img height="88" width="358" class="mkdf-normal-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                                                                                                        <img height="88" width="358" class="mkdf-dark-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="dark logo" /> <img height="88" width="358" class="mkdf-light-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="light logo" /> </a>
                                                                                        </div>

                                                                                </div>
                                                                        </div>
                                                                        <div class="mkdf-position-right">
                                                                                <div class="mkdf-position-right-inner">

                                                                                        <nav class="mkdf-main-menu mkdf-drop-down mkdf-sticky-nav">
                                                                                                <ul id="menu-top-menu-1" class="clearfix">
                                                                                                        <li id="sticky-nav-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children has_sub narrow <?php if ($action == 'index') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="plus"></span></span>', ['site/index'], ['class' => 'current']) ?></li>
                                                                                                        <li id="sticky-nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub wide <?php if ($action == 'about') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">About Us</span></span><span class="plus"></span></span>', ['site/about'], ['class' => '']) ?></li>

                                                                                                        <?php
                                                                                                        if ($action == 'doctor-visit' || $action == 'nursing-care' || $action == 'caregive' || $action == 'laboratory' || $action == 'pharmacy' || $action == 'equipment-hire' || $action == 'doctor-visit') {
                                                                                                                $active = 'mkdf-active-item';
                                                                                                        } else {
                                                                                                                $active = '';
                                                                                                        }
                                                                                                        ?>

                                                                                                        <li id="sticky-nav-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= $active; ?>"><a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span class="item_text">Services</span></span><span class="plus"></span></span></a>
                                                                                                                <div class="second ">
                                                                                                                        <div class="inner">
                                                                                                                                <ul>
                                                                                                                                        <li id="nav-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Doctor Visit</span></span><span class="plus"></span></span>', ['services/doctor-visit'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Nursing Care</span></span><span class="plus"></span></span>', ['services/nursing-care'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Caregiving Services (24<span style="font-size: 14px;">&#10005;</span>7)</span></span><span class="plus"></span></span>', ['services/caregiver'], ['class' => '']) ?></li>

                                                                                                                                        <li id="nav-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Physiotherapy</span></span><span class="plus"></span></span>', ['services/physiotherapy'], ['class' => '']) ?></li>

<!--<li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment-hire'], ['class' => ''])                                                                                                                         ?></li>-->
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Health Check-up</span></span><span class="plus"></span></span>', ['services/health-check-up'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Air Ambulance</span></span><span class="plus"></span></span>', ['services/air-ambulance'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Ambulance</span></span><span class="plus"></span></span>', ['services/ambulance'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Counselling</span></span><span class="plus"></span></span>', ['services/councelling-psychologist'], ['class' => '']) ?></li>

                                                                                                                                        <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Pharmacy</span></span><span class="plus"></span></span>', ['services/mobile-pharmacy'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Laboratory</span></span><span class="plus"></span></span>', ['services/laboratory'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Dietitian</span></span><span class="plus"></span></span>', ['services/dietitian'], ['class' => '']) ?></li>
                                                                                                                                        <li id="nav-menu-item-613" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Speech Therapy</span></span><span class="plus"></span></span>', ['services/speech-therapy'], ['class' => '']) ?></li>

                                                                                                                                        <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Other Services</span></span><span class="plus"></span></span>', ['services/other-services'], ['class' => '']) ?></li>

<!--                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Software (Use it if needed)</span></span><span class="plus"></span></span>', ['services/software'], ['class' => ''])                                                                                                              ?></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Your welfare</span></span><span class="plus"></span></span>', ['services/welfare'], ['class' => ''])                                                                                                              ?></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text"> Meals on Wheels</span></span><span class="plus"></span></span>', ['services/meals-on-wheels'], ['class' => '']                                                                                                               ?></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Handyman Service</span></span><span class="plus"></span></span>', ['services/handyman-service'], ['class' => ''                                                                                                                ?></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Hairdressing Service</span></span><span class="plus"></span></span>', ['services/mobile-hairdressing-service'], ['class' => ')                                                                                                                ?></li>-->

                                                                                                                                </ul>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </li>

                                                                                                        <li id="sticky-nav-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'testimonial') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="plus"></span></span>', ['site/testimonial'], ['class' => '']) ?></li>
                                                                                                        <li id="sticky-nav-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'feedback') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="plus"></span></span>', ['site/feedback'], ['class' => '']) ?></li>
                                                                                                        <li id="sticky-nav-menu-item-501" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'gallery') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="plus"></span></span>', ['site/gallery'], ['class' => '']) ?></li>
                                                                                                        <li id="sticky-nav-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?php if ($action == 'contact') { ?> mkdf-active-item <?php } ?>"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="plus"></span></span>', ['site/contact'], ['class' => '']) ?></li>
                                                                                                        <li id="sticky-nav-menu-item-2022" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow"><a href="javascript:void(0)" class=" mkdf-side-menu-button-opener " onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span  aria-hidden="true">Log In</span></span><span class="plus"></span></span></a>
                                                                                                        </li>
                                                                                                </ul>
                                                                                        </nav>

                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                </header>

                                <header class="mkdf-mobile-header">
                                        <div class="mkdf-mobile-header-inner">
                                                <div class="mkdf-mobile-header-holder">
                                                        <div class="mkdf-grid">
                                                                <div class="mkdf-vertical-align-containers">
                                                                        <div class="mkdf-mobile-menu-opener">
                                                                                <a href="javascript:void(0)">
                                                                                        <span class="mkdf-mobile-opener-icon-holder">
                                                                                                <i class="mkdf-icon-font-awesome fa fa-bars " ></i>                    </span>
                                                                                </a>
                                                                        </div>
                                                                        <div class="mkdf-position-center">
                                                                                <div class="mkdf-position-center-inner">

                                                                                        <div class="mkdf-mobile-logo-wrapper">
                                                                                                <a href="<?= Yii::$app->homeUrl; ?>site/index" style="height: 44px">
                                                                                                        <img height="88" width="358" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="mobile-logo" />
                                                                                                </a>
                                                                                        </div>

                                                                                </div>
                                                                        </div>
                                                                        <div class="mkdf-position-right">
                                                                                <div class="mkdf-position-right-inner">
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <!-- close .mkdf-vertical-align-containers -->

                                                                 <div class="mobile_login">
                                                                        <a href="javascript:void(0)" class=" mkdf-side-menu-button-opener large " onclick="JavaScript: return false;">
                                                                                <span aria-hidden="true"><i class="fa fa-user-o"></i></span>LogIn
                                                                        </a>
                                                                </div>
                                                             
                                                        </div>
                                                </div>

                                                <nav class="mkdf-mobile-nav">
                                                        <div class="mkdf-grid">
                                                                <ul id="menu-top-menu-2" class="">
                                                                        <li id="mobile-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children mkdf-active-item has_sub"><h4><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="plus"></span></span>', ['site/index'], ['class' => 'current']) ?></h4></li>
                                                                        <li id="mobile-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub"><h4><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">About US</span></span><span class="plus"></span></span>', ['site/about'], ['class' => '']) ?></h4></li>

                                                                        <li id="mobile-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                                                                <h4><span>Services</span></h4><span class="mobile_arrow"><i class="mkdf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                                                                                <ul class="sub_menu">
                                                                                        <li id="mobile-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Doctor Visit</span></span><span class="plus"></span></span>', ['services/doctor-visit'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Nursing Care</span></span><span class="plus"></span></span>', ['services/nursing-care'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Caregiving Services (24<span style="font-size: 14px;">&#10005;</span>7)</span></span><span class="plus"></span></span>', ['services/caregiver'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Physiotherapy</span></span><span class="plus"></span></span>', ['services/physiotherapy'], ['class' => '']) ?></li>


<!--<li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment-hire'], ['class' => ''])                                                                                                                        ?></li>-->
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Health Check-up</span></span><span class="plus"></span></span>', ['services/health-check-up'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Air Ambulance</span></span><span class="plus"></span></span>', ['services/air-ambulance'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Ambulance</span></span><span class="plus"></span></span>', ['services/ambulance'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Counselling </span></span><span class="plus"></span></span>', ['services/councelling-psychologist'], ['class' => '']) ?></li>

                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span>', ['services/equipment'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Pharmacy</span></span><span class="plus"></span></span>', ['services/mobile-pharmacy'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Laboratory</span></span><span class="plus"></span></span>', ['services/laboratory'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Dietitian</span></span><span class="plus"></span></span>', ['services/dietitian'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Speech Therapy</span></span><span class="plus"></span></span>', ['services/speech-therapy'], ['class' => '']) ?></li>
                                                                                        <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Other Services</span></span><span class="plus"></span></span>', ['services/other-services'], ['class' => '']) ?></li>

<!--                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Software (Use it if needed)</span></span><span class="plus"></span></span>', ['services/software'], ['class'  ''])                                                                                                              ?></li>
                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Your welfare</span></span><span class="plus"></span></span>', ['services/welfare'], ['class'> ''])                                                                                                              ?></li>
                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Meals on Wheels</span></span><span class="plus"></span></span>', ['services/meals-on-wheels'], ['class=> ''])                                                                                                              ?></li>
                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Handyman Service</span></span><span class="plus"></span></span>', ['services/handyman-service'], ['clas => ''])                                                                                                              ?></li>
                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page"><?php // Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Mobile Hairdressing Service</span></span><span class="plus"></span></span>', ['services/mobile-hairdressing-service'], ['cla' => ''])                                                                                                              ?></li>-->
                                                                                </ul>
                                                                        </li>
                                                                        <li id="mobile-menu-item-2022" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="mobile_arrow"></span></span>', ['site/testimonial'], ['class' => '']) ?></li>
                                                                        <li id="mobile-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="mobile_arrow"></span></span>', ['site/feedback'], ['class' => '']) ?></li>
                                                                        <li id="mobile-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="mobile_arrow"></span></span>', ['site/gallery'], ['class' => '']) ?></li>
                                                                        <li id="mobile-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub"><?= Html::a('<span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="mobile_arrow"></span></span>', ['site/contact'], ['class' => '']) ?></li>

                                                                </ul>
                                                        </div>
                                                </nav>

                                        </div>
                                </header>
                                <!-- close .mkdf-mobile-header -->

                                <a id='mkdf-back-to-top' href='#'>
                                        <span class="mkdf-icon-stack">
                                                <span aria-hidden="true" class="mkdf-icon-font-elegant arrow_carrot-up " ></span> </span>
                                        <span class="mkdf-back-to-top-inner">
                                                <span class="mkdf-back-to-top-text">Top</span>
                                        </span>
                                </a>

                                <?php $this->beginBody() ?>


                                <?= $content ?>



                                <?php $this->endBody() ?>

                                <footer class="mkdf-page-footer">
                                        <div class="mkdf-footer-inner clearfix">

                                                <div class="mkdf-footer-top-holder">
                                                        <div class="mkdf-footer-top mkdf-footer-top-aligment-left">

                                                                <div class="mkdf-container">
                                                                        <div class="mkdf-container-inner">

                                                                                <div class="mkdf-four-columns clearfix">
                                                                                        <div class="mkdf-four-columns-inner">
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div id="text-13" class="widget mkdf-footer-column-1 widget_text">
                                                                                                                        <div class="textwidget">
                                                                                                                                <div data-original-height="15" class="vc_empty_space" style="height: 15px"><span class="vc_empty_space_inner"></span></div>

                                                                                                                                <a href="<?= Yii::$app->homeUrl; ?>site/index">
                                                                                                                                        <img width="179" height="44" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo">
                                                                                                                                </a>
                                                                                                                                <div data-original-height="16" class="vc_empty_space" style="height: 16px"><span class="vc_empty_space_inner"></span></div>

                                                                                                                                Caring People is a highly distinct firm specializing as an in-home service provider, which supports the clients by offering comprehensive services so as to lead dignified and independent lifestyles in the comfort and safety of their own homes. We are a professional team designed to provide an outstanding service to our clients.

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>

                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div class="widget mkdf-latest-posts-widget">
                                                                                                                        <h3 class="mkdf-footer-widget-title">Address</h3>
                                                                                                                        <h4 style="margin-bottom: 5px; margin-top: 0px;" class="mkdf-footer-widget-title">Cochin</h4>
                                                                                                                        <div class="mkdf-blog-list-holder  mkdf-minimal">
                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="fa fa-home" aria-hidden="true" style="color:#ffffff;font-size:15px"></i>
                                                                                                                                                </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Caring People
                                                                                                                                                <br> Door No. 5 ,DD Vyapar Bhavan
                                                                        <br> K P Vallon Road
                                                                        <br> Kadavnthra
                                                                        <br> Cochin 20</p>
                                                                                                                                </div>
                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Mon - Sat 10.00 - 17.00 Sunday CLOSED</p>
                                                                                                                                </div>

                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> info@caringpeople.in
                                                                                                                                        </p>
                                                                                                                                </div>




                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div class="widget mkdf-latest-posts-widget">
                                                                                                                        <br/>
                                                                                                                        <br/>
                                                                                                                        <br/>
                                                                                                                        <h4 style="margin-bottom: 5px; margin-top: 0px;" class="mkdf-footer-widget-title">Mumbai</h4>
                                                                                                                        <div class="mkdf-blog-list-holder  mkdf-minimal">
                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="fa fa-home" aria-hidden="true" style="color:#ffffff;font-size:15px"></i>
                                                                                                                                                </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Caring People
                                                                                                                                                <br> Shop No 6,
                                                                                                                                                <br> J2 Vijay Park,
                                                                                                                                                <br> Dias & Periera Nagar,

                                                                                                                                                <br> Naigaon Mumbai</p>
                                                                                                                                </div>
                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Mon - Sat 10.00 - 17.00 Sunday CLOSED</p>
                                                                                                                                </div>

                                                                                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                                                        <div class="mkdf-icon-list-icon-holder">
                                                                                                                                                <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                                                        <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                                                                                        </div>
                                                                                                                                        <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> info@caringpeople.in
                                                                                                                                        </p>
                                                                                                                                </div>






                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div id="text-3" class="widget mkdf-footer-column-4 widget_text">
                                                                                                                        <div class="textwidget">
                                                                                                                                <h3 style="color: #ffffff;">Contact</h3>
                                                                                                                                <div data-original-height="1" class="vc_empty_space" style="height: 1px"><span class="vc_empty_space_inner"></span></div>

                                                                                                                                <!--<div role="form" class="wpcf7" id="wpcf7-f219-o1" lang="en-US" dir="ltr">-->
                                                                                                                                <!--<div class="screen-reader-response"></div>-->
                                                                                                                                <?= Html::beginForm(['site/contactform'], 'post', ['class' => 'wpcf7-form cf7_custom_style_1']) ?>

                                                                                                                                <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="first-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name*" required /></span></p>
                                                                                                                                <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email*" required /></span></p>
                                                                                                                                <div><span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Comment*" required></textarea></span></div>
                                                                                                                                <div>
                                                                                                                                        <input type="submit" name="contact-sends" value="Submit" class="wpcf7-form-control wpcf7-submit" >
                                                                                                                                </div>
                                                                                                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                                                                                                                <?= Html::endForm() ?>
                                                                                                                                <!--</div>-->
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>


                                                                                <div class="row">
                                                                                        <div class="col-md-3"></div>
                                                                                        <div class="col-md-6"><span style="color: #fbfbfc;font-weight: 700;"> Helpline Numbers : </span></br>
                                                                                                <p> Domestic : +91 90 20 599 599 | International : +44 7445 968106 </p></div>

                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="mkdf-footer-bottom-holder">
                                                        <div class="mkdf-footer-bottom-holder-inner">
                                                                <div class="mkdf-container">
                                                                        <div class="mkdf-container-inner">

                                                                                <div class="mkdf-two-columns-50-50 clearfix">
                                                                                        <div class="mkdf-two-columns-50-50-inner">
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div id="text-4" class="widget mkdf-footer-bottom-left widget_text">
                                                                                                                        <div class="textwidget">Copyrights 2017 © <span style="color:#8f8f8f;">Caringpeople</span></div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <div id="text-5" class="widget mkdf-footer-bottom-left widget_text">
                                                                                                                        <div class="textwidget">Follow Us
                                                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 10px" data-color="#ffffff">
                                                                                                                                        <a href="https://twitter.com/" target="_blank">

                                                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_twitter_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                                                                                        </a>
                                                                                                                                </span>

                                                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                                                                                        <a href="https://www.facebook.com/" target="_blank">

                                                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_facebook_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                                                                                        </a>
                                                                                                                                </span>

                                                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                                                                                        <a href="https://www.linkedin.com/" target="_blank">

                                                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_linkedin_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                                                                                        </a>
                                                                                                                                </span>

                                                                                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 0 0 0" data-color="#ffffff">
                                                                                                                                        <a href="https://vimeo.com/" target="_blank">

                                                                                                                                                <span aria-hidden="true" class="mkdf-icon-font-elegant social_vimeo_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                                                                                        </a>
                                                                                                                                </span>

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>



                                </footer>

                        </div>
                        <!-- close div.mkdf-wrapper-inner  -->
                </div>
                <!-- close div.mkdf-wrapper -->
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.minafe3.js?rev=5.1.6'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.minafe3.js?rev=5.1.6'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.parallax.min.js'></script>
                <script>
                                                                                                                var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
                                                                                                                var htmlDivCss = ".tp-caption.Default-Title-1,.Default-Title-1{color:rgba(255,255,255,1.00);font-size:75px;line-height:80px;font-weight:700;font-style:normal;font-family:Josefin Sans;padding:0px 0px 0px 0px;text-decoration:none;text-align:left;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.Button,.Button{color:rgba(255,255,255,1.00);font-size:16px;line-height:16px;font-weight:700;font-style:normal;font-family:Open Sans;padding:17px 46px 17px 46px;text-decoration:none;text-align:left;background-color:rgba(79,191,112,1.00);border-color:rgba(79,191,112,1.00);border-style:solid;border-width:2px;border-radius:30px 30px 30px 30px}.tp-caption.Button:hover,.Button:hover{color:rgba(79,191,112,1.00);text-decoration:none;background-color:rgba(255,255,255,1.00);border-color:rgba(255,255,255,1.00);border-style:solid;border-width:2px;border-radius:30px 30px 30px 30px;cursor:pointer}.tp-caption.Default-Subtitle,.Default-Subtitle{color:rgba(128,128,128,1.00);font-size:17px;line-height:30px;font-weight:400;font-style:normal;font-family:Open Sans;padding:0px 0px 0px 0px;text-decoration:none;text-align:left;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}";
                                                                                                                if (htmlDiv) {
                                                                                                                        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                                                                                                } else {
                                                                                                                        var htmlDiv = document.createElement("div");
                                                                                                                        htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
                                                                                                                        document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
                                                                                                                }
                </script>
                <script type="text/javascript">
                        /******************************************
                         -	PREPARE PLACEHOLDER FOR SLIDER	-
                         ******************************************/

                        var setREVStartSize = function () {
                                try {
                                        var e = new Object,
                                                i = jQuery(window).width(),
                                                t = 9999,
                                                r = 0,
                                                n = 0,
                                                l = 0,
                                                f = 0,
                                                s = 0,
                                                h = 0;
                                        e.c = jQuery('#rev_slider_11_1');
                                        e.responsiveLevels = [1920, 1440, 778, 480];
                                        e.gridwidth = [1400, 1200, 778, 480];
                                        e.gridheight = [868, 700, 600, 600];
                                        e.sliderLayout = "fullscreen";
                                        e.fullScreenAutoWidth = 'off';
                                        e.fullScreenAlignForce = 'off';
                                        e.fullScreenOffsetContainer = '.mkdf-top-bar, .mkdf-page-header';
                                        e.fullScreenOffset = '';
                                        e.minHeight = 300;
                                        if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function (e, f) {
                                                f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                                        }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                                                var u = (e.c.width(), jQuery(window).height());
                                                if (void 0 != e.fullScreenOffsetContainer) {
                                                        var c = e.fullScreenOffsetContainer.split(",");
                                                        if (c)
                                                                jQuery.each(c, function (e, i) {
                                                                        u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                                                                }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                                                }
                                                f = u
                                        } else
                                                void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                                        e.c.closest(".rev_slider_wrapper").css({
                                                height: f
                                        })

                                } catch (d) {
                                        console.log("Failure at Presize of Slider:" + d)
                                }
                        };
                        setREVStartSize();
                        function revslider_showDoubleJqueryError(sliderID) {
                                var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
                                errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
                                errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
                                errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
                                errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
                                jQuery(sliderID).show().html(errorMessage);
                        }
                        var tpj = jQuery;
                        var revapi11;
                        tpj(document).ready(function () {
                                if (tpj("#rev_slider_11_1").revolution == undefined) {
                                        revslider_showDoubleJqueryError("#rev_slider_11_1");
                                } else {
                                        revapi11 = tpj("#rev_slider_11_1").show().revolution({
                                                sliderType: "standard",
                                                jsFileLocation: "//wp-content/plugins/revslider/public/assets/js/",
                                                sliderLayout: "fullscreen",
                                                dottedOverlay: "none",
                                                delay: 5000,
                                                navigation: {
                                                        keyboardNavigation: "off",
                                                        keyboard_direction: "horizontal",
                                                        mouseScrollNavigation: "off",
                                                        onHoverStop: "off",
                                                        arrows: {
                                                                style: "wellspring-light",
                                                                enable: true,
                                                                hide_onmobile: true,
                                                                hide_under: 770,
                                                                hide_onleave: false,
                                                                tmp: '',
                                                                left: {
                                                                        h_align: "left",
                                                                        v_align: "center",
                                                                        h_offset: 20,
                                                                        v_offset: 0
                                                                },
                                                                right: {
                                                                        h_align: "right",
                                                                        v_align: "center",
                                                                        h_offset: 20,
                                                                        v_offset: 0
                                                                }
                                                        }
                                                },
                                                responsiveLevels: [1920, 1440, 778, 480],
                                                visibilityLevels: [1920, 1440, 778, 480],
                                                gridwidth: [1400, 1200, 778, 480],
                                                gridheight: [868, 700, 600, 600],
                                                lazyType: "none",
                                                minHeight: 300,
                                                parallax: {
                                                        type: "mouse+scroll",
                                                        origo: "enterpoint",
                                                        speed: 4000,
                                                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                                                        type: "mouse+scroll",
                                                },
                                                shadow: 0,
                                                spinner: "spinner2",
                                                stopLoop: "off",
                                                stopAfterLoops: -1,
                                                stopAtSlide: -1,
                                                shuffle: "off",
                                                autoHeight: "off",
                                                fullScreenAutoWidth: "off",
                                                fullScreenAlignForce: "off",
                                                fullScreenOffsetContainer: ".mkdf-top-bar, .mkdf-page-header",
                                                fullScreenOffset: "",
                                                disableProgressBar: "on",
                                                hideThumbsOnMobile: "off",
                                                hideSliderAtLimit: 0,
                                                hideCaptionAtLimit: 0,
                                                hideAllCaptionAtLilmit: 0,
                                                debugMode: false,
                                                fallbacks: {
                                                        simplifyAll: "off",
                                                        nextSlideOnWindowFocus: "on",
                                                        disableFocusListener: false,
                                                }
                                        });
                                }
                        }); /*ready*/
                        jQuery.noConflict();
                        jQuery(document).ready(function () {
                                jQuery(".btn-close").click(function () {
                                        if (jQuery(".btn-close").hasClass('out')) {
                                                jQuery(".btn-close").addClass('in').removeClass('out');
                                                jQuery('.btn-close').animate({right: '0'}, "500");
                                                jQuery('.btn-close img').animate({right: '-138'}, "500");
                                        } else if (jQuery(".btn-close").hasClass('in')) {
                                                jQuery(".btn-close").addClass('out').removeClass('in');
                                                jQuery('.btn-close').animate({right: '432'}, "500");
                                                jQuery('.btn-close img').animate({right: '0'}, "500");
                                        }


                                        // Set the effect type
                                        var effect = 'slide';
                                        // Set the options for the effect type chosen
                                        var options = {direction: 'right'};
                                        console.log(options);
                                        // Set the duration (default: 400 milliseconds)
                                        var duration = 500;
                                        jQuery('#style-selector').toggle(effect, options, duration);
                                });
                        });</script>

                

                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/core.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/widget.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/mouse.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/resizable.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/draggable.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/button.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/position.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/dialog.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/wpdialog.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/bbpress/templates/default/js/editor.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js'></script>
                <script type='text/javascript'>
                        /* <![CDATA[ */
                        var _wpcf7 = {
                                "loaderUrl": "http:\/\/wellspring.mikado-themes.com\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif",
                                "recaptchaEmpty": "Please verify that you are not a robot.",
                                "sending": "Sending ..."
                        };
                        /* ]]> */
                </script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/js/scripts.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/tabs.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/jquery.ba-bbq.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/jquery.carouFredSel-6.2.1-packed.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/timetable.js'></script>
                <script type='text/javascript'>
                        /* <![CDATA[ */
                        var woocommerce_params = {
                                "ajax_url": "\/wp-admin\/admin-ajax.php",
                                "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
                        };
                        /* ]]> */
                </script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min.js'></script>
                <script type='text/javascript'>
                        /* <![CDATA[ */
                        var wc_cart_fragments_params = {
                                "ajax_url": "\/wp-admin\/admin-ajax.php",
                                "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
                                "fragment_name": "wc_fragments"
                        };
                        /* ]]> */
                </script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/accordion.min.js'></script>
                <script type='text/javascript'>
                        /* <![CDATA[ */
                        var mejsL10n = {
                                "language": "en-US",
                                "strings": {
                                        "Close": "Close",
                                        "Fullscreen": "Fullscreen",
                                        "Download File": "Download File",
                                        "Download Video": "Download Video",
                                        "Play\/Pause": "Play\/Pause",
                                        "Mute Toggle": "Mute Toggle",
                                        "None": "None",
                                        "Turn off Fullscreen": "Turn off Fullscreen",
                                        "Go Fullscreen": "Go Fullscreen",
                                        "Unmute": "Unmute",
                                        "Mute": "Mute",
                                        "Captions\/Subtitles": "Captions\/Subtitles"
                                }
                        };
                        var _wpmejsSettings = {
                                "pluginPath": "\/wp-includes\/js\/mediaelement\/"
                        };
                        /* ]]> */
                </script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/mediaelement/mediaelement-and-player.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/third-party.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/smoothPageScroll.js'></script>
              
                <script type='text/javascript'>
                        /* <![CDATA[ */
                        var mkdfGlobalVars = {
                                "vars": {
                                        "mkdfAddForAdminBar": 0,
                                        "mkdfElementAppearAmount": -150,
                                        "mkdfFinishedMessage": "No more posts",
                                        "mkdfMessage": "Loading new posts...",
                                        "mkdfTopBarHeight": 40,
                                        "mkdfStickyHeaderHeight": 0,
                                        "mkdfStickyHeaderTransparencyHeight": 60,
                                        "mkdfLogoAreaHeight": 0,
                                        "mkdfMenuAreaHeight": 132,
                                        "mkdfMobileHeaderHeight": 100
                                }
                        };
                        var mkdfPerPageVars = {
                                "vars": {
                                        "mkdfStickyScrollAmount": 400,
                                        "mkdfStickyScrollAmountFullScreen": true,
                                        "mkdfHeaderTransparencyHeight": 0
                                }
                        };
                        /* ]]> */
                </script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/modules.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/blog.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/comment-reply.min.js'></script>
                <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/wp-embed.min.js'></script>
        </body>




</html>
