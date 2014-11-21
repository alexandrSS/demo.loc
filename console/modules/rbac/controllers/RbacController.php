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

        // Комментарии
        $bcCommentsIndex = $auth->createPermission('bcCommentsIndex');
        $bcCommentsIndex->description = 'Список комментариев';
        $auth->add($bcCommentsIndex);

        $bcCommentsDelete = $auth->createPermission('bcCommentsDelete');
        $bcCommentsDelete->description = 'Удаление комментария';
        $auth->add($bcCommentsDelete);

        $bcCommentsBatchDelete = $auth->createPermission('bcCommentsBatchDelete');
        $bcCommentsBatchDelete->description = 'Удаление комментариев';
        $auth->add($bcCommentsBatchDelete);

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

        // События
        $bcSystemEventIndex = $auth->createPermission('bcSystemEventIndex');
        $bcSystemEventIndex->description = 'Список событий';
        $auth->add($bcSystemEventIndex);

        $bcSystemEventView = $auth->createPermission('bcSystemEventView');
        $bcSystemEventView->description = 'Просмотр события';
        $auth->add($bcSystemEventView);

        $bcSystemEventDelete = $auth->createPermission('bcSystemEventDelete');
        $bcSystemEventDelete->description = 'Удаление события';
        $auth->add($bcSystemEventDelete);

        $bcSystemEventBatchDelete = $auth->createPermission('bcSystemEventBatchDelete');
        $bcSystemEventBatchDelete->description = 'Удаление событий';
        $auth->add($bcSystemEventBatchDelete);

        // События
        $bcLogIndex = $auth->createPermission('bcLogIndex');
        $bcLogIndex->description = 'Список событий';
        $auth->add($bcLogIndex);

        $bcLogView = $auth->createPermission('bcLogView');
        $bcLogView->description = 'Просмотр события';
        $auth->add($bcLogView);

        $bcLogDelete = $auth->createPermission('bcLogDelete');
        $bcLogDelete->description = 'Удаление события';
        $auth->add($bcLogDelete);

        $bcLogBatchDelete = $auth->createPermission('bcLogBatchDelete');
        $bcLogBatchDelete->description = 'Удаление событий';
        $auth->add($bcLogBatchDelete);

        // Системная информация
        $bcSystemInformationIndex = $auth->createPermission('bcSystemInformationIndex');
        $bcSystemInformationIndex->description = 'Список событий';
        $auth->add($bcSystemInformationIndex);

        // Карта сайта
        $bcSiteMapIndex = $auth->createPermission('bcSiteMapIndex');
        $bcSiteMapIndex->description = 'Список событий';
        $auth->add($bcSiteMapIndex);



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
        $auth->addChild($admin, $bcCommentsIndex);
        $auth->addChild($admin, $bcUserIndex);
        $auth->addChild($admin, $bcUserCreate);
        $auth->addChild($admin, $bcUserUpdate);
        $auth->addChild($admin, $bcSystemEventIndex);
        $auth->addChild($admin, $bcSystemEventView);
        $auth->addChild($admin, $bcLogIndex);
        $auth->addChild($admin, $bcLogView);
        $auth->addChild($admin, $bcSystemInformationIndex);
        $auth->addChild($admin, $bcSiteMapIndex);

        // Супер-Админ
        $superadmin = $auth->createRole('superadmin');
        $superadmin->description = 'Супер-Админ';
        $superadmin->ruleName = $groupRule->name;
        $auth->add($superadmin);
        $auth->addChild($superadmin, $admin);
        $auth->addChild($superadmin, $bcArticleCategoryDelete);
        $auth->addChild($superadmin, $bcArticleCategoryBatchDelete);
        $auth->addChild($superadmin, $bcArticleDelete);
        $auth->addChild($superadmin, $bcArticleBatchDelete);
        $auth->addChild($superadmin, $bcPagesDelete);
        $auth->addChild($superadmin, $bcPagesBatchDelete);
        $auth->addChild($superadmin, $bcCommentsDelete);
        $auth->addChild($superadmin, $bcCommentsBatchDelete);
        $auth->addChild($superadmin, $bcUserDelete);
        $auth->addChild($superadmin, $bcUserBatchDelete);
        $auth->addChild($superadmin, $bcSystemEventDelete);
        $auth->addChild($superadmin, $bcSystemEventBatchDelete);
        $auth->addChild($superadmin, $bcLogDelete);
        $auth->addChild($superadmin, $bcLogBatchDelete);

        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($superadmin, $id);
        }
    }
}
