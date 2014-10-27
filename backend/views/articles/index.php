<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = Yii::t('backend', 'Статьи');
$this->params['subtitle'] = Yii::t('backend', 'Список статей');
$this->params['breadcrumbs'] = [
    $this->title
]; ?>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{create}',
                'grid' => 'articles-grid'
            ]
        ); ?>
        <?= GridView::widget(
            [
                'id' => 'articles-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //['class' => CheckboxColumn::classname()],
                    [
                        'attribute' => 'title',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                $model['title'],
                                ['update', 'id' => $model['id']]
                            );
                        }
                    ],
                    [
                        'attribute' => 'category_id',
                        'format' => 'html',
                        'value' => function ($model) {
                                if($model->category_id !== NULL)
                                {
                                    return Html::a($model->category['title'], ['/article-category/view', 'id' => $model->category['id']]);
                                }else{
                                    return NULL;
                                }
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'category_id',
                                $categoryList,
                                [
                                    'class' => 'form-control',
                                    'prompt' => Yii::t('backend', 'Выберите категорию')
                                ]
                            )
                    ],
                    [
                        'attribute' => 'status_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            $class = ($model->status_id === $model::STATUS_PUBLISHED) ? 'label-success' : 'label-danger';

                            return '<span class="label ' . $class . '">' . $model->status . '</span>';
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status_id',
                            $statusArray,
                            [
                                'class' => 'form-control',
                                'prompt' => Yii::t('backend', 'Выберите статус')
                            ]
                        )
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'date',
                        'filter' => DatePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'created_at',
                                'options' => [
                                    'class' => 'form-control'
                                ],
                                'clientOptions' => [
                                    'dateFormat' => 'dd.mm.yy',
                                ]
                            ]
                        )
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'date',
                        'filter' => DatePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'updated_at',
                                'options' => [
                                    'class' => 'form-control'
                                ],
                                'clientOptions' => [
                                    'dateFormat' => 'dd.mm.yy',
                                ]
                            ]
                        )
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}'
                    ]
                ]
            ]
        ); ?>
        <?php Box::end(); ?>
    </div>
</div>