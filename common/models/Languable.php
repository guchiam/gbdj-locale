<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\CoreLangs;

use common\models\LangModel;

/**
 * Class Languable
 * @package common\models
 */
class Languable extends LangModel
{

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getLang()
    {
        return $this->hasOne(CoreLangs::className(), ['id' => 'langs_id']);
    }

}