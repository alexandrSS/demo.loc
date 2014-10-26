<?php

use common\widget\fileapi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Регистрация');
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
        <?= $form->field($profile, 'name')->textInput(
            ['placeholder' => $profile->getAttributeLabel('name')]
        )->label(false) ?>
        <?= $form->field($profile, 'surname')->textInput(
            ['placeholder' => $profile->getAttributeLabel('surname')]
        )->label(false) ?>
        <?= $form->field($user, 'username')->textInput(
            ['placeholder' => $user->getAttributeLabel('username')]
        )->label(false) ?>
        <?= $form->field($user, 'email')->textInput(
            ['placeholder' => $user->getAttributeLabel('email')]
        )->label(false) ?>
        <?= $form->field($user, 'password')->passwordInput(
            ['placeholder' => $user->getAttributeLabel('password')]
        )->label(false) ?>
        <?= $form->field($user, 'repassword')->passwordInput(
            ['placeholder' => $user->getAttributeLabel('repassword')]
        )->label(false) ?>
        <?= $form->field($profile, 'avatar_url')->widget(
            Widget::className(),
            [
                'settings' => [
                    'url' => ['fileapi-upload']
                ],
                'crop' => true,
                'cropResizeWidth' => 100,
                'cropResizeHeight' => 100
            ]
        )->label(false) ?>
        <?= Html::submitButton(
            Yii::t('frontend', 'Зарегистрироватся'),
            [
                'class' => 'btn btn-success btn-large pull-right'
            ]
        ) ?>
        <?= Html::a(Yii::t('frontend', 'Повторная отправка e-mail подтверждения'), ['resend']); ?>
    </fieldset>
<?php ActiveForm::end(); ?>