<?php

namespace backend\modules\articles\controllers;

use backend\modules\admin\components\Controller;
use backend\modules\articles\models\Article;
use backend\modules\articles\models\ArticleSearch;
use common\widget\fileapi\actions\UploadAction as FileAPIUpload;
use backend\widget\imperavi\actions\GetAction as ImperaviGet;
use backend\widget\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Default backend controller.
 */
class ArticlesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get'],
                'create' => ['get', 'post'],
                'update' => ['get', 'put', 'post'],
                'delete' => ['post', 'delete'],
                'batch-delete' => ['post', 'delete']
            ]
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => $this->module->contentUrl,
                'path' => $this->module->contentPath
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => $this->module->contentUrl,
                'path' => $this->module->contentPath
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => $this->module->fileUrl,
                'path' => $this->module->filePath,
                'uploadOnlyImage' => false
            ],
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => $this->module->imagesTempPath
            ]
        ];
    }

    /**
     * Posts list page.
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $statusArray = Article::getStatusArray();

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * Create post page.
     */
    public function actionCreate()
    {
        $model = new Article(['scenario' => 'admin-create']);
        $statusArray = Article::getStatusArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('articles', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * Update post page.
     *
     * @param integer $id Post ID
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin-update');
        $statusArray = Article::getStatusArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('articles', 'BACKEND_FLASH_FAIL_ADMIN_UPDATE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'update',
            [
                'model' => $model,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * Find model by ID.
     *
     * @param integer|array $id Post ID
     *
     * @return \vova07\articles\models\backend\Article Model
     *
     * @throws HttpException 404 error if post not found
     */
    protected function findModel($id)
    {
        if (is_array($id)) {
            /** @var \vova07\articles\models\backend\Article $model */
            $model = Article::findAll($id);
        } else {
            /** @var \vova07\articles\models\backend\Article $model */
            $model = Article::findOne($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }

    /**
     * Delete post page.
     *
     * @param integer $id Post ID
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Delete multiple posts page.
     *
     * @return mixed
     * @throws \yii\web\HttpException
     */
    public function actionBatchDelete()
    {
        if (($ids = Yii::$app->request->post('ids')) !== null) {
            $models = $this->findModel($ids);
            foreach ($models as $model) {
                $model->delete();
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }
}
