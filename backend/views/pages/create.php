<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Pages',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
