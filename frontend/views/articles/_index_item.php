<?php

use yii\helpers\Html;

?>

<div class="blog-content">
    <h3>
        <?= Html::a($model->title, ['/articles/'.$model->alias]) ?>
    </h3>

    <div class="entry-meta">
        <span><i class="icon-calendar"></i> <?= $model->created ?></span>
        <span><i class="icon-eye-open"></i> <?= $model->views ?></span>
        <span><i class="icon-user"></i> <?= \common\models\User::getUsername($model->author_id) ?></span>
    </div>

    <?= $model->snippet ?>
    <?= Html::a(
        Yii::t('frontend', 'Читать далее') . '  <i class="icon-angle-right"></i>',
        ['/articles/'.$model->alias],
        ['class' => 'btn btn-default']
    ) ?>
</div>