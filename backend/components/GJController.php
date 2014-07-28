<?php

namespace backend\components;

use yii\web\Controller;
use common\models\CoreLangs;


/**
 * Class GJController
 * @package app\components
 */
class GJController extends Controller
{
    public $langID = null;

    /**
     * Main Controller Initializationo
     */
    public function init()
    {
        $this->langID = $this->getLang();
        parent::init();
    }


    /**
     * @return int - Language ID
     */
    protected function getLang()
    {
        $lang = CoreLangs::findByLangCode(\Yii::$app->language);

        if (is_object($lang)) {
            return $lang->id;
        }

       return CoreLangs::DEFAULT_LANG;
    }
}