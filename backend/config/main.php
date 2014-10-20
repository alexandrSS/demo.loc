<?php

Yii::setAlias('backend', dirname(__DIR__));

return [
    'id' => 'app-backend',
    'name' => 'Yii2-Start',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'default/index',
    'modules' => [
        'system' => [
            'class' => 'backend\modules\system\Module',
        ],
    ],
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
                //'<_m:articles>' => '<_m>/articles',
                //'<_m:category>' => '<_m>/category',
                //'<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
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
                'admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/modules/admin/messages',
                ],
                'category' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/modules/category/messages',
                ],
                'articles' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/modules/articles/messages',
                ],
                'themes' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/themes/admin/messages',
                ],
                'system' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/modules/system/messages',
                ]
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];
