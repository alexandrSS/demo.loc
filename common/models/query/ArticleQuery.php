<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\Article;

/**
 * Class ArticleQuery
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
