<?php

Yii::setAlias('backend', dirname(__DIR__));

return [
    'id' => 'app-backend',
    'name' => 'Yii2-Demo',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'default/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => '7fdsf%dbYd&djsb#sn0mlsfo(kj^kf98dfh',
            'baseUrl' => '/backend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'loginUrl' => ['login']
        ],
        'urlManager' => [
            'rules' => [
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
                    'sourceLanguage' => 'ru',
                    'basePath' => '@backend/messages',
                ],
                'themes' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'sourceLanguage' => 'ru-RU',
                    'basePath' => '@backend/themes/admin/messages',
                ],
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
