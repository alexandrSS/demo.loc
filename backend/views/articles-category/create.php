<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Категории статей');
$this->params['subtitle'] = Yii::t('backend', 'Создание категории');
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
];

$buttonsTemplate[]='{cancel}';

$buttonsTemplate = !empty($buttonsTemplate) ? implode(' ', $buttonsTemplate) : null;

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
                'buttonsTemplate' => $buttonsTemplate
            ]
        );
        echo $this->render(
            '_form',
            [
                'model' => $model,
                'statusArray' => $statusArray,
                'categoryList' => $categoryList,
                'box' => $box
            ]
        );
        Box::end(); ?>
    </div>
</div>
