<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class ReviewData extends Model
{
    public $date_start;
    public $date_end;
    public $student_name;
    public $event_name;

    public function rules()
    {
        return [
            [['date_start', 'date'], 'required'],
            [['date_end', 'date'],'required'],
            [['student_name', 'text'], 'required'],
            [['event_name', 'text'],'required']
        

        ];
    }
}