<?php

namespace backend\controllers;

use backend\components\Controller;
use backend\models\search\SystemLogSearch;
use backend\models\SystemLog;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Контроллер управленя ошибками и предупреждениями
 * Class LogController
 * @package backend\controllers
 */
class LogController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['bcLogIndex']
            ],
            [
                'allow' => true,
                'actions' => ['view'],
                'roles' => ['bcLogView']
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['bcLogDelete']
            ],
            [
                'allow' => true,
                'actions' => ['all-delete'],
                'roles' => ['bcLogBatchDelete']
            ],
            [
                'allow' => false,
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get'],
                'delete' => ['post', 'delete'],
                'all-delete' => ['get', 'delete']
            ],
        ];

        return $behaviors;
    }

    /**
     * Список всех ошибок и предупреждений
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['log_time' => SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Вывод ошибки или предупреждения
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Поиск модели
     * @param $id
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = SystemLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Удаление всех ошибок и предупреждений
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Удаляет все
     */
    public function actionAllDelete()
    {
        $searchModel = new SystemLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        SystemLog::deleteAll($dataProvider->query->where);

        $this->redirect('index');
    }
}
