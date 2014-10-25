<?php

namespace common\models;

use common\behaviors\PurifierBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
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
     * Whether posts need to be moderated before publishing
     */
    const MODERATION = true;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias'
            ],
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_VALIDATE => [
                        'content' => [
                            'HTML.AllowedElements' => '',
                            'AutoFormat.RemoveEmpty' => true
                        ]
                    ]
                ],
                'textAttributes' => [
                    self::EVENT_BEFORE_VALIDATE => ['title', 'alias']
                ]
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['title', 'alias'], 'required'],
            // Trim
            [['title', 'content'], 'trim'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 100],
            // CreatedAtJui and UpdatedAtJui
            [['createdAtJui', 'updatedAtJui'], 'date', 'format' => 'd.m.Y'],
            // Status
            [
            'status_id',
                'default',
                'value' => self::MODERATION ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
            ]
        ];
    }

    public static function getMenuPage()
    {
        $models = self::find()->where(['status_id' => self::STATUS_PUBLISHED])->all();

        $arrayPage = [];

        foreach($models as $model)
        {
            $arrayPage[] = [
                'label' => $model->title,
                'url' => ['/' . $model->alias]
            ];
        }

        $array = [
            [
                'label' => Yii::t('themes', 'Войти'),
                'url' => ['/guest/login'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => Yii::t('themes', 'Регистрация'),
                'url' => ['/guest/signup'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => Yii::t('themes', 'Настройки'),
                'url' => '#',
                'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => Yii::t('themes', 'Профиль'),
                        'url' => ['/user/update']
                    ],
                    [
                        'label' => Yii::t('themes', 'Смена почты'),
                        'url' => ['/user/email']
                    ],
                    [
                        'label' => Yii::t('themes', 'Сменить пароль'),
                        'url' => ['/user/password']
                    ],
                    [
                        'label' => \Yii::t('themes', 'Управление сайтом'),
                        'url' => ['/backend'],
                        'visible' => Yii::$app->user->can('admin')
                    ],
                ]
            ],
            [
                'label' => Yii::t('themes', 'Выйти'),
                'url' => ['/user/logout'],
                'visible' => !Yii::$app->user->isGuest
            ]
        ];

        return $arrayReturn = array_merge($arrayPage,$array);
    }
}
