<?php

use backend\themes\admin\widgets\GridView;

$this->title = Yii::t('backend', 'Системные события');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-event-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'application',
            'category',
            'event',
            'event_time:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>

</div>
