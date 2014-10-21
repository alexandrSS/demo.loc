<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticlesCategory */
/* @var $form yii\widgets\ActiveForm */
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
        <?= $form->field($model, 'parent_id')->dropDownList($parentList, [
            'prompt' => Yii::t('backend', 'Выберите категорию')
        ]) ?>
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

<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $model->isNewRecord ? Yii::t('backend', 'BACKEND_CREATE_SUBMIT') : Yii::t(
        'backend',
        'BACKEND_UPDATE_SUBMIT'
    ),
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>
