<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%User}}`.
 */
class m191009_110414_create_User_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%User}}', [
            'id' => $this->primaryKey(),
            'Name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%User}}');
    }
}
