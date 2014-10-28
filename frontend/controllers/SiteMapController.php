<?php

namespace frontend\controllers;

use frontend\components\Controller;
use frontend\models\Pages;
use Yii;

class SiteMapController extends Controller
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    public function actionIndex()
    {


        $items = array();

        //Category
//        $items = array_merge($items, array(array(
//            'models' => Category::model()->published()->findAll(),
//            'changefreq' => self::DAILY,
//            'priority' => 0.5,
//        )));
        //Page
//        $items = array_merge($items, array(array(
//            'models' => Page::model()->published()->findAll(),
//            'changefreq' => self::DAILY,
//            'priority' => 0.8,
//        )));

        $tests = [
            [
                'url' => '/',
                'date' => '2014-03-03',
                'changefreq' => self::HOURLY,
                'priority' => 1,
            ],
            [
                'url' => '/map',
                'date' => '2014-01-20',
                'changefreq' => self::WEEKLY,
                'priority' => 0.5,
            ],
            [
                'url' => '/letter',
                'date' => '2014-01-20',
                'changefreq' => self::DAILY,
                'priority' => 0.5,
            ],
        ];

        header('Content-type: text/xml');

        $this->renderPartial('index', array(
            //'items'=>$items,
            //'host'=>Yii::$app->request->hostInfo,
            'tests' => $tests,
        ));
    }
}