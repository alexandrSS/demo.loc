<?php

namespace backend\models\query;

use backend\models\SystemEvent;
use yii\db\ActiveQuery;

/**
 * Класс кастомных запросов модели [[SystemEvent]]
 * Class SystemEventQuery
 * @package backend\models\query
 */
class SystemEventQuery extends ActiveQuery
{
    /**
     * Сегодняшние события
     * @return $this
     */
    public function today()
    {
        $this->andWhere(SystemEvent::tableName() . '.event_time > :midnight', [':midnight' => strtotime('today midnight')]);
        return $this;
    }
} 