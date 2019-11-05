<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $number_of_hours;
    public $work_statement;
    public $eventID;
    public $studentID;

    public function rules()
    {
        return [
            [['number_of_hours', 'number'], 'required'],
            [['work_statement', 'text'],'required']
        ];
    }
}