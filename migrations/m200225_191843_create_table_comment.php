<?php

use yii\db\Migration;

/**
 * Class m200225_191843_create_table_comment
 */
class m200225_191843_create_table_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'id_task' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_191843_create_table_comment cannot be reverted.\n";

        return false;
    }
    */
}
