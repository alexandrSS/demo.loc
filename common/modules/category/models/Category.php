<?php

namespace common\modules\category\models;

//use common\behaviors\PurifierBehavior;
use common\behaviors\NestedSet;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $title
 * @property string $alias
 * @property integer $view_id
 * @property integer $status_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 */
class Category extends \yii\db\ActiveRecord
{

    /**
     * Unpublished status
     */
    const STATUS_UNPUBLISHED = 0;
    /**
     * Published status
     */
    const STATUS_PUBLISHED = 1;
    /**
     * Top menu
     */
    const VIEW_TOP = 1;
    /**
     * Left menu
     */
    const VIEW_LEFT = 2;
    /**
     * Right menu
     */
    const VIEW_RIGHT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
/*            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],*/
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias'
            ],
/*            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
                    self::EVENT_BEFORE_VALIDATE => ['title', 'alias']
                ]
            ],*/
            'nestedSet' => [
                'class' => NestedSet::className (),
                'hasManyRoots' => TRUE
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['title', 'view_id', 'status_id'],'required'],
            // Trim
            [['title'],'trim'],
            // Integer
            [['view_id', 'status_id'], 'integer'],
            // String
            [['title', 'alias', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('category', 'ID'),
            'root' => Yii::t('category', 'Root'),
            'lft' => Yii::t('category', 'Lft'),
            'rgt' => Yii::t('category', 'Rgt'),
            'level' => Yii::t('category', 'Level'),
            'title' => Yii::t('category', 'Title'),
            'alias' => Yii::t('category', 'Alias'),
            'view_id' => Yii::t('category', 'View'),
            'status_id' => Yii::t('category', 'Status'),
            'meta_title' => Yii::t('category', 'Meta Title'),
            'meta_description' => Yii::t('category', 'Meta Description'),
            'meta_keywords' => Yii::t('category', 'Meta Keywords'),
        ];
    }
    /**
     * @return array Status array.
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_UNPUBLISHED => Yii::t('category', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Yii::t('category', 'STATUS_PUBLISHED')
        ];
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
     * @return array
     */
    public static function getViewArray()
    {
        return [
            self::VIEW_TOP => Yii::t('category', 'VIEW_TOP_MENU'),
            self::VIEW_LEFT => Yii::t('category', 'VIEW_LEFT_MENU'),
            self::VIEW_RIGHT => Yii::t('category', 'VIEW_RIGHT_MENU'),
        ];
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        $views = self::getViewArray();
        return $views[$this->view_id];
    }

    public function getRoot()
    {
    }

    /**
     * @return CategoryQuery
     */
    public static function createQuery()
    {
        return new CategoryQuery(['modelClass' => get_called_class()]);
    }
}
