<?php

namespace frontend\controllers;

use frontend\models\Articles;
use frontend\models\ArticlesCategory;
use Yii;
use yii\web\Cookie;
use yii\web\Controller;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;

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
                'category' => $category
            ]
        );
    }

    /**
     * @param $alias
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionView($alias)
    {
        if (($model = Articles::findOne(['alias' => $alias])) !== null) {
            $this->counter($model);
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
    /**
     * Update blog views counter.
     *
     * @param Articles $model Model
     */
    protected function counter($model)
    {
        $cookieName = 'articles-views';
        $shouldCount = false;
        $views = Yii::$app->request->cookies->getValue($cookieName);

        if ($views !== null) {
            if (is_array($views)) {
                if (!in_array($model->id, $views)) {
                    $views[] = $model->id;
                    $shouldCount = true;
                }
            } else {
                $views = [$model->id];
                $shouldCount = true;
            }
        } else {
            $views = [$model->id];
            $shouldCount = true;
        }

        if ($shouldCount === true) {
            if ($model->updateViews()) {
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => $cookieName,
                    'value' => $views,
                    'expire' => time() + 86400 * 365
                ]));
            }
        }
    }
}
