<?php

namespace common\modules\category\models;

use yii\db\ActiveQuery;
use common\behaviors\NestedSetQuery;

/**
 * Class ArticleQuery
 * @package vova07\blog\models
 */
class CategoryQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'nestedSet' => [
                'class' => NestedSetQuery::className (),
                'hasManyRoots' => TRUE
            ]
        ];
    }
    /**
     * Select published posts.
     *
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status_id' => Category::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     * Select unpublished posts.
     *
     * @return $this
     */
    public function unpublished()
    {
        $this->andWhere(['status_id' => Category::STATUS_UNPUBLISHED]);

        return $this;
    }
}
