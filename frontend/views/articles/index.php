<?php

use frontend\themes\site\widgets\Menu;
use frontend\models\ArticlesCategory;
use yii\widgets\ListView;

$this->title = Yii::t('frontend', 'Статьи');
$this->params['breadcrumbs'][] = $this->title; ?>
<div class="row">

    <aside class="col-sm-4 col-sm-push-8">
        <?=
        Menu::widget(
            [
                'options' => [
                    'class' => isset($footer) ? 'pull-right' : 'nav navbar-nav navbar-right'
                ],
                'items' => ArticlesCategory::getMenuPage()
            ]
        );
        ?>
        <div class="widget ads">
            <div class="row">
                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@frontend/themes/site/images/ads/ad1.png')[1] ?>" alt="Ads" />
                </div>

                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@frontend/themes/site/images/ads/ad2.png')[1] ?>" alt="Ads" />
                </div>
            </div>
            <p> </p>
            <div class="row">
                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@frontend/themes/site/images/ads/ad3.png')[1] ?>" alt="Ads" />
                </div>

                <div class="col-xs-6">
                    <img class="img-responsive img-rounded" src="<?= $this->assetManager->publish('@frontend/themes/site/images/ads/ad4.png')[1] ?>" alt="Ads" />
                </div>
            </div>
        </div><!--/.ads-->
    </aside>

    <div class="col-sm-8 col-sm-pull-4">
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