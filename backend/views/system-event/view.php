<?php

use yii\widgets\DetailView;
use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Системные события');
$this->params['subtitle'] = Yii::t('backend', 'Просмотр события');
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
                'application',
                'category',
                'event',
                'name',
                'message',
                'event_time:datetime',
            ],
        ]);?>

        <?= Box::end(); ?>
    </div>
</div>
