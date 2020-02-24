<?php

use yii\db\Migration;

/**
 * Class m200224_191742_create_table_users
 */
class m200224_191742_create_table_users extends Migration
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

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('{{%users}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200224_191742_create_table_users cannot be reverted.\n";

        return false;
    }
    */
}
