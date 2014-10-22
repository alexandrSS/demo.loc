<?php
namespace backend\models\query;

use yii\db\ActiveQuery;
use backend\models\ArticlesCategory;

/**
 * Class CategoryQuery
 * @package common\modules\blogs\models\query
 * Класс кастомных запросов модели [[Category]]
 */
class ArticlesCategoryQuery extends ActiveQuery
{
    /**
     * Выбираем только опубликованные записи.
     * @return $this
     */
    public function published()
    {
        $this->andWhere('status_id = :status_id', [':status_id' => ArticlesCategory::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     * Выбираем только неопубликованные записи.
     * @return $this
     */
    public function unpublished()
    {
        $this->andWhere('status_id = :status_id', [':status_id' => ArticlesCategory::STATUS_UNPUBLISHED]);
        return $this;
    }
}