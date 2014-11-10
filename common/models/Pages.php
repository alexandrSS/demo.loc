<?php

namespace common\models;

use common\helpers\Sitemap;
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
    const CACHE_MENU_PAGE = 'CACHE_MENU_PAGE';
    /**
     * Unpublished status
     */
    const STATUS_UNPUBLISHED = 0;
    /**
     * Published status
     */
    const STATUS_PUBLISHED = 1;
    /**
     * Whether posts need to be moderated before publishing
     */
    const MODERATION = true;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }
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
            // Required
            [['title', 'alias'], 'required'],
            // Trim
            [['title', 'content'], 'trim'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 100],
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
            'id' => Yii::t('backend', 'Идентификатор'),
            'title' => Yii::t('backend', 'Название'),
            'alias' => Yii::t('backend', 'Адрес (URL)'),
            'content' => Yii::t('backend', 'Текст'),
            'status_id' => Yii::t('backend', 'Статус'),
            'created_at' => Yii::t('backend', 'Создана'),
            'updated_at' => Yii::t('backend', 'Обнавлена'),
        ];
    }


    public function afterSave()
    {
        Yii::$app->getCache()->delete(self::CACHE_MENU_PAGE);
        Yii::$app->getCache()->delete(Sitemap::PAGES_CACHE);
        Sitemap::init();
    }

    public function afterDelete()
    {
        Yii::$app->getCache()->delete(self::CACHE_MENU_PAGE);
        Yii::$app->getCache()->delete(Sitemap::PAGES_CACHE);
        Sitemap::init();
    }
}
