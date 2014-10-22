<?php

use yii\helpers\Html;
use backend\models\Pages;

$this->title = Yii::t('backend', 'Панель управления');
$this->params['subtitle'] = Yii::t('backend', 'Центральная страница'); ?>
<div class="jumbotron text-center">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p><?= Yii::t('backend', 'Yii2-Demo панель управления.') ?></p>
</div>
<?php
print_r(Pages::getMenuPage())
?>