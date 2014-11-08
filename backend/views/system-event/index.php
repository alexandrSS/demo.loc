<?php

use yii\helpers\Html;
use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;


$this->title = Yii::t('backend', 'Системные события');
$this->params['subtitle'] = Yii::t('backend', 'Список событий');
$this->params['breadcrumbs'] = [
    $this->title
];
?>
<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'articles-grid'
            ]
        ); ?>

        <p>
            <?= Html::a(Yii::t('backend', 'Очистить всё'), ['batch-delete'], ['class' => 'btn btn-danger']) ?>
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
                    'template' => '{view} {delete}'
                ],
            ],
        ]); ?>

        <?php Box::end(); ?>
    </div>
</div>
