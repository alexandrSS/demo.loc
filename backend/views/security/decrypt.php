<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SecurityForm */
/* @var $form ActiveForm */
?>
<div class="security-encrypt">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'file')->fileInput() ?>
        <?= $form->field($model, 'key') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Дешифровать', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?= $model->file !== null ? Html::a('Скачать файл - "' . $model->file->baseName . '.decrypt.' . $model->file->extension . '"',
    ['download', 'file' => 'C:/wamp/www/demo.loc/statics/web/' . $model->file->baseName . '.decrypt.' . $model->file->extension],
    ['class' => 'btn btn-primary']
) : null
?>
