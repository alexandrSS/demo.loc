<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Смена пароля');
$this->params['breadcrumbs'] = [
    Yii::t('frontend', 'Настройки'),
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
            Yii::t('frontend', 'Изменить'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>