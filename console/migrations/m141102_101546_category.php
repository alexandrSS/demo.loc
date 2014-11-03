<?php

use yii\db\Schema;
use yii\db\Migration;

class m141102_101546_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'root' =>  Schema::TYPE_INTEGER . ' UNSIGNED DEFAULT NULL',
            'lft' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'level' => Schema::TYPE_SMALLINT. ' UNSIGNED NOT NULL',
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'alias' => Schema::TYPE_STRING . '(100) NOT NULL',
            'status_id' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        // Indexes
        $this->createIndex('root', '{{%category%}}', 'root');
        $this->createIndex('lft', '{{%category%}}', 'lft');
        $this->createIndex('rgt', '{{%category%}}', 'rgt');
        $this->createIndex('level', '{{%category%}}', 'level');
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
