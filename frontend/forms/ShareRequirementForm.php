<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ShareRequirementForm extends Model
{

    public $txtFName;
    public $txtLName;
    public $txtEmail;
    public $txtJTitle;
    public $txtPhone;
    public $txtPhoneExt;
    public $requirementChecks;
    public $txtComments;
    
    /* Hidden Inputs Start */
	public $formId;
    public $txtCompany;
    public $txtCheckboxName;
    public $datetimepicker;
    public $timezonepicker;
    public $txtCountry;
    public $hidReportCode;
    public $hidReport;
    public $hidCat;
    public $hidSubCat;
    public $hidReportName;
    public $hidCatName;
    public $hidPName;
    public $hidSubCatName;
    public $hidSubPName;
    public $pub_date;
    public $noofpages;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['txtFName', 'txtLName','txtEmail', 'txtJTitle', 'txtPhone'], 'required'],
			[['txtComments','requirementChecks'],'safe'],
            // email has to be a valid email address
            ['txtEmail', 'email'],
            //string validation
			[['txtFName','txtLName', 'txtJTitle','txtComments',],'string'],
			[['txtFName','txtLName',],'match','pattern'=>'/^[a-zA-Z.,-]+(?:\s[a-zA-Z.,-]+)*$/','message'=> 'only string pattern allowed'],
			//[['txtJTitle','txtComments',],'match','pattern'=>'/^[a-zA-Z0-9.,-]+(?:\s[a-zA-Z.,-]+)*$/','message'=> 'only string and number pattern allowed'],
			[['txtPhoneExt','txtPhone'],'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
			'txtFName'=>'First Name',
			'txtLName'=>'Last Name',
			'txtEmail'=>'Email',
			'txtJTitle'=>'Job Title',
			'txtPhone'=>'Contact Number',
            'txtPhoneExt'=>'Country Code',
			'txtComments'=>'Your Requirements',
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
