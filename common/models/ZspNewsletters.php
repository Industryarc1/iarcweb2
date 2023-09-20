<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_newsletters".
 *
 * @property int $nl_id
 * @property string $nl_email
 * @property string $nl_subcribed_date
 * @property string $nl_unsubcribed_date
 * @property int $nl_status
 * @property string $nl_industry
 */
class ZspNewsletters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_newsletters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nl_email', 'nl_subcribed_date'], 'required'],
            [['nl_subcribed_date', 'nl_unsubcribed_date', 'nl_industry'], 'safe'],
            ['nl_email', 'email'],
            ['nl_email', 'unique', 'targetClass' => '\common\models\ZspNewsletters', 'message' => 'Email already subscribed.'],
            [['nl_email'], 'string', 'max' => 200],
            [['nl_status'], 'string', 'max' => 4],
            [['nl_industry'], 'string', 'max' => 255],
            [['nl_email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nl_id' => 'ID',
            'nl_email' => 'Email',
            'nl_subcribed_date' => 'Subcribed Date',
            'nl_unsubcribed_date' => 'Unsubcribed Date',
            'nl_status' => 'Status',
            'nl_industry' => 'Industry',
        ];
    }
}
