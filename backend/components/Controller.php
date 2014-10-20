<?php

namespace backend\components;

use yii\filters\AccessControl;
use Yii;

/**
 * Основной контроллер backend приложеннием
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superadmin', 'admin']
                    ]
                ]
            ]
        ];
    }
}
