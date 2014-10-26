<?php

namespace frontend\models;

use common\helpers\Security;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Email
 * @package frontend\models
 * Email is the model that is used to change user email address.
 *
 * @property integer $user_id User ID
 * @property string $email E-mail
 * @property string $token Confirmation token
 */
class Email extends ActiveRecord
{
	/**
	 * @var string Current e-mail address
	 */
	private $_oldemail;

	/**
	 * @var string Email model instance
	 */
	private $_model;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_email}}';
	}

	/**
	 * @return string Current e-mail address
	 */
	public function getOldemail()
	{
		if ($this->_oldemail === null) {
			$this->_oldemail = Yii::$app->user->identity->email;
		}
		return $this->_oldemail;
	}

	/**
     * Generates secure key.
     */
    public function generateToken()
    {
        $this->token = Security::generateExpiringRandomString();
    }

    /**
     * Check if token is valid.
     *
     * @return boolean true if token is valid
     */
    public function isValidToken()
    {
    	if (Security::isValidToken($this->token, $this->module->emailWithin) === true) {
    		return ($this->_model = static::findOne(['token' => $this->token])) !== null;
    	}
    	return false;
    }

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
			['email', 'compare', 'compareAttribute' => 'oldemail', 'operator' => '!=='],
			['email', 'unique', 'targetClass' => User::className()],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'email' => Yii::t('frontend', 'Новый e-mail'),
			'oldemail' => Yii::t('frontend', 'Текущий e-mail'),
		];
	}

    /**
     * @return ActiveQuery
     */
    public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            static::deleteAll(['user_id' => Yii::$app->user->identity->id]);
            $this->user_id = Yii::$app->user->identity->id;
            $this->generateToken();
            $this->send();

            return true;
        }
        return false;
    }

	/**
	 * Confirm email change.
	 *
	 * @return boolean true if email was successfully confirmed.
	 */
	public function confirm()
	{
		$model = $this->_model;
		$user = $model->user;
		$user->email = $model->email;
		return $user->save(false) && $model->delete();
	}

	/**
     * Send an email confirmation token.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
    	return $this->module->mail
    	            ->compose('email', ['model' => $this])
    	            ->setTo($this->email)
    	            ->setSubject(Yii::t('frontend', 'Код подтверждения новой электронной почты.') . ' ' . Yii::$app->name)
    	            ->send();
    }
}
