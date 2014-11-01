<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\Articles;

/**
 * Class ArticleQuery
 */
class ArticlesQuery extends ActiveQuery
{
    /**
     * Select published posts.
     *
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status_id' => Articles::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     * Select unpublished posts.
     *
     * @return $this
     */
    public function unpublished()
    {
        $this->andWhere(['status_id' => Articles::STATUS_UNPUBLISHED]);

        return $this;
    }


    public function category($category)
    {
        $this->andWhere(['category_id' => $category]);

        return $this;
    }
}
