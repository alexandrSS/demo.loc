<?php

namespace common\models;

use common\behaviors\PurifierBehavior;
use common\widget\fileapi\behaviors\UploadBehavior;
use common\models\query\ArticlesQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Articles
 * @package common\modules\articles\models
 * Articles model.
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
class Articles extends ActiveRecord
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
     * Posts per page
     */
    const RECORDS_PER_PAGE = 20;

    /**
     * Whether posts need to be moderated before publishing
     */
    const MODERATION = true;

    /**
     * Preview path
     */
    const PREVIEW_PATH = '@statics/web/articles/previews/';

    /**
     * Image path
     */
    const IMAGE_PATH = '@statics/web/articles/images/';

    /**
     * @var string Files path
     */
    const FILE_PATH = '@statics/web/articles/files';

    /**
     * @var string Files path
     */
    const CONTENT_PATH = '@statics/web/articles/content';

    /**
     * @var string Images temporary path
     */
    const IMAGES_TEMP_PATH = '@statics/temp/articles/images/';

    /**
     * @var string Preview URL
     */
    const PREVIEW_URL = '/statics/articles/previews';

    /**
     * @var string Image URL
     */
    const IMAGE_URL = '/statics/articles/images';

    /**
     * @var string Files URL
     */
    const FILE_URL = '/statics/articles/files';

    /**
     * @var string Files URL
     */
    const CONTENT_URL = '/statics/articles/content';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new ArticlesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias'
            ],
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'preview_url' => [
                        'path' => self::PREVIEW_PATH,
                        'tempPath' => self::IMAGES_TEMP_PATH,
                        'url' => self::PREVIEW_URL
                    ],
                    'image_url' => [
                        'path' => self::IMAGE_PATH,
                        'tempPath' => self::IMAGES_TEMP_PATH,
                        'url' => self::IMAGE_URL
                    ]
                ]
            ],
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_VALIDATE => [
                        'snippet',
                        'content' => [
                            'HTML.AllowedElements' => '',
                            'AutoFormat.RemoveEmpty' => true
                        ]
                    ]
                ],
                'textAttributes' => [
                    self::EVENT_BEFORE_VALIDATE => ['title', 'alias']
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['title', 'category_id', 'content'], 'required'],
            // Trim
            [['title', 'snippet', 'content'], 'trim'],
            // CreatedAtJui and UpdatedAtJui
            [['createdAtJui', 'updatedAtJui'], 'date', 'format' => 'd.m.Y'],
            // Status
            [
                'status_id',
                'default',
                'value' => self::MODERATION ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Заголовок'),
            'alias' => Yii::t('common', 'Алиас'),
            'snippet' => Yii::t('common', 'Введение'),
            'content' => Yii::t('common', 'Контент'),
            'views' => Yii::t('common', 'Просмотры'),
            'status_id' => Yii::t('common', 'Статус'),
            'created_at' => Yii::t('common', 'Создана'),
            'updated_at' => Yii::t('common', 'Обновлёна'),
            'preview_url' => Yii::t('common', 'Мини-изображение'),
            'image_url' => Yii::t('common', 'Изображение'),
        ];
    }
}
