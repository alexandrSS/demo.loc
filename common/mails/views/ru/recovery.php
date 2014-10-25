<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/guest/recovery-confirmation', 'token' => $model['token']], true); ?>
<p>Здравствуйте <?= Html::encode($model['username']) ?>!</p>
<p>Перейдите по ссылке ниже чтобы восстановить пароль:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>