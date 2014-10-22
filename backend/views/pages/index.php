<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;

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
                'grid' => 'pages-grid'
            ]
        ); ?>

        <?= GridView::widget([
            'id' => 'pages-grid',
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
                'created_at',
                'updated_at',

                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}'
                ]
            ],
        ]); ?>

    </div>
</div>
