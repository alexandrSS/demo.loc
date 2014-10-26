<?php

namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * Class ContactForm.
 * @package frontend\models
 * Contact form model.
 *
 * @property string $name Name
 * @property string $email E-mail
 * @property string $subject Subject
 * @property string $body Body
 * @property string $verifyCode Verify Code
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [[name]], [[email]], [[subject]] and [[body]] are required.
            [['name', 'email', 'subject', 'body'], 'required'],
            // [[email]] must be an valid e-mail.
            ['email', 'email'],
            // [[verifyCode]] must be a right captcha code.
            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('frontend', 'ФИО'),
            'email' => Yii::t('frontend', 'E-mail'),
            'subject' => Yii::t('frontend', 'Тема'),
            'body' => Yii::t('frontend', 'Сообщение'),
            'verifyCode' => Yii::t('frontend', 'Код верификации'),
        ];
    }

    /**
     * Send user's message to `Admin` e-mail address.
     *
     * @param string $email E-mail address
     *
     * @return boolean Model validation status
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mail->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
            return true;
        } else {
            return false;
        }
    }
}