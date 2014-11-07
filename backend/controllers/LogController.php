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
        $behaviors['verbs']=[
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
                'clear' => ['post'],
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

        if (strcasecmp(Yii::$app->request->method, 'delete') == 0) {
            SystemLog::deleteAll($dataProvider->query->where);
        }
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
}
