<?php

namespace common\components\widgets\carousel;

use common\models\WidgetCarousel;
use yii\base\InvalidConfigException;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

class CarouselWidget extends Carousel{
    public $alias;
    public $controls = [
        '<span class="glyphicon glyphicon-chevron-left"></span>',
        '<span class="glyphicon glyphicon-chevron-right"></span>',
    ];

    public function init(){
        if(!$this->alias){
            throw new InvalidConfigException;
        }
        $model = WidgetCarousel::find()
            ->with(['items'=>function($query){
                return $query->where(['status'=>1])->orderBy(['order'=>SORT_ASC]);
            }])
            ->where(['alias'=>$this->alias])
            ->one();
        if($model){
            foreach($model->items as $k => $item){
                if($item->path){
                    $this->items[$k]['content'] = Html::img($item->path);
                } else {
                    continue;
                }
                if($item->url){
                    $this->items[$k]['content'] = Html::a($this->items[$k]['content'], $item->url, ['target'=>'_blank']);
                }

                if($item->caption){
                    $this->items[$k]['caption'] = $item->caption;
                }
            }
        }
        parent::init();
    }

} 