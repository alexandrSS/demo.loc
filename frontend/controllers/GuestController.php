<?php

namespace frontend\controllers;

use common\widget\fileapi\actions\UploadAction as FileAPIUpload;
use frontend\models\ActivationForm;
use frontend\models\RecoveryConfirmationForm;
use frontend\models\RecoveryForm;
use frontend\models\ResendForm;
use frontend\models\User;
use common\models\LoginForm;
use common\models\Profile;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Class GuestController
 * @package frontend\controllers
 */
class GuestController extends Controller
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
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    /**
     * @return array
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
     * Регистрация
     * @return array|string|Response
     */
    public function actionSignup()
    {
        $user = new User(['scenario' => 'signup']);
        $profile = new Profile();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);
                if ($user->save(false)) {
                    if (User::REQUIRE_EMAIL_CONFIGURATION === true) {
                        Yii::$app->session->setFlash(
                            'success',
                            Yii::t(
                                'frontend',
                                'Учётная запись была успешно создана. Через несколько секунд вам на почту будет отправлен код для активации аккаунта.
                                В случае если письмо не пришло в течении 15 минут,
                                вы можете заново запросить отправку ключа по данной <a href="{url}">ссылке</a>.',
                                [
                                    'url' => Url::toRoute('resend')
                                ]
                            )
                        );
                    } else {
                        Yii::$app->user->login($user);
                        Yii::$app->session->setFlash(
                            'success',
                            Yii::t('frontend', 'Учётная запись была успешно создана.')
                        );
                    }
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент регистрации возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user);
            }
        }

        return $this->render(
            'signup',
            [
                'user' => $user,
                'profile' => $profile
            ]
        );
    }

    /**
     * Повторное подтверждение почты
     * @return array|string|Response
     */
    public function actionResend()
    {
        $model = new ResendForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->resend()) {
                    Yii::$app->session->setFlash('success', Yii::t('frontend', 'На указанный электронный адрес было отправлено письмо с кодом активации новой учётной записи.'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент отправки письма возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'resend',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Страница входа
     * @return array|string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm();

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
     * Активация нового пользователя
     * @param $token
     * @return Response
     */
    public function actionActivation($token)
    {
        $model = new ActivationForm(['token' => $token]);

        if ($model->validate() && $model->activation()) {
            Yii::$app->session->setFlash('success', Yii::t('frontend', 'Ваша учётная запись была успешно активирована.'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('frontend', 'Неверный код активации или возмоможно аккаунт был уже ранее активирован.'));
        }

        return $this->goHome();
    }

    /**
     * Восстановление пароля
     * @return array|string|Response
     */
    public function actionRecovery()
    {
        $model = new RecoveryForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->recovery()) {
                    Yii::$app->session->setFlash('success', Yii::t('frontend', 'На указанный вами электронный адрес было отправлено письмо с кодом восстановления пароля.'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('frontend', 'В момент отправки письма возникла ошибка. Попробуйте ещё раз пожалуйста!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'recovery',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Подтверждение пароля после восстановления
     * @param $token
     * @return array|string|Response
     */
    public function actionRecoveryConfirmation($token)
    {
        $model = new RecoveryConfirmationForm(['token' => $token]);

        if (!$model->isValidToken()) {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('frontend', 'Неверный код подтверждения.')
            );
            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->recovery()) {
                    Yii::$app->session->setFlash(
                        'success',
                        Yii::t('frontend', 'Пароль был успешно восстановлен.')
                    );
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash(
                        'danger',
                        Yii::t('frontend', 'В момент подтверждения нового пароля возникла ошибка. Попробуйте ещё раз пожалуйста!')
                    );
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'recovery-confirmation',
            [
                'model' => $model
            ]
        );

    }
}
