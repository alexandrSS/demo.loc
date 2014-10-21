<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('backend', 'Авторизация'); ?>
<div class="form-box" id="login-box">
    <div class="header"><?php echo Html::encode($this->title); ?></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="body bg-gray">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer">
        <?= Html::submitButton(Yii::t('backend', 'Войти'), ['class' => 'btn bg-olive btn-block']) ?>
        <p><?= Html::a(Yii::t('backend', 'Восстановить пароль'), ['recovery']) ?></p>
    </div>
    <?php ActiveForm::end(); ?>
</div>