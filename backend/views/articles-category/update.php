<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Категории статей');
$this->params['subtitle'] = Yii::t('backend', 'Обновление категории');
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
];

$buttonsTemplate[]='{cancel}';

if(Yii::$app->user->can('bcArticleCategoryCreate')){
    $buttonsTemplate[]='{create}';
}

if(Yii::$app->user->can('bcArticleCategoryDelete')){
    $buttonsTemplate[]='{delete}';
}

$buttonsTemplate = !empty($buttonsTemplate) ? implode(' ', $buttonsTemplate) : null;

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
