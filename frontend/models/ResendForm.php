<?php

namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * Class ResendForm
 * @package frontend\models
 * ResendForm is the model behind the resend form.
 *
 * @property string $email E-mail
 */
class ResendForm extends Model
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
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            [
                'email',
                'exist',
                'targetClass' => User::className(),
                'filter' => function ($query) {
                        $query->inactive();
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
     * Resend email confirmation token
     *
     * @return boolean true if message was sent successfully
     */
    public function resend()
    {
        $this->_model = User::findByEmail($this->email, 'inactive');
        if ($this->_model !== null) {
            return $this->send();
        }
        return false;
    }

    /**
     * Resend an email confirmation token.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
        return User::getMail()
            ->compose('signup', ['model' => $this->_model])
            ->setTo($this->email)
            ->setSubject(Yii::t('frontend', 'Код подтверждения новой учётной записи.') . ' ' . Yii::$app->name)
            ->send();
    }
}
