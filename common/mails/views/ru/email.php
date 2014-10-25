<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/guest/email', 'token' => $model['token']], true); ?>
<p>Здравствуйте!</p>
<p>Перейдите по ссылке ниже чтобы подтвердить новый электронный адрес:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>