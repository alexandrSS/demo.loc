<?php

namespace backend\models\search;

use yii\data\ActiveDataProvider;
use backend\models\Articles;

/**
 * Поиск для модели Articles
 * Class ArticlesSearch
 * @package backend\models\search
 */
class ArticlesSearch extends Articles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Integer
            ['id', 'integer'],
            // String
            [['snippet', 'content'], 'string'],
            [['title', 'alias'], 'string', 'max' => 255],
            // Status
            ['status_id', 'in', 'range' => array_keys(self::getStatusArray())],
            // Date
            [['created_at', 'updated_at'], 'date', 'format' => 'd.m.Y']
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params Search params
     *
     * @return ActiveDataProvider DataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'category_id' => $this->category_id,
                'status_id' => $this->status_id,
                'FROM_UNIXTIME(created_at, "%d.%m.%Y")' => $this->created_at,
                'FROM_UNIXTIME(updated_at, "%d.%m.%Y")' => $this->updated_at
            ]
        );

        $query->andFilterWhere(['like', 'alias', $this->alias]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'snippet', $this->snippet]);
        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
