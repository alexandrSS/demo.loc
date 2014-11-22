<?php

namespace backend\models;

use Yii;
use common\behaviors\PurifierBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterateBehavior;

/**
 * Class Article
 * @package backend\models
 * Article model.
 *
 * @property integer $id ID
 * @property string $title Title
 * @property string $alias Alias
 * @property string $snippet Intro text
 * @property string $content Content
 * @property integer $views Views
 * @property integer $status_id Status
 * @property integer $created_at Created time
 * @property integer $updated_at Updated time
 */
class Articles extends \common\models\Articles
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
     * @return string Readable blog status
     */
    public function getStatus()
    {
        $statuses = self::getStatusArray();

        return $statuses[$this->status_id];
    }

    /**
     * @return array Status array.
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_UNPUBLISHED => Yii::t('backend', 'Скрыта'),
            self::STATUS_PUBLISHED => Yii::t('backend', 'Опубликована')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticlesCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();

        return array_merge(
            $rules,
            [
                ['status_id', 'in', 'range' => array_keys(self::getStatusArray())],
            ]
        );

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'category_id' => Yii::t('backend', 'Категория'),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return[
            'admin-create' => [
                'title',
                'alias',
                'category_id',
                'snippet',
                'content',
                'status_id',
            ],
            'admin-update' => [
                'title',
                'alias',
                'category_id',
                'snippet',
                'content',
                'status_id',
            ]
        ];
    }
}
