<?php

/**
 * User form view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\backend\User $model Model
 * @var \vova07\users\models\Profile $profile Profile
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 * @var \backend\themes\admin\widgets\Box $box Box widget instance
 */

use common\widget\fileapi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'name') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'surname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'username') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'email') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'password')->passwordInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'repassword')->passwordInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($user, 'status_id')->dropDownList(
                $statusArray,
                [
                    'prompt' => Yii::t('users', 'BACKEND_PROMPT_STATUS')
                ]
            ) ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($user, 'role')->dropDownList(
                $roleArray,
                [
                    'prompt' => Yii::t('users', 'BACKEND_PROMPT_ROLE')
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($profile, 'avatar_url')->widget(Widget::className(),
                [
                    'settings' => [
                        'url' => ['fileapi-upload']
                    ],
                    'crop' => true,
                    'cropResizeWidth' => 100,
                    'cropResizeHeight' => 100
                ]
            ) ?>
        </div>
    </div>
<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $user->isNewRecord ? Yii::t('users', 'BACKEND_CREATE_SUBMIT') : Yii::t('users', 'BACKEND_UPDATE_SUBMIT'),
    [
        'class' => $user->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>