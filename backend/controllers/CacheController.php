<?php

namespace backend\controllers;

use backend\components\Controller;
use Yii;
use yii\filters\VerbFilter;

/**
 * Генератор sitemap.xml
 * Class SiteMapController
 * @package backend\controllers
 */
class CacheController extends Controller
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
                'roles' => ['bcCacheIndex']
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['bcCacheDelete']
            ]
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'delete' => ['get'],
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

    /**
     * @return string
     */
    public function actionDelete()
    {
        Yii::$app->cache->flush();
        return $this->redirect('index');
    }
}