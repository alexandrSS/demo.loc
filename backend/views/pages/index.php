<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;

$this->title = Yii::t('backend', 'Страницы');
$this->params['subtitle'] = Yii::t('backend', 'Список страниц');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">

        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{create} {batch-delete}',
                'grid' => 'articles-grid'
            ]
        ); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => CheckboxColumn::classname()
                ],
                'title',
                'alias',
                'content:ntext',
                'status_id',
                // 'created_at',
                // 'updated_at',

                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}'
                ]
            ],
        ]); ?>

    </div>
</div>
