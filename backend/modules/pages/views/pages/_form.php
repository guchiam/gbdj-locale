<?php
/**
 * Представление формы поста.
 * @var yii\web\View $this Представление
 * @var yii\widgets\ActiveForm $form Форма
 * @var backend\modules\pages\models\PagePages $model Модель
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use common\extensions\fileapi\FileAPIAdvanced;

use common\extensions\tinymce\Tinymce;

$this->registerJsFile(
    '@web/js/pages/jscolor/jscolor.js',
    ['yii\web\JqueryAsset']
);

$this->registerJsFile(
    '@web/js/pages/page_edit.js',
    ['yii\web\JqueryAsset']
);


$form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation'   => true,
        'validateOnChange'       => false,
        'beforeValidate'         => new JsExpression('function ($form, attribute, messages) { if (attribute.name === "content") { tinymce.triggerSave(); } return true; }')
    ]); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'name') . $form->field($model, 'url');?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'meta_title'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'meta_description')->textArea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'meta_keywords')->textArea(['rows' => 6]) ?>
        </div>
    </div>

    <div style="display:none;"><?php echo TinyMCE::widget(['name' => 'to-load']);?></div>

    <div class="page-contents">

    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= Html::buttonInput(\Yii::t('pages', 'Add Content Block'), ['class' => 'btn add-content-block', 'attr-blocks-count'=>0]); ?>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">
            <?=
            Html::submitButton($model->isNewRecord ? \Yii::t('pages', 'Save') : \Yii::t('pages', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
                ]); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>