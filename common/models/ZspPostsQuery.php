<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ZspPosts]].
 *
 * @see ZspPosts
 */
class ZspPostsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ZspPosts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ZspPosts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function getCategoryWiseReport($arrInputs = [])
    {
        $arrReportCatlog = ZspPosts::find()->alias('zp');
        if (isset($arrInputs['cat']) && !empty($arrInputs['cat'])) {
            $arrReportCatlog = $arrReportCatlog->innerJoin('zsp_catlog_categories zcc', 'zcc.inc_id = IF(zp.subcat>0,zp.subcat,zp.cat)')->select(['zp.curl', 'zcc.code', 'zp.dup_inc_id', 'zp.title', 'zp.slp']);
        }

        if (isset($arrInputs['cat']) && !empty($arrInputs['cat'])) {
            $arrReportCatlog = $arrReportCatlog->where(['zcc.code' => $arrInputs['cat']]);
        }
        $arrReportCatlog = $arrReportCatlog->andWhere(['zp.status' => 1]);

        /* uncomment the below line to see the raw sql */
        //$arrReportCatlog = $arrReportCatlog->createCommand()->getRawSql();echo $arrReportCatlog;exit;
        
        if (!empty($arrInputs['asObj']) && $arrInputs['asObj'] == TRUE) {
            $arrReportCatlogObj = $arrReportCatlog;
        } else {
            $arrReportCatlog = $arrReportCatlog->asArray()->all();
        }

        return $arrReportCatlogObj;
    }
}
