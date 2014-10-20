<div class="row">
    <div class="col-xs-12">
        <div id="memory-usage" class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    <?= Yii::t('system', 'Memory Usage') ?>
                </h3>
                <div class="box-tools pull-right">
                    <?= Yii::t('system', 'Real time') ?>
                    <div class="btn-group realtime" data-toggle="btn-toggle">
                        <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                            <?= Yii::t('system', 'On') ?>
                        </button>
                        <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                            <?= Yii::t('system', 'Off') ?>
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="chart" style="height: 300px;">
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>