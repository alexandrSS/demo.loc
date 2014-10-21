<?php

namespace backend\controllers;

use Yii;
use backend\models\ArticlesCategory;
use backend\models\search\ArticlesCategorySearch;
use backend\components\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ArticlesCategoryController implements the CRUD actions for ArticlesCategory model.
 */
class ArticlesCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'create' => ['get', 'post'],
                    'update' => ['get', 'put', 'post'],
                    'delete' => ['post', 'delete'],
                    'batch-delete' => ['post', 'delete']
                ],
            ],
        ];
    }

    /**
     * Lists all ArticlesCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $parentList = ArticlesCategory::getParentListArray();
        $statusArray = ArticlesCategory::getStatusArray();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parentList' => $parentList,
            'statusArray' => $statusArray
        ]);
    }

    /**
     * Creates a new ArticlesCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticlesCategory(['scenario' => 'admin-create']);
        $statusArray = ArticlesCategory::getStatusArray();
        $parentList = ArticlesCategory::getParentListArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
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
                'statusArray' => $statusArray,
                'parentList' => $parentList,
            ]
        );
    }

    /**
     * Updates an existing ArticlesCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin-update');
        $statusArray = ArticlesCategory::getStatusArray();
        $parentList = ArticlesCategory::getParentListArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'BACKEND_FLASH_FAIL_ADMIN_UPDATE'));
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
                'statusArray' => $statusArray,
                'parentList' => $parentList,
            ]
        );
    }

    /**
     * Find model by ID.
     *
     * @param integer|array $id Post ID
     *
     * @return \vova07\Articless\models\backend\Articles Model
     *
     * @throws HttpException 404 error if post not found
     */
    protected function findModel($id)
    {
        if (is_array($id)) {
            /** @var \vova07\Articless\models\backend\Articles $model */
            $model = ArticlesCategory::findAll($id);
        } else {
            /** @var \vova07\Articless\models\backend\Articles $model */
            $model = ArticlesCategory::findOne($id);
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
