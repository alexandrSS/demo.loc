<?php

use backend\themes\admin\widgets\Box;
use backend\themes\admin\widgets\GridView;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Карта сайта');
$this->params['subtitle'] = Yii::t('backend', 'sitemap.xml');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">

        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'site-map-grid'
            ]
        ); ?>

        <?= Html::a(Yii::t('backend','Обновить'), ['index'], ['class' => 'btn btn-success']) ?>

        <hr>
        <pre>
            <?php print_r($siteMap) ?>
        </pre>

        <?php Box::end(); ?>

    </div>
</div>
