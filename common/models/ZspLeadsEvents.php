<?php

namespace common\models;

use Yii;


class ZspLeadsEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_leads_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comments', 'industry'], 'string'],
            [['fname','email','phone','type','ip'], 'required'],
            [['country', 'industry', 'revenue', 'speak_to_alyst', 'dt_created'], 'safe'],
            [['rid', 'cid', 'scid', 'phone'], 'string', 'max' => 25],
			['email','email'],
            [['fname', 'lname'], 'string', 'max' => 200],
            [['email', 'job', 'company', 'country', 'ip', 'revenue'], 'string', 'max' => 255],
            [['pincode'], 'string', 'max' => 8],
            [['type'], 'string', 'max' => 20],
            [['speak_to_alyst'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inc_id' => 'Inc ID',
            'rid' => 'Rid',
            'cid' => 'Cid',
            'scid' => 'Scid',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'job' => 'Job',
            'company' => 'Company',
            'pincode' => 'Pincode',
            'comments' => 'Comments',
            'dt_created' => 'Dt Created',
            'type' => 'Type',
            'country' => 'Country',
            'ip' => 'Ip',
            'industry' => 'Industry',
            'revenue' => 'Revenue',
            'speak_to_alyst' => 'Speak To Alyst',
        ];
    }
}
