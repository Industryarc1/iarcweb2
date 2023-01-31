<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_catlog_categories".
 *
 * @property int $inc_id
 * @property string $name
 * @property int $p_id
 * @property string $p_name
 * @property int $s_p_id
 * @property string $s_p_name
 * @property string $title
 * @property string $keywords
 * @property string $descr
 * @property string $seo_keyword
 * @property int $sort_order
 * @property int $status
 * @property string $dt_created
 * @property int $home
 * @property string $code
 * @property string $image
 * @property string $meta_desc
 */
class ZspCatlogCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_catlog_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 's_p_name', 'title', 'keywords', 'descr', 'seo_keyword', 'dt_created', 'code', 'meta_desc'], 'required'],
            [['p_id', 's_p_id', 'sort_order', 'status', 'home'], 'integer'],
            [['keywords', 'descr', 'meta_desc'], 'string'],
            [['dt_created'], 'safe'],
            [['name', 'p_name', 's_p_name', 'title', 'seo_keyword', 'image'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 15],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inc_id' => 'Inc ID',
            'name' => 'Name',
            'p_id' => 'P ID',
            'p_name' => 'P Name',
            's_p_id' => 'S P ID',
            's_p_name' => 'S P Name',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'descr' => 'Descr',
            'seo_keyword' => 'Seo Keyword',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'dt_created' => 'Dt Created',
            'home' => 'Home',
            'code' => 'Code',
            'image' => 'Image',
            'meta_desc' => 'Meta Desc',
        ];
    }

    /**
     * @inheritdoc
     * @return ZspCatlogCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZspCatlogCategoriesQuery(get_called_class());
    }
}
