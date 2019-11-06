<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_answers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $questions_id
 * @property int $answer_id
 *
 * @property Questions $questions
 * @property User $user
 * @property Answers $answer
 */
class UserAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'questions_id', 'answer_id'], 'required'],
            [['user_id', 'questions_id', 'answer_id'], 'integer'],
            [['questions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['questions_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['answer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'questions_id' => 'Questions ID',
            'answer_id' => 'Answer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'questions_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answer_id']);
    }
}
