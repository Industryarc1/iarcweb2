<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zsp_posts".
 *
 * @property int $inc_id
 * @property string $cat
 * @property string $subcat
 * @property string $title
 * @property string $code
 * @property string $short_descr
 * @property string $description
 * @property string $table_of_content
 * @property string $report_type
 * @property string $pub_date
 * @property string $report_del
 * @property string $del_time
 * @property string $file_format
 * @property string $no_pages
 * @property double $slp
 * @property double $clp
 * @property string $image
 * @property int $status
 * @property string $curl
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_descr
 * @property string $seo_keyword
 * @property string $dt_created
 * @property string $related
 * @property string $taf
 * @property double $cc
 * @property int $new
 * @property int $top
 * @property string $pages
 * @property int $cat_but
 * @property string $atag
 * @property int $dup_inc_id
 * @property string $cbreadcrumb
 * @property int $publish_type
 * @property int $is_publish
 * @property string $pub_date_new
 * @property int $copies_sold
 * @property double $rating
 * @property string $description_de
 * @property string $description_de1
 */
class ZspPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zsp_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat', 'subcat', 'title', 'code', 'short_descr', 'description', 'table_of_content', 'report_type', 'pub_date', 'report_del', 'del_time', 'file_format', 'no_pages', 'slp', 'status', 'curl', 'meta_title', 'meta_keywords', 'meta_descr', 'seo_keyword', 'dt_created', 'related', 'taf', 'dup_inc_id', 'cbreadcrumb', 'is_publish', 'pub_date_new', 'copies_sold', 'rating'], 'required'],
            [['title', 'short_descr', 'description', 'table_of_content', 'meta_keywords', 'meta_descr', 'seo_keyword', 'related', 'taf', 'cbreadcrumb', 'description_de', 'description_de1'], 'string'],
            [['pub_date', 'dt_created', 'pub_date_new'], 'safe'],
            [['slp', 'clp', 'cc', 'rating'], 'number'],
            [['status', 'new', 'top', 'cat_but', 'dup_inc_id', 'publish_type', 'is_publish', 'copies_sold'], 'integer'],
            [['cat', 'subcat', 'image', 'atag'], 'string', 'max' => 255],
            [['code', 'report_type', 'report_del', 'del_time'], 'string', 'max' => 200],
            [['file_format', 'no_pages'], 'string', 'max' => 50],
            [['curl'], 'string', 'max' => 500],
            [['meta_title'], 'string', 'max' => 300],
            [['pages'], 'string', 'max' => 20],
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
            'cat' => 'Cat',
            'subcat' => 'Subcat',
            'title' => 'Title',
            'code' => 'Code',
            'short_descr' => 'Short Descr',
            'description' => 'Description',
            'table_of_content' => 'Table Of Content',
            'report_type' => 'Report Type',
            'pub_date' => 'Pub Date',
            'report_del' => 'Report Del',
            'del_time' => 'Del Time',
            'file_format' => 'File Format',
            'no_pages' => 'No Pages',
            'slp' => 'Slp',
            'clp' => 'Clp',
            'image' => 'Image',
            'status' => 'Status',
            'curl' => 'Curl',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_descr' => 'Meta Descr',
            'seo_keyword' => 'Seo Keyword',
            'dt_created' => 'Dt Created',
            'related' => 'Related',
            'taf' => 'Taf',
            'cc' => 'Cc',
            'new' => 'New',
            'top' => 'Top',
            'pages' => 'Pages',
            'cat_but' => 'Cat But',
            'atag' => 'Atag',
            'dup_inc_id' => 'Dup Inc ID',
            'cbreadcrumb' => 'Cbreadcrumb',
            'publish_type' => 'Publish Type',
            'is_publish' => 'Is Publish',
            'pub_date_new' => 'Pub Date New',
            'copies_sold' => 'Copies Sold',
            'rating' => 'Rating',
            'description_de' => 'Description De',
            'description_de1' => 'Description De1',
        ];
    }

    /**
     * @inheritdoc
     * @return ZspPostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZspPostsQuery(get_called_class());
    }
}
