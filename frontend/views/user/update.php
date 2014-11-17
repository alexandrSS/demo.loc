<?php

use vova07\fileapi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Редактирование профиля');
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
        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(
            false
        ) ?>
        <?= $form->field($model, 'surname')->textInput(['placeholder' => $model->getAttributeLabel('surname')])->label(
            false
        ) ?>
        <?=
        $form->field($model, 'avatar_url')->widget(
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
            Yii::t('frontend', 'Обновить'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>