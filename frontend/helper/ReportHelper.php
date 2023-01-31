<?php
namespace frontend\helper;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\ZspCatlogCategoriesQuery;
class ReportHelper{
	
	public static function getCountryDtls(){
		$sql = "SELECT location_id,name,prefix FROM zsp_location WHERE is_visible=0 AND location_type=0 ORDER BY NAME ASC";
		$query = Yii::$app->db->createCommand($sql)->queryAll();
		//try{
		//	$currentCountry = self::getGoogleLocInfo()['geoplugin_countryName'];
		//}catch(Exception $e){
		//	$currentCountry = 'United States';
		//}
		$currentCountry = 'United States';
		foreach($query as $res){
			$arrResponce['cnty_wise_det'][$res['name']] =$res;
		}
		$arrResponce['cnty_dropdown']= ArrayHelper::map($query,'name','name');
		$arrResponce['selected_cnty']= $currentCountry;
		return $arrResponce;
	}
	
	public static function getGoogleLocInfo(){
		$userIp = (Yii::$app->request->hostName =='localhost')?'202.153.37.98': Yii::$app->getRequest()->getUserIP();
	    //echo $_SERVER['REMOTE_ADDR'];
	    //echo "<pre>";
	    //print_r($_SERVER);
	    //exit;
		//$userIp = Yii::$app->getRequest()->getUserIP();
		try{
			$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$userIp;
			
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$geopluginURL);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Length: 2048'));
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl_handle, CURLINFO_HEADER_OUT, true);
			$arrAddDetails = curl_exec($curl_handle);
			//$info = curl_getinfo($curl_handle);
			//var_dump($info);
			curl_close($curl_handle);
			$arrAddDetails = unserialize($arrAddDetails);
			//print_r($arrAddDetails);exit;			
			return $arrAddDetails;
			//return ['geoplugin_countryName'=>'United States'];
		}catch(Exception $e){
			//echo 'Message: ' .$e->getMessage();
			return ['geoplugin_countryName'=>'United States'];
		}
	}
	
	public static function getUserLocInfo(){
		$userIp = (Yii::$app->request->hostName =='localhost')?'202.153.37.98': Yii::$app->getRequest()->getUserIP();
		//$userIp = Yii::$app->getRequest()->getUserIP();
		try{
			$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$userIp;
			
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$geopluginURL);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$arrAddDetails1 = curl_exec($curl_handle);
			curl_close($curl_handle);
			
			$arrAddDetails = unserialize($arrAddDetails1);
		}catch(Exception $e){
			//echo 'Message: ' .$e->getMessage();
			$arrAddDetails = ['geoplugin_countryName'=>'United States'];
		}
		//$arrAddDetails = unserialize(file_get_contents($geopluginURL));		
		$sql = "SELECT * FROM zsp_location WHERE name= '".$arrAddDetails['geoplugin_countryName']."'";
		$arrResponce = Yii::$app->db->createCommand($sql)->queryOne();
		return $arrResponce;
	}
	
	public static function modifyInquiryFormData($arrInputs = []){
		$arrFormData = [
			'token'=>'deeptest',
			'f_name' => !empty($arrInputs['txtFName'])?$arrInputs['txtFName']:NULL,
			'l_name' => !empty($arrInputs['txtLName'])?$arrInputs['txtLName']:NULL,
			'company' =>  !empty($arrInputs['txtCompany'])?$arrInputs['txtCompany']:NULL,
			'job_title' => !empty($arrInputs['txtJTitle'])?$arrInputs['txtJTitle']:NULL,
			'phonenumber' => !empty($arrInputs['txtPhoneExt'] && $arrInputs['txtPhone'])? $arrInputs['txtPhoneExt'].' '.$arrInputs['txtPhone'] :NULL ,
			'email' => !empty($arrInputs['txtEmail'])?$arrInputs['txtEmail']:NULL,
			'txtComments' => !empty($arrInputs['txtComments'])?$arrInputs['txtComments']:NULL,
			'hidReportCode' => !empty($arrInputs['hidReportCode'])?$arrInputs['hidReportCode']:NULL,
			'hidReportName' => !empty($arrInputs['hidReportName'])?$arrInputs['hidReportName']:NULL,
			'hidCatName' => !empty($arrInputs['hidCatName'])?$arrInputs['hidCatName']:NULL,
			'hidSubCatName' => !empty($arrInputs['hidSubCatName'])?$arrInputs['hidSubCatName']:NULL,
			'pub_date' =>  !empty($arrInputs['pub_date'])?$arrInputs['pub_date']:NULL,
			'noofpages' => !empty($arrInputs['noofpages'])?$arrInputs['noofpages']:NULL,
			'timezonepicker' => !empty($arrInputs['timezonepicker'])?$arrInputs['timezonepicker']:NULL,
			'entry_point' => 'RBB',
			'lead_generation_channel' => 'IARC-Inbound',
			//'lead_generation_channel' => 'MIR-Inbound',
			'txtAddress' => '',
			'txtState' => '',
			'txtCity' => '',
			'txtCountry' => !empty($arrInputs['txtCountry'])?$arrInputs['txtCountry']:NULL,
			'txtPincode' => '',
			'logo' => '',
			'speak_to_analyst' => !empty($arrInputs['datetimepicker'])?$arrInputs['datetimepicker']:NULL,
			'TitlesRelatedMyCompany' => !empty($arrInputs['txtCheckboxName'])?$arrInputs['txtCheckboxName']:NULL,
			'paymentOption' => ''
			];
		return $arrFormData;
	}
	public static function crmInboundLeads($arrData){
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($arrData));
		$response1 = curl_exec($ch2);
		curl_close($ch2);
		
		return $response1;
	}
	
	public static function insertZspLeadData($arrData){
		//echo '<pre>';print_r($arrData);exit;
		$type='RBB';
		$phone=$arrData['txtPhoneExt']."-".$arrData['txtPhone'];
		$txtFName=trim($arrData['txtFName']);
		$txtLName=trim($arrData['txtLName']);
		$txtEmail=trim($arrData['txtEmail']);
		$txtJTitle=trim($arrData['txtJTitle']);
		$txtCompany=trim($arrData['txtCompany']);
		$txtPin=NULL;
    
		$txtComments=trim($arrData['txtComments']);
		$txtComments=str_replace("'","",$txtComments);
		$txtCountry=$arrData['txtCountry'];
		$timezonepicker=$arrData['timezonepicker'];
		$datetimepicker=$arrData['datetimepicker'];
		$txtCheckboxName=$arrData['txtCheckboxName'];
		if($datetimepicker!=""){
			$speak_to_alyst=$datetimepicker." ".$timezonepicker;  
		}else{
			$speak_to_alyst="";
		}    
		$hidReportCode=$arrData['hidReportCode']; //Report Code
		$hidCatName=$arrData['hidCatName']; //Domain Name
		$hidReportName=$arrData['hidReportName'];
		$hidPName=$arrData['hidPName']; //Category Sales Email
		$hidSubPName=$arrData['hidSubPName']; //Sub Category Sales Email
		$hidReportName=str_replace('&','and',$hidReportName);
		$hidReportName=str_replace('-',' ',$hidReportName);
		$ip = NULL;
		$industry="Test Company";
		$revenue="00";
		
		if($txtFName!="" && $txtLName!="" && $txtEmail!="" && $phone!="" && $txtJTitle!="" && $txtCompany!=""){
			$sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
				values(
				"'.$arrData["hidReport"].'",
				"'.$arrData["hidCat"].'",
				"'.$arrData["hidSubCat"].'",
				"'.$txtFName.'",
				"'.$txtLName.'",
				"'.$txtEmail.'",
				"'.$phone.'",
				"'.$txtJTitle.'",
				"'.$txtCompany.'",
				"'.$txtPin.'",
				"'.$txtComments.'",
				now(),
				"'.$type.'",
				"'.$arrData["txtCountry"].'",
				"'.$ip.'",
				"'.$speak_to_alyst.'",
				"'.$txtCheckboxName.'",
				"'.$industry.'",
				"'.$revenue.'"
				)';
			$isInserted = Yii::$app->db->createCommand($sql)->execute();
			if($isInserted){
				$txtCheckboxName1 =NULL;
				$message="Dear Sales Team, <br> <br> Below are the details of client who has requested for Table of Contents.<br><br>
					<table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>First Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtFName</td>
					</tr>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>Last Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtLName</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Email</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtEmail</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Job Title</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtJTitle</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Company</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtCompany</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Country</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtCountry</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Contact Number</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$phone</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Speak to Analyst</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$speak_to_alyst</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Kindly Provide Titles Related to My Company</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtCheckboxName</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Report Code</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$hidReportCode</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Report Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$hidReportName</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Domain Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$hidCatName</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>IP Address</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$ip</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Requirement Title</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtCheckboxName1</td>
					</tr>
					<tr style='border: 0px'>
					<td width='20%'><b>Requirements</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtComments</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";
					$subject = "Inquiry Before Buying";   
					
					$msg = Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
					->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
					->setTo($hidPName)
					->setBcc (\Yii::$app->params['devManagerEmail'])
					->setSubject($subject)
					->send();
					if($msg){
						return 'done';
					}
					else{
						echo "error ...";
					}
					
					//return 'done';
			}
		}
		
	}
	/*
	public static function createTree(&$list, $parent){
		$tree = array();
		foreach ($parent as $k=>$l){
			if(isset($list[$l['toc_id']])){
				$l['children'] = self::createTree($list, $list[$l['toc_id']]);
			}
			$tree[] = $l;
		}
		return $tree;
	}
	*/
	
	public static function changeBtoH($text){
		$arrText = explode('<b>',$text);
		$strRes = NULL;
		foreach($arrText as $newText){
			if(strpos($newText,'</b>')>0){
				$strText = '<h2 class="rdh2">'.$newText;
				$strText = preg_replace("<\/b>",'/h2',$strText,1);
				//$strText = substr_replace($strText,'</h3>',strpos($strText,'</b>'),4);
				$strRes .= $strText;
			}else{
				$strRes .= $newText;
			}
		}
		return $strRes;
	}
	
	
}
?>