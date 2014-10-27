<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterateBehavior;
use common\behaviors\PurifierBehavior;

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
     * @var Читабельный статус категории
     */
    protected $_categoryList;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
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
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['title'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['title'],
                ],
                'purifierOptions' => [
                    'HTML.AllowedElements' => Yii::$app->params['allowHtmlTags']
                ]
            ]
        ];
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
        $rules[] = ['status_id', 'in', 'range' => array_keys(self::getStatusArray())];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('backend', 'Категория'),
            'title' => Yii::t('backend', 'Название'),
            'alias' => Yii::t('backend', 'Адрес (URL)'),
            'snippet' => Yii::t('backend', 'Фрагмент'),
            'content' => Yii::t('backend', 'Содержание'),
            'views' => Yii::t('backend', 'Вид'),
            'status_id' => Yii::t('backend', 'Статус'),
            'created_at' => Yii::t('backend', 'Создана'),
            'updated_at' => Yii::t('backend', 'Обнавлена'),
            'preview_url' => Yii::t('backend', 'Предваретельное изображение'),
            'image_url' => Yii::t('backend', 'Основное изображение'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'alias',
            'category_id',
            'snippet',
            'content',
            'status_id',
            'preview_url',
            'image_url',
        ];
        $scenarios['admin-update'] = [
            'title',
            'alias',
            'category_id',
            'snippet',
            'content',
            'status_id',
            'preview_url',
            'image_url',
        ];

        return $scenarios;
    }
}
