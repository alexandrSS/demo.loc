<?php

namespace frontend\controllers;

use frontend\models\Articles;
use frontend\models\ArticlesCategory;
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
     * @return string
     */
    function actionCategory($category)
    {
        $articleCategory = ArticlesCategory::find()->where(['alias' => $category])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Articles::find()->category($articleCategory['id']),
            'pagination' => [
                'pageSize' => Articles::RECORDS_PER_PAGE
            ]
        ]);

        return $this->render(
            'category',
            [
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * @param $id
     * @param $alias
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionView($alias)
    {
        if (($model = Articles::findOne(['alias' => $alias])) !== null) {
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
