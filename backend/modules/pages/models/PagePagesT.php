<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PagePages;
use common\models\Languable;

class PagePagesT extends Languable
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_pages_t}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            ['meta_description', 'string', 'max' => 500],

            ['langs_id', 'number', 'integerOnly' => true],

            ['page_id', 'exist', 'targetClass' => PagePages::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {

            if ($this->isNewRecord) {

                if (!$this->langs_id) {
                    $this->langs_id = $this->getLangID();
                }
            }

            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'           => Yii::t('pages', 'Name')
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPage()
    {
        return $this->hasOne(PagePages::className(), ['id' => 'page_id']);
    }

}