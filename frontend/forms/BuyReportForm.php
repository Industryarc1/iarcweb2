<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;
use common\models\ZspUserAccounts;

/**
 * ContactForm is the model behind the contact form.
 */
class BuyReportForm extends Model
{
    public $f_name;
    public $l_name;
    public $email;
    public $company_name;
    public $contact_number;
    public $address;
    public $state;
    public $city;
    public $country;
    public $zipcode;
    public $payment_mode;
    public $report_id;
    public $licence_amount;
    public $title;
    public $coupon_code;
    public $discount;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_name', 'email', 'company_name', 'contact_number','address','city',
				'country','zipcode','payment_mode'], 'required'],
			//[['l_name'],'safe'],
            // email has to be a valid email address
            ['email', 'email'],
			//['email', 'unique', 'targetClass' => ZspUserAccounts::className(),'targetAttribute'=>['email'=>'login_id'], 'message' => 'This email address has already been taken.'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
			'f_name'=>'First Name',
			'l_name'=>'Last Name',
			'email'=>'Email',
			'company_name'=>'Company Name',
			'contact_number'=>'Contact Number',
			'address'=>'Address',
			'city'=>'City',
			'country'=>'Country',
			'zipcode'=>'Zipcode',
            'verifyCode' => 'Verification Code',
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
