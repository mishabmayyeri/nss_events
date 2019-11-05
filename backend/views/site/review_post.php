<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;
use backend\models\Review;
use backend\models\Students;
use backend\models\Events;

$studentID=$model->student_id;
$eventID=$model->event_id;
$studentModel=Students::find()
                ->where(['id' => $studentID])
                ->one();
$eventModel=Events::find()
                ->where(['event_id' => $eventID])
                ->one();


?>


<div class="review_post">

<style>
table, th, td {
  border: 2px solid grey;
  border-collapse: collapse;
  padding: 3px;
}
table {
  border-spacing: 3px;
}
</style>


  <table style="width:100%">
  <tr>
    <th>Student Name</th>
    <th>Guardian Name</th>
    <th>Gender</th>
    <th>Date of Birth</th>
    <th>Address</th>
    <th>Street</th>
    <th>City</th>
    <th>District</th>
    <th>State</th>
    <th>Pin code</th>
    <th>E-mail</th>
    <th>Mobile</th>
    <th>Blood Group</th>
    <th>Aadhar Number</th>
    </tr>
  <tr>
    <td><?= HtmlPurifier::process($studentModel->student_name) ?></td>
    <td><?= HtmlPurifier::process($studentModel->guardian_name) ?></td>
    <td><?= HtmlPurifier::process($studentModel->gender)?></td>
    <td><?= HtmlPurifier::process($studentModel->date_of_birth)?></td>
    <td><?= HtmlPurifier::process($studentModel->address)?></td>
    <td><?= HtmlPurifier::process($studentModel->street)?></td>
    <td><?= HtmlPurifier::process($studentModel->city)?></td>
    <td><?= HtmlPurifier::process($studentModel->district)?></td>
    <td><?= HtmlPurifier::process($studentModel->state)?></td>
    <td><?= HtmlPurifier::process($studentModel->pin_code)?></td>
    <td><?= HtmlPurifier::process($studentModel->email)?></td>
    <td><?= HtmlPurifier::process($studentModel->mobile)?></td>
    <td><?= HtmlPurifier::process($studentModel->blood_group)?></td>
    <td><?= HtmlPurifier::process($studentModel->aadhar_number)?></td>
    </tr>
   </table>
   <table style="width:100%">
    <tr> 
    <th> Event Name</th>
    <th>Event Description</th>
    <th>Venue</th>
    <th>Event Date</th>
    <th>Registration Date</th>
    <th>Work Statement</th>
    <th>Number of Hours</th>
    </tr>
    <tr>
    <td><?= HtmlPurifier::process($eventModel->event_name) ?></td>
    <td><?= HtmlPurifier::process($eventModel->event_description) ?></td>
    <td><?= HtmlPurifier::process($eventModel->venue) ?></td>
    <td><?= HtmlPurifier::process($eventModel->event_date)?></td>
    <td><?= HtmlPurifier::process($eventModel->registration_date)?></td>
    <th><?= HtmlPurifier::process($model->work_statement)?></th>
    <th><?= HtmlPurifier::process($model->no_of_hours)?></th>
    <th><?=Html::a('Approve', ['/site/approve-request', 'event_id' => $eventID,'student_id'=>$studentID], ['class'=>'btn btn-primary'])?></th>
    </tr>
  

  </table> 
  		
 </div> 			