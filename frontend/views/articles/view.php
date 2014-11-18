<?php

use yii\helpers\Html;
use frontend\themes\site\widgets\Menu;
use frontend\models\ArticlesCategory;

$this->title = $model['title'];
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('frontend', 'Статьи'),
        'url' => ['index']
    ],
    $this->title
]; ?>
<div class="row">
    <aside class="col-sm-3 col-sm-push-9">
        <?=
        Menu::widget(
            [
                'options' => [
                    'class' => 'nav nav-pills nav-stacked'
                ],
                'items' => ArticlesCategory::getMenuArticleCategory()
            ]
        );
        ?>
    </aside>

    <div class="col-sm-9 col-sm-pull-3">
        <div class="blog">
            <div class="blog-item">

                <div class="blog-content">

                    <h3><?= $model->title ?></h3>

                    <div class="entry-meta">
                        <span><i class="icon-calendar"></i> <?= $model->created ?></span>
                        <span><i class="icon-eye-open"></i> <?= $model->views ?></span>
                    </div>

                    <?= $model->content ?>
                </div>
            </div>
            <!--/.blog-item-->
        </div>
    </div>
    <!--/.col-md-8-->
</div><!--/.row-->
