<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use backend\models\Students;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $student_name;
    public $email;
    public $password;
    public $guardian_name;
    public $gender;
    public $date_of_birth;
    public $address;
    public $street;
    public $city;
    public $district;
    public $state;
    public $pin_code;
    public $mobile;
    public $blood_group;
    public $aadhar_number;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','student_name','guardian_name','gender','date_of_birth','address','street','city','district','state','pin_code','email','mobile','blood_group','aadhar_number'],'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username','student_name'],'string', 'min' => 2, 'max' => 255],
            ['date_of_birth','safe'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $students = new Students();
        $students->student_name = $this->student_name;
        $students->guardian_name = $this->guardian_name;
        $students->gender = $this->gender;
        $students->date_of_birth = $this->date_of_birth;
        $students->address = $this->address;
        $students->street = $this->street;
        $students->city = $this->city;
        $students->district = $this->district;
        $students->state = $this->state;
        $students->pin_code = $this->pin_code;
        $students->mobile = $this->mobile;
        $students->blood_group = $this->blood_group;
        $students->aadhar_number = $this->aadhar_number;
        $students->email = $this->email;
        $students->save();
        

        return $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
