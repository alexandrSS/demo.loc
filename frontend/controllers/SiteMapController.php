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
        $items = [];

        //Страницы
        $items = array_merge(
            $items,
            [
                [
                    'models' => Pages::find()->where(['status_id' => Pages::STATUS_PUBLISHED])->all(),
                    'changefreq' => self::DAILY,
                    'priority' => 0.8
                ]
            ]
        );

        header("Content-type: text/xml");

        $this->renderPartial('index', array(
            'items'=>$items,
            'host'=>Yii::$app->request->hostInfo,
            //'tests'=>$tests,
        ));
    }
}