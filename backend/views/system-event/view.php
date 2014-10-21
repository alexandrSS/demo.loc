<?php

use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Системные события'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-event-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'application',
            'category',
            'event',
            'name',
            'message',
            'event_time:datetime',
        ],
    ]) ?>

</div>
