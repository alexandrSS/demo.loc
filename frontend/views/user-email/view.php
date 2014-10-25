<?php

use yii\helpers\Html;

$this->title = $model->profile['surname'] . ' ' . $model->profile['name'] . '[' . $model['username'] . ']';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title); ?></h1>