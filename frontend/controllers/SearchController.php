<?php
namespace frontend\controllers;

use Yii;
use common\models\ZspPosts;

/**
 * SearchController
 */
class SearchController extends IarcfbaseController
{

  public function actionSearch() {
		$arrGet1 = Yii::$app->request->get();
		$arrGet['searchKey'] = filter_var($arrGet1['searchKey'], FILTER_SANITIZE_STRING);
		if(isset($arrGet1['tag'])){
		$arrGet['tag'] = filter_var($arrGet1['tag'], FILTER_SANITIZE_STRING);	
		}else{
		$arrGet['tag']	= "All";
		}
		//echo '<pre>';print_r($arrGet);exit;
    if(empty($arrGet['searchKey']) || !isset($arrGet['searchKey'])){
     return $this->goHome();
    }
  $searchTag = $arrGet['tag'];		
  $searchKey = $_SESSION['searchKey'] =$arrGet['searchKey'];
		$searchIn = !empty($arrGet['searchIn'])?$arrGet['searchIn']:NULL;

				$arrReports = $this->actionSearchReport($searchKey);
				$arrReportData = $this->actionModifyArr(['report'=>$arrReports]);

				$arrPrsData = array();
				$arrArticleData = array();
				$arrPaperData = array(); 

/*
				$arrPrs = $this->actionSearchPressRelease($searchKey);
				$arrPrsData = $this->actionModifyArr(['prs'=>$arrPrs]);

				$arrArticle = $this->actionSearchArticles($searchKey);
				$arrArticleData = $this->actionModifyArr(['article'=>$arrArticle]);

				$arrPaper = $this->actionSearchWhitepapers($searchKey);
				$arrPaperData = $this->actionModifyArr(['whitepaper'=>$arrPaper]);
*/
				$arrAllData = array_merge($arrReportData,$arrPrsData,$arrArticleData,$arrPaperData);

		  return $this->render('search',[
		 	'searchKey'=>$searchKey,
		 	'searchIn'=>$searchIn,
			'searchTag'=>$searchTag,
			 'reportdata'=>!empty($arrReportData)?$arrReportData:[],
			 'pressdata'=>!empty($arrPrsData)?$arrPrsData:[],
    'articledata'=>!empty($arrArticleData)?$arrArticleData:[],
    'paperdata'=>!empty($arrPaperData)?$arrPaperData:[],
    'data'=>!empty($arrAllData)?$arrAllData:[]
		 ]);
 }
	
	public function actionSearchReport($reportTitle){
		$keyTitle1= \Yii::$app->db->quoteValue($reportTitle.'%');
		$keyTitle2= \Yii::$app->db->quoteValue($reportTitle);
		$newtitle = strtoupper($reportTitle);
		$newtitle2 = ucfirst($reportTitle);
		$newtitle3 = ucwords($reportTitle);
		
		$sql = "(SELECT `title`, `short_descr`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE status=1 AND `title` LIKE ".$keyTitle1." (REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$reportTitle%')) LIMIT 10";

		/*$sql = "(SELECT `title`, `short_descr`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE status=1 AND `title` LIKE ".$keyTitle1.") 
				UNION 
				(SELECT `title`, `short_descr`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE status=1 AND MATCH(`title`) AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 10";*/


	//$sql = "(SELECT `title`, `short_descr`, `description`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE STATUS =1 AND (FROM_BASE64(`description`) LIKE '%$reportTitle%' OR FROM_BASE64(`description`) LIKE '%$newtitle%' OR title LIKE ".$keyTitle1.")) UNION (SELECT `title`, `short_descr`, `description`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE STATUS=1 AND MATCH(`title`) AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 50";	
	
	//main now  $sql = "(SELECT `title`, `short_descr`, `description`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE STATUS =1 AND (FROM_BASE64(`description`) LIKE '%$reportTitle%' OR FROM_BASE64(`description`) LIKE '%$newtitle%' OR title LIKE ".$keyTitle1."))";

	// main now all - $sql = 	"(SELECT `title`, `short_descr`, `description`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE STATUS =1 AND (REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$newtitle3%' OR REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$newtitle2%' OR REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$reportTitle%' OR REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$newtitle%' OR title LIKE ".$keyTitle1.") limit 10)";
		
//$sql = 	"(SELECT `title`, `short_descr`, `description`, `curl`, `meta_title`, `dup_inc_id` FROM `zsp_posts` WHERE STATUS =1 AND  (REGEXP_REPLACE(FROM_BASE64(`description`), '<img[^>]*>', '') LIKE '%$reportTitle%' OR title LIKE ".$keyTitle1.") limit 10)";


	//echo $sql;		

//exit;
		/*$sql = "(SELECT title, short_descr, description, curl, meta_title, dup_inc_id FROM zsp_posts WHERE STATUS =1 AND (FROM_BASE64('description') LIKE '%".$keyTitle2."%' OR title LIKE '".$keyTitle1."'))UNION (SELECT title, short_descr, description, curl, meta_title, dup_inc_id FROM zsp_posts WHERE STATUS=1 AND MATCH('title') AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 10";*/		


		$arrReports = Yii::$app->db->createCommand($sql)->queryAll();
		return $arrReports;
	}
	
	private function actionModifyArr($arrData = []){
		$arrResponce = [];
		if(!empty($arrData)){
			if(!empty($arrData['report'])){
				foreach($arrData['report'] as $data){
					$title = !empty(strpos(strtolower($data['title']),'market')) ? substr($data['title'],0,strpos(strtolower($data['title']),'market')+6) : $data['title'];
					$arrResponce[]=[
						//'title'=>substr($data['title'],0,strpos(strtolower($data['title']),'market')+6),//strpos + 6 will give the position till market because characters in market =6
						'title'=>$title,
						'short_descr'=>$data['short_descr'],
						'curl'=>($data['dup_inc_id']<500000)? 'Report/'.$data['dup_inc_id'].'/'.$data['curl'] : 'Research/'.$data['curl'].'-'.$data['dup_inc_id'],
						'meta_title'=>$data['meta_title'],
					];
				}
			}
			if(!empty($arrData['prs'])){
				foreach($arrData['prs'] as $data){
					$title = !empty(strpos(strtolower($data['title']),'market')) ? substr($data['title'],0,strpos(strtolower($data['title']),'market')+6) : $data['title'];
					$arrResponce[]=[
						'title'=>$title,
						'short_descr'=>base64_decode($data['short_descr']),
						'curl'=>'PressRelease/'.$data['prod_id'].'/'.$data['seo_keyword'],
						'meta_title'=>$data['meta_title'],
					];
				}
			}
			if(!empty($arrData['article'])){
				foreach($arrData['article'] as $data){
					$title = !empty(strpos(strtolower($data['title']),'market')) ? substr($data['title'],0,strpos(strtolower($data['title']),'market')+6) : $data['title'];
					$arrResponce[]=[
						'title'=>$title,
						'short_descr'=>base64_decode($data['short_descr']),
						'curl'=>'Article/'.$data['custid'].'/'.$data['seo_keyword'],
						'meta_title'=>$data['meta_title'],
					];
				}
			}
			if(!empty($arrData['whitepaper'])){
				foreach($arrData['whitepaper'] as $data){
					$title = $data['title'];
					$arrResponce[]=[
						'title'=>$title,
						'short_descr'=>base64_decode($data['short_descr']),
						'curl'=>'WhitePaperDownload/'.$data['prod_id'].'/'.$data['seo_keyword'],
						'meta_title'=>$data['meta_title'],
					];
				}
			}
		}
		return $arrResponce;
	}
	
	/* 
	*@Description: This Method will be called via Ajax call 
	* when we type in search input field
	*/
	
	public function actionSearchOptions(){
		$searchKey = filter_var(Yii::$app->request->post('searchKey'), FILTER_SANITIZE_STRING);
		$sql = "SELECT `title` FROM `zsp_posts` WHERE status=1 AND `title` LIKE '%".$searchKey."%' LIMIT 20";
		$arrReports = Yii::$app->db->createCommand($sql)->queryAll();
		$strResponce = NULL;
		foreach($arrReports as $report){
			$title = explode("Market",$report['title'])[0];
			$strResponce .= '<option value="'.$title.'">';
		}
		return $strResponce;
	}
	
	public function unique_multidim_array($array, $key) {
		$temp_array = $key_array = array();
		$i = 0;
		foreach($array as $val) {
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$temp_array[$i] = $val;
			}
			$i++;
		}
		return $temp_array;
	}

	public function actionSearchPressRelease($title){
		$keyTitle1= \Yii::$app->db->quoteValue($title.'%');
		$keyTitle2= \Yii::$app->db->quoteValue($title);
		$newtitle = strtoupper($title);
		$sql = "(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `prod_id` FROM `zsp_prs` WHERE  (FROM_BASE64(`descr`) LIKE '%$title%' OR FROM_BASE64(`descr`) LIKE '%$newtitle%' OR `title` LIKE ".$keyTitle1.")) 
				UNION 
				(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `prod_id` FROM `zsp_prs` WHERE MATCH(`title`) AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 50";
		$arrPrs = Yii::$app->db->createCommand($sql)->queryAll();
		return $arrPrs;
	}
	
	public function actionSearchWhitepapers($title){
		$keyTitle1= \Yii::$app->db->quoteValue($title.'%');
		$keyTitle2= \Yii::$app->db->quoteValue($title);
		$newtitle = strtoupper($title);
		$sql = "(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `prod_id` FROM `zsp_whitepapers` WHERE (FROM_BASE64(`descr`) LIKE '%$title%' OR FROM_BASE64(`descr`) LIKE '%$newtitle%' OR `title` LIKE ".$keyTitle1.")) 
				UNION 
				(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `prod_id` FROM `zsp_whitepapers` WHERE MATCH(`title`) AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 50";
		$arrPapers = Yii::$app->db->createCommand($sql)->queryAll();
		return $arrPapers;
	}
	
	public function actionSearchArticles($title){
		$keyTitle1= \Yii::$app->db->quoteValue($title.'%');
		$keyTitle2= \Yii::$app->db->quoteValue($title);
		$newtitle = strtoupper($title);
		$sql = "(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `custid` FROM `zsp_news` WHERE (FROM_BASE64(`descr`) LIKE '%$title%' OR FROM_BASE64(`descr`) LIKE '%$newtitle%' OR `title` LIKE ".$keyTitle1.")) 
				UNION 
				(SELECT `title`, `short_descr`, `seo_keyword`, `meta_title`, `custid` FROM `zsp_news` WHERE MATCH(`title`) AGAINST (".$keyTitle2." IN NATURAL LANGUAGE MODE)) LIMIT 50";
		$arrArticles = Yii::$app->db->createCommand($sql)->queryAll();
		return $arrArticles;
	}
	public function actionSearch_Bk()
     {
 		$arrGet = Yii::$app->request->get();
 		//echo '<pre>';print_r($arrGet);exit;
 		if(empty($arrGet['searchKey']) || !isset($arrGet['searchKey'])){
 			return $this->goHome();
 		}
 		$searchKey = $_SESSION['searchKey'] =$arrGet['searchKey'];
 		$searchIn = !empty($arrGet['searchIn'])?$arrGet['searchIn']:NULL;
 		switch($searchIn){
 			case'report':
 				$arrReports = $this->actionSearchReport($searchKey);
 				$arrModifiedData = $this->actionModifyArr(['report'=>$arrReports]);
 				break;
 			case'prs':
 				$arrPrs = $this->actionSearchPressRelease($searchKey);
 				$arrModifiedData = $this->actionModifyArr(['prs'=>$arrPrs]);
 				break;
 			case'article':
 				$arrArticle = $this->actionSearchArticles($searchKey);
 				$arrModifiedData = $this->actionModifyArr(['article'=>$arrArticle]);
 				break;
 			case'whitepaper':
 				$arrPaper = $this->actionSearchWhitepapers($searchKey);
 				$arrModifiedData = $this->actionModifyArr(['whitepaper'=>$arrPaper]);
 				break;
 			default:
 				$arrReports = $this->actionSearchReport($searchKey);
 				$arrPrs = $this->actionSearchPressRelease($searchKey);
 				$arrArticle = $this->actionSearchArticles($searchKey);
 				$arrPaper = $this->actionSearchWhitepapers($searchKey);
 				$arrModifiedData = $this->actionModifyArr([
 										'report'=>$arrReports,
 										'prs'=>$arrPrs,
 										'article'=>$arrArticle,
 										'whitepaper'=>$arrPaper,
 									]);
 		}

 		$arrLatestReport = $this->actionModifyArr(['report'=>ZspPosts::find()->where(['status'=>1])->orderBy(['dt_created'=>SORT_DESC])->limit(10)->asArray()->all()]);
         return $this->render('search',[
 			'searchKey'=>$searchKey,
 			'searchIn'=>$searchIn,
 			'data'=>!empty($arrModifiedData)?$arrModifiedData:[],
 			'latestReport'=>$arrLatestReport,
 		]);
     }
}
