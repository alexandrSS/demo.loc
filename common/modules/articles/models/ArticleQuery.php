<?php

namespace common\modules\articles\models;

use yii\db\ActiveQuery;

/**
 * Class ArticleQuery
 * @package vova07\blog\models
 */
class ArticleQuery extends ActiveQuery
{
    /**
     * Select published posts.
     *
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status_id' => Article::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     * Select unpublished posts.
     *
     * @return $this
     */
    public function unpublished()
    {
        $this->andWhere(['status_id' => Article::STATUS_UNPUBLISHED]);

        return $this;
    }
}
