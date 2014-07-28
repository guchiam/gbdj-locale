<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PagePagesT;
use backend\modules\pages\models\PageContentBlocks;
use backend\modules\pages\models\PageBanners;

use common\models\LangModel;

/**
 * Class PagePages
 * @package backend\modules\pages\models
 */
class PagePages extends LangModel
{

    public $name;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    public $bammers = [];
    public $contentBlocks = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_pages}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['url', 'string', 'max' => 50],
            ['url', 'unique'],

            ['name', 'required', 'on'=>'admin'],

            [['name', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            ['meta_description', 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin'  => ['url', 'name', 'meta_title', 'meta_description', 'meta_keywords'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url'              => Yii::t('pages', 'URL'),
            'content'          => Yii::t('pages', 'Content Block Content'),
            'title'            => Yii::t('pages', 'Content Block Title'),
            'background_color' => Yii::t('pages', 'Content Block Cackground Color'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {

            if ($this->url == '') {
                $this->url = '';
            }

            return true;
        }
        return false;
    }

    /**
     * Add translation to page
     *
     * @return bool
     */
    protected function addPageTranslation()
    {
        if (!$this->pageTranslation) {
            $this->pageTranslation = new PagePagesT();
        }
        var_dump($this->pageTranslation);

        return true;
    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert)
    {
        $this->addPageTranslation();

        die();
        parent::afterSave($insert);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPageTranslation()
    {
        $lang = $this->getLangID();

        return $this->hasOne(PagePagesT::className(), ['page_id' => 'id'])->where('langs_id = :langs_id', [':langs_id' => $lang]);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getContentBlocks()
    {
        return $this->hasMany(PageContentBlocks::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getBanners()
    {
        return $this->hasMany(PageBanners::className(), ['id' => 'page_id']);
    }

}