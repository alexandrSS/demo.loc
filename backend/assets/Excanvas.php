<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Excanvas extends AssetBundle
{
    public $sourcePath = '@backend/assets/bower/excanvas';
    public $js = [
        'excanvas.js'
    ];

    public $jsOptions = [
        'condition' => 'lte IE 8'
    ];
} 