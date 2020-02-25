<?php

use yii\db\Migration;

/**
 * Class m200225_192721_create_table_status
 */
class m200225_192721_create_table_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
        $this->dropTable('{{%status}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_192721_create_table_status cannot be reverted.\n";

        return false;
    }
    */
}
