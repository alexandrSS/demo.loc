<?php

use frontend\themes\site\widgets\Menu;
use frontend\models\ArticlesCategory;
use yii\widgets\ListView;

$this->title = Yii::t('frontend', 'Статьи');
$this->params['breadcrumbs'][] = $this->title; ?>
<div class="row">

    <aside class="col-sm-3 col-sm-push-9">
        <pre>
            <?= print_r(ArticlesCategory::getCategoryListArray())?>
        </pre>
        <pre>
            <?= print_r(ArticlesCategory::getMenuArticleCategory())?>
        </pre>
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
        <?= ListView::widget(
            [
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'itemView' => '_index_item',
                'options' => [
                    'class' => 'blog'
                ],
                'itemOptions' => [
                    'class' => 'blog-item',
                    'tag' => 'article'
                ]
            ]
        ); ?>
    </div>
</div>