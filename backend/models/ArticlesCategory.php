<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\query\ArticlesCategoryQuery;

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
class ArticlesCategory extends \common\models\ArticlesCategory
{
    /**
     * Ключи кэша которые использует модель.
     */
    const CACHE_ARTICLE_CATEGORY_LIST_DATA = 'articleCategoriesListData';
    /**
     * @var string Jui created date
     */
    private $_createdAtJui;

    /**
     * @var string Jui updated date
     */
    private $_updatedAtJui;

    /**
     * @return string Jui created date
     */
    public function getCreatedAtJui()
    {
        if (!$this->isNewRecord && $this->_createdAtJui === null) {
            $this->_createdAtJui = Yii::$app->formatter->asDate($this->created_at, 'Y-m-d');
        }
        return $this->_createdAtJui;
    }

    /**
     * Set jui created date
     */
    public function setCreatedAtJui($value)
    {
        $this->_createdAtJui = $value;
    }

    /**
     * @return string Jui updated date
     */
    public function getUpdatedAtJui()
    {
        if (!$this->isNewRecord && $this->_updatedAtJui === null) {
            $this->_updatedAtJui = Yii::$app->formatter->asDate($this->updated_at, 'Y-m-d');
        }
        return $this->_updatedAtJui;
    }

    /**
     * Set jui created date
     */
    public function setUpdatedAtJui($value)
    {
        $this->_updatedAtJui = $value;
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
            self::STATUS_UNPUBLISHED => Yii::t('backend', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Yii::t('backend', 'STATUS_PUBLISHED')
        ];
    }
    /**
     * @return array [[DropDownList]] массив категорий.
     */
    public static function getCategoryArray()
    {
        $key = self::CACHE_CATEGORIES_LIST_DATA;
        $value = Yii::$app->getCache()->get($key);
        if ($value === false || empty($value)) {
            $value = self::find()->select(['id', 'title'])->published()->asArray()->all();
            $value = ArrayHelper::map($value, 'id', 'title');
            Yii::$app->cache->set($key, $value);
        }
        return $value;
    }

    public static function getParentListArray($parent_id = null, $level = 0)
    {
        if (empty($parent_id)) {
            $parent_id = null;
        }

        $categories = self::find()->where(['parent_id' => $parent_id])->all();

        $list = array();

        foreach ($categories as $category) {

            $category->title = str_repeat(' - ', $level) . $category->title;

            $list[$category->id] = $category->title;

            $list = ArrayHelper::merge($list, self::getParentListArray($category->id, $level + 1));
        }

        return $list;
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
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'alias' => Yii::t('backend', 'Alias'),
            'parent_id' => Yii::t('backend', 'Parent ID'),
            'status_id' => Yii::t('backend', 'Status ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
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
            'parent_id',
            'status_id',
            'createdAtJui',
            'updatedAtJui'
        ];
        $scenarios['admin-update'] = [
            'title',
            'alias',
            'parent_id',
            'status_id',
            'createdAtJui',
            'updatedAtJui'
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            Yii::$app->getCache()->delete(self::CACHE_ARTICLE_CATEGORY_LIST_DATA);
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete($insert)
    {
        if(parent::beforeDelete($insert)) {
            Yii::$app->getCache()->delete(self::CACHE_ARTICLE_CATEGORY_LIST_DATA);
            return true;
        }
        return false;
    }
}
