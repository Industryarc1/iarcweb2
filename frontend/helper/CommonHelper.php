<?php
namespace frontend\helper;
use Yii;
use yii\helpers\Url;
use common\models\ZspCatlogCategoriesQuery;
class CommonHelper{
	public static function getPressImgHtml($img = ''){
		$data = "";
		if(!empty($img)){
			$imgPath = Yii::$app->request->baseUrl.'/images/press_release/'.$img;
			
			$data.='<div class="image-box">';
			$data.='<img src="'.$imgPath.'" alt="">';
			$data.='</div>';
		}
		return $data;
	}
	public static function getPressContentHtml($arrPress=[]){
		$data = "";
		if(isset($arrPress) && !empty($arrPress)){
			$date = date("d-M-Y",strtotime($arrPress['mnfctr']));
			$contentTitle = !empty($arrPress['title'])?$arrPress['title']:NULL;
			//$pageUrl = !empty($arrPress['seo_keyword'])?$arrPress['prod_id'].'/'.$arrPress['seo_keyword']:"javascript:void(0)";
			//$pageUrl = !empty($arrPress['prod_id'])?Url::to(['press-releases/press-report','prod_id'=>$arrPress['prod_id']]):"javascript:void(0)";
			$pageUrl = !empty($arrPress['prod_id'])?Url::to(['PressRelease/'.$arrPress['prod_id'].'/'.$arrPress['seo_keyword']]):"javascript:void(0)";
			$shortDesc = !empty($arrPress['short_descr'])?base64_decode($arrPress['short_descr']):NULL;
			
			$data.='<div class="content-box">';
			$data.='<div class="date">'.$date.'</div>';
			$data.='<h2><a href = "'.$pageUrl.'" target="_blank">'.$contentTitle.'</a></h2>';
			$data.='<p>'.$shortDesc.'</p></div>';
		}
		return $data;
	}
	
	public static function reportMenuTree(&$list, $parent){
		$tree = [];
		foreach ($parent as $k=>$l){
			if(isset($list[$l['p_id']]) && !empty($list[$l['p_id']])){
				$l['children'] = !empty($list[$l['inc_id']])?self::reportMenuTree($list, $list[$l['inc_id']]):NULL;
			}
			$tree[] = $l;
		}
		return $tree;
	}
	
	public static function reportMenu(){
	$menu=array();
		$arrCatlogs = ZspCatlogCategoriesQuery::getAllCatlogs();
		if(isset($arrCatlogs) && !empty($arrCatlogs)){
			foreach ($arrCatlogs as $i){
				$arrCat[$i['p_id']][]= $i;
			}
			$list = !empty($arrCat)?$arrCat:[];
			$parent = !empty($arrCat[0])?$arrCat[0]:[];
			if(!empty($list) && !empty($parent)){
				$menu = self::reportMenuTree($list, $parent);
			}
		}
		return $menu;
	}
	
	public static function modifyContent($content = NULL){
		$finalContent= str_replace('\"', '"', $content);
		$finalContent= str_replace("\'", "'", $finalContent);
		$finalContent= str_replace('\n', "<br>", $finalContent);
		return $finalContent;
	}
	
	public static function sanitizeContent($content){
		//return preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&:$,-;]/s', ' ', $content);
		return $content;
		
	}
	
	public static function getCountryList(){
		$sql = "SELECT * FROM zsp_location WHERE is_visible=0 AND location_type=0 ORDER BY NAME ASC";
		$query = Yii::$app->db->createCommand($sql)->queryAll();
		return $query;
	}
}
?>