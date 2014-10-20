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



        public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_category}}', [
            'id' => Schema::TYPE_PK,
            'slug' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title' => Schema::TYPE_STRING . '(512) NOT NULL',
            'body' => Schema::TYPE_TEXT,
            'parent_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        // Blogs table
        $this->createTable('{{%articles}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'alias' => Schema::TYPE_STRING . '(100) NOT NULL',
            'category_id' => Schema::TYPE_INTEGER,
            'author_id' => Schema::TYPE_INTEGER,
            'snippet' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => 'longtext NOT NULL',
            'image_url' => Schema::TYPE_STRING . '(64) NOT NULL',
            'preview_url' => Schema::TYPE_STRING . '(64) NOT NULL',
            'status_id' => 'tinyint(4) NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

        // Indexes
        $this->createIndex('category_id', '{{%category%}}', 'category_id');

        if ($this->db->driverName === 'mysql') {
            $this->createIndex('idx_article_author_id', '{{%article}}', 'author_id');
            $this->addForeignKey('fk_article_author', '{{%article}}', 'author_id', '{{%user}}', 'id');

            $this->createIndex('idx_article_updater_id', '{{%article}}', 'author_id');
            $this->addForeignKey('fk_article_updater', '{{%article}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

            $this->createIndex('idx_category_id', '{{%article}}', 'category_id');
            $this->addForeignKey('fk_article_category', '{{%article}}', 'category_id', '{{%article_category}}', 'id');

            $this->createIndex('idx_parent_id', '{{%article_category}}', 'parent_id');
            $this->addForeignKey('fk_article_category_section', '{{%article_category}}', 'parent_id', '{{%article_category}}', 'id');
        }

    }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%articles}}');
    }


    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_article_author', '{{%article}}');
            $this->dropForeignKey('fk_article_updater', '{{%article}}');
            $this->dropForeignKey('fk_article_category', '{{%article}}');
            $this->dropForeignKey('fk_article_category_section', '{{%article_category}}');
        }
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_category}}');
    }
}
