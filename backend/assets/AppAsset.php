<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic',
            'css/fonts/linecons/css/linecons.css',
            'css/fonts/fontawesome/css/font-awesome.min.css',
            'css/bootstrap.css',
            'css/xenon-core.css',
            'css/xenon-forms.css',
            'css/xenon-components.css',
            'css/xenon-skins.css',
            'css/custom.css',
            
            'js/select2/select2.css',
            'js/select2/select2-bootstrap.css',
        ];
        public $js = [
            'js/bootstrap.min.js',
            'js/TweenMax.min.js',
            'js/resizeable.js',
            'js/joinable.js',
            'js/xenon-api.js',
            'js/xenon-toggles.js',
            'js/xenon-widgets.js',
            //'js/devexpress-web-14.1/js/globalize.min.js',
            // 'js/devexpress-web-14.1/js/dx.chartjs.js',
            'js/toastr/toastr.min.js',
            'js/xenon-custom.js',
            'js/script.js',
            'js/staff.js',
            'js/enquiry.js',
            'js/followup.js',
            'js/select2/select2.min.js',
            'js/add-to-dropdown.js',
            'js/service.js',
            'js/report.js',
            
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

}
