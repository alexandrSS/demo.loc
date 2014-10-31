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
class ArticlesCategoryController extends Controller
{
    /**
     * @param $id
     * @param $alias
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionView($alias)
    {
        if (($model = ArticlesCategory::findOne(['alias' => $alias])) !== null) {

            if(($model = Articles::findOne(['alias' => $alias])) !== null){

                return $this->render(
                    'view',
                    [
                        'model' => $model
                    ]
                );
            }


        } else {
            throw new HttpException(404);
        }
    }
}
