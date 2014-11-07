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

        return array_merge(
            $behaviors,
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ]
        );
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

    public function actionsBatchDelete()
    {
        $searchModel = new SystemEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        SystemEvent::deleteAll($dataProvider->query->where);
        $this->redirect('index');
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
     * Создает новую модель SystemEvent.
     * Если создано успешно, перенапровляет на действие 'view'
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SystemEvent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Обновляет существующию модель SystemEvent.
     * Если обновлено успешно, перенапровляет на действие 'view'
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
}
