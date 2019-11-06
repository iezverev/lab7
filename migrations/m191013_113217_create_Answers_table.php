<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Answers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%Questions}}`
 */
class m191013_113217_create_Answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Answers}}', [
            'id' => $this->primaryKey(),
            'Answer' => $this->string(255),
            'questions_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `questions_id`
        $this->createIndex(
            '{{%idx-Answers-questions_id}}',
            '{{%Answers}}',
            'questions_id'
        );

        // add foreign key for table `{{%Questions}}`
        $this->addForeignKey(
            '{{%fk-Answers-questions_id}}',
            '{{%Answers}}',
            'questions_id',
            '{{%Questions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%Questions}}`
        $this->dropForeignKey(
            '{{%fk-Answers-questions_id}}',
            '{{%Answers}}'
        );

        // drops index for column `questions_id`
        $this->dropIndex(
            '{{%idx-Answers-questions_id}}',
            '{{%Answers}}'
        );

        $this->dropTable('{{%Answers}}');
    }
}
