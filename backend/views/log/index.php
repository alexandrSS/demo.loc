<?php

use yii\helpers\Html;
use backend\themes\admin\widgets\GridView;

$this->title = Yii::t('backend', 'Системный журнал');
$this->params['subtitle'] = Yii::t('backend', 'Все события');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-log-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Очистить'), false, ['class' => 'btn btn-danger', 'data-method' => 'delete', 'data-pjax' => '1']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'level',
                'value' => function ($model) {
                    return \yii\log\Logger::getLevelName($model->level);
                }
            ],
            'category',
            'prefix',
            'log_time:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}'
            ],
        ],
    ]); ?>

</div>
