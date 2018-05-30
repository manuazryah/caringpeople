<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetHome extends AssetBundle {

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'css/responsive.css',
            'css/style.css',
            'css/bootstrap.css',
            'css/xenon-forms.css',
        ];
        public $js = [
            'js/bootstrap.min.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

}
