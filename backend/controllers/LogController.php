<?php

namespace backend\controllers;

use Yii;
use backend\models\SystemLog;
use backend\models\search\SystemLogSearch;
use backend\components\Controller;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogController реализует CRUD действия для модел SystemLog.
 */
class LogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'clear' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Список всех моделеи SystemLog.
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
     * Отображает одну модель SystemLog.
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
     * Удаляет существующию модель SystemLog.
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
     * Finds the SystemLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SystemLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
