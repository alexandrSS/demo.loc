<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/guest/activation', 'token' => $model['token']], true); ?>
<p>Hello <?= Html::encode($model['username']) ?>,</p>
<p>Follow the link below to activate your account:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>