<div class="row">
    <div class="col-xs-12">
        <div id="cpu-usage" class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    <?= Yii::t('backend', 'Загрузка процессора') ?>
                </h3>

                <div class="box-tools pull-right">
                    <?= Yii::t('backend', 'В режиме реального времени') ?>
                    <div class="realtime btn-group" data-toggle="btn-toggle">
                        <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                            <?= Yii::t('backend', 'Вскл') ?>
                        </button>
                        <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                            <?= Yii::t('backend', 'Выкл') ?>
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="chart" style="height: 300px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>