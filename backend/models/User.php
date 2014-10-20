<?php

namespace backend\models;

use backend\modules\system\models\SystemEvent;
use yii\helpers\ArrayHelper;
use Yii;

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
class User extends \common\modules\users\models\User
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

    const EVENT_AFTER_SIGNUP = 'afterSignup';

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
            self::STATUS_ACTIVE => Yii::t('backend', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('backend', 'STATUS_INACTIVE'),
            self::STATUS_BANNED => Yii::t('backend', 'STATUS_BANNED')
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
                'username' => Yii::t('backend', 'ATTR_USERNAME'),
                'email' => Yii::t('backend', 'ATTR_EMAIL'),
                'role' => Yii::t('backend', 'ATTR_ROLE'),
                'status_id' => Yii::t('backend', 'ATTR_STATUS'),
                'created_at' => Yii::t('backend', 'ATTR_CREATED'),
                'updated_at' => Yii::t('backend', 'ATTR_UPDATED'),
                'password' => Yii::t('backend', 'ATTR_PASSWORD'),
                'repassword' => Yii::t('backend', 'ATTR_REPASSWORD')
            ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generateToken();
                SystemEvent::log('users', self::EVENT_AFTER_SIGNUP, [
                    'username' => $this->username,
                    'email' => $this->email,
                    'created_at' => $this->created_at
                ]);
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
