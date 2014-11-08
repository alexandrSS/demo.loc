<?php

namespace backend\controllers;

use backend\components\Controller;
use backend\models\search\SystemEventSearch;
use backend\models\SystemEvent;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Контроллер управления событиями
 * Class SystemEventController
 * @package backend\controllers
 */
class SystemEventController extends Controller
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
                'roles' => ['bcSystemEventIndex']
            ],
            [
                'allow' => true,
                'actions' => ['view'],
                'roles' => ['bcSystemEventView']
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['bcSystemEventDelete']
            ],
            [
                'allow' => true,
                'actions' => ['batch-delete'],
                'roles' => ['bcSystemEventBatchDelete']
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
                'batch-delete' => ['get', 'delete']
            ],
        ];

        return $behaviors;
    }

    /**
     * Список всех моделеи SystemEvent.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['event_time' => SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Отображает одну модель SystemEvent.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the SystemEvent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SystemEvent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemEvent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Удаляет существующию модель SystemEvent.
     * Если удаление прошло успешно, перенаправляется на действие 'index'.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Удаляет все
     */
    public function actionBatchDelete()
    {
        $searchModel = new SystemEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        SystemEvent::deleteAll($dataProvider->query->where);

        $this->redirect('index');
    }
}
