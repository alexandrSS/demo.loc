<?php

namespace frontend\controllers;

use common\widget\fileapi\actions\UploadAction as FileAPIUpload;
use frontend\models\Email;
use frontend\models\PasswordForm;
use common\models\Profile;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Frontend controller for authenticated users.
 */
class UserController extends Controller
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
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => User::AVATARS_TEMP_PATH
            ]
        ];
    }

    /**
     * Log Out page.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Change password page.
     */
    public function actionPassword()
    {
        $model = new PasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->password()) {
                    Yii::$app->session->setFlash(
                        'success',
                        Yii::t('frontend', 'Пароль был успешно обновлён!')
                    );
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент изменения пароля возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'password',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Request email change page.
     */
    public function actionEmail()
    {
        $model = new Email();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Yii::t('frontend', 'На указанный новый электронный адрес было отправлено письмо с кодом подтверждения.'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент изменения электронного адреса возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'email',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Profile updating page.
     */
    public function actionUpdate()
    {
        $model = Profile::findByUserId(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Yii::t('frontend', 'Профиль был успешно обновлён.'));
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент обноеления профиля возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                }
                return $this->refresh();
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'update',
            [
                'model' => $model
            ]
        );
    }
}
