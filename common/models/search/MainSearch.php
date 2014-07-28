<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class MainSearch
 * @package common\models
 */
class MainSearch extends Model
{

    /**
     * Функция добавления условий поиска по связаным моделям.
     * @param \yii\db\Query $query Экземпляр выборки.
     * @param string $attribute Имя отрибута с переданым значением.
     * @param string $relation Имя связи.
     * @param string $targetAttribute Имя удаленного отрибута по которому нужно искать.
     * @param boolean $partialMatch Тип добавляемого сравнения. Строгое совпадение или частичное.
     */
    protected function addWithCondition($query, $attribute, $relation, $targetAttribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->innerJoinWith([$relation])
                ->andWhere(['like', $targetAttribute, $value]);
        } else {
            $query->innerJoinWith([$relation])
                ->andWhere([$targetAttribute => $value]);
        }
    }

}