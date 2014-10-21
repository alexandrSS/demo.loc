<?php

namespace backend\models;

use Yii;

/**
 * Class Article
 * @package backend\models
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
class Articles extends \common\models\Articles
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
            self::STATUS_UNPUBLISHED => Yii::t('backend', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Yii::t('backend', 'STATUS_PUBLISHED')
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
            'title' => Yii::t('backend', 'Название'),
            'alias' => Yii::t('backend', 'Псевдоним'),
            'snippet' => Yii::t('backend', 'Фрагмент'),
            'content' => Yii::t('backend', 'Содержание'),
            'views' => Yii::t('backend', 'Вид'),
            'status_id' => Yii::t('backend', 'Статус'),
            'created_at' => Yii::t('backend', 'Создана'),
            'updated_at' => Yii::t('backend', 'Обнавлена'),
            'preview_url' => Yii::t('backend', 'Предваретельное изображение'),
            'image_url' => Yii::t('backend', 'Основное изображение'),
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
