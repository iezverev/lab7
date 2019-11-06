<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%User_Answers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%User}}`
 * - `{{%Test}}`
 * - `{{%Questions}}`
 */
class m191013_113659_create_User_Answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%User_Answers}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'test_id' => $this->integer()->notNull(),
            'questions_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-User_Answers-user_id}}',
            '{{%User_Answers}}',
            'user_id'
        );

        // add foreign key for table `{{%User}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-user_id}}',
            '{{%User_Answers}}',
            'user_id',
            '{{%User}}',
            'id',
            'CASCADE'
        );

        // creates index for column `test_id`
        $this->createIndex(
            '{{%idx-User_Answers-test_id}}',
            '{{%User_Answers}}',
            'test_id'
        );

        // add foreign key for table `{{%Test}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-test_id}}',
            '{{%User_Answers}}',
            'test_id',
            '{{%Test}}',
            'id',
            'CASCADE'
        );

        // creates index for column `questions_id`
        $this->createIndex(
            '{{%idx-User_Answers-questions_id}}',
            '{{%User_Answers}}',
            'questions_id'
        );

        // add foreign key for table `{{%Questions}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-questions_id}}',
            '{{%User_Answers}}',
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
        // drops foreign key for table `{{%User}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-user_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-User_Answers-user_id}}',
            '{{%User_Answers}}'
        );

        // drops foreign key for table `{{%Test}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-test_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            '{{%idx-User_Answers-test_id}}',
            '{{%User_Answers}}'
        );

        // drops foreign key for table `{{%Questions}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-questions_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `questions_id`
        $this->dropIndex(
            '{{%idx-User_Answers-questions_id}}',
            '{{%User_Answers}}'
        );

        $this->dropTable('{{%User_Answers}}');
    }
}
