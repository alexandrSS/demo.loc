<?php

/**
 * Signup page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\frontend\User $user Model
 * @var \vova07\users\models\Profile $profile Profile
 */

use common\widget\fileapi\Widget;
use frontend\modules\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_SIGNUP_TITLE');
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
            Yii::t('users', 'FRONTEND_SIGNUP_SUBMIT'),
            [
                'class' => 'btn btn-success btn-large pull-right'
            ]
        ) ?>
        <?= Html::a(Yii::t('users', 'FRONTEND_SIGNUP_RESEND'), ['resend']); ?>
    </fieldset>
<?php ActiveForm::end(); ?>