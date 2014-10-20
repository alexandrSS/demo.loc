<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'content', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 100]
        ];
    }
}
