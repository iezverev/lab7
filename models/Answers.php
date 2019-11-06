<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property string $Answer
 * @property int $questions_id
 *
 * @property Questions $questions
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['questions_id'], 'required'],
            [['questions_id'], 'integer'],
            [['Answer'], 'string', 'max' => 255],
            [['questions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['questions_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Answer' => 'Answer',
            'questions_id' => 'Questions ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'questions_id']);
    }
}
