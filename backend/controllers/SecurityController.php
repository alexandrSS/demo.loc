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
                'roles' => ['bcSecurityIndex']
            ],
            [
                'allow' => true,
                'actions' => ['decrypt'],
                'roles' => ['bcSecurityIndex']
            ],
            [
                'allow' => true,
                'actions' => ['download'],
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


    public function actionEncrypt()
    {
        $model = new SecurityForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $dir = Yii::getAlias('@statics');
                $model->file->saveAs($dir . '/web/' . $model->file->baseName . '.encrypt.' . $model->file->extension);

                $messagePart = file_get_contents($dir . '/web/' . $model->file->baseName . '.encrypt.' . $model->file->extension);

                $ctx = new \backend\helpers\AES\Context\ECB($model->key);
                $ctr = new \backend\helpers\AES\Mode\ECB();

                $countText = strlen($messagePart);

                $i = $countText % 8;

                if($i > 0)
                    $i = 8 - $i;

                $a = $i + $countText;
                $messagePart = str_pad($messagePart, $i);



                $cipherText = $ctr->encrypt($ctx, $messagePart);

                file_put_contents($dir . '/web/' . $model->file->baseName . '.encrypt.' . $model->file->extension, $cipherText);

                return $this->render('encrypt', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('encrypt', [
            'model' => $model,
        ]);
    }

    public function actionDecrypt()
    {
        $model = new SecurityForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $dir = Yii::getAlias('@statics');
                $model->file->saveAs($dir . '/web/' . $model->file->baseName . '.decrypt.' . $model->file->extension);

                $messagePart = file_get_contents('C:/wamp/www/demo.loc/statics/web/' . $model->file->baseName . '.decrypt.' . $model->file->extension);

                $ctx = new \backend\helpers\AES\Context\ECB($model->key);
                $ctr = new \backend\helpers\AES\Mode\ECB();
                $cipherText = $ctr->decrypt($ctx, $messagePart);

                file_put_contents('C:/wamp/www/demo.loc/statics/web/' . $model->file->baseName . '.decrypt.' . $model->file->extension, $cipherText);

                return $this->render('decrypt', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('decrypt', [
            'model' => $model,
        ]);
    }


    public function actionDownload($file)
    {
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }
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