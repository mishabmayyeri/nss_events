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
                        'actions' => ['login', 'error', 'register','register-student'],
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
       
        $events=new ActiveDataProvider(['query'=>Events::find(),
            'pagination'=>['pageSize'=>10,]]);
        return $this->render('index',['events'=>$events]);
    }

    /**
     * Login action.
     *
     * @return string
     */

    public function actionRegisterStudent($event_id) {
        // update table events set register_index=registered
        // where event id=$event_id
         $connection=createCommand('UPDATE events SET registration_index="registered" WHERE event_id=$event_id');
        $connection->execute();
        /// 
        Yii::$app->session->setFlash('success', 'Registration success');
        return $this->redirect(['/site/index']);
    }

    public function actionRegister() 
    {    
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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

    
    
}
