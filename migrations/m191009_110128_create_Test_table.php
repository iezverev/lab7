<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Test}}`.
 */
class m191009_110128_create_Test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Test}}', [
            'id' => $this->primaryKey(),
            'Name' => $this->string(255),
            'Description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Test}}');
    }
}
