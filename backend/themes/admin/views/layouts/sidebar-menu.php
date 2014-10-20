<?php

echo \common\components\widgets\menu\MenuWidget::widget([
    'options'=>['class'=>'sidebar-menu'],
    'labelTemplate' => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents'=>true,
    'items'=>[
        [
            'label'=>Yii::t('themes', 'Dashboard'),
            'icon'=>'<i class="fa fa-bar-chart-o"></i>',
            'url'=>Yii::$app->homeUrl
        ],
        [
            'label'=>Yii::t('themes', 'Content'),
            'icon'=>'<i class="fa fa-edit"></i>',
            'options'=>['class'=>'treeview'],
            'items'=>[
                ['label'=>Yii::t('themes', 'Articles'), 'url'=>['/articles'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                ['label'=>Yii::t('themes', 'Static pages'), 'url'=>['/pages'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'Articles'), 'url'=>['/article/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'Article Categories'), 'url'=>['/article-category/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'Text Widgets'), 'url'=>['/widget-text/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'Menu Widgets'), 'url'=>['/widget-menu/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'Carousel Widgets'), 'url'=>['/widget-carousel/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
            ]
        ],
        [
            'label'=>Yii::t('themes', 'Users'),
            'icon'=>'<i class="fa fa-users"></i>',
            'url'=>['/user']
        ],
        [
            'label'=>Yii::t('themes', 'System'),
            'icon'=>'<i class="fa fa-cogs"></i>',
            'options'=>['class'=>'treeview'],
            'items'=>[
                [
                    'label'=>Yii::t('themes', 'System Information'),
                    'url'=>['/system-information/index'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>'
                ],
                //['label'=>Yii::t('themes', 'Key-Value Storage'), 'url'=>['/key-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'File Storage Items'), 'url'=>['/file-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                //['label'=>Yii::t('themes', 'File Manager'), 'url'=>['/file-manager/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                [
                    'label'=>Yii::t('themes', 'System Events'),
                    'url'=>['/system-event/index'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>',
                    'badge'=>\backend\models\SystemEvent::find()->today()->count(),
                    'badgeBgClass'=>'bg-green',
                ],
                [
                    'label'=>Yii::t('themes', 'Logs'),
                    'url'=>['/log/index'],
                    'icon'=>'<i class="fa fa-angle-double-right"></i>',
                    'badge'=>\backend\models\SystemLog::find()->count(),
                    'badgeBgClass'=>'bg-red',
                ],
            ]
        ]
    ]
]);