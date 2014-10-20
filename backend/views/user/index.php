<?php

/**
 * Users list view.
 *
 * @var \yii\base\View $this View
 * @var \yii\data\ActiveDataProvider $dataProvider Data provider
 * @var \vova07\users\models\backend\UserSearch $searchModel Search model
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 */

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = Yii::t('backend', 'BACKEND_INDEX_TITLE');
$this->params['subtitle'] = Yii::t('backend', 'BACKEND_INDEX_SUBTITLE');
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
                'buttonsTemplate' => '{create} {batch-delete}',
                'grid' => 'users-grid'
            ]
        ); ?>
        <?= GridView::widget(
            [
                'id' => 'users-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => CheckboxColumn::classname()
                    ],
                    'id',
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
                            ['class' => 'form-control', 'prompt' => Yii::t('backend', 'BACKEND_PROMPT_STATUS')]
                        )
                    ],
                    [
                        'attribute' => 'role',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'role',
                            $roleArray,
                            ['class' => 'form-control', 'prompt' => Yii::t('backend', 'BACKEND_PROMPT_ROLE')]
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