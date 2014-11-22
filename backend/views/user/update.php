<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Пользователи');
$this->params['subtitle'] = Yii::t('backend', 'Обновление пользователя');
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
];

$buttonsTemplate[]='{cancel}';

if(Yii::$app->user->can('bcArticleCreate')){
    $buttonsTemplate[]='{create}';
}

if(Yii::$app->user->can('bcArticleDelete')){
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
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray,
                'box' => $box
            ]
        );
        Box::end(); ?>
    </div>
</div>