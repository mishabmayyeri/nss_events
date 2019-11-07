<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $coordinator_id
 * @property int $event_id
 * @property int $student_id
 * @property int $registration_index
 * @property int $no_of_hours
 * @property string $work_statement
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coordinator_id', 'event_id', 'student_id', 'registration_index', 'no_of_hours', 'work_statement'], 'required'],
            [['coordinator_id', 'event_id', 'student_id', 'registration_index', 'no_of_hours'], 'integer'],
            [['work_statement'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coordinator_id' => 'Coordinator ID',
            'event_id' => 'Event ID',
            'student_id' => 'Student ID',
            'registration_index' => 'Registration Index',
            'no_of_hours' => 'No of hours',
            'work_statement' => 'Work Statement',
        ];
    }
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['event_id' => 'event_id']);
    }


}