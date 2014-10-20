<?php

/**
 * Article create view.
 *
 * @var \yii\base\View $this View
 * @var \vova07\articles\models\backend\Article $model Model
 * @var array $statusArray Statuses array
 */

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('articles', 'BACKEND_CREATE_TITLE');
$this->params['subtitle'] = Yii::t('articles', 'BACKEND_CREATE_SUBTITLE');
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
]; ?>
<div class="row">
    <div class="col-sm-12">
        <?php $box = Box::begin(
            [
                'title' => $this->params['subtitle'],
                'renderBody' => false,
                'options' => [
                    'class' => 'box-primary'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttons' => [
                    [
                        'url' => ['index'],
                        'icon' => 'fa-reply',
                        'options' => [
                            'class' => 'btn-default',
                            'title' => Yii::t('articles', 'BACKEND_CANCEL_BTN_TITLE')
                        ]
                    ]
                ]
            ]
        );
        echo $this->render(
            '_form',
            [
                'model' => $model,
                'statusArray' => $statusArray,
                'box' => $box
            ]
        );
        Box::end(); ?>
    </div>
</div>