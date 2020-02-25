<?php

use yii\db\Migration;

/**
 * Class m200225_192149_create_table_task
 */
class m200225_192149_create_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_192149_create_table_task cannot be reverted.\n";

        return false;
    }
    */
}
