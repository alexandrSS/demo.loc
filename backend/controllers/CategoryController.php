<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param null $id
     * @return string|\yii\web\Response
     */
    public function actionIndex($id = null)
    {
        $model = new Category();
        $statusArray = Category::getStatusArray();
        if ($model->load(Yii::$app->request->post('root'))){
            $model->saveNode();
            return $this->redirect('index');
        }
        if($model->load(Yii::$app->request->post())){
            if (isset($_POST['root'])){
                $model->saveNode();
                Yii::$app->response->refresh();
            }
            if (isset($_POST['children'])){
                //$root=Category::findOne($id);
                //$model->prependTo($root);
                //Yii::$app->response->refresh();
            }
        }
        if(isset($id)){
            $root=Category::find()->where(['id'=>$id])->one();
            $model->appendTo($root);
            //return $this->redirect('index');
        }
        $post = Yii::$app->request->post();
        $categories = Category::find()->all();
        return $this->render('index', [
            'model' => $model,
            'categories' => $categories,
            'statusArray' => $statusArray,
            'post' => $post
        ]);
    }

    public function actionCreate($id)
    {
        //$model = new Category();
        return $this->redirect('index');

    }

    /**
     * Displays a single Category model.
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteNode();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
