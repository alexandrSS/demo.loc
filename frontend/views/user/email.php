<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Изменение адреса электронной почты');
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
        <?= $form->field($model, 'oldemail')->textInput(['readonly' => true, 'placeholder' => $model->getAttributeLabel('oldemail')])->label(false) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
        <?=
        Html::submitButton(
            Yii::t('frontend', 'Изменить'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>