<?php

echo \common\components\widgets\menu\MenuWidget::widget([
    'options' => ['class' => 'sidebar-menu'],
    'labelTemplate' => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        [
            'label' => Yii::t('themes', 'К сайту'),
            'icon' => '<i class="fa fa-home"></i>',
            'url' => '/'
        ],
        [
            'label' => Yii::t('themes', 'Панель управления'),
            'icon' => '<i class="fa fa-bar-chart-o"></i>',
            'url' => Yii::$app->homeUrl
        ],
        [
            'label' => Yii::t('themes', 'Контент'),
            'icon' => '<i class="fa fa-edit"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                ['label' => Yii::t('themes', 'Категории статей'), 'url' => ['/articles-category'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('themes', 'Статьи'), 'url' => ['/articles'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('themes', 'Страницы'), 'url' => ['/pages'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
            ]
        ],
        [
            'label' => Yii::t('themes', 'Пользователи'),
            'icon' => '<i class="fa fa-users"></i>',
            'url' => ['/user']
        ],
        [
            'label' => Yii::t('themes', 'Система'),
            'icon' => '<i class="fa fa-cogs"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                [
                    'label' => Yii::t('themes', 'Системная информация'),
                    'url' => ['/system-information/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                //['label'=>Yii::t('themes', 'Key-Value Storage'), 'url'=>['/key-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'File Storage Items'), 'url'=>['/file-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'File Manager'), 'url'=>['/file-manager/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                [
                    'label' => Yii::t('themes', 'Системные события'),
                    'url' => ['/system-event/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                    'badge' => \backend\models\SystemEvent::find()->today()->count(),
                    'badgeBgClass' => 'bg-green',
                ],
                [
                    'label' => Yii::t('themes', 'Журнал'),
                    'url' => ['/log/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                    'badge' => \backend\models\SystemLog::find()->count(),
                    'badgeBgClass' => 'bg-red',
                ],
            ]
        ]
    ]
]);