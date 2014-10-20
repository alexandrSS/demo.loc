<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * CLass m141020_174319_pages
 */
class m141020_174319_pages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // Blogs table
        $this->createTable('{{%pages}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'alias' => Schema::TYPE_STRING . '(100) NOT NULL',
            'content' => 'longtext NOT NULL',
            'status_id' => 'tinyint(4) NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%articles}}');
    }
}
