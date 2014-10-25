<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'FRONTEND_RECOVERY_CONFIRMATION_TITLE');
$this->params['breadcrumbs'] = [
    $this->title
];
$this->params['contentId'] = 'error'; ?>
<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'center'
        ]
    ]
); ?>
    <fieldset class="registration-form">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'repassword')->passwordInput(['placeholder' => $model->getAttributeLabel('repassword')])->label(false) ?>
        <?= $form->field($model, 'token', ['template' => "{input}\n{error}"])->hiddenInput() ?>
        <?= Html::submitButton(
            Yii::t('frontend', 'FRONTEND_RECOVERY_CONFIRMATION_SUBMIT'),
            [
                'class' => 'btn btn-success pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>