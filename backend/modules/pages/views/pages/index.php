<?php

/**
 * View of Pages List
 * @var yii\web\View $this
 * @var backend\modules\pages\models\search\PagePagesSearch $searchModel
 * @var backend\modules\pages\models\PagePages $dataProvider
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\SerialColumn;
use yii\widgets\Menu;

$this->title = $pageTitle;

$this->params['control'] = [
    'gridId' => 'pages-grid'
];
$this->params['breadcrumbs'][] = Yii::t('pages', 'Pages List');
?>

<h2><?= Html::encode(Yii::t('pages', 'Pages List')) ?></h2>

<p>
    <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> ' . Yii::t('pages', 'Create new page'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php
echo GridView::widget([
        'id'            => 'pages-grid',
        'dataProvider'  => $dataProvider,
        'filterModel'   => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::classname()
            ],
            [
                'class' => SerialColumn::className(),
            ],
            [
                'attribute' => 'name',
                'format'    => 'html',
                'value'     => function ($model) {
                    return Html::a($model->pageTranslation['name'], ['view', 'id' => $model['id']]);
                },
            ],
            [
                'attribute' => 'url',
                'format'    => 'html',
                'value'     => function ($model) {
                    return Html::a($model['url'], ['view', 'id' => $model['id']]);
                },
            ],
            [
                'class'  => ActionColumn::className(),
                'header' => Yii::t('pages', 'Controls')
            ]
        ]
    ]);




