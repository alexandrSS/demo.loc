<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Категории');
$this->params['subtitle'] = Yii::t('backend', 'Список котегорий');
$this->params['breadcrumbs'] = [
    $this->title
];
?>
<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'options' => [
                    'class' => 'box-primary'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'articlesCategory-grid'
            ]
        ); ?>

        <?php
        Modal::begin([
            'header' => '<h1>' . Yii::t('backend', 'Создание категории') . '<h1>',
            'toggleButton' => [
                'label' => Yii::t('backend', 'Создать категорию'),
                'class' => 'btn btn-primary btn-lg'
            ],
        ]);
        $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['create']
        ]);
        echo $form->field($model, 'title')->textInput(['maxlength' => 100]);
        echo $form->field($model, 'alias')->textInput(['maxlength' => 100]);
        echo $form->field($model, 'status_id')->dropDownList($statusArray);
        //echo Html::a('Создать', ['create','title'=>$model['title'],'alias'=>$model['alias'],'status_id'=>$model['status_id']], ['class' => 'btn btn-success']);
        echo Html::submitButton(Yii::t('backend', 'Создать'), ['class' => 'btn btn-success']);
        echo Html::submitButton(Yii::t('backend', 'Закрыть'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']);
        ActiveForm::end();
        Modal::end();
        ?>
        <hr>
        <?php
        $level = 0;

        foreach ($categories as $n => $category) {
            if ($category->level == $level)
                echo Html::endTag('li') . "\n";
            else if ($category->level > $level)
                echo Html::beginTag('ul') . "\n";
            else {
                echo Html::endTag('li') . "\n";

                for ($i=$level-$category->level;$i;$i--) {
                    echo Html::endTag('ul') . "\n";
                    echo Html::endTag('li') . "\n";
                }
            }

            echo Html::beginTag('li');
            echo Html::submitButton($category->title, ['class' => 'btn btn-default']);
            Modal::begin([
                'header' => '<h1>' . Yii::t('backend', 'Создание категории!') . '<h1>',
                'toggleButton' => [
                    'label' => '<i class="fa fa-plus"></i>',
                    'class' => 'btn btn-success'
                ],
            ]);
            $form1 = ActiveForm::begin([
                'method' => 'get',
                'action' => ['create1?id='.$category->id]
            ]);
            echo $form1->field($model, 'title')->textInput(['maxlength' => 100]);
            echo $form1->field($model, 'alias')->textInput(['maxlength' => 100]);
            echo $form1->field($model, 'status_id')->dropDownList($statusArray);
            //echo Html::a('Создать', ['index','id'=>$category->id], ['class' => 'btn btn-success']);
            echo Html::submitButton(Yii::t('backend', 'Создать'), ['class' => 'btn btn-success']);
            echo Html::submitButton(Yii::t('backend', 'Закрыть'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']);
            ActiveForm::end();
            Modal::end();
            echo Html::a('<i class="fa fa-trash-o"></i>', ['delete', 'id' => $category->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
            $level = $category->level;
        }

        for ($i = $level; $i; $i--) {
            echo Html::endTag('li') . "\n";
            echo Html::endTag('ul') . "\n";
        }
        ?>
        <pre>
        <?php //print_r($roots) ?>
        </pre>
        <?php Box::end(); ?>


    </div>
</div>