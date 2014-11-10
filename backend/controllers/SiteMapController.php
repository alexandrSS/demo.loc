<?php

namespace backend\controllers;

use backend\components\Controller;
use common\helpers\Sitemap;
use Yii;
use yii\filters\VerbFilter;

/**
 * Генератор sitemap.xml
 * Class SiteMapController
 * @package backend\controllers
 */
class SiteMapController extends Controller
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
                'roles' => ['bcSiteMapIndex']
            ]
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get']
            ]
        ];

        return $behaviors;
    }

    /**
     * Показывает sitemap.xml
     * @return string
     */
    public function actionIndex()
    {
        $siteMap = Sitemap::init(1);

        return $this->render('index',[
            'siteMap' => $siteMap
        ]);
    }

    /**
     * Генерирует sitemap.xml
     */
    public function actionGenerate()
    {
        Yii::$app->getCache()->delete(Sitemap::PAGES_CACHE);
        Yii::$app->getCache()->delete(Sitemap::ARTICLES_CACHE);
        Sitemap::init();

        $this->redirect('index');
    }
}