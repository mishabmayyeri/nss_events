<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

use backend\models\ReviewData; 
use backend\models\Events; 
use backend\models\Students; 
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;


?>
<div class="site-reviewpage">
    <div class="jumbotron">
        <h2>NSS Student's Review</h2>
    </div>
    
    <div class="body-content">
           <div>
    	  	<?php 
             $reviewData = new ReviewData();
        
 
    	  	$form = ActiveForm::begin([
            'id' => 'ReviewForm',
            'enableClientValidation' => true,
   				'action' => Url::to(['/site/creview']),
    			'method' => 'post',
    			'options' => [
                'class' => 'form-vertical',

    			]
			]);?>
		
		<?= $form->field($reviewData, 'date_start')->textInput()->widget(
                    DatePicker::className(), [
                        'inline'=>false,
                        'clientOptions'=>[
                            'autoclose'=>true,
                            'format'=>'dd-mm-yyyy'
                        ]
                    ]

                    ) ?>

		  <?= $form->field($reviewData, 'date_end')->textInput()->widget(
                    DatePicker::className(), [
                        'inline'=>false,
                        'clientOptions'=>[
                            'autoclose'=>true,
                            'format'=>'dd-mm-yyyy'
                        ]
                    ]

                    ) ?>
			<?= $form->field($reviewData, 'student_name')
     		->dropDownList(
            ArrayHelper::map(Students::find()->asArray()->all(), 'student_name', 'student_name')
            )?>
	

			<?= $form->field($reviewData, 'event_name')
     		->dropDownList(
            ArrayHelper::map(Events::find()->asArray()->all(), 'event_name', 'event_name')
            )?>
	
		    <?= Html::submitButton('Get Review',

             ['class' => 'btn btn-primary']) ?>
             <?php ActiveForm::end();?>
	
           
          </div>
             <div>
             <?php
             if($reviews!=null){
 

$this->title = 'NSS EVENT';
?>
<div class="site-reviewpage">

    <div class="jumbotron">
        <h1>NSS Events</h1>
    </div>

    <div class="body-content">
           <?php 
           		echo ListView::widget([
                'dataProvider' => $reviews,
                'itemView' => 'review_post',
                ]);
           }
           		
           ?>
             	
             </div>       

           		
           ?>
                   
            
        </div>

    </div>
</div>

</div>
