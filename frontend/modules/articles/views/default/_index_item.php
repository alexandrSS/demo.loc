<?php

/**
 * Articles list item view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\articles\models\frontend\Articles $model Model
 */

use yii\helpers\Html;

?>

<div class="blog-content">
    <h3>
        <?= Html::a($model->title, ['view', 'id' => $model->id, 'alias' => $model->alias]) ?>
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
            ['view', 'id' => $model->id, 'alias' => $model->alias]
        ) ?>
    <?php endif; ?>

    <?= $model->snippet ?>
    <?= Html::a(
        Yii::t('articles', 'FRONTEND_INDEX_READ_MORE_BTN') . ' <i class="icon-angle-right"></i>',
        ['view', 'id' => $model->id, 'alias' => $model->alias],
        ['class' => 'btn btn-default']
    ) ?>
</div>