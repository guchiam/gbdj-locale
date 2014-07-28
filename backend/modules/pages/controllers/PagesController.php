<?php

namespace backend\modules\pages\controllers;

use yii\web\Response;
use yii\web\HttpException;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

use backend\components\GJController;
use backend\modules\pages\models\search\PagePagesSearch;
use backend\modules\pages\models\PagePages;

/**
 * Class PagesController
 * @package app\modules\pages\controllers
 */
class PagesController extends GJController
{

    /**
     * Page index action
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageTitle    = \Yii::t('pages', 'Pages List').' - '.\Yii::$app->name;

        $searchModel  = new PagePagesSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->get(), $this->langID);

        return $this->render('index', [
                'pageTitle'    => $pageTitle,
                'dataProvider' => $dataProvider,
                'searchModel'  => $searchModel,
            ]);
    }


    /**
     * Create page action
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $pageTitle     = \Yii::t('pages', 'Create Page').' - '.\Yii::$app->name;

        $model         = new PagePages(['scenario' => 'admin']);

        if ($model->load(\Yii::$app->request->post())/* && $model->save()*/) {

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model['id']]);
            } elseif (\Yii::$app->request->isAjax) {

                \Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($model);
            }

        } else {

            return $this->render('create', [
                    'model'     => $model,
                    'pageTitle' => $pageTitle,
                ]);
        }
    }

    /**
     * View page action
     */
    public function actionView()
    {
       echo('test view action');
    }

    /**
     * Ajax-action create content block
     */
    public function actionCreate_content_block()
    {
        $render   = '';
        $model    = new PagePages(['scenario' => 'admin']);

        $postPage    = \Yii::$app->request->post();
        $blocksCount = isset($postPage['blocks_count'])?$postPage['blocks_count']:0;

        $render['content_block'] = $this->renderPartial('_partials/_page_ontent_block', [
                'model'       => $model,
                'blocksCount' => $blocksCount,
            ]);

        echo Json::encode($render);
        exit;
    }

}