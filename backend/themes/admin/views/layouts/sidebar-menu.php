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
            'url' => ['/default/index']
        ],
        [
            'label' => Yii::t('themes', 'Содержимое'),
            'icon' => '<i class="fa fa-edit"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                [
                    'label' => Yii::t('themes', 'Категории статей'),
                    'url' => ['/articles-category/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                    'label' => Yii::t('themes', 'Статьи'),
                    'url' => ['/articles/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                    'label' => Yii::t('themes', 'Страницы'),
                    'url' => ['/pages/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                    'label' => Yii::t('themes', 'Комментарии'),
                    'url' => ['/comments/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
            ]
        ],
        [
            'label' => Yii::t('themes', 'Пользователи'),
            'icon' => '<i class="fa fa-users"></i>',
            'url' => ['/user/index']
        ],
        [
            'label' => Yii::t('themes', 'Настройки'),
            'icon' => '<i class="fa fa-gear"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                [
                    'label' => Yii::t('themes', 'Карта сайта'),
                    'url' => ['/site-map/index'],
                    'icon' => '<i class="fa fa-sitemap"></i>',
                ],
            ]
        ],
        [
            'label' => Yii::t('themes', 'Система'),
            'icon' => '<i class="fa fa-cogs"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                [
                    'label' => Yii::t('themes', 'Кэш'),
                    'url' => ['/cache/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                    'label' => Yii::t('themes', 'Информация о системе'),
                    'url' => ['/system-information/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                    'label' => Yii::t('themes', 'События'),
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
        ],
        [
            'label' => Yii::t('themes', 'Институт'),
            'icon' => '<i class="fa fa-briefcase"></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                [
                    'label' => Yii::t('themes', 'Мет. и ср. защиты комп. информации'),
                    'url' => ['/security/index'],
                    'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
            ]
        ]
    ]
]);