<?php

return [
    'id' => 'app-frontend',
    'name' => 'Yii2-Start',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'site/default/index',
    'modules' => [
        'articles' => [
            'class' => 'frontend\modules\articles\Module',
        ],
        'category' => [
            'class' => 'frontend\modules\category\Module',
        ],
        'site' => [
            'class' => 'frontend\modules\site\Module'
        ],
        'users' => [
            'class' => 'frontend\modules\users\Module',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '7MGUCaKyJbDJJuY1fxiUnJMmmUUzyA',
            'baseUrl' => ''
        ],
        'urlManager' => [
            'rules' => [
                '' => 'site/default/index',
                'POST <_m:articles>' => '<_m>/user/create',
                '<_m:articles>' => '<_m>/default/index',
                '<_m:articles>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/view',
                '<_a:(about|contacts|captcha)>' => 'site/default/<_a>',
                '<_a:(login|signup|activation|recovery|recovery-confirmation|resend|fileapi-upload)>' => 'users/guest/<_a>',
                '<_a:logout>' => 'users/user/<_a>',
                '<_a:email>' => 'users/default/<_a>',
                'my/settings/<_a:[\w\-]+>' => 'users/user/<_a>',
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
            'loginUrl' => ['users/guest/login']
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
            'errorAction' => 'site/default/error'
        ],
        'i18n' => [
            'translations' => [
                'articles' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/modules/articles/messages',
                ],
                'site' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/modules/site/messages',
                ],
                'users' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/modules/users/messages',
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
