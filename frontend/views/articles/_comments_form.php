<?php

use yii\helpers\Html;

?>
<?= Html::beginForm(['/comments/create'], 'POST', ['class' => 'form-horizontal', 'data-comment' => 'form', 'data-comment-action' => 'create']) ?>
    <div class="form-group" data-comment="form-group">
        <div class="col-sm-12">
            <?= Html::activeTextarea($modelComment, 'content', ['class' => 'form-control']) ?>
            <?= Html::error($modelComment, 'content', ['data-comment' => 'form-summary', 'class' => 'help-block hidden']) ?>
        </div>
    </div>
<?= Html::submitButton(Yii::t('frontend', 'Опубликовать комментарий'), ['class' => 'btn btn-danger btn-lg']); ?>
<?= Html::endForm(); ?>