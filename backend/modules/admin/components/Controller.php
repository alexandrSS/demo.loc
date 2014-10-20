<?php

namespace backend\modules\admin\components;

use yii\filters\AccessControl;
use Yii;

/**
 * Main backend controller.
 */
class Controller extends \yii\web\Controller
{
    /////////////////////////////////////////////////////

    /**
     * @var array the default query params for the index view
     */
    var $defaultQueryParams = ['status' => 'Active'];
    /**
     * @var ActiveRecord the search model
     */
    var $searchModel;
    /**
     * @var \yii\data\ActiveDataProvider the data provider for the index, pdf, csv
     */
    var $dataProvider;
    /////////////////////////////////////////////////////
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superadmin', 'admin']
                    ]
                ]
            ]
        ];
    }


////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Gets the simple name for the current controller
     * @return string
     */
    public function getCompatibilityId()
    {
        $controller = $this->getUniqueId();
        if (strpos($controller, "/")) {
            $controller = substr($controller, strpos($controller, "/") + 1);
        }
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $controller)));
    }

    /**
     * creates the search criteria for the model
     * @return null
     */
    public function getSearchCriteria()
    {
        /* setting the default pagination for the page */
        if (!Yii::$app->session->get($this->MainModel . 'Pagination')) {
            Yii::$app->session->set($this->MainModel . 'Pagination', 10);
        }
        $savedQueryParams = Yii::$app->session->get($this->MainModel . 'QueryParams');
        if (count($savedQueryParams)) {
            $queryParams = $savedQueryParams;
        } else {
            $queryParams = [substr($this->MainModelSearch, strrpos($this->MainModelSearch, "\\") + 1) => $this->defaultQueryParams];
        }
        /* use the same filters as before */
        if (count(Yii::$app->request->queryParams)) {
            $queryParams = array_merge($queryParams, Yii::$app->request->queryParams);
        }

        if (isset($queryParams['page'])) {
            $_GET['page'] = $queryParams['page'];
        }
        if (Yii::$app->request->getIsPjax()) {
            $this->layout = false;
        }
        Yii::$app->session->set($this->MainModel . 'QueryParams', $queryParams);
        $this->searchModel = new $this->MainModelSearch;
        $this->dataProvider = $this->searchModel->search($queryParams);
    }
///////////////////////////////////////////////////////////////
}
