<?php

/**
 * Email changing page view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\users\models\frontend\User $model Model
 */

use frontend\modules\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_EMAIL_CHANGE_TITLE');
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
        <?= $form->field($model, 'oldemail')->textInput(['readonly' => true, 'placeholder' => $model->getAttributeLabel('oldemail')])->label(false) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
        <?=
        Html::submitButton(
            Yii::t('users', 'FRONTEND_EMAIL_CHANGE_SUBMIT'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>