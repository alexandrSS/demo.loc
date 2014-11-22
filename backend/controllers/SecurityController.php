<?php

namespace backend\controllers;

use backend\components\Controller;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class SiteMapController
 * @package backend\controllers
 */
class SecurityController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['bcSecurityIndex']
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}