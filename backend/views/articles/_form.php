<?php

use common\widget\fileapi\Widget as FileAPI;
use backend\widget\imperavi\Widget as Imperavi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'category_id')->dropDownList($categoryList, [
                'prompt' => Yii::t('backend', 'Выберите категорию')
            ]) ?>
        </div>
    </div>
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
            <?= $form->field($model, 'preview_url')->widget(
                FileAPI::className(),
                [
                    'settings' => [
                        'url' => ['/articles/fileapi-upload']
                    ]
                ]
            ) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'image_url')->widget(
                FileAPI::className(),
                [
                    'settings' => [
                        'url' => ['/articles/fileapi-upload']
                    ]
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'snippet')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 200,
                        'imageGetJson' => Url::to(['/articles/imperavi-get']),
                        'imageUpload' => Url::to(['/articles/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/articles/imperavi-file-upload'])
                    ]
                ]
            ) ?>
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
    $model->isNewRecord ? Yii::t('backend', 'Сохранить') : Yii::t('backend','Обнавить'),
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>