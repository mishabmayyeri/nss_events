<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $student_name
 * @property string $guardian_name
 * @property string $gender
 * @property string $date_of_birth
 * @property string $address
 * @property string $street
 * @property string $city
 * @property string $district
 * @property string $state
 * @property int $pin_code
 * @property string $email
 * @property string $mobile
 * @property string $blood_group
 * @property int $aadhar_number
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_name', 'guardian_name', 'gender', 'date_of_birth', 'address', 'street', 'city', 'district', 'state', 'pin_code', 'email', 'mobile', 'blood_group', 'aadhar_number','coordinator_id'], 'required'],
            [['gender', 'address'], 'string'],
            [['date_of_birth'], 'safe'],
            [['pin_code', 'aadhar_number','coordinator_id'], 'integer'],
            [['student_name', 'guardian_name', 'email'], 'string', 'max' => 255],
            [['street', 'city', 'district', 'state'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 15],
            [['blood_group'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_name' => 'Student Name',
            'guardian_name' => 'Guardian Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Address',
            'street' => 'Street',
            'city' => 'City',
            'district' => 'District',
            'state' => 'State',
            'pin_code' => 'Pin Code',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'blood_group' => 'Blood Group',
            'aadhar_number' => 'Aadhar Number',
            'coordinator_id'=>'Coordinator ID',
        ];
    }
}
