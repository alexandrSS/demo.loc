<?php

/**
 * Recovery password page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\frontend\RecoveryForm $model Model
 */

use frontend\modules\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_RECOVERY_TITLE');
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
        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
        <?= Html::submitButton(
            Yii::t('users', 'FRONTEND_RECOVERY_SUBMIT'),
            [
                'class' => 'btn btn-success pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>