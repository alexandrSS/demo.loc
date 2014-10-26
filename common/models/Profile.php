<?php

namespace common\models;

use common\widget\fileapi\behaviors\UploadBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Profile
 * @package vova07\users\models
 * User profile model.
 *
 * @property integer $user_id User ID
 * @property string $name Name
 * @property string $surname Surname
 *
 * @property User $user User
 */
class Profile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'avatar_url' => [
                        'path' => User::AVATAR_PATH,
                        'tempPath' => User::AVATARS_TEMP_PATH,
                        'url' => User::AVATAR_URL
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findByUserId($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @return string User full name
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Name
            ['name', 'match', 'pattern' => '/^[a-zа-яё]+$/iu'],
            // Surname
            ['surname', 'match', 'pattern' => '/^[a-zа-яё]+(-[a-zа-яё]+)?$/iu']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'name' => Yii::t('common', 'Имя'),
//            'surname' => Yii::t('common', 'Фамилия')
        ];
    }

    /**
     * @return Profile|null Profile user
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('profile');
    }
}
