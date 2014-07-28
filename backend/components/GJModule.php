<?php

namespace backend\components;

use Yii;
/**
 * Class GJModule
 */
class GJModule extends \yii\base\Module
{
    protected static $moduleUrlRules = array();

    /**
     * Get main routes
     * PHP 5.3 - Late Static Bindings
     * @return array
     */
    public static function getModuleUrlRules()
    {
        return array();
    }
}