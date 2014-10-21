<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterateBehavior;
use common\behaviors\PurifierBehavior;

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
     * @var Читабельный статус категории
     */
    protected $_parentList;

    /**
     * @var Читабельный статус категории
     */
    protected $_categoryStatus;

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
            self::STATUS_UNPUBLISHED => Yii::t('backend', 'Не активная'),
            self::STATUS_PUBLISHED => Yii::t('backend', 'Активная')
        ];
    }

    /**
     * @return array [[DropDownList]] массив категорий.
     */
    public static function getCategoryArray()
    {
        $key = self::CACHE_ARTICLE_CATEGORY_LIST_DATA;
        $value = Yii::$app->getCache()->get($key);
        if ($value === false || empty($value)) {
            $value = self::find()->select(['id', 'title'])->published()->asArray()->all();
            $value = ArrayHelper::map($value, 'id', 'title');
            Yii::$app->cache->set($key, $value);
        }
        return $value;
    }

    /**
     * Читабельный статус котегории
     * @return mixed
     */
    public function getParentList()
    {
        if(!empty($this->parent_id)){
            if($this->_parentList === NULL){
                $parentList = self::getParentListArray();
                $this->_parentList = $parentList[$this->parent_id];
            }
            return $this->_parentList;
        }
        return $this->_parentList = NULL;
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
            'title' => Yii::t('backend', 'Название'),
            'alias' => Yii::t('backend', 'Псевдоним'),
            'parent_id' => Yii::t('backend', 'Родитель'),
            'status_id' => Yii::t('backend', 'Статус'),
            'created_at' => Yii::t('backend', 'Создана'),
            'updated_at' => Yii::t('backend', 'Обнавлена'),
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
            'parent_id',
            'status_id'
        ];
        $scenarios['admin-update'] = [
            'title',
            'parent_id',
            'status_id'
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
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
        if (parent::beforeDelete($insert)) {
            Yii::$app->getCache()->delete(self::CACHE_ARTICLE_CATEGORY_LIST_DATA);
            return true;
        }
        return false;
    }
}
