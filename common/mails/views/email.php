<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/guest/email', 'token' => $model['token']], true); ?>
<p>Hello,</p>
<p>Follow the link below to confirm your new e-mail:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>