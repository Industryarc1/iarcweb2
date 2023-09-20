<?php

namespace frontend\models;

use Yii;

class ZspContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $verifyCode;
	public $title;
	public $pr_title;
	public $phoneExt;
	public $txtCountry;
	public $txtPhoneExt;
	public $report_code;
	
    public static function tableName()
    {
        return 'zsp_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_fname', 'c_email', 'c_phone', 'c_message', 'c_ip', 'c_dt_created', 'c_status'], 'required'],
            [['c_message', 'c_ip'], 'string'],
            [['c_dt_created', 'c_lname'], 'safe'],
            [['c_fname', 'c_lname', 'c_phone'], 'string', 'max' => 100],
            [['c_email'], 'string', 'max' => 255],
            [['c_status'], 'number', ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'ID',
            'c_fname' => 'First Name',
            'c_lname' => 'Last Name',
            'c_email' => 'Email',
            'c_phone' => 'Phone',
            'c_message' => 'Message',
            'c_ip' => 'Ip',
            'c_dt_created' => 'Created Date',
            'c_status' => 'Status',
        ];
    }
}
