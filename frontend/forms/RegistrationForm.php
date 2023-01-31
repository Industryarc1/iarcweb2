<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\models\ZspUserAccounts;

/**
 * ContactForm is the model behind the contact form.
 */
class RegistrationForm extends Model
{
	public $fname;
	public $lname;
	public $phone;
	public $email;
	public $password;
	public $confirm_password;
	public $verifyCode;
	
	public function rules()
    {
        return [
			[['fname', 'phone', 'email','password','confirm_password'], 'required'],
			
			['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => ZspUserAccounts::className(),'targetAttribute'=>['email'=>'login_id'], 'message' => 'This email address has already been taken.'],
			
			['password', 'string', 'min' => 6],
			['confirm_password', 'compare', 'compareAttribute' => 'password'],
			
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
			'fname'=>'First Name',
			'lname'=>'Last Name',
			'email'=>'Email',
			'phone'=>'Contact Number',
			'password'=>'Password',
			'confirm_password'=>'Confirm Password',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
