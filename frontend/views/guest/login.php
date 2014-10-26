<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Авторизация');
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
        <?= Html::submitButton(Yii::t('frontend', 'Войти'), ['class' => 'btn btn-primary']) ?>
        &nbsp;
        <?= Yii::t('frontend', 'или') ?>
        &nbsp;
        <?= Html::a(Yii::t('frontend', 'Восстановить пароль'), ['recovery']) ?>
    </fieldset>
<?php ActiveForm::end(); ?>