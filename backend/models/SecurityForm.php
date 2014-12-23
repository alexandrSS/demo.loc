<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class SecurityForm
 * @package backend\models
 */
class SecurityForm extends Model
{
    public $key;
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'file'], 'required'],
            [['file'], 'file'],
            // Username
            ['key', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['key', 'string', 'min' => 3, 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Ключ',
            'file' => 'Файл',
        ];
    }
}