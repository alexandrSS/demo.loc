<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Пользователи');
$this->params['subtitle'] = Yii::t('backend', 'Создание пользователя');
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