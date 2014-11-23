<?php

namespace backend\controllers;

use backend\components\Controller;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class SiteMapController
 * @package backend\controllers
 */
class SecurityController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['bcSecurityIndex']
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $messagePart1 = 'Сообщение';
        $key = 'key';
        $ctx = new \backend\helpers\AES\Context\ECB($key);
        $ctr = new \backend\helpers\AES\Mode\ECB();
        $cipherText = $ctr->encrypt($ctx, $messagePart1);

        return $this->render(
                'index',
                [
                    'cipherText' => $cipherText
                ]
            );
    }
}
/*// Instantiate a context
$ctx = new AES\Context\CTR($key, $nonce);

// Instantiate a cipher mode
$ctr = new AES\Mode\CTR();

// Encrypt / decrypt a message
$cipherText = $ctr->encrypt($ctx, $messagePart1);

// Encrypt / decrypt more of a message
$cipherText .= $ctr->encrypt($ctx, $messagePart2);*/