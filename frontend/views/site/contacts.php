<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Контакты');
$this->params['breadcrumbs'] = [
    $this->title
]; ?>
<div class="row">
    <div class="col-sm-7">
        <p><?= Yii::t('frontend', 'Если у вас есть вопросы или пожелания, вы можете написать нам сообщение. Спасибо!') ?></p>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
        <?=
        $form->field($model, 'verifyCode')->widget(
            Captcha::className(),
            [
                'captchaAction' => '/site/captcha',
                'options' => ['class' => 'form-control'],
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
            ]
        ) ?>
        <?= Html::submitButton(Yii::t('frontend', 'Отправить'), ['class' => 'btn btn-primary btn-lg']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>