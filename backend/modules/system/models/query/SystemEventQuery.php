<?php

namespace backend\modules\system\models\query;


use backend\modules\system\models\SystemEvent;
use yii\db\ActiveQuery;

class SystemEventQuery extends ActiveQuery{
    public function today(){
        $this->andWhere(SystemEvent::tableName().'.event_time > :midnight', [':midnight'=>strtotime('today midnight')]);
        return $this;
    }
} 