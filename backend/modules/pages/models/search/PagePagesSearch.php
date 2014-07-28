<?php

namespace backend\modules\pages\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use common\models\search\MainSearch;
use backend\modules\pages\models\PagePages;
use backend\modules\pages\models\PagePagesT;

/**
 * Class PagePagesSearch
 * @package backend\modules\pages\models\search
 */
class PagePagesSearch extends MainSearch
{
    /**
     * @var string URL.
     */
    public $url;

    /**
     * @var string Page Name.
     */
    public $name;

    /**
     * @var integer Lang ID
     */
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'string'],
        ];
    }

    /**
     * Search pages with criteria
     * @param array|null
     * @param integer $langID
     *
     * @return \yii\data\ActiveDataProvider dataProvider
     */
    public function search($params, $langID)
    {
        $query          = PagePages::find();
        $dataProvider   = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->getModule('pages')->recordsPerPage
            ]
        ]);

        $query->innerJoinWith(['pageTranslation'])
            ->andWhere(['page_pages_t.langs_id'=>$langID]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'url', true);
        $this->addWithCondition($query, 'name', 'pageTranslation', PagePagesT::tableName() . '.name', true);

        return $dataProvider;
    }


    /**
     * Функция добавления условий поиска.
     * @param \yii\db\Query $query Экземпляр выборки.
     * @param string $attribute Имя отрибута по которому нужно искать.
     * @param boolean $partialMatch Тип добавляемого сравнения. Строгое совпадение или частичное.
     */
    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        $attribute = PagePages::tableName() . '.' . $attribute;
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}