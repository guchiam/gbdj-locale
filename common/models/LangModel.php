<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\CoreLangs;

/**
 * Class LangModel
 * @package common\models
 */
class LangModel extends ActiveRecord
{

    /**
     * @return int - Language ID
     */
    public function getLangID()
    {
        $lang = CoreLangs::findByLangCode(\Yii::$app->language);

        if (is_object($lang)) {
            return $lang->id;
        }

        return CoreLangs::DEFAULT_LANG;
    }

}