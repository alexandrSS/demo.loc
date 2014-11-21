<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Comments */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Comments',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
