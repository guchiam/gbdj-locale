<?php
    use yii\helpers\Html;
?>
<div class="odd">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group field-pagepages-meta_title">
                <?= Html::label($model->getAttributeLabel('title'),'PagePages_contentBlocks_name['.$blocksCount.']', ['class'=>'control-label']); ?>
                <?= Html::input('text', 'PagePages[contentBlocks][name]['.$blocksCount.']', '', ['id' => 'PagePages_contentBlocks_name_'.$blocksCount, 'class' => 'form-control']); ?>

                <div class="help-block"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group field-pagepages-meta_title">
                <?= Html::label($model->getAttributeLabel('content'),'PagePages_contentBlocks_content['.$blocksCount.']', ['class'=>'control-label']); ?>
                <?php

                echo Html::textarea('PagePages[contentBlocks][content]['.$blocksCount.']', '', [
                        'class' => 'form-control vizivig',
                        'id'    => 'PagePages_contentBlocks_content_'.$blocksCount
                    ]);

                ?>

                <div class="help-block"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group field-pagepages-meta_title">
                <?= Html::label($model->getAttributeLabel('background_color'),'PagePages_contentBlocks_background_color['.$blocksCount.']', ['class'=>'control-label']); ?>
                <?= Html::input('text', 'PagePages[contentBlocks][background_color]['.$blocksCount.']', '', ['id' => 'PagePages_contentBlocks_background_color_'.$blocksCount, 'class' => 'form-control color {required:false}']); ?>

                <div class="help-block"></div>
            </div>
        </div>
    </div>
<div>