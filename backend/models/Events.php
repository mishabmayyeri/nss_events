<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $event_id
 * @property string $event_name
 * @property string $event_description
 * @property string $venue
 * @property string $event_date
 * @property string $registration_date
 * @property string $registration_index
 * @property int $coordinator_id
 * @property string $event_image
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name', 'event_description', 'venue', 'event_date', 'registration_date', 'registration_index', 'coordinator_id', 'event_image'], 'required'],
            [['event_description', 'registration_index', 'event_image'], 'string'],
            [['event_date', 'registration_date'], 'safe'],
            [['coordinator_id'], 'integer'],
            [['event_name', 'venue'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_name' => 'Event Name',
            'event_description' => 'Event Description',
            'venue' => 'Venue',
            'event_date' => 'Event Date',
            'registration_date' => 'Registration Date',
            'registration_index' => 'Registration Index',
            'coordinator_id' => 'Coordinator ID',
            'event_image' => 'Event Image',
        ];
    }
}