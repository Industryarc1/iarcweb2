<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\IarcfbaseController;
use common\models\ZspNews;

class NewsArticleController extends IarcfbaseController
{
    public function actionListArticle()
    {
		   		$arrArticle = ZspNews::find()->where(['status'=>1])->asArray()->all();
     		$objArticle = ZspNews::find()->orderBy(['dt_created'=>SORT_DESC]);
     		/* Pagination code start */
     		$count = count($arrArticle);
     		$pagination = new \yii\data\Pagination(['totalCount' => $count, 'defaultPageSize' => 3000]);
     		//$models = $objArticle->orderBy('dt_created1', 'DESC')->offset($pagination->offset)
            $models = $objArticle->offset($pagination->offset)
              ->limit($pagination->limit)
     	      ->all();
     		/* Pagination code End */
     		//echo '<pre>';print_r($models);exit;
     		return $this->render('listArticle',['articles'=>$models,'pagination' => $pagination]);
    }
	
     public function actionArticle(){
     	$urlParam = Yii::$app->request->get();
    		$contactModel = new \frontend\models\ZspContact();
    		$arrArticle = ZspNews::find()
    			->where([
    				'status'=>1,
    				'custid'=>$urlParam['custid'],
    				'seo_keyword'=>$urlParam['seo_keyword'],
    				])
    			->asArray()->one();
    			 	//	 echo '<pre>';print_r($arrArticle);exit;
    		if(empty($arrArticle)){
    			return $this->goHome();
    		}
    		return $this->render('article',['article'=>$arrArticle,'contactModel'=>$contactModel]);
     }
    
}
