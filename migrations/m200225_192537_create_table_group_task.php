<?php

use yii\db\Migration;

/**
 * Class m200225_192537_create_table_group_task
 */
class m200225_192537_create_table_group_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('group_task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group_task}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_192537_create_table_group_task cannot be reverted.\n";

        return false;
    }
    */
}
