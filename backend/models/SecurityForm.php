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
    public $text;
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'text'], 'required'],
            [['file'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Ключ',
            'text' => 'Текст для шифрования',
            'file' => 'Файл',
        ];
    }
}