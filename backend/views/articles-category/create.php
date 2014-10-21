<?php

use yii\helpers\Html;
use backend\themes\admin\widgets\Box;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticlesCategory */

$this->title = Yii::t('backend', 'Категории статей');
$this->params['subtitle'] = Yii::t('backend', 'Создание категории');
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
                            'title' => Yii::t('backend', 'BACKEND_CANCEL_BTN_TITLE')
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
                'parentList' => $parentList,
                'box' => $box
            ]
        );
        Box::end(); ?>
    </div>
</div>
