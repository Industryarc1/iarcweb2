<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ZspPosts]].
 *
 * @see ZspPosts
 */
class ZspFaqsQuery extends \yii\db\ActiveQuery
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
	
	public static function getCategoryWiseReport($arrInputs = []){
		//print_r($arrInputs); die;
		$arrReportCatlog= ZspPosts::find()->alias('zp');//->select(['']);
		if(isset($arrInputs['cat']) && !empty($arrInputs['cat'])){
			$arrReportCatlog= $arrReportCatlog->innerJoin('zsp_catlog_categories zcc','zcc.inc_id = IF(zp.subcat>0,zp.subcat,zp.cat)');
		}
		if(isset($arrInputs['cat']) && !empty($arrInputs['cat'])){
			$arrReportCatlog= $arrReportCatlog->where(['zcc.code'=>$arrInputs['cat']]);
		}
		$arrReportCatlog= $arrReportCatlog->andWhere(['zp.status'=>1]);
		/* if(isset($arrInputs['subcat']) && !empty($arrInputs['subcat'])){
			$arrReportCatlog= $arrReportCatlog->andWhere(['subcat'=>$arrInputs['subcat']]);
		} */
		/* uncomment the below line to see the raw sql */
		//$arrReportCatlog = $arrReportCatlog->createCommand()->getRawSql();echo $arrReportCatlog;exit;
        if(!empty($arrInputs['asObj']) && $arrInputs['asObj'] == TRUE){
            $arrReportCatlog= $arrReportCatlog;
        }else if(!empty($arrInputs['getCount']) && $arrInputs['getCount'] == TRUE){
            $arrReportCatlog= $arrReportCatlog->count();
        }else{
			$arrReportCatlog= $arrReportCatlog->asArray()->all();
		}
		
		//print_r($arrReportCatlog); die;
		return $arrReportCatlog;
	}
}
