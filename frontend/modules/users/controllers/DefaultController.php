<?php

namespace frontend\modules\users\controllers;

use frontend\modules\users\models\Email;
use frontend\modules\users\Module;
use yii\web\Controller;
use Yii;

/**
 * Default frontend controller.
 */
class DefaultController extends Controller
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
                Yii::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION_WITH_INVALID_KEY')
            );
        } else {
            if ($model->confirm()) {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('users', 'FRONTEND_FLASH_SUCCESS_NEW_EMAIL_CONFIRMATION')
                );
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    Yii::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION')
                );
            }
        }

        return $this->goHome();
    }
}
