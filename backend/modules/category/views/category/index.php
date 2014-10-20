<?php

use backend\themes\admin\widgets\Box;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category\models\search\SearchCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category', 'BACKEND_INDEX_TITLE');
$this->params['subtitle'] = Yii::t('category', 'BACKEND_INDEX_SUBTITLE');
$this->params['breadcrumbs'] = [
    $this->title
];
?>
<div class="row">
    <div class="col-xs-12">

        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{create} {batch-delete}',
                'grid' => 'articles-grid'
            ]
        ); ?>
        <!-- Button trigger modal -->
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Посмотреть демо
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Название модали</h4>
                    </div>
                    <div class="modal-body">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'view_id')->dropDownList($viewArray) ?>

                        <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'status_id')->dropDownList($statusArray) ?>
                    </div>
                    <div class="modal-footer">
                        <?= Html::submitButton(Yii::t('category', 'Close'), ['class' => 'btn btn-default','data-dismiss'=>'modal']) ?>
                        <?= Html::submitButton(Yii::t('category', 'Create'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <?php Box::end(); ?>
    </div>
    <?php //print_r($roots) ?>
</div>