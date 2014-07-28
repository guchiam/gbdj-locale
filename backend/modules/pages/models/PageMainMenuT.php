<?php

namespace backend\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;

use backend\modules\pages\models\PageMainMenu;
use common\models\Languable;

/**
 * Class PageMainMenuT
 * @package backend\modules\pages\models
 */
class PageMainMenuT extends Languable
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_main_menu_t}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'string', 'max' => 50],
            [['langs_id', 'main_menu_id'], 'integer', 'max' => 10],

            ['main_menu_id', 'exist', 'targetClass' => PageMainMenu::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'          => Yii::t('pages', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getMainMenu()
    {
        return $this->hasOne(PageMainMenu::className(), ['id' => 'main_menu_id']);
    }


}