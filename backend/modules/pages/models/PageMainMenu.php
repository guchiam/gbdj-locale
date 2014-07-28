<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PagePages;
use backend\modules\pages\models\PageMainMenuT;

use common\models\LangModel;

/**
 * Class PageMainMenu
 * @package backend\modules\pages\models
 */
class PageMainMenu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_main_menu}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['url', 'string', 'max' => 50],
            [['page_id', 'position'], 'integer', 'max' => 10],

            [['is_main_page', 'is_deleted'], 'integer', 'max' => 9],

            ['page_id', 'exist', 'targetClass' => PagePages::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('pages', 'ID'),
            'page_id'       => Yii::t('pages', 'Page'),
            'url'           => Yii::t('pages', 'URL'),
            'is_main_page'  => Yii::t('pages', 'Main Page Flag'),
            'is_deleted'    => Yii::t('pages', 'Delete Flag'),
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
    public function getMainMenuTranslation()
    {
        $lang = $this->getLangID();

        return $this->hasOne(PageMainMenuT::className(), ['main_menu_id' => 'id'])->where('langs_id = :langs_id', [':langs_id' => $lang]);
    }

}