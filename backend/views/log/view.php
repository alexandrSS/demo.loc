<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::t('backend', 'Системный журнал');
$this->params['subtitle'] = Yii::t('backend', 'Просмотр события');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Системный журнал'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="system-log-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
            'category',
            'log_time:datetime',
            'prefix:ntext',
            [
                'attribute' => 'message',
                'format' => 'raw',
                'value' => Html::tag('pre', $model->message, ['style' => 'white-space: pre-wrap'])
            ],
        ],
    ]) ?>

</div>
