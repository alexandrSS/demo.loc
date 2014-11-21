<?php

use backend\themes\admin\widgets\Box;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Кэш');
$this->params['subtitle'] = Yii::t('backend', 'Очистка кэша');
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

        <p>
            <?= Html::a('Delete', ['delete'], ['class' => 'btn btn-danger']) ?>
        </p>

        <?php Box::end(); ?>
    </div>
</div>