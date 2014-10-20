<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Backend app asset.
 */
class AppAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@backend/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/style.css'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset'
    ];
}
