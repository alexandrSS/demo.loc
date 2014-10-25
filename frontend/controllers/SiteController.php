<?php

namespace frontend\controllers;

use frontend\components\Controller;
use frontend\models\ContactForm;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\ViewAction;
use Yii;

/**
 * Frontend main controller.
 */
class SiteController extends Controller
{
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
     * Site "Home" page.
     */
    public function actionIndex()
    {
        $this->layout = '//home';

        return $this->render('index');
    }

    /**
     * Site "Contact" page.
     */
    public function actionContacts()
    {
        $model = new ContactForm;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash(
                'success',
                Yii::t('frontend', 'CONTACTS_FLASH_SUCCESS_MSG')
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
