<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package vova07\users\models\backend
 * User administrator model.
 *
 * @property string|null $password Password
 * @property string|null $repassword Repeat password
 *
 * @property Profile $profile Profile
 */
class User extends \common\models\User
{
    /**
     * @var string|null Password
     */
    public $password;
    /**
     * @var string|null Repeat password
     */
    public $repassword;
    /**
     * @var string Model status.
     */
    private $_status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['username', 'email'], 'required'],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            // Trim
            [['username', 'email', 'password', 'repassword', 'name', 'surname'], 'trim'],
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
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            // Role
            ['role', 'in', 'range' => array_keys(self::getRoleArray())],
            // Status
            ['status_id', 'in', 'range' => array_keys(self::getStatusArray())]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => ['username', 'email', 'password', 'repassword', 'status_id', 'role'],
            'admin-update' => ['username', 'email', 'password', 'repassword', 'status_id', 'role']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return
            [
                'username' => Yii::t('backend', 'Логин'),
                'email' => Yii::t('backend', 'Почта'),
                'role' => Yii::t('backend', 'Роль'),
                'status_id' => Yii::t('backend', 'Статус'),
                'created_at' => Yii::t('backend', 'Создан'),
                'updated_at' => Yii::t('backend', 'Обновлен'),
                'password' => Yii::t('backend', 'Пароль'),
                'repassword' => Yii::t('backend', 'Повторите пароль'),
            ];
    }

    /**
     * @return string Model status.
     */
    public function getStatus()
    {
        if ($this->_status === null) {
            $statuses = self::getStatusArray();
            $this->_status = $statuses[$this->status_id];
        }
        return $this->_status;
    }

    /**
     * @return array Status array.
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('backend', 'Активный'),
            self::STATUS_INACTIVE => Yii::t('backend', 'Не активный'),
            self::STATUS_BANNED => Yii::t('backend', 'Забаненый')
        ];
    }


    /**
     * @return array Role array.
     */
    public static function getRoleArray()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }


    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generateToken();
                SystemEvent::log(
                    'users',
                    self::EVENT_AFTER_SIGNUP,
                    ['username' => $this->username, 'email' => $this->email, 'created_at' => $this->created_at]
                );
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

        if ($this->profile !== null) {
            $this->profile->save(false);
        }
    }
}
