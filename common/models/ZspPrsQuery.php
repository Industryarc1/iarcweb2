<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ZspPrs]].
 *
 * @see ZspPrs
 */
class ZspPrsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ZspPrs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ZspPrs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	public static function getListPress($arrInputs=[]){
		$orderBy = !empty($arrInputs['orderBy'])?$arrInputs['orderBy']:SORT_DESC;
	//	var_dump($orderBy);exit;
		$arrPressReleas = ZspPrs::find()
                ->where(['status'=>1])->andWhere('mnfctr <= CURRENT_DATE()');
        /* if only year is selected */
        if(!empty($arrInputs['y']) && empty($arrInputs['m'])){
            $arrPressReleas = $arrPressReleas->andWhere(['YEAR(mnfctr)' => $arrInputs['y']]);
        }
        /* if month is selected */
        if(isset($arrInputs['m']) && !empty($arrInputs['m'])){
            $month = date('m',strtotime($arrInputs['m']));
            $sdate = date('Y-m-d',strtotime($arrInputs['y'].'-'.$month.'-01'));
            $edate = date('Y-m-t',strtotime($sdate));

            $arrPressReleas = $arrPressReleas->andWhere(['between','mnfctr',$sdate,$edate]);
        }
		/* Default order-by  is Descending order */
        $arrPressReleas = $arrPressReleas->orderBy(['prod_id'=>$orderBy]);
		
        if(isset($arrInputs['limit']) && !empty($arrInputs['limit'])){
			$arrPressReleas = $arrPressReleas->limit($arrInputs['limit']);
		}
		/* uncomment the below line to see the raw sql */
        // $arrPressReleas = $arrPressReleas->createCommand()->getRawSql();echo $arrPressReleas;exit;
        if(!empty($arrInputs['asObj']) && $arrInputs['asObj'] == TRUE){
            $arrPressReleas= $arrPressReleas;
        }else{
            $arrPressReleas = $arrPressReleas->asArray()->all();
        }
        
        return $arrPressReleas;
	}
}
