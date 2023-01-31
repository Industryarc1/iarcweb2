<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_order_dtls".
 *
 * @property int $inc_id
 * @property string $order_hdr_num
 * @property string $post_id
 * @property string $licence
 * @property int $qty
 * @property double $price
 * @property string $dt_created
 * @property string $dt_modified
 */
class ZspOrderDtls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_order_dtls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_hdr_num', 'post_id', 'licence', 'qty', 'price', 'dt_created'], 'required'],
            [['qty'], 'integer'],
            [['price'], 'number'],
            [['dt_created', 'dt_modified'], 'safe'],
            [['order_hdr_num', 'post_id', 'licence'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inc_id' => 'Inc ID',
            'order_hdr_num' => 'Order Hdr Num',
            'post_id' => 'Post ID',
            'licence' => 'Licence',
            'qty' => 'Qty',
            'price' => 'Price',
            'dt_created' => 'Dt Created',
            'dt_modified' => 'Dt Modified',
        ];
    }
}
