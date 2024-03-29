<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Connection;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;
use yii\data\ActiveDataProvider;
use backend\models\Events;

use backend\models\Students;
use backend\models\Review;
use backend\models\EntryForm;
use backend\models\ReviewData;
use yii\widgets\Activeform;

use backend\models\Review;
use backend\models\Students;
use backend\models\Users;
use yii\widgets\ActiveForm;
use backend\models\EntryForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [

                        'actions' => ['login', 'review', 'approve', 'error', 'register', 'register-student', 'entry-confirm', 'approval', 'undo-request', 'approve-request', 'creview'],

                        'actions' => ['login','review', 'error', 'approve','register-student','entry-confirm','undo-request','approve-request'],

                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
        $events=new ActiveDataProvider(['query'=>Events::find()->orderBy(['event_id' => SORT_DESC]),
            'pagination'=>['pageSize'=>10,]]);
         // $type = 1 ;
        // echo '<pre>'; print_r(Yii::$app->user->identity->attributes['role']); echo '</pre>'; die();  


         if (Yii::$app->user->identity->attributes['role'] == 1) {
            return $this->redirect(['events/index']);    
         }
         else {
        return $this->render('index',['events'=>$events]);
        }   
    }


    /**
     * Login action.
     *
     * @return string
     */

    public function actionRegisterStudent($event_id,$registration_index,$event_name) {
            $user_id=Yii::$app->user->id;
            $email=Yii::$app->user->identity->email;

            $model=null;
            $model=Students::find()
                ->where(['email'=>$email])
                ->one();
            $student_id=$model->id;
            $coordinator_id=$model->coordinator_id;    
          
            $model=null;
            
            $model = Review::find()
                ->where(['event_id' => $event_id, 'student_id' => $student_id])
                ->one();
            if($model==null){
            Yii::$app->db->createCommand()
            ->insert(
            'review',
             array(

                'coordinator_id'=>$coordinator_id,
                'event_id'=>$event_id,
                'student_id'=>$student_id,
                'registration_index'=>1,
                'no_of_hours'=>0,
                'work_statement'=>""
                  
                  )
        )
        ->execute();
         $a="Registered to  ";
         $b=$a.$event_name;
         Yii::$app->session->setFlash('success',$b);
         



         }else{
         
            Yii::$app->db->createCommand()
                ->delete('review', ['event_id'=>$event_id,
                                    'student_id'=>$student_id])
                ->execute();
            $a="Unregisterd from  ";
            $b=$a.$event_name;
            Yii::$app->session->setFlash('error',$b);
         
            }
        return $this->redirect(['/site/index']);
    }

 
    

    

    public function actionApprove($event_id,$student_id) 
    {    
        $model = new EntryForm();
             
        if ($model->load(Yii::$app->request->post())) {
             
            Yii::$app->db->createCommand()
             ->update('review', ['work_statement' => $model->work_statement,
                'no_of_hours' => $model->number_of_hours,'registration_index'=>2],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Data send for approval to respective Coordinator");
             return $this->redirect(['/site/index']);

             } else {

            return $this->redirect(['/site/index']);
        }
    }

        
    public function actionReview(){
    
       $reviews=new ActiveDataProvider(['query'=>Review::find()
         ->where(['registration_index' => 2]),
         'pagination'=>['pageSize'=>10,]]);
        return $this->render('/site/reviewpage',['reviews'=>$reviews]); 
       }
    
    
    public function actionUndoRequest($event_id,$student_id){
        Yii::$app->db->createCommand()
             ->update('review', ['work_statement' => "",
                'no_of_hours' => 0,'registration_index'=>1],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Approval request reverted");
             return $this->redirect(['/site/index']);

    
    }
   
      public function actionApproveRequest($event_id,$student_id){
             Yii::$app->db->createCommand()
             ->update('review', ['registration_index'=>3],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Approval confirmed");
             return $this->redirect(['/site/review']);

    
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
        return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    
    public function actionRegisterStudent($event_id,$registration_index,$event_name) {
            $user_id=Yii::$app->user->id;
            $email=Yii::$app->user->identity->email;

            $model=null;
            $model=Students::find()
                ->where(['email'=>$email])
                ->one();
            $student_id=$model->id;
            $coordinator_id=$model->coordinator_id;    
          
            $model=null;
            
            $model = Review::find()
                ->where(['event_id' => $event_id, 'student_id' => $student_id])
                ->one();
            if($model==null){
            Yii::$app->db->createCommand()
            ->insert(
            'review',
             array(

                'coordinator_id'=>$coordinator_id,
                'event_id'=>$event_id,
                'student_id'=>$student_id,
                'registration_index'=>1,
                'no_of_hours'=>0,
                'work_statement'=>""
                  
                  )
        )
        ->execute();
         $a="Registered to  ";
         $b=$a.$event_name;
         Yii::$app->session->setFlash('success',$b);
         



         }else{
         
            Yii::$app->db->createCommand()
                ->delete('review', ['event_id'=>$event_id,
                                    'student_id'=>$student_id])
                ->execute();
            $a="Unregisterd from  ";
            $b=$a.$event_name;
            Yii::$app->session->setFlash('error',$b);
         
            }
        return $this->redirect(['/site/index']);
    }

 
    public function actionCreview(){
    
        $model = new ReviewData();
        $reviews=null;     
        if ($model->load(Yii::$app->request->post())) {
          
           $


          $reviews=new ActiveDataProvider(['query'=>Review::find()
           ->where(['registration_index' => 3]),
             'pagination'=>['pageSize'=>10,]]);

              
            
             return $this->render('/site/reviewpage',['reviews'=>$reviews]); 
    
            }

            return $this->render('/site/reviewpage',['reviews'=>$reviews]); 
         

    }
    

    

    public function actionApprove($event_id,$student_id) 
    {    
        $model = new EntryForm();
             
        if ($model->load(Yii::$app->request->post())) {
             
            Yii::$app->db->createCommand()
             ->update('review', ['work_statement' => $model->work_statement,
                'no_of_hours' => $model->number_of_hours,'registration_index'=>2],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Data send for approval to respective Coordinator");
             return $this->redirect(['/site/index']);

             } else {

            return $this->redirect(['/site/index']);
        }
    }

        
    public function actionApproval(){
    
       $reviews=new ActiveDataProvider(['query'=>Review::find()
         ->where(['registration_index' => 2]),
         'pagination'=>['pageSize'=>10,]]);
        return $this->render('/site/approvalpage',['reviews'=>$reviews]); 
       }


    
    
    public function actionUndoRequest($event_id,$student_id){
        Yii::$app->db->createCommand()
             ->update('review', ['work_statement' => "",
                'no_of_hours' => 0,'registration_index'=>1],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Approval request reverted");
             return $this->redirect(['/site/index']);

    
    }
   
      public function actionApproveRequest($event_id,$student_id){
             Yii::$app->db->createCommand()
             ->update('review', ['registration_index'=>3],['event_id' => $event_id, 'student_id' => $student_id] )
             ->execute();
             Yii::$app->session->setFlash('success',"Approval confirmed");
             return $this->redirect(['/site/approval']);

    
    }
}
