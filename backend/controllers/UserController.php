<?php

namespace backend\controllers;

use backend\components\Controller;
use backend\models\search\UserSearch;
use backend\models\User;
use common\models\Profile;
use common\widget\fileapi\actions\UploadAction as FileAPIUpload;
use Yii;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Контроллер управления пользователями
 * Class UserController
 * @package backend\controllers
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['bcUserIndex']
            ],
            [
                'allow' => true,
                'actions' => ['create','fileapi-upload'],
                'roles' => ['bcUserCreate']
            ],
            [
                'allow' => true,
                'actions' => ['update'],
                'roles' => ['bcUserUpdate','fileapi-upload']
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['bcUserDelete','fileapi-upload']
            ],
            [
                'allow' => true,
                'actions' => ['bach-delete'],
                'roles' => ['bcUserBatchDelete','fileapi-upload']
            ],
            [
                'allow' => false,
            ]
        ];
        $behaviors['verbs']=[
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'create' => ['get', 'post'],
                'update' => ['get', 'put', 'post'],
                'delete' => ['post', 'delete'],
                'batch-delete' => ['post', 'delete']
            ]
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => User::AVATARS_TEMP_PATH
            ]
        ];
    }

    /**
     * Список пользователей
     * @return string
     */
    function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * Создание пользователя
     * @return array|string|Response
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'admin-create']);
        $profile = new Profile();
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);
                if ($user->save(false)) {
                    return $this->redirect(['update', 'id' => $user->id]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'Не удалось сохранить пользователя. Попробуйте пожалуйста еще раз!'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render(
            'create',
            [
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * Обновление пользователя
     * @param $id
     * @return array|string|Response
     * @throws HttpException
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $user->setScenario('admin-update');
        $profile = $user->profile;
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);
                if (!$user->save(false)) {
                    Yii::$app->session->setFlash('danger', Yii::t('backend', 'Не удалось обновить пользователя. Попробуйте пожалуйста еще раз!'));
                }
                return $this->refresh();
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render(
            'update',
            [
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]
        );
    }

    /**
     * @param $id
     * @throws HttpException
     */
    protected function findModel($id)
    {
        if (is_array($id)) {
            $model = User::findIdentities($id);
        } else {
            $model = User::findIdentity($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }

    /**
     * @param $id
     * @return Response
     * @throws HttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Delete multiple users page.
     */
    public function actionBatchDelete()
    {
        if (($ids = Yii::$app->request->post('ids')) !== null) {
            $models = $this->findModel($ids);
            foreach ($models as $model) {
                $model->delete();
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }
}
