<?php

Yii::setAlias('backend', dirname(__DIR__));

return [
    'id' => 'app-backend',
    'name' => 'Yii2-Start',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'default/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => '7fdsf%dbYd&djsb#sn0mlsfo(kj^kf98dfh',
            'baseUrl' => '/backend',
            'enableCsrfValidation' => false,
        ],
        'urlManager' => [
            'rules' => [
                '' => 'default/index',
                'login' => 'login/login',
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/views' => '@backend/themes/admin/views',
                    '@backend/modules' => '@backend/themes/admin/modules'
                ]
            ]
        ],
        'user' => [
            'loginUrl' => ['login']
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@backend/themes/admin',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@backend/themes/admin',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'default/error'
        ],
        'i18n' => [
            'translations' => [
                'backend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ],
                'themes' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/themes/admin/messages',
                ],
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
