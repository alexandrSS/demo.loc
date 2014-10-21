<?php

namespace backend\controllers;

use backend\components\Controller;
use backend\models\Articles;
use backend\models\search\ArticlesSearch;
use backend\widget\imperavi\actions\GetAction as ImperaviGet;
use backend\widget\imperavi\actions\UploadAction as ImperaviUpload;
use common\widget\fileapi\actions\UploadAction as FileAPIUpload;
use Yii;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Контроллер управления статьями
 * Class ArticlesController
 * @package backend\controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return array
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
                'url' => Articles::CONTENT_URL,
                'path' => Articles::CONTENT_PATH
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => Articles::CONTENT_URL,
                'path' => Articles::CONTENT_PATH
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => Articles::FILE_URL,
                'path' => Articles::FILE_PATH,
                'uploadOnlyImage' => false
            ],
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => Articles::IMAGES_TEMP_PATH
            ]
        ];
    }

    /**
     * Список статей
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $statusArray = Articles::getStatusArray();

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
     * Создание статьи
     * @return array|string|Response
     */
    public function actionCreate()
    {
        $model = new Articles(['scenario' => 'admin-create']);
        $statusArray = Articles::getStatusArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'Не удалось сохранить статью. Попробуйте пожалуйста еще раз!'));
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
     * Обновление статьи
     * @param $id
     * @return array|string|Response
     * @throws HttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin-update');
        $statusArray = Articles::getStatusArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'Не удалось обновить статью. Попробуйте пожалуйста еще раз!'));
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
     * Поиск статьи по id
     * @param $id
     * @throws HttpException
     */
    protected function findModel($id)
    {
        if (is_array($id)) {
            $model = Articles::findAll($id);
        } else {
            $model = Articles::findOne($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }

    /**
     * Удаление статьи
     * @param $id
     * @return Response
     * @throws HttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Удаление статей
     * @throws HttpException
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
