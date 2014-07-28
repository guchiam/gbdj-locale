<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PageContentBlocks;
use common\models\Languable;

/**
 * Class PageContentBlocksT
 * @package backend\modules\pages\models
 */
class PageContentBlocksT extends Languable
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_content_blocks_t}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'content', 'content_blocks_id'], 'required'],
            ['title', 'string', 'max' => 255],

            ['content_blocks_id', 'exist', 'targetClass' => PageContentBlocks::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title'          => Yii::t('pages', 'Content Block Title'),
            'content'        => Yii::t('pages', 'Content'),
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getParentContentBlock()
    {
        return $this->hasOne(PageContentBlocks::className(), ['id' => 'content_blocks_id']);
    }

}