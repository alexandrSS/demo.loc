<?php

namespace backend\modules\articles\models;

use Yii;

/**
 * Class Article
 * @package backend\modules\articles\models
 * Article model.
 *
 * @property integer $id ID
 * @property string $title Title
 * @property string $alias Alias
 * @property string $snippet Intro text
 * @property string $content Content
 * @property integer $views Views
 * @property integer $status_id Status
 * @property integer $created_at Created time
 * @property integer $updated_at Updated time
 */
class Article extends \common\modules\articles\models\Article
{
    /**
     * @var string Jui created date
     */
    private $_createdAtJui;

    /**
     * @var string Jui updated date
     */
    private $_updatedAtJui;

    /**
     * @return string Jui created date
     */
    public function getCreatedAtJui()
    {
        if (!$this->isNewRecord && $this->_createdAtJui === null) {
            $this->_createdAtJui = Yii::$app->formatter->asDate($this->created_at, 'Y-m-d');
        }
        return $this->_createdAtJui;
    }

    /**
     * Set jui created date
     */
    public function setCreatedAtJui($value)
    {
        $this->_createdAtJui = $value;
    }

    /**
     * @return string Jui updated date
     */
    public function getUpdatedAtJui()
    {
        if (!$this->isNewRecord && $this->_updatedAtJui === null) {
            $this->_updatedAtJui = Yii::$app->formatter->asDate($this->updated_at, 'Y-m-d');
        }
        return $this->_updatedAtJui;
    }

    /**
     * Set jui created date
     */
    public function setUpdatedAtJui($value)
    {
        $this->_updatedAtJui = $value;
    }

    /**
     * @return string Readable blog status
     */
    public function getStatus()
    {
        $statuses = self::getStatusArray();

        return $statuses[$this->status_id];
    }

    /**
     * @return array Status array.
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_UNPUBLISHED => Yii::t('articles', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Yii::t('articles', 'STATUS_PUBLISHED')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['status_id', 'in', 'range' => array_keys(self::getStatusArray())];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('articles', 'ATTR_ID'),
            'title' => Yii::t('articles', 'ATTR_TITLE'),
            'alias' => Yii::t('articles', 'ATTR_ALIAS'),
            'snippet' => Yii::t('articles', 'ATTR_SNIPPET'),
            'content' => Yii::t('articles', 'ATTR_CONTENT'),
            'views' => Yii::t('articles', 'ATTR_VIEWS'),
            'status_id' => Yii::t('articles', 'ATTR_STATUS'),
            'created_at' => Yii::t('articles', 'ATTR_CREATED'),
            'updated_at' => Yii::t('articles', 'ATTR_UPDATED'),
            'preview_url' => Yii::t('articles', 'ATTR_PREVIEW_URL'),
            'image_url' => Yii::t('articles', 'ATTR_IMAGE_URL'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'alias',
            'snippet',
            'content',
            'status_id',
            'preview_url',
            'image_url',
            'createdAtJui',
            'updatedAtJui'
        ];
        $scenarios['admin-update'] = [
            'title',
            'alias',
            'snippet',
            'content',
            'status_id',
            'preview_url',
            'image_url',
            'createdAtJui',
            'updatedAtJui'
        ];

        return $scenarios;
    }
}
