<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Questions}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%Test}}`
 */
class m191013_113056_create_Questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Questions}}', [
            'id' => $this->primaryKey(),
            'Question' => $this->string(255),
            'Answer' => $this->string(255),
            'test_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `test_id`
        $this->createIndex(
            '{{%idx-Questions-test_id}}',
            '{{%Questions}}',
            'test_id'
        );

        // add foreign key for table `{{%Test}}`
        $this->addForeignKey(
            '{{%fk-Questions-test_id}}',
            '{{%Questions}}',
            'test_id',
            '{{%Test}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%Test}}`
        $this->dropForeignKey(
            '{{%fk-Questions-test_id}}',
            '{{%Questions}}'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            '{{%idx-Questions-test_id}}',
            '{{%Questions}}'
        );

        $this->dropTable('{{%Questions}}');
    }
}
