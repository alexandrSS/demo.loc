<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'title') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'alias') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'status_id')->dropDownList($statusArray) ?>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'content')->widget(
            Imperavi::className(),
            [
                'settings' => [
                    'minHeight' => 300,
                    'imageGetJson' => Url::to(['/articles/imperavi-get']),
                    'imageUpload' => Url::to(['/articles/imperavi-image-upload']),
                    'fileUpload' => Url::to(['/articles/imperavi-file-upload'])
                ]
            ]
        ) ?>
    </div>
</div>

<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $model->isNewRecord ? Yii::t('backend', 'Сохранить') : Yii::t('backend','Обновить'),
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>
