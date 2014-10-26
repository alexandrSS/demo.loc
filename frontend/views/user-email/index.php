<?php

use yii\widgets\ListView;

$this->title = Yii::t('frontend', 'Пользователи');
$this->params['subtitle'] = Yii::t('frontend', 'Список пользователей');
$this->params['breadcrumbs'] = [
    $this->title
]; ?>

<div class="row">
<?php echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'layout' => '<div class="row">{items}</div><div class="row">{pager}</div>',
        'itemView' => '_index_item',
        'itemOptions' => [
            'class' => 'col-md-4 col-sm-6',
            'tag' => 'article',
            'itemscope' => true,
            'itemtype' => 'http://schema.org/Person'
        ]
    ]
); ?>
</div>