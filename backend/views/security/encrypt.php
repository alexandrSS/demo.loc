<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SecurityForm */
/* @var $form ActiveForm */
?>
<div class="security-encrypt">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'key') ?>
        <?= $form->field($model, 'text')->Textarea() ?>
        <?= $form->field($model, 'file')->fileInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зашифровать', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <pre>
    <?php

        if(isset($href)){
            echo $href;
        }

        print_r($model->file);
    ?>
    </pre>
</div>
