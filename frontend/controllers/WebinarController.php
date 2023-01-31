<?php
namespace frontend\controllers;

use Yii;
use common\models\ZspWebinars;
use common\models\ZspLeadsEvents;

/**
 * SearchController
 */
class WebinarController extends IarcfbaseController
{
    public function actionListWebinar(){
      $arrWebinars = ZspWebinars::find()->where(['status'=>1])
       ->orderBy(['pub_date'=>SORT_DESC])->asArray()->all();
      //echo '<pre>';print_r($arrWebinars);exit;
            return $this->render('listWebinar',[
       'webinar'=>$arrWebinars,
      ]);
  }
	public function actionWebinarDetail(){
		$arrWebinar = [];
		$arrGet= Yii::$app->request->get();
		$model= new ZspLeadsEvents();
		//echo '<pre>';print_r($arrGet);exit;
		if(!empty($arrGet['inc_id']) && !empty($arrGet['curl'])){
			$arrWebinar = ZspWebinars::find()->alias('zw')
				->select(['zw.*','wv.*'])
				->leftJoin('webinar_videos wv','wv.webinar_id = zw.inc_id')
				->where([
					'inc_id'=>$arrGet['inc_id'],
					'curl'=>$arrGet['curl'],
					'status'=>1,
					])
				//->createCommand()->rawSql;echo $arrWebinar;exit;
				->asArray()->one();
				//echo '<pre>';print_r($arrWebinar);exit;
			if(empty($arrWebinar)){
				return $this->goHome();
			}
		}else{
			return $this->goHome();
		}
		
		//echo '<pre>';print_r($arrWebinar);exit;
		return $this->render('webinarDetail',[
			'webinar'=>$arrWebinar,
			'model'=>$model,
		]);
	}
	
	public function actionRegistration(){
		$arrInputs = Yii::$app->request->post();
		//echo '<pre>';print_r($arrInputs);exit;
		
		/* Capcha code start */
		$secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
		$captcha = !empty($_POST['g-recaptcha-response'])?$_POST['g-recaptcha-response']:NULL;
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
		$responseData = json_decode($verifyResponse);
		$isValidCaptcha = (Yii::$app->request->hostName =='localhost')?TRUE:$responseData->success;
		/* Capcha code End */
		$model= new ZspLeadsEvents();
		if($isValidCaptcha && isset($arrInputs) && !empty($arrInputs)){
			$model->dt_created = date('d-m-y H:i:s');
			$model->ip = Yii::$app->getRequest()->getUserIP();
			$model->country = $model->industry = $model->revenue = $model->speak_to_alyst = '';
			if($model->load($arrInputs) && $model->validate()){
				if($model->save()){
					$emailMsg="Dear Sales Team, <br> <br> Below are the details of client who is willing to join the Webinar Session.<br><br>
					<table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>First Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->fname</td>
					</tr>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>Last Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->lname</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Email</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->email</td>
					</tr>
					
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Company</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->company</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Webinar Title</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->comments</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Contact Number</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->phone</td>
					</tr>
					
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>IP Address</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->ip</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";				 
					$emailSub = "Webinar Lead"; 
					
					Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMsg])
					->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
					->setTo(\Yii::$app->params['salesEmail'])
					->setBcc (\Yii::$app->params['testEmail'])
					->setSubject($emailSub)
					->send();
					//Yii::$app->session->setFlash('success', 'Thank you for Registration. We will respond to you as soon as possible.');
					return "SUCCESS";
				}
			}else{
				// Yii::$app->session->setFlash('error', 'Something went wrong in registration.');
				echo '<pre>';print_r($model->getErrors());exit;
			}
		}
	}
	
}
