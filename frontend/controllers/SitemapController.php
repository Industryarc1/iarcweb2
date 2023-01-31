<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\IarcfbaseController;
use frontend\helper\CommonHelper;

class SitemapController extends IarcfbaseController
{

    public function actionSitemapHtml()
    {
		$arrReportDomains = CommonHelper::reportMenu();
		//echo '<pre>';print_r($arrReportDomains);exit;
		return $this->render('sitemapHtml',['reports'=>$arrReportDomains]);
    }
	
	public function actionCreateSitemapXml(){
		$isValidLogin =FALSE;
		$loginErr = NULL;
		if(Yii::$app->request->isPost){
			$arrInputs = Yii::$app->request->post();
			$username = $arrInputs['username'];
			$password = $arrInputs['password'];
			$validCrential = [
				'iarc'=>'Iarc@123',
				'iarcadmin'=>'akm@329',
			];
			$valid_users = array_keys($validCrential);
			$isValidLogin = ((in_array($username,$valid_users)) && ($password ===$validCrential[$username]));
			if(!$isValidLogin){
				$loginErr= 'Invalid Login Credential';
			}else{
				$arrData = [];
				$sqlReport = "SELECT IF(zp.dup_inc_id<500000,CONCAT('https://industryarc.com/Report/',zp.dup_inc_id,'/',zp.curl), CONCAT('https://industryarc.com/Research/',zp.curl,'-',zp.dup_inc_id)) AS link FROM zsp_posts zp  WHERE zp.status=1 AND zp.curl<>'' AND zp.curl NOT LIKE '%&%'";
				$arrData['report'] = Yii::$app->db->createCommand($sqlReport)->queryAll();
				
				$sqlDomain = "SELECT CONCAT('https://industryarc.com/Domain/',zp.code,'/',zp.seo_keyword) AS link FROM zsp_catlog_categories zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
				$arrData['domain'] = Yii::$app->db->createCommand($sqlDomain)->queryAll();
				
				$sqlArticle = "SELECT CONCAT('https://industryarc.com/Article/',zp.custid,'/',zp.seo_keyword) AS link FROM zsp_news zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
				$arrData['article'] = Yii::$app->db->createCommand($sqlArticle)->queryAll();
				
				$sqlPr = "SELECT CONCAT('https://industryarc.com/PressRelease/',zp.prod_id,'/',zp.seo_keyword) as link FROM zsp_prs zp WHERE `status`=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
				$arrData['pressrelease'] = Yii::$app->db->createCommand($sqlPr)->queryAll();
				
				$sqlWp = "SELECT CONCAT('https://industryarc.com/WhitePaperDownload/',zp.prod_id,'/',zp.seo_keyword) AS link FROM zsp_whitepapers zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
				$arrData['whitepaper'] = Yii::$app->db->createCommand($sqlWp)->queryAll();
				
				$arrData['others'] = [
					['link'=> 'https://industryarc.com/'],
					['link'=> 'https://industryarc.com/press-releases.php'],
					['link'=> 'https://industryarc.com/contact-us.php'],
					['link'=> 'https://industryarc.com/team.php'],
					['link'=> 'https://industryarc.com/about-us.php'],
					['link'=> 'https://industryarc.com/privacy-policy.php'],
					['link'=> 'https://industryarc.com/term-and-conditions.php'],
				];
				//echo '<pre>';print_r($arrData);exit;
				
				$xmlFileData = $this->renderPartial('sitemapXml',['data'=>$arrData]);
				$DS = DIRECTORY_SEPARATOR;
				$fileName = dirname(__DIR__).$DS.'web'.$DS.'popo.xml';
				file_put_contents($fileName,$xmlFileData);
				ob_clean();
				$xmlUrl = Yii::$app->request->baseurl .'/popo.xml';
				echo "<h3>XML File Created.</h3><h3><a href='$xmlUrl' target='_blank'>Click here</a> to See the file.</h3>";exit;
			}
			
		}
		return $this->renderPartial('sitemapLogin',['loginErr'=>$loginErr]);

	}
}
