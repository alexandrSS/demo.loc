<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'FRONTEND_LOGIN_TITLE');
$this->params['breadcrumbs'] = [
    $this->title
]; ?>
<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'center'
        ]
    ]
); ?>
    <fieldset class="registration-form">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <?= Html::submitButton(Yii::t('frontend', 'FRONTEND_LOGIN_SUBMIT'), ['class' => 'btn btn-primary']) ?>
        &nbsp;
        <?= Yii::t('frontend', 'FRONTEND_LOGIN_OR') ?>
        &nbsp;
        <?= Html::a(Yii::t('frontend', 'FRONTEND_LOGIN_RECOVERY'), ['recovery']) ?>
    </fieldset>
<?php ActiveForm::end(); ?>