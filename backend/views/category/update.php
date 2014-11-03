<?php

use backend\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = Yii::t('backend', 'Категории');
$this->params['subtitle'] = Yii::t('backend', 'Обновление категории');
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
                    'class' => 'box-success'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{cancel} {create} {delete}'
            ]
        );
    echo $this->render('_form', [
        'model' => $model,
        'box' => $box
    ]);

        Box::end(); ?>
    </div>
</div>
