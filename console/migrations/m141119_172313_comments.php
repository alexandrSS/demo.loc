<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m141119_172313_comments
 */
class m141119_172313_comments extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // Comments table
        $this->createTable('{{%comments}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'model_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'status_id' => 'tinyint(2) NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

        // Indexes
        $this->createIndex('status_id', '{{%comments}}', 'status_id');
        $this->createIndex('created_at', '{{%comments}}', 'created_at');
        $this->createIndex('updated_at', '{{%comments}}', 'updated_at');

        // Foreign Keys
        $this->addForeignKey('FK_comment_parent', '{{%comments}}', 'parent_id', '{{%comments}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_comment_author', '{{%comments}}', 'author_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('{{%comments}}');
    }
}
