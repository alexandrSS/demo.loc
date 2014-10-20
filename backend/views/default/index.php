<?php

/**
 * Backend main page view.
 *
 * @var yii\base\View $this View
 */

use yii\helpers\Html;

$this->title = Yii::t('backend', 'INDEX_TITLE');
$this->params['subtitle'] = Yii::t('backend', 'INDEX_SUBTITLE'); ?>
<div class="jumbotron text-center">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p><?= Yii::t('backend', 'INDEX_JUMBOTRON_MSG') ?></p>
</div>