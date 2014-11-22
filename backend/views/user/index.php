<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Пользователи');
$this->params['subtitle'] = Yii::t('backend', 'Список пользователей');
$this->params['breadcrumbs'] = [
    $this->title
];

if(Yii::$app->user->can('bcArticleCreate')){
    $buttonsTemplate[]='{create}';
}

if(Yii::$app->user->can('bcArticleBatchDelete')){
    $buttonsTemplate[]='{batch-delete}';
}

$buttonsTemplate = !empty($buttonsTemplate) ? implode(' ', $buttonsTemplate) : null;

?>
<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $buttonsTemplate,
                'grid' => 'users-grid'
            ]
        ); ?>
        <?= GridView::widget(
            [
                'id' => 'users-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => SerialColumn::classname()],
                    ['class' => CheckboxColumn::classname()],
                    [
                        'attribute' => 'username',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a($model['username'], ['update', 'id' => $model['id']], ['data-pjax' => 0]);
                        }
                    ],
                    'email',
                    [
                        'attribute' => 'name',
                        'value' => 'profile.name'
                    ],
                    [
                        'attribute' => 'surname',
                        'value' => 'profile.surname'
                    ],
                    [
                        'attribute' => 'status_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            if ($model->status_id === $model::STATUS_ACTIVE) {
                                $class = 'label-success';
                            } elseif ($model->status_id === $model::STATUS_INACTIVE) {
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
                    [
                        'attribute' => 'role',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'role',
                            $roleArray,
                            ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Выберите роль')]
                        )
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'date',
/*                        'filter' => DatePicker::widget(
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
                        )*/
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'date',
/*                        'filter' => DatePicker::widget(
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
                        )*/
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