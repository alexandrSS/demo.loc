<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\models\SystemLog;
use backend\models\SystemEvent;

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('//layouts/head') ?>
    </head>
    <body class="skin-blue">
    <?php $this->beginBody(); ?>

        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?= Yii::$app->name ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?= Yii::t('themes', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li id="notifications-dropdown" class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                        <span class="badge bg-green">
                            <?= SystemEvent::find()->today()->count() ?>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
                                    <?= Yii::t('themes', 'You have {num} events', ['num'=>SystemEvent::find()->today()->count()]) ?>
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach(SystemEvent::find()->today()->orderBy(['event_time'=>SORT_DESC])->limit(10)->all() as $eventRecord): ?>
                                            <li>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/system-event/view', 'id'=>$eventRecord->id]) ?>">
                                                    <i class="fa fa-bell"></i>
                                                    <?= $eventRecord->getName() ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <?= Html::a(Yii::t('themes', 'View all'), ['/system-event/index']) ?>
                                </li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li id="log-dropdown" class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                        <span class="badge bg-red">
                            <?= SystemLog::find()->count() ?>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?= Yii::t('themes', 'You have {num} log items', ['num'=>SystemLog::find()->count()]) ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach(SystemLog::find()->orderBy(['log_time'=>SORT_DESC])->limit(5)->all() as $logEntry): ?>
                                            <li>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['/log/view', 'id'=>$logEntry->id]) ?>">
                                                    <i class="fa fa-warning <?= $logEntry->level == \yii\log\Logger::LEVEL_ERROR ? 'bg-red' : 'bg-yellow' ?>"></i>
                                                    <?= $logEntry->category ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <?= Html::a(Yii::t('themes', 'View all'), ['/log/index']) ?>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= Yii::$app->user->identity->profile->fullName ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php if (Yii::$app->user->identity->profile->avatar_url) : ?>
                                        <?= Html::img(Yii::$app->user->identity->profile->urlAttribute('avatar_url'), ['class' => 'img-circle', 'alt' => Yii::$app->user->identity->username]) ?>
                                    <?php endif; ?>
                                    <p>
                                        <?= Yii::$app->user->identity->profile->fullName ?> - <?= Yii::$app->user->identity->role ?>
                                        <small><?= Yii::t('themes', 'Member since') ?> <?= Yii::$app->user->identity->created ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?= Html::a(
                                            Yii::t('themes', 'Profile'),
                                            ['/user/update', 'id' => Yii::$app->user->id],
                                            ['class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a(
                                            Yii::t('themes', 'Sign out'),
                                            ['/login/logout'],
                                            ['class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <?php if (Yii::$app->user->identity->profile->avatar_url) : ?>
                            <div class="pull-left image">
                                <?= Html::img(Yii::$app->user->identity->profile->urlAttribute('avatar_url'), ['class' => 'img-circle', 'alt' => Yii::$app->user->identity->username]) ?>
                            </div>
                        <?php endif; ?>
                        <div class="pull-left info">
                            <p>
                                <?= Yii::t('themes', 'Hello, {name}', ['name' => Yii::$app->user->identity->profile->name]) ?>
                            </p>
                            <a>
                                <i class="fa fa-circle text-success"></i>
                                <?= Yii::$app->formatter->asDatetime(time()) ?>
                            </a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?= $this->render('//layouts/sidebar-menu') ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $this->title ?>
                        <?php if (isset($this->params['subtitle'])) : ?>
                            <small><?= $this->params['subtitle'] ?></small>
                        <?php endif; ?>
                    </h1>
                    <?= Breadcrumbs::widget(
                        [
                            'homeLink' => [
                                'label' => '<i class="fa fa-dashboard"></i> ' . Yii::t('themes', 'Home'),
                                'url' => '/'
                            ],
                            'encodeLabels' => false,
                            'tag' => 'ol',
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                        ]
                    ) ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?= $content ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>