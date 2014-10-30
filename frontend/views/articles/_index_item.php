<?php

use yii\helpers\Html;

?>

<div class="blog-content">
    <h3>
        <?= Html::a($model->title, ['/articles/'.$model->alias]) ?>
    </h3>

    <div class="entry-meta">
        <span><i class="icon-calendar"></i> <?= $model->created ?></span>
    </div>

    <?php if ($model->preview_url) : ?>
        <?= Html::a(
            Html::img(
                $model->urlAttribute('preview_url'),
                ['class' => 'img-responsive img-blog', 'width' => '100%', 'alt' => $model->title]
            ),
            ['/articles/'.$model->alias]
        ) ?>
    <?php endif; ?>

    <?= $model->snippet ?>
    <?= Html::a(
        Yii::t('frontend', 'Читать далее') . ' <i class="icon-angle-right"></i>',
        ['/articles/'.$model->alias],
        ['class' => 'btn btn-default']
    ) ?>
</div>