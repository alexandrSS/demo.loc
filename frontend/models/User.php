<?php

namespace frontend\models;

use Yii;

/**
 * Class User
 * @package frontend\models
 * User is the model behind the signup form.
 *
 * @property string $username Username
 * @property string $email E-mail
 * @property string $password Password
 * @property string $repassword Repeat password
 *
 * @property Profile $profile Profile
 */
class User extends \common\models\User
{
    /**
     * @var string $password Password
     */
    public $password;

    /**
     * @var string $repassword Repeat password
     */
    public $repassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['username', 'email', 'password', 'repassword'], 'required'],

            // Trim
            [['username', 'email', 'password', 'repassword'], 'trim'],

            // String
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],

            // Unique
            [['username', 'email'], 'unique'],

            // Username
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 30],

            // E-mail
            ['email', 'string', 'max' => 100],
            ['email', 'email'],

            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'signup' => ['username', 'email', 'password', 'repassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge($labels, [
            'password' => Yii::t('frontend', 'Пароль'),
            'repassword' => Yii::t('frontend', 'Повторите пароль')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setPassword($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            if ($this->profile !== null) {
                $this->profile->save(false);
            }
            if (self::REQUIRE_EMAIL_CONFIGURATION === true) {
                $this->send();
            }
        }
    }

    /**
     * Send an email confirmation token.
     *
     * @return boolean true if email was sent successfully
     */
    public function send()
    {
        return self::getMail()
                    ->compose('signup', ['model' => $this])
                    ->setTo($this->email)
                    ->setSubject(Yii::t('frontend', 'Код подтверждения новой учётной записи.') . ' ' . Yii::$app->name)
                    ->send();
    }
}
