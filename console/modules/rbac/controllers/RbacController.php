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

        // Roles
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $groupRule->name;
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Админ';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $superadmin = $auth->createRole('superadmin');
        $superadmin->description = 'Супер-Админ';
        $superadmin->ruleName = $groupRule->name;
        $auth->add($superadmin);
        $auth->addChild($superadmin, $admin);

        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($superadmin, $id);
        }
    }
}
