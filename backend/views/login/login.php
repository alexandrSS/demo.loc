<?php

/**
 * Sign In page view.
 *
 * @var \yii\base\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\LoginForm $model Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('backend', 'BACKEND_LOGIN_TITLE'); ?>
<div class="form-box" id="login-box">
    <div class="header"><?php echo Html::encode($this->title); ?></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="body bg-gray">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer">
        <?= Html::submitButton(Yii::t('backend', 'BACKEND_LOGIN_SUBMIT'), ['class' => 'btn bg-olive btn-block']) ?>
        <p><?= Html::a(Yii::t('backend', 'BACKEND_LOGIN_RECOVERY'), ['recovery']) ?></p>
    </div>
    <?php ActiveForm::end(); ?>
</div>