<?php

return [
    'id' => 'app-frontend',
    'name' => 'Yii2-Demo',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'site/index',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'cookieValidationKey' => '7MGUCaKyJbDJJuY1fxiUnJMmmUUzyA',
            'baseUrl' => ''
        ],
        'urlManager' => [
            'rules' => [
                '' => 'site/index',
                'sitemap.xml' => 'site-map/index',
                'POST <_m:articles>' => '<_m>/user/create',
                '<_a:(about|contacts|captcha)>' => 'site/<_a>',
                '<_a:(login|signup|activation|recovery|recovery-confirmation|resend|fileapi-upload)>' => 'guest/<_a>',
                '<_a:logout>' => 'user/<_a>',
                '<_a:email>' => 'default/<_a>',
                'my/settings/<_a:[\w\-]+>' => 'user/<_a>',
                '<_m:articles>' => '<_m>/index',
                '<_m:articles>/<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/view',
                '<alias:[a-zA-Z0-9_-]{1,100}+>' => 'pages/view'
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@frontend/views' => '@frontend/themes/site/views',
                    '@frontend/modules' => '@frontend/themes/site/modules'
                ]
            ]
        ],
        'user' => [
            'loginUrl' => ['guest/login']
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@frontend/themes/site',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@frontend/themes/site',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'i18n' => [
            'translations' => [
                'frontend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                ],
                'themes' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/themes/site/messages',
                ]
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
