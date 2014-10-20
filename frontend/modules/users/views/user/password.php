<?php

/**
 * Password changing page view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\users\models\frontend\User $model Model
 */

use frontend\modules\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_PASSWORD_CHANGE_TITLE');
$this->params['breadcrumbs'] = [
    Yii::t('users', 'FRONTEND_SETTINGS_LABEL'),
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
        <?= $form->field($model, 'oldpassword')->passwordInput(['placeholder' => $model->getAttributeLabel('oldpassword')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'repassword')->passwordInput(['placeholder' => $model->getAttributeLabel('repassword')])->label(false) ?>
        <?= Html::submitButton(
            Yii::t('users', 'FRONTEND_PASSWORD_CHANGE_SUBMIT'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>