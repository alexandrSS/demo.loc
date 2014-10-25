<?php

namespace frontend\models;

use Yii;

/**
 * Class Articless
 * @package vova07\articless\models\frontend
 * Articles model.
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
     * @var string Created date
     */
    private $_created;

    /**
     * @var string Updated date
     */
    private $_updated;

    /**
     * @return string Created date
     */
    public function getCreated()
    {
        if ($this->_created === null) {
            $this->_created = Yii::$app->formatter->asDate($this->created_at);
        }
        return $this->_created;
    }

    /**
     * @return string Updated date
     */
    public function getUpdated()
    {
        if ($this->_updated === null) {
            $this->_updated = Yii::$app->formatter->asDate($this->updated_at);
        }
        return $this->_updated;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['title', 'snippet', 'content', 'preview_url', 'image_url'];
        $scenarios['update'] = ['title', 'snippet', 'content', 'preview_url', 'image_url'];

        return $scenarios;
    }
}
