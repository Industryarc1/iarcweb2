<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\ZspCatlogCategories;
class Newsletters extends Widget
{
	
	public function run()
	{
		$arrCatlog = ZspCatlogCategories::find()->select('name')->where(['p_id'=>0,'status'=>1])->orderBy(['sort_order'=>SORT_ASC])->asArray()->all();
		$arrIndustry = yii\helpers\ArrayHelper::map($arrCatlog,'name','name');
		return $this->render('newsletter', [
			'industry'  => $arrIndustry,
        ]);
		
	}
}
?>
