<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

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
     * Меню страниц
     * @return array
     */
    public static function getMenuArticleCategory()
    {
        $models = Yii::$app->cache->get(self::CACHE_MENU_ARTICLE_CATEGORY);
        if($models === false)
        {
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            // и сохраняем его в кэше для дальнейшего использования:
            $models = self::find()->where(['status_id' => self::STATUS_PUBLISHED])->all();
            Yii::$app->cache->set(self::CACHE_MENU_ARTICLE_CATEGORY,$models);
        }

        $array[]=[];

        foreach($models as $model)
        {
            $array[] = [
                'label' => $model->title,
                'url' => ['/category/' . $model->alias]
            ];
        }
        return $array;
    }

    public static function getCategoryListArray($parent_id = null, $level = 0)
    {
        if (empty($parent_id)) {
            $parent_id = null;
        }

        $categories = self::find()->where(['parent_id' => $parent_id])->all();

        $list = array();

        foreach ($categories as $category) {

            $category->title = str_repeat(' - ', $level) . $category->title;

            $list[$category->id] = $category->title;

            $list = ArrayHelper::merge($list, self::getCategoryListArray($category->id, $level + 1));
        }

        return $list;
    }
}
