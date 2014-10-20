<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * CLass m140526_193056_create_module_tbl
 * @package vova07\articles\migrations
 *
 * Create module tables.
 *
 * Will be created 1 table:
 * - `{{%articles}}` - Blogs table.
 */
class m140526_193056_articles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // Blogs table
        $this->createTable('{{%articles}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'alias' => Schema::TYPE_STRING . '(100) NOT NULL',
            'snippet' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => 'longtext NOT NULL',
            'image_url' => Schema::TYPE_STRING . '(64) NOT NULL',
            'preview_url' => Schema::TYPE_STRING . '(64) NOT NULL',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'status_id' => 'tinyint(4) NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

        // Indexes
        $this->createIndex('status_id', '{{%articles}}', 'status_id');
        $this->createIndex('views', '{{%articles}}', 'views');
        $this->createIndex('created_at', '{{%articles}}', 'created_at');
        $this->createIndex('updated_at', '{{%articles}}', 'updated_at');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%articles}}');
    }
}
