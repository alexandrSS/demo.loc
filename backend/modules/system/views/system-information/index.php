<?php

use backend\modules\users\models\User;
use backend\modules\system\controllers\SystemInfo;

$this->title = Yii::t('system', 'System Information');

$this->registerJsFile('/backend/js/system-information/index.js', ['depends'=>['\yii\web\JqueryAsset', '\backend\assets\Flot', '\yii\bootstrap\BootstrapPluginAsset']]) ?>
<div id="system-information-index">
    <div class="row connectedSortable">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('system', 'Processor') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('system', 'Processor') ?></dt>
                        <dd><?= SystemInfo::getCpuinfo('model name') ?></dd>

                        <dt><?= Yii::t('system', 'Processor Architecture') ?></dt>
                        <dd><?= SystemInfo::getArchitecture() ?></dd>

                        <dt><?= Yii::t('system', 'Number of cores') ?></dt>
                        <dd><?= SystemInfo::getCpuCores() ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('system', 'Operating System') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('system', 'OS') ?></dt>
                        <dd><?= SystemInfo::getOS() ?></dd>

                        <?php if(!SystemInfo::getIsWindows()): ?>
                            <dt><?= Yii::t('system', 'OS Release') ?></dt>
                            <dd><?= SystemInfo::getLinuxOSRelease() ?></dd>

                            <dt><?= Yii::t('system', 'Kernel version') ?></dt>
                            <dd><?= SystemInfo::getLinuxKernelVersion() ?></dd>
                        <?php endif; ?>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('system', 'Network') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('system', 'Hostname') ?></dt>
                        <dd><?= SystemInfo::getHostname() ?></dd>

                        <dt><?= Yii::t('system', 'Internal IP') ?></dt>
                        <dd><?= SystemInfo::getServerIP() ?></dd>

                        <dt><?= Yii::t('system', 'External IP') ?></dt>
                        <dd><?= SystemInfo::getExternalIP() ?></dd>

                        <dt><?= Yii::t('system', 'Port') ?></dt>
                        <dd><?= $_SERVER['REMOTE_PORT'] ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('system', 'Software') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('system', 'Web Server') ?></dt>
                        <dd><?= SystemInfo::getServerSoftware() ?></dd>

                        <dt><?= Yii::t('system', 'PHP Version') ?></dt>
                        <dd><?= SystemInfo::getPhpVersion() ?></dd>

                        <dt><?= Yii::t('system', 'DB Type') ?></dt>
                        <dd><?= SystemInfo::getDbType(Yii::$app->db->pdo) ?></dd>

                        <dt><?= Yii::t('system', 'DB Version') ?></dt>
                        <dd><?= SystemInfo::getDbVersion(Yii::$app->db->pdo) ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('system', 'Memory') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('system', 'Total memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalMem()) ?></dd>

                        <dt><?= Yii::t('system', 'Free memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeMem()) ?></dd>

                        <dt><?= Yii::t('system', 'Total Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalSwap()) ?></dd>

                        <dt><?= Yii::t('system', 'Free Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeSwap()) ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?= Yii::t('system', '{uptime, duration}', ['uptime'=>SystemInfo::getUptime()]) ?>
                    </h3>
                    <p>
                        <?= Yii::t('system', 'Uptime') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="small-box-footer">
                    &nbsp;
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?= SystemInfo::getLoadAverage(5) ?>
                    </h3>
                    <p>
                        <?= Yii::t('system', 'Load average') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <div class="small-box-footer">
                    &nbsp;
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?= User::find()->count() ?>
                    </h3>
                    <p>
                        <?= Yii::t('system', 'User Registrations') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl(['/user/index']) ?>" class="small-box-footer">
                    <?= Yii::t('system', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?//= trntv\filekit\storage\models\FileStorageItem::find()->count() ?>
                    </h3>
                    <p>
                        <?= Yii::t('system', 'Files in storage') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl(['/file-storage/index']) ?>" class="small-box-footer">
                    <?= Yii::t('system', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <?= $this->render('_cpu.php')?>

    <?= $this->render('_memory.php')?>


</div>