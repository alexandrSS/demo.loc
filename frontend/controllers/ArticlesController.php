<?php

namespace frontend\controllers;

use frontend\models\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Контроллер для вывода статей
 * Class ArticlesController
 * @package frontend\controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return string
     */
    function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Articles::find()->published(),
            'pagination' => [
                'pageSize' => Articles::RECORDS_PER_PAGE
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
     * @param $id
     * @param $alias
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionView($id, $alias)
    {
        if (($model = Articles::findOne(['id' => $id, 'alias' => $alias])) !== null) {
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
