<?php

namespace common\modules\articles\traits;

use common\modules\articles\Module;
use Yii;

/**
 * Class ModuleTrait
 * @package vova07\articles\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \vova07\articles\Module|null Module instance
     */
    private $_module;

    /**
     * @return \vova07\articles\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $module = Module::getInstance();
            if ($module instanceof Module) {
                $this->_module = $module;
            } else {
                $this->_module = Yii::$app->getModule('articles');
            }
        }
        return $this->_module;
    }
}
