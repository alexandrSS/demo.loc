<?php

namespace backend\models;

use Yii;
use common\behaviors\PurifierBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterateBehavior;

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
class Category extends \common\models\Category
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge(
            $behaviors,
            [
                'timestamp' => [
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
                'transliterateBehavior' => [
                    'class' => TransliterateBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['title' => 'alias'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['title' => 'alias'],
                    ]
                ],
                'purifierBehavior' => [
                    'class' => PurifierBehavior::className(),
                    'textAttributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['title'],
                        ActiveRecord::EVENT_BEFORE_INSERT => ['title'],
                    ],
                    'purifierOptions' => [
                        'HTML.AllowedElements' => Yii::$app->params['allowHtmlTags'],
                        'AutoFormat.RemoveEmpty' => true
                    ]
                ],
                'sluggableBehavior' => [
                    'class' => SluggableBehavior::className(),
                    'attribute' => 'title',
                    'slugAttribute' => 'alias'
                ],
            ]
        );
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();

        return $attributeLabels;
    }
}
