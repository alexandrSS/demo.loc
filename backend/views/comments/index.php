<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Комментарии');
$this->params['subtitle'] = Yii::t('backend', 'Список комментариев');
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
                'buttonsTemplate' => '{batch-delete}',
                'grid' => 'articles-grid'
            ]
        ); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],

                'parent_id',
                'model_id',
                'author_id',
                'content:ntext',
                'status_id',
                'created_at',
                'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Box::end(); ?>
    </div>
</div>
