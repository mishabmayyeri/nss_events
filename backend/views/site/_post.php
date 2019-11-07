<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;
use backend\models\Review;
use backend\models\Students;
use backend\models\EntryForm;
use yii\helpers\Url;




/* ADD FORM FIELDS */

?>

<div class="post">

<?php
			$user_id=Yii::$app->user->id;
            $email=Yii::$app->user->identity->email;

            $students=null;
            $students=Students::find()
                ->where(['email'=>$email])
                ->one();
            $student_id=$students->id;
            $coordinator_id=$students->coordinator_id;
            $event_id=$model->event_id;

			$review=null;
            $review = Review::find()
                ->where(['event_id' => $event_id, 'student_id' => $student_id])
                ->one();
            
            $todayDate=date("Y-m-d");
            $registrationDate=$model->registration_date; 
?>
            

           <?php if($review==null&&($coordinator_id==$model->coordinator_id)&&$todayDate<=$registrationDate){?>



     
 			<h2><?= Html::encode($model->event_name) ?></h2>
      
    	
      Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
 			Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
 			Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
 			Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
  		<?=Html::a(' Register', ['/site/register-student', 'event_id' => $model->event_id,'registration_index'=>$model->registration_index,'event_name'=>$model->event_name], 
  		['class'=>'btn btn-primary'])?>

 			<h2><?= Html::encode($model->event_name) ?></h2>
 			Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
 			Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
 			Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
 			Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
  			
  			<?=Html::a(' Register', ['/site/register-student', 'event_id' => $model->event_id,'registration_index'=>$model->registration_index,'event_name'=>$model->event_name], 
  			['class'=>'btn btn-primary'])?>

			<?php } ?> 



            <?php
			
			if($review!=null&&($coordinator_id==$model->coordinator_id)&&
			$todayDate<=$registrationDate) { 
            

            $registration_index=$review->registration_index;
            

            if($registration_index==1){?>
	        
           

	        <h2><?= Html::encode($model->event_name) ?></h2>
 			Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
 			Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
 			Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
 			Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
  			

  			<?=Html::a(' Undo Registeration', ['/site/register-student', 'event_id' => $model->event_id,'registration_index'=>$model->registration_index,'event_name'=>$model->event_name], ['class'=>'btn btn-primary'])?>
           <br><br><br>
          

           <?php $form = ActiveForm::begin([
            'id' => 'EntryForm',
            'enableClientValidation' => true,
   				'action' => Url::to(['/site/approve','event_id' => $model->event_id,'student_id'=>$student_id]),
    			'method' => 'post',
    			'options' => [
                'class' => 'form-horizontal',

    			]
			]);
 
 			?>      
           
            <?php     
            $entryModel = new EntryForm();
            $entryModel->eventID=$event_id;
			$entryModel->studentID=$student_id;
			
			?>
             

			<?= $form->field($entryModel, 'number_of_hours') ?>
			<?= $form->field($entryModel, 'work_statement') ?>
			
			
			<div class="form-group">
        	<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit for Approval',

             ['class' => 'btn btn-primary']) ?>
       		 </div>
    		</div>
		    
		    <?php ActiveForm::end();?>

		    <br><br><br>
            <?php } if($registration_index==2) {?>

		    <h2><?= Html::encode($model->event_name) ?></h2>
 			Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
 			Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
 			Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
 			Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
            
            Work Statement::   <?= HtmlPurifier::process($review->work_statement) ?>     <br>
 			Number of hours::   <?= HtmlPurifier::process($review->no_of_hours) ?>     <br>
  			  			

  			<?=Html::a(' Undo Approval Request', ['/site/undo-request', 'event_id' => $model->event_id,'student_id'=>$student_id], ['class'=>'btn btn-primary'])?>
            <br><br><br>
          
             
        






		     <?php } if($registration_index==3) {?>
      

      Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
      Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
      Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
      Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
      Work Statement::   <?= HtmlPurifier::process($review->work_statement) ?>     <br>
      Number of hours::   <?= HtmlPurifier::process($review->no_of_hours) ?>     <br>
      <h2>Approved by Coordinator <h2>
        <br><br><br>
      
	<?php	}

  }?>
    





 </div>

 </div>










