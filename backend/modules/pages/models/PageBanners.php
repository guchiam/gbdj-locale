<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PagePages;
use backend\modules\pages\models\PageBannersT;

use common\models\LangModel;

/**
 * Class PageBanners
 * @package backend\modules\pages\models
 */
class PageBanners extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_banners}}';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['picture', 'string', 'max' => 255],

            ['page_id', 'exist', 'targetClass' => PagePages::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('pages', 'ID'),
            'page_id'           => Yii::t('pages', 'Page'),
            'picture'           => Yii::t('pages', 'Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPage()
    {
        return $this->hasOne(PagePages::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getBannerTranslation()
    {
        $lang = $this->getLangID();

        return $this->hasOne(PageBannersT::className(), ['banners_id' => 'id'])->where('langs_id = :langs_id', [':langs_id' => $lang]);
    }

}