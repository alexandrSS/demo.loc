<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $model_id
 * @property integer $author_id
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property Comments $parent
 * @property Comments[] $comments
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'model_id', 'author_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['model_id', 'author_id', 'content', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ИД'),
            'parent_id' => Yii::t('common', 'Родитель'),
            'model_id' => Yii::t('common', 'Модель'),
            'author_id' => Yii::t('common', 'Автор'),
            'content' => Yii::t('common', 'Содержание'),
            'status_id' => Yii::t('common', 'Статус'),
            'created_at' => Yii::t('common', 'Создан'),
            'updated_at' => Yii::t('common', 'Обновлен'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comments::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['parent_id' => 'id']);
    }
}
