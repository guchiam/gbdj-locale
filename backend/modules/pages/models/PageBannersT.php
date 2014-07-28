<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PageBanners;
use common\models\Languable;

/**
 * Class PageBannersT
 * @package backend\modules\pages\models
 */
class PageBannersT extends Languable
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_banners_t}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title1', 'title2'], 'safe'],

            ['banners_id', 'exist', 'targetClass' => PageBanners::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title1'        => Yii::t('pages', 'Title'),
            'title2'        => Yii::t('pages', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getParentBanner()
    {
        return $this->hasOne(PageBanners::className(), ['id' => 'banners_id']);
    }

}