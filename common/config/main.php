<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'language'=>'ru-RU',
    'modules' => [
        'category' => [
            'class' => 'common\modules\category\Module',
        ],
    ],
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl' => ['login']
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@root/cache',
            'keyPrefix' => 'yii2start'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'=>false,
            'suffix' => '/'
        ],
        'assetManager' => [
            'linkAssets' => true   // TODO: Windows XP
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => [
                'user',
                'admin',
                'superadmin'
            ],
            'itemFile' => '@console/modules/rbac/data/items.php',
            'assignmentFile' => '@console/modules/rbac/data/assignments.php',
            'ruleFile' => '@console/modules/rbac/data/rules.php',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:404', 'yii\i18n\I18N::format'], // todo: DbTarget для 404 и 403
                    'prefix'=>function(){
                            $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                            return sprintf('[%s][%s]', Yii::$app->id, $url);
                        },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'formatter' => [
            'dateFormat' => 'dd.MM.y',
            'datetimeFormat' => 'HH:mm:ss dd.MM.y'
        ],

        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'fileapi' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/widget/fileapi/messages',
                    'fileMap' => [
                        'fileapi' => 'fileapi.php',
                    ],
                ],
            ]
        ],
        'db' => require(__DIR__ . '/db.php')
    ],
    'params' => require(__DIR__ . '/params.php')
];
