<?php

namespace backend\controllers;

use backend\components\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * Системная информация
 * Class SystemInformationController
 * @package backend\controllers
 */
class SystemInformationController extends Controller
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
                        'index' => ['get'],
                    ],
                ],
            ]
        );
    }
    /**
     * @return array|float|string
     */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if ($key = \Yii::$app->request->get('data')) {
                switch ($key) {
                    case 'cpu_usage':
                        return SystemInfo::getCpuUsage(1);
                        break;
                    case 'memory_usage':
                        return (SystemInfo::getTotalMem() - SystemInfo::getFreeMem()) / SystemInfo::getTotalMem();
                        break;
                }
            }
        } else {
            return $this->render('index');
        }
    }
} 