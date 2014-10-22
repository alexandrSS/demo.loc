<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Категории статей');
$this->params['subtitle'] = Yii::t('backend', 'Список котегорий');
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
                'buttonsTemplate' => '{create} {batch-delete}',
                'grid' => 'articlesCategory-grid'
            ]
        ); ?>
        <?= GridView::widget([
            'id' => 'articlesCategory-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => CheckboxColumn::classname()
                ],
                'title',
                'alias',
                [
                    'attribute' => 'parent_id',
                    'value' => function ($model) {
                        return $model->ParentList;
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'parent_id',
                        $parentList,
                        [
                            'class' => 'form-control',
                            'prompt' => Yii::t('backend', 'Выберите родителя')
                        ]
                    )
                ],
                [
                    'attribute' => 'status_id',
                    'format' => 'html',
                    'value' => function ($model) {
                            if ($model->status_id === $model::STATUS_PUBLISHED) {
                                $class = 'label-success';
                            } elseif ($model->status_id === $model::STATUS_UNPUBLISHED) {
                                $class = 'label-warning';
                            } else {
                                $class = 'label-danger';
                            }

                            return '<span class="label ' . $class . '">' . $model->status . '</span>';
                        },
                    'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status_id',
                            $statusArray,
                            ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Выберите статус')]
                        )
                ],
                // 'created_at',
                // 'updated_at',

                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}'
                ]
            ],
        ]); ?>

        <?php Box::end(); ?>
    </div>
</div>
