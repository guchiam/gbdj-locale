<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class CoreLangs
 * @package common\models
 */
class CoreLangs extends ActiveRecord
{

    const DEFAULT_LANG = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%core_langs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            [['code', 'name'], 'required'],
            ['name', 'string', 'max' => 45],
            ['code', 'unique', 'targetClass' => CoreLangs::className(), 'targetAttribute' => 'code', 'message' => Yii::t('pages', 'This code is already use')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'           => Yii::t('pages', 'Name'),
            'code'           => Yii::t('pages', 'Code'),
        ];
    }

    /**
     * @param $id
     * @param $alias
     * @return array|null|ActiveRecord
     */
    public static function findByLangCode($code)
    {
        return static::find()->where('code = :code', [':code' => $code])->one();
    }

}