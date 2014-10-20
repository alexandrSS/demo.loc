<?php

namespace backend\assets;


use yii\web\AssetBundle;

class Flot extends AssetBundle
{
    public $sourcePath = '@backend/assets/bower/flot';
    public $js = [
        'jquery.flot.js'
    ];

    public $depends = [
        '\yii\web\JqueryAsset',
        '\backend\assets\Excanvas'
    ];
} 