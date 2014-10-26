<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Повторная отправка e-mail подтверждения');
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
            Yii::t('frontend', 'Отправить'),
            [
                'class' => 'btn btn-success pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>