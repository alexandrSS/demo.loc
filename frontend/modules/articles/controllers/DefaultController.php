<?php

namespace frontend\modules\articles\controllers;

use frontend\modules\articles\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use Module;

/**
 * Default controller.
 */
class DefaultController extends Controller
{
    /**
     * Articles list page.
     */
    function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->published(),
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider
            ]
        );
    }

    /**
     * Articles page.
     *
     * @param integer $id Articles ID
     * @param string $alias Articles alias
     *
     * @return mixed
     *
     * @throws \yii\web\HttpException 404 if blog was not found
     */
    public function actionView($id, $alias)
    {
        if (($model = Article::findOne(['id' => $id, 'alias' => $alias])) !== null) {
            return $this->render(
                'view',
                [
                    'model' => $model
                ]
            );
        } else {
            throw new HttpException(404);
        }
    }
}
