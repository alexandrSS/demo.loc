<?php

namespace common\components\widgets\datetimepicker;


use yii\web\AssetBundle;

class DatetimepickerAsset extends AssetBundle{

    public function init(){
        $this->sourcePath = __DIR__.'/assets';
        parent::init();
    }

    public $css = [
        'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ];

    public $js = [
        'moment/min/moment-with-langs.min.js',
        'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    ];

}