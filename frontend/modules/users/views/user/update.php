<?php

/**
 * Update profile page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\frontend\User $model Model
 */

use common\widget\fileapi\Widget;
use frontend\modules\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_UPDATE_TITLE');
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
            Yii::t('users', 'FRONTEND_UPDATE_SUBMIT'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>