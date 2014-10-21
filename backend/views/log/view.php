<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Системный журнал'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
