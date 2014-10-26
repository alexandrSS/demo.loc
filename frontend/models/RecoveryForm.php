<?php

namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * Class RecoveryForm
 * @package frontend\models
 * RecoveryForm is the model behind the recovery form.
 *
 * @property string $email E-mail
 */
class RecoveryForm extends Model
{
    /**
     * @var string $email E-mail
     */
    public $email;

    /**
     * @var User instance
     */
    private $_model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // E-mail
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'string', 'max' => 100],
            [
                'email',
                'exist',
                'targetClass' => User::className(),
                'filter' => function ($query) {
                        $query->active();
                    }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('frontend', 'E-mail')
        ];
    }

    /**
     * Send a recovery password token.
     *
     * @return boolean true if recovery token was successfully sent
     */
    public function recovery()
    {
        $this->_model = User::findByEmail($this->email, 'active');
        if ($this->_model !== null) {
            return $this->send();
        }
        return false;
    }

    /**
     * Send an email confirmation token.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
        return $this->module->mail
            ->compose('recovery', ['model' => $this->_model])
            ->setTo($this->email)
            ->setSubject(Yii::t('frontend', 'Код восстановления пароля.') . ' ' . Yii::$app->name)
            ->send();
    }
}
