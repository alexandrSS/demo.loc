<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pages;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер вывода страниц
 * Class PagesController
 * @package frontend\controllers
 */
class PagesController extends Controller
{
    /**
     * Вывод страницы
     * @param $alias
     * @return string
     */
    public function actionView($alias)
    {
        $model = self::findModel($alias);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alias)
    {
        if (($model = Pages::find()->where(['alias' => $alias])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
