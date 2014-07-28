<?php
/**
 * Представление создания поста.
 * @var yii\base\View $this Представление
 * @var backend\modules\pages\models\PagePages $model Модель
 */

use yii\helpers\Html;
use yii\widgets\Menu;

$this->title = $pageTitle;
$this->params['breadcrumbs'][] = [
    'label' => \Yii::t('pages', 'Pages List'),
    'url'   => ['index']
];
$this->params['breadcrumbs'][] = \Yii::t('pages', 'Create Page');
?>
    <div class="navbar navbar-default">
        <div class="navbar-brand"><?= Html::encode(\Yii::t('pages', 'Create Page')); ?></div>
        <div class="navbar-right">
            <?= Menu::widget([
                    'options'         => ['class' => 'nav navbar-nav'],
                    'activeCssClass'  => 'active',
                    'encodeLabels'    => false,
                    'activateParents' => true,
                    'items' => [
                        [
                            'label' => '<span class="glyphicon glyphicon-remove-sign"></span> ' . \Yii::t('pages', 'Cansel'),
                            'url' => ['index']
                        ]
                    ]
                ]); ?>
        </div>
    </div>
<?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>