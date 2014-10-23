<?php

use frontend\themes\site\widgets\Menu;
use common\models\Pages;

echo Menu::widget(
    [
        'options' => [
            'class' => isset($footer) ? 'pull-right' : 'nav navbar-nav navbar-right'
        ],
        'items' => Pages::getMenuPage()
    ]
);