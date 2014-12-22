<?php

namespace backend\controllers;

use backend\components\Controller;
use backend\models\SecurityForm;
use Yii;
use yii\web\UploadedFile;
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
            [
                'allow' => true,
                'actions' => ['encrypt'],
                'roles' => ['bcSecurityEncrypt']
            ],
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['bcSecurityDecrypt']
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


    public function actionEncrypt()
{
    $model = new SecurityForm();

    if ($model->load(Yii::$app->request->post())) {
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->validate()) {
            $dir = Yii::getAlias('@statics/security');
            $model->file->saveAs($dir . '/' . $model->file->baseName . '.' . $model->file->extension);

            //<a href="/statics/articles/files/549865c1dc0ed.txt">549865c1dc0ed.txt</a>

            $href = '<a href="' . $dir . '/' . $model->file->baseName . '.' . $model->file->extension . '">' . $model->file->baseName . '.' . $model->file->extension . '</a>';

            return $this->render('encrypt', [
                'model' => $model,
                'href' => $href
            ]);
        }
    }

    return $this->render('encrypt', [
        'model' => $model,
    ]);
}


    /**
     * @return string
     */
    public function actionIndex()
    {
/*        $messagePart = 'Сообщение';
        $key = '111111111111111111111111';

        $ctx = new \backend\helpers\AES\Context\ECB($key);
        $ctr = new \backend\helpers\AES\Mode\ECB();

        $count = strlen($messagePart);
        $i = $count % 8;
        $i = 8 - $i;
        $messagePart = str_pad($messagePart, $i);

        $cipherText = $ctr->encrypt($ctx, $messagePart);
        $cipherText1 = $ctr->decrypt($ctx, $cipherText);*/

        return $this->render(
                'index',
                [
/*                    'cipherText' => $cipherText,
                    'cipherText1' => $cipherText1,*/
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