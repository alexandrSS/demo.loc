<?php

namespace frontend\controllers;

use frontend\components\Controller;
use frontend\models\ContactForm;
use frontend\models\Pages;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\ViewAction;
use Yii;

/**
 * Основной контроллер frontend приложенния
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends Controller
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    public function actionMap()
    {
        $this->layout = '//siteMap';
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

        //header("Content-type: text/xml");

        $this->render('index', array(
            'items'=>$items,
            'host'=>Yii::$app->request->hostInfo,
            //'tests'=>$tests,
        ));
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className()
            ],
            'about' => [
                'class' => ViewAction::className(),
                'defaultView' => 'about'
            ],
            'captcha' => [
                'class' => CaptchaAction::className(),
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0XF5F5F5,
                'height' => 34
            ]
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '//home';

        return $this->render('index');
    }

    /**
     * Страница "Контакты"
     * @return string|\yii\web\Response
     */
    public function actionContacts()
    {
        $model = new ContactForm;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash(
                'success',
                Yii::t('frontend', 'Сообщение было успешно отправлено. Спасибо!')
            );
            return $this->refresh();
        } else {
            return $this->render(
                'contacts',
                [
                    'model' => $model
                ]
            );
        }
    }
}
