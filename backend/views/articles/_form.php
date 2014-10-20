<?php

/**
 * Article form view.
 *
 * @var \yii\base\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\articles\models\backend\Article $model Model
 * @var array $statusArray Statuses array
 * @var \backend\themes\admin\widgets\Box $box Box widget instance
 */

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
        <div class="col-sm-6">
            <?= $form->field($model, 'preview_url')->widget(
                FileAPI::className(),
                [
                    'settings' => [
                        'url' => ['/articles/default/fileapi-upload']
                    ]
                ]
            ) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'image_url')->widget(
                FileAPI::className(),
                [
                    'settings' => [
                        'url' => ['/articles/default/fileapi-upload']
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
                        'imageGetJson' => Url::to(['/articles/default/imperavi-get']),
                        'imageUpload' => Url::to(['/articles/default/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/articles/default/imperavi-file-upload'])
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
    $model->isNewRecord ? Yii::t('backend', 'BACKEND_CREATE_SUBMIT') : Yii::t(
        'articles',
        'BACKEND_UPDATE_SUBMIT'
    ),
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>