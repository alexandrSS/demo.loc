<?php

namespace common\models;

use Yii;
use common\behaviors\NestedSetBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $title
 * @property string $alias
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * Unpublished status
     */
    const STATUS_UNPUBLISHED = 0;
    /**
     * Published status
     */
    const STATUS_PUBLISHED = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('common', 'Название'),
            'alias' => Yii::t('common', 'Адрес (URL)'),
            'status_id' => Yii::t('common', 'Статус'),
            'created_at' => Yii::t('common', 'Создана'),
            'updated_at' => Yii::t('common', 'Обнавлена'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'NestedSetBehavior' => [
                'class'=> NestedSetBehavior::className(),
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
            ],
        ];
    }
}
