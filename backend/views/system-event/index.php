<?php

use yii\helpers\Html;
use backend\themes\admin\widgets\GridView;

$this->title = Yii::t('backend', 'Системные события');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-event-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Очистить'), false, ['class' => 'btn btn-danger', 'data-method' => 'delete', 'data-pjax' => '1']) ?>
    </p>

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
