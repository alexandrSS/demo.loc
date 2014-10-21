<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widget\imperavi\Widget as Imperavi;
use yii\helpers\Url;
use yii\jui\DatePicker;

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
    <div class="col-sm-6">
        <?= $form->field($model, 'createdAtJui')->widget(
            DatePicker::className(),
            [
                'options' => [
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'dateFormat' => 'dd.mm.yy',
                    'changeMonth' => true,
                    'changeYear' => true
                ]
            ]
        ); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'updatedAtJui')->widget(
            DatePicker::className(),
            [
                'options' => [
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'dateFormat' => 'dd.mm.yy',
                    'changeMonth' => true,
                    'changeYear' => true
                ]
            ]
        ); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'content')->widget(
            Imperavi::className(),
            [
                'settings' => [
                    'minHeight' => 300,
                    'imageGetJson' => Url::to(['/articles/default/imperavi-get']),
                    'imageUpload' => Url::to(['/articles/default/imperavi-image-upload']),
                    'fileUpload' => Url::to(['/articles/default/imperavi-file-upload'])
                ]
            ]
        ) ?>
    </div>
</div>

<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $model->isNewRecord ? Yii::t('backend', 'Сохранить') : Yii::t('articles','Обновить'),
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>
