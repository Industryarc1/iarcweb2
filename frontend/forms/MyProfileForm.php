<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;

class MyProfileForm extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $company;
    public $phone;
    public $password;
    public $b_address_line1;
    public $b_address_line2;
    public $b_city;
    public $b_state;
    public $b_pincode;
    public $b_country;
    
    public $s_address_line1;
    public $s_address_line2;
    public $s_city;
    public $s_state;
    public $s_pincode;
    public $s_country;
    
    public function rules()
    {
        return [
            [['fname', 'email', 'company', 'phone','password','b_address_line1','b_city','b_state','b_pincode','b_country','s_address_line1','s_city','s_state','s_pincode','s_country'], 'required'],
			[['b_address_line2','s_address_line2'],'safe'],
            // email has to be a valid email address
            ['email', 'email'],
            //string validation
			[['fname','lname', 'email','company',],'string'],
			[['fname','lname',],'match','pattern'=>'/^[a-zA-Z.,-]+(?:\s[a-zA-Z.,-]+)*$/','message'=> 'only string pattern allowed'],
			//[['txtJTitle','txtComments',],'match','pattern'=>'/^[a-zA-Z0-9.,-]+(?:\s[a-zA-Z.,-]+)*$/','message'=> 'only string and number pattern allowed'],
			[['phone','b_pincode','s_pincode'],'number'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
			'fname'=>'First Name',
			'lname'=>'Last Name',
			'email'=>'Email',
        ];
    }

}
