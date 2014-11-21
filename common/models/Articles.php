<?php

namespace common\models;

use common\helpers\Sitemap;
use common\models\query\ArticlesQuery;
use common\behaviors\PurifierBehavior;
use vova07\fileapi\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * Class Articles
 * @package common\modules\articles\models
 * Articles model.
 *
 * @property integer $id ID
 * @property string $title Title
 * @property string $alias Alias
 * @property integer $category_id Articles Category
 * @property integer $author_id Author
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
    const RECORDS_PER_PAGE = 10;

    /**
     * Whether posts need to be moderated before publishing
     */
    const MODERATION = true;

    /**
     * @var string Files path
     */
    const FILE_PATH = '@statics/web/articles/files';

    /**
     * @var string Files path
     */
    const CONTENT_PATH = '@statics/web/articles/content';

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
            // Title
            ['title', 'required'],
            ['title', 'trim'],
            ['title', 'string', 'length' => [1,100]],

            // Alias
            ['alias', 'trim'],
            ['alias', 'string', 'length' => [1,100]],

            // Category_id
            ['category_id', 'required'],
            ['category_id', 'integer'],

            // Author_id
            ['author_id', 'integer'],

            // Snippet
            ['snippet', 'required'],

            // Content
            ['content', 'required'],

            // Status
            ['status_id', 'integer'],
            [
                'status_id',
                'default',
                'value' => self::MODERATION ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
            ],

            // CreatedAtJui and UpdatedAtJui
            [['createdAtJui', 'updatedAtJui'], 'date', 'format' => 'd.m.Y'],
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

    /**
     * @param bool $insert
     * @return bool|void
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                if(!$this->author_id){
                    $this->author_id = Yii::$app->getUser()->id;
                }
            }
            return true;
        }
        return false;
    }

    public function afterSave()
    {
        Yii::$app->getCache()->delete(Sitemap::ARTICLES_CACHE);
        Sitemap::init();
    }

    public function afterDelete()
    {
        Yii::$app->getCache()->delete(Sitemap::ARTICLES_CACHE);
        Sitemap::init();
    }
}
