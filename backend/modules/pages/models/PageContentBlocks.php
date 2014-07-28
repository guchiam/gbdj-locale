<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PagePages;
use backend\modules\pages\models\PageContentBlocksT;

use common\models\LangModel;

/**
 * Class PageContentBlocks
 * @package backend\modules\pages\models
 */
class PageContentBlocks extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_content_blocks}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['background_pic', 'string', 'max' => 255],
            ['background_color', 'string', 'max' => 45],
            ['position', 'integer', 'max' => 10],

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
            'background_pic'    => Yii::t('pages', 'Background Pic'),
            'background_color'  => Yii::t('pages', 'Background Color'),
            'position'          => Yii::t('pages', 'Position'),
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
    public function getContentTranslation()
    {
        $lang = $this->getLangID();

        return $this->hasOne(PageContentBlocksT::className(), ['content_blocks_id' => 'id'])->where('langs_id = :langs_id', [':langs_id' => $lang]);
    }

}