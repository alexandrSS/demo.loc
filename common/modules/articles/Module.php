<?php

namespace common\modules\articles;

use Yii;

/**
 * Module [[Articles]]
 * Yii2 articles module.
 */
class Module extends \yii\base\Module
{
    /**
     * @var integer Posts per page
     */
    public $recordsPerPage = 20;

    /**
     * @var boolean Whether posts need to be moderated before publishing
     */
    public $moderation = true;

    /**
     * @var string Preview path
     */
    public $previewPath = '@statics/web/articles/previews/';

    /**
     * @var string Image path
     */
    public $imagePath = '@statics/web/articles/images/';

    /**
     * @var string Files path
     */
    public $filePath = '@statics/web/articles/files';

    /**
     * @var string Files path
     */
    public $contentPath = '@statics/web/articles/content';

    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/articles/images/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/articles/previews';

    /**
     * @var string Image URL
     */
    public $imageUrl = '/statics/articles/images';

    /**
     * @var string Files URL
     */
    public $fileUrl = '/statics/articles/files';

    /**
     * @var string Files URL
     */
    public $contentUrl = '/statics/articles/content';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
