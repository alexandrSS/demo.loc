<?php

namespace frontend\controllers;

use frontend\models\Email;
use yii\web\Controller;
use Yii;

/**
 * Default frontend controller.
 */
class UserEmailController extends Controller
{
    /**
     * Confirm new e-mail address.
     *
     * @param string $key Confirmation token
     *
     * @return mixed View
     */
    public function actionEmail($key)
    {
        $model = new Email(['token' => $key]);

        if ($model->isValidToken() === false) {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('frontend', 'Неверный код подтверждения.')
            );
        } else {
            if ($model->confirm()) {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('frontend', 'E-mail адрес был успешно обновлён!')
                );
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    Yii::t('frontend', 'В момент подтверждения нового электронного адреса возникла ошибка. Попробуйте ещё раз пожалуйста!')
                );
            }
        }

        return $this->goHome();
    }
}
