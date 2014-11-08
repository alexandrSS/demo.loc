<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Системный журнал');
$this->params['subtitle'] = Yii::t('backend', 'Просмотр ошибок и предупреждений');
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
];
?>
<div class="row">
    <div class="col-sm-12">
        <?php $box = Box::begin(
            [
                'title' => $this->params['subtitle'],
                'renderBody' => false,
                'options' => [
                    'class' => 'box-success'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{cancel} {delete}'
            ]
        );?>

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

        <?php Box::end(); ?>
    </div>
</div>
