<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_order_hdrs".
 *
 * @property int $inc_id
 * @property string $login_id
 * @property string $order_num
 * @property string $cust_name
 * @property string $cust_po_num
 * @property string $cust_email
 * @property string $cust_s_addr
 * @property string $cust_b_addr
 * @property string $pincode
 * @property double $order_amt
 * @property string $dt_created
 * @property string $dt_modified
 * @property string $order_status
 * @property string $pay_mode
 */
class ZspOrderHdrs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_order_hdrs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_id', 'order_num', 'cust_name', 'cust_email', 'cust_s_addr', 'cust_b_addr', 'order_amt', 'dt_created', 'dt_modified', 'order_status', 'pay_mode'], 'required'],
            [['cust_s_addr', 'cust_b_addr'], 'string'],
            [['order_amt'], 'number'],
            [['dt_created', 'dt_modified'], 'safe'],
            [['login_id', 'cust_name', 'cust_email', 'order_status', 'pay_mode'], 'string', 'max' => 255],
            [['order_num'], 'string', 'max' => 200],
            [['cust_po_num'], 'string', 'max' => 20],
            [['pincode'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inc_id' => 'Inc ID',
            'login_id' => 'Login ID',
            'order_num' => 'Order Num',
            'cust_name' => 'Cust Name',
            'cust_po_num' => 'Cust Po Num',
            'cust_email' => 'Cust Email',
            'cust_s_addr' => 'Cust S Addr',
            'cust_b_addr' => 'Cust B Addr',
            'pincode' => 'Pincode',
            'order_amt' => 'Order Amt',
            'dt_created' => 'Dt Created',
            'dt_modified' => 'Dt Modified',
            'order_status' => 'Order Status',
            'pay_mode' => 'Pay Mode',
        ];
    }
}
