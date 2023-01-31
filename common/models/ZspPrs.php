<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_prs".
 *
 * @property int $prod_id
 * @property string $title
 * @property string $type
 * @property string $cat
 * @property string $mnfctr
 * @property string $image
 * @property string $descr
 * @property int $pplr
 * @property int $sort_order
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_descr
 * @property string $seo_keyword
 * @property int $status
 * @property string $dt_created
 * @property int $featured
 * @property string $short_descr
 */
class ZspPrs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_prs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'dt_created', 'short_descr'], 'required'],
            [['descr', 'meta_keywords', 'meta_descr', 'short_descr'], 'string'],
            [['pplr', 'sort_order', 'status', 'featured'], 'integer'],
            [['dt_created'], 'safe'],
            [['title', 'type', 'cat', 'mnfctr', 'image', 'meta_title', 'seo_keyword'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prod_id' => 'Prod ID',
            'title' => 'Title',
            'type' => 'Type',
            'cat' => 'Cat',
            'mnfctr' => 'Mnfctr',
            'image' => 'Image',
            'descr' => 'Descr',
            'pplr' => 'Pplr',
            'sort_order' => 'Sort Order',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_descr' => 'Meta Descr',
            'seo_keyword' => 'Seo Keyword',
            'status' => 'Status',
            'dt_created' => 'Dt Created',
            'featured' => 'Featured',
            'short_descr' => 'Short Descr',
        ];
    }

    /**
     * @inheritdoc
     * @return ZspPrsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZspPrsQuery(get_called_class());
    }
}
