<?php

use backend\models\User;
use backend\helpers\SystemInfo;
use backend\themes\admin\widgets\GridView;
use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Информация о системе');

$this->registerJsFile('/backend/js/system-information/index.js', ['depends' => ['\yii\web\JqueryAsset', '\backend\assets\Flot', '\yii\bootstrap\BootstrapPluginAsset']]);

?>
<div id="system-information-index">
<div class="row connectedSortable">
    <div class="col-lg-6 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>

                <h3 class="box-title"><?= Yii::t('backend', 'Процессор') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'Процессор') ?></dt>
                    <dd><?= SystemInfo::getCpuinfo('model name') ?></dd>

                    <dt><?= Yii::t('backend', 'Архетиктура процессора') ?></dt>
                    <dd><?= SystemInfo::getArchitecture() ?></dd>

                    <dt><?= Yii::t('backend', 'Кол-во ядер') ?></dt>
                    <dd><?= SystemInfo::getCpuCores() ?></dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>

                <h3 class="box-title"><?= Yii::t('backend', 'Операционная система') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'ОС') ?></dt>
                    <dd><?= SystemInfo::getOS() ?></dd>

                    <?php if (!SystemInfo::getIsWindows()): ?>
                        <dt><?= Yii::t('backend', 'Версия ОС') ?></dt>
                        <dd><?= SystemInfo::getLinuxOSRelease() ?></dd>

                        <dt><?= Yii::t('backend', 'Версия ядра') ?></dt>
                        <dd><?= SystemInfo::getLinuxKernelVersion() ?></dd>
                    <?php endif; ?>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="box-title"><?= Yii::t('backend', 'Время') ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'Системная дата') ?></dt>
                    <dd><?= Yii::$app->formatter->asDate(time()) ?></dd>

                    <dt><?= Yii::t('backend', 'Системное время') ?></dt>
                    <dd><?= Yii::$app->formatter->asTime(time()) ?></dd>

                    <dt><?= Yii::t('backend', 'Временая зона') ?></dt>
                    <dd><?= date_default_timezone_get() ?></dd>
                </dl>
            </div><!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-4 col-xs-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>

                <h3 class="box-title"><?= Yii::t('backend', 'Сеть') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'Имя хоста') ?></dt>
                    <dd><?= SystemInfo::getHostname() ?></dd>

                    <dt><?= Yii::t('backend', 'ВнутреннийIP') ?></dt>
                    <dd><?= SystemInfo::getServerIP() ?></dd>

                    <dt><?= Yii::t('backend', 'Внешний IP') ?></dt>
                    <dd><?= SystemInfo::getExternalIP() ?></dd>

                    <dt><?= Yii::t('backend', 'Порт') ?></dt>
                    <dd><?= $_SERVER['REMOTE_PORT'] ?></dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-4 col-xs-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>

                <h3 class="box-title"><?= Yii::t('backend', 'ПО') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'WEB Сервер') ?></dt>
                    <dd><?= SystemInfo::getServerSoftware() ?></dd>

                    <dt><?= Yii::t('backend', 'PHP Версия') ?></dt>
                    <dd><?= SystemInfo::getPhpVersion() ?></dd>

                    <dt><?= Yii::t('backend', 'Тип БД') ?></dt>
                    <dd><?= SystemInfo::getDbType(Yii::$app->db->pdo) ?></dd>

                    <dt><?= Yii::t('backend', 'Версия БД') ?></dt>
                    <dd><?= SystemInfo::getDbVersion(Yii::$app->db->pdo) ?></dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-4 col-xs-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-hdd-o"></i>

                <h3 class="box-title"><?= Yii::t('backend', 'Память') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= Yii::t('backend', 'Общая память') ?></dt>
                    <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalMem()) ?></dd>

                    <dt><?= Yii::t('backend', 'Свободно памяти') ?></dt>
                    <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeMem()) ?></dd>

                    <dt><?= Yii::t('backend', 'Всего Swap') ?></dt>
                    <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalSwap()) ?></dd>

                    <dt><?= Yii::t('backend', 'Свободно Swap') ?></dt>
                    <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeSwap()) ?></dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?= Yii::t('backend', '{uptime, duration}', ['uptime' => SystemInfo::getUptime()]) ?>
                </h3>

                <p>
                    <?= Yii::t('backend', 'Uptime') ?>
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-clock-o"></i>
            </div>
            <div class="small-box-footer">
                &nbsp;
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?= SystemInfo::getLoadAverage(5) ?>
                </h3>

                <p>
                    <?= Yii::t('backend', 'Средняя нагрузка') ?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <div class="small-box-footer">
                &nbsp;
            </div>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    <?= User::find()->count() ?>
                </h3>

                <p>
                    <?= Yii::t('backend', 'Регистраций') ?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/user/index']) ?>" class="small-box-footer">
                <?= Yii::t('backend', 'Подробнее') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <? //= trntv\filekit\storage\models\FileStorageItem::find()->count() ?>
                </h3>

                <p>
                    <?= Yii::t('backend', 'Файлов в хранилище') ?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/file-storage/index']) ?>" class="small-box-footer">
                <?= Yii::t('backend', 'Подробнее') ?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>

<?= $this->render('_cpu.php') ?>

<?= $this->render('_memory.php') ?>


</div>