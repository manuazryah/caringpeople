<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'home' => 'site/index',
                'about' => 'site/about',
                'testimonial' => 'site/testimonial',
                'feedback' => 'site/feedback',
                'gallery' => 'site/gallery',
                'contact' => 'site/contact',
            ],
        ],
	'assetManager' => [
	    'bundles' => [
		'dosamigos\google\maps\MapAsset' => [
		    'options' => [
			'key' => 'AIzaSyB9x-YCwXE-drWPq8ZWenSPexeHEZLJfLs',
			'language' => 'id',
			'version' => '3.1.18'
		    ]
		]
	    ]
	],
    ],
    'params' => $params,
];
