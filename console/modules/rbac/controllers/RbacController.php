<?php

namespace console\modules\rbac\controllers;

use Yii;
use yii\console\Controller;
use console\modules\rbac\rules\GroupRule;

/**
 * RBAC console controller.
 */
class RbacController extends Controller
{
    /**
     * Initial RBAC action
     * @param integer $id Superadmin ID
     */
    public function actionInit($id = null)
    {
        $auth = Yii::$app->authManager;

        // Rules
        $groupRule = new GroupRule();

        $auth->add($groupRule);

        // Permissions
        // Основной контроллер backend приложенния
        $mainControllerBackend = $auth->createPermission('mainControllerBackend');
        $mainControllerBackend->description = 'Основной контроллер backend приложенния';
        $auth->add($mainControllerBackend);

        // Панель управления
        $bcDefaultController = $auth->createPermission('bcDefaultController');
        $bcDefaultController->description = 'Панель управления';
        $auth->add($bcDefaultController);

        // Категории статей
        $bcArticleCategoryIndex = $auth->createPermission('bcArticleCategoryIndex');
        $bcArticleCategoryIndex->description = 'Список категрорий статей';
        $auth->add($bcArticleCategoryIndex);

        $bcArticleCategoryCreate = $auth->createPermission('bcArticleCategoryCreate');
        $bcArticleCategoryCreate->description = 'Создание категрорий статей';
        $auth->add($bcArticleCategoryCreate);

        $bcArticleCategoryUpdate = $auth->createPermission('bcArticleCategoryUpdate');
        $bcArticleCategoryUpdate->description = 'Обновление категрорий статей';
        $auth->add($bcArticleCategoryUpdate);

        $bcArticleCategoryDelete = $auth->createPermission('bcArticleCategoryDelete');
        $bcArticleCategoryDelete->description = 'Удаление категрори статей';
        $auth->add($bcArticleCategoryDelete);

        $bcArticleCategoryBatchDelete = $auth->createPermission('bcArticleCategoryBatchDelete');
        $bcArticleCategoryBatchDelete->description = 'Удаление категрорий статей';
        $auth->add($bcArticleCategoryBatchDelete);

        // Статьи
        $bcArticleIndex = $auth->createPermission('bcArticleIndex');
        $bcArticleIndex->description = 'Список статей';
        $auth->add($bcArticleIndex);

        $bcArticleCreate = $auth->createPermission('bcArticleCreate');
        $bcArticleCreate->description = 'Создание статей';
        $auth->add($bcArticleCreate);

        $bcArticleUpdate = $auth->createPermission('bcArticleUpdate');
        $bcArticleUpdate->description = 'Обновление статей';
        $auth->add($bcArticleUpdate);

        $bcArticleDelete = $auth->createPermission('bcArticleDelete');
        $bcArticleDelete->description = 'Удаление статьи';
        $auth->add($bcArticleDelete);

        $bcArticleBatchDelete = $auth->createPermission('bcArticleBatchDelete');
        $bcArticleBatchDelete->description = 'Удаление статей';
        $auth->add($bcArticleBatchDelete);

        // Страницы
        $bcPagesIndex = $auth->createPermission('bcPagesIndex');
        $bcPagesIndex->description = 'Список страниц';
        $auth->add($bcPagesIndex);

        $bcPagesCreate = $auth->createPermission('bcPagesCreate');
        $bcPagesCreate->description = 'Создание страниц';
        $auth->add($bcPagesCreate);

        $bcPagesUpdate = $auth->createPermission('bcPagesUpdate');
        $bcPagesUpdate->description = 'Обновление страниц';
        $auth->add($bcPagesUpdate);

        $bcPagesDelete = $auth->createPermission('bcPagesDelete');
        $bcPagesDelete->description = 'Удаление страницы';
        $auth->add($bcPagesDelete);

        $bcPagesBatchDelete = $auth->createPermission('bcPagesBatchDelete');
        $bcPagesBatchDelete->description = 'Удаление страниц';
        $auth->add($bcPagesBatchDelete);

        // Пользователи
        $bcUserIndex = $auth->createPermission('bcUserIndex');
        $bcUserIndex->description = 'Список страниц';
        $auth->add($bcUserIndex);

        $bcUserCreate = $auth->createPermission('bcUserCreate');
        $bcUserCreate->description = 'Создание страниц';
        $auth->add($bcUserCreate);

        $bcUserUpdate = $auth->createPermission('bcUserUpdate');
        $bcUserUpdate->description = 'Обновление страниц';
        $auth->add($bcUserUpdate);

        $bcUserDelete = $auth->createPermission('bcUserDelete');
        $bcUserDelete->description = 'Удаление страницы';
        $auth->add($bcUserDelete);

        $bcUserBatchDelete = $auth->createPermission('bcUserBatchDelete');
        $bcUserBatchDelete->description = 'Удаление страниц';
        $auth->add($bcUserBatchDelete);


        // Roles
        // Пользователь
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $groupRule->name;
        $auth->add($user);

        // Админ
        $admin = $auth->createRole('admin');
        $admin->description = 'Админ';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $mainControllerBackend);
        $auth->addChild($admin, $bcDefaultController);
        $auth->addChild($admin, $bcArticleCategoryIndex);
        $auth->addChild($admin, $bcArticleCategoryCreate);
        $auth->addChild($admin, $bcArticleCategoryUpdate);
        $auth->addChild($admin, $bcArticleIndex);
        $auth->addChild($admin, $bcArticleCreate);
        $auth->addChild($admin, $bcArticleUpdate);
        $auth->addChild($admin, $bcPagesIndex);
        $auth->addChild($admin, $bcPagesCreate);
        $auth->addChild($admin, $bcPagesUpdate);
        $auth->addChild($admin, $bcUserIndex);
        $auth->addChild($admin, $bcUserCreate);
        $auth->addChild($admin, $bcUserUpdate);

        // Супер-Админ
        $superadmin = $auth->createRole('superadmin');
        $superadmin->description = 'Супер-Админ';
        $superadmin->ruleName = $groupRule->name;
        $auth->add($superadmin);
        $auth->addChild($superadmin, $admin);
        $auth->addChild($admin, $bcArticleCategoryDelete);
        $auth->addChild($admin, $bcArticleCategoryBatchDelete);
        $auth->addChild($admin, $bcArticleDelete);
        $auth->addChild($admin, $bcArticleBatchDelete);
        $auth->addChild($admin, $bcPagesDelete);
        $auth->addChild($admin, $bcPagesBatchDelete);
        $auth->addChild($admin, $bcUserDelete);
        $auth->addChild($admin, $bcUserBatchDelete);

        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($superadmin, $id);
        }
    }
}
