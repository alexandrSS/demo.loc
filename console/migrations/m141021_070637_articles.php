<?php

use yii\db\Schema;
use yii\db\Migration;

class m141021_070637_articles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 ENGINE=InnoDB';
        }

        $this->createTable('{{%articles_category}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'alias' => Schema::TYPE_STRING . '(100) NOT NULL',
            'parent_id' => Schema::TYPE_INTEGER,
            'status_id' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
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
        $this->createIndex('parent_id', '{{%articles_category%}}', 'parent_id');
        $this->createIndex('category_id', '{{%articles%}}', 'category_id');
        $this->createIndex('author_id', '{{%articles%}}', 'author_id');

        if ($this->db->driverName === 'mysql') {
            $this->createIndex('idx_article_author_id', '{{%articles}}', 'author_id');
            $this->addForeignKey('fk_article_author', '{{%articles}}', 'author_id', '{{%users}}', 'id');

            $this->createIndex('idx_category_id', '{{%articles}}', 'category_id');
            $this->addForeignKey('fk_articles_category', '{{%articles}}', 'category_id', '{{%articles_category}}', 'id');

            $this->createIndex('idx_parent_id', '{{%articles_category}}', 'parent_id');
            $this->addForeignKey('fk_articles_category_section', '{{%articles_category}}', 'parent_id', '{{%articles_category}}', 'id');
        }

    }


    public function safeDown()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_article_author', '{{%article}}');
            $this->dropForeignKey('fk_articles_category', '{{%article}}');
            $this->dropForeignKey('fk_articles_category_section', '{{%articles_category}}');
        }
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%articles_category}}');
    }
}
