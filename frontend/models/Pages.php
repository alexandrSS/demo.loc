<?php

namespace frontend\models;

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
class Pages extends \common\models\Pages
{
    private $_url;

    /**
     * Меню страниц
     * @return array
     */
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
                'label' => Yii::t('themes', 'Статьи'),
                'url' => ['/articles'],
            ],
            [
                'label' => Yii::t('themes', 'Контакты'),
                'url' => ['/contacts'],
            ],
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


    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::$app->urlManager->createUrl($this->alias);
        return $this->_url;
    }
}
