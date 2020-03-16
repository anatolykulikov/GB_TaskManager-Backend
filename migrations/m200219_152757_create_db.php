<?php

use yii\db\Migration;

/**
 * Class m200219_152757_create_db
 */
class m200219_152757_create_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'hash_pass' => $this->string(255)->notNull(),
            'e-mail' => $this->string(255)->notNull(),
            'id_role' => $this->integer()
            ]);
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'id_task' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
           ]);

           $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'id_status' => $this->integer()->notNull(),
            'id_group_task' => $this->integer(),
            'id_user' => $this->integer()->notNull(),
            'date_start' => $this->timestamp()->defaultExpression("now()"),
            'date_end' => $this->timestamp()->defaultExpression("now()"),
           ]);

           $this->createTable('group_task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
           ]);

           $this->createTable('status', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
           ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      //  echo "m200219_152757_create_db cannot be reverted.\n";
      $this->dropTable('group_task');
      $this->dropTable('status');
      $this->dropTable('task');
      $this->dropTable('comment');
      $this->dropTable('users');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200219_152757_create_db cannot be reverted.\n";

        return false;
    }
    */
}
