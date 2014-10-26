<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Контроллер авторизации и деавторизации
 * Class LoginController
 * @package backend\controllers
 */
class LoginController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = '//guest';

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
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    /**
     * Авторизация пользователя
     * @return array|string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm(['scenario' => 'admin']);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->login()) {
                    return $this->goHome();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Деавторизация пользователя
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
