<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Мет. и ср. защиты комп. информации');
$this->params['subtitle'] = Yii::t('backend', 'Контрольная работа');
$this->params['breadcrumbs'] = [
    $this->title
];
?>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'articles-grid'
            ]
        ); ?>



        <?php Box::end(); ?>
    </div>
</div>