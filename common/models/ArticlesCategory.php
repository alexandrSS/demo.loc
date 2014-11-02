<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "articles_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $parent_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Articles[] $articles
 * @property ArticlesCategory $parent
 * @property ArticlesCategory[] $articlesCategories
 */
class ArticlesCategory extends ActiveRecord
{
    const CACHE_MENU_ARTICLE_CATEGORY = 'CACHE_MENU_ARTICLE_CATEGORY';
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
    public static function tableName()
    {
        return 'articles_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['parent_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 100]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticlesCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticlesCategories()
    {
        return $this->hasMany(ArticlesCategory::className(), ['parent_id' => 'id']);
    }

    public function afterSave()
    {
        Yii::$app->getCache()->delete(self::CACHE_MENU_ARTICLE_CATEGORY);
    }

    public function afterDelete()
    {
        Yii::$app->getCache()->delete(self::CACHE_MENU_ARTICLE_CATEGORY);
    }
}
