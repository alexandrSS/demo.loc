<?php

namespace backend\controllers;

use backend\components\Controller;

/**
 * Контроллер по умолчанию
 * Class DefaultController
 * @package backend\controllers
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['error'],
            'roles' => ['@']
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /**
     * Основная страница
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
