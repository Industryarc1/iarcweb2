<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\IarcfbaseController;

class UserController extends IarcfbaseController
{
	public function beforeAction($action){
		$loginid = (!empty(Yii::$app->user->identity->login_id) || !empty(Yii::$app->session->get('user')['login_id']))? Yii::$app->session->get('user')['login_id'] : NULL;
		if(!$loginid){
			return $this->redirect(['site/login']);
		}
		return parent::beforeAction($action);
	}
	
    public function actionAccountDashboard(){
		$loginid = (!empty(Yii::$app->user->identity->login_id) || !empty(Yii::$app->session->get('user')['login_id']))? Yii::$app->session->get('user')['login_id'] : NULL;
		$sql = "SELECT ua.inc_user_id,ua.fname,ua.lname,ua.company,ua.job,ua.phone,ua.login_id,ua.password,ua.status,za.addr_type,za.addr1,za.addr2,za.city,za.pincode,za.state,za.country FROM `zsp_user_accounts` ua  LEFT JOIN `zsp_addresses` za ON za.user_id=ua.login_id WHERE ua.login_id = '".$loginid."'";
		$arrUserInfo = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render('accountDashboard',[
			'userInfo' => $arrUserInfo,
		]);
    }
	
	public function actionMyProfile(){
		$loginid = (!empty(Yii::$app->user->identity->login_id) || !empty(Yii::$app->session->get('user')['login_id']))? Yii::$app->session->get('user')['login_id'] : NULL;
		if($loginid){
			$loginUser = Yii::$app->session->get('user');
			if(isset($_POST)&& !empty($_POST)){
				//echo '<pre>';print_r($_POST);exit;
				$model = new \frontend\forms\MyProfileForm();
				unset($_POST['_csrf-frontend']);
				if(!empty($_POST['new_password']) && !empty($_POST['cnf_password']) && $_POST['new_password']==$_POST['cnf_password']){
					$_POST['password'] = $_POST['new_password'];
					unset($_POST['new_password'],$_POST['cnf_password']);
				}
				$arrInputs['MyProfileForm'] = $_POST;
				if($model->load($arrInputs) && $model->validate()){
					$upadateUser = "UPDATE zsp_user_accounts SET 
						fname = '".$model->fname ."',
						lname='".$model->lname ."',
						company='".$model->company ."',
						phone='".$model->phone ."',
						password='".$model->password ."'
						WHERE login_id ='".$model->email ."'";
					$isUpadatedUser = Yii::$app->db->createCommand($upadateUser)->execute();
					$add_b = "SELECT user_id FROM `zsp_addresses` WHERE user_id = '".$model->email ."' AND addr_type='b'";
					$add_s = "SELECT user_id FROM `zsp_addresses` WHERE user_id = '".$model->email ."' AND addr_type='s'";
					$isExistAdd_b = !empty(Yii::$app->db->createCommand($add_b)->queryOne())? TRUE : FALSE;
					$isExistAdd_s = !empty(Yii::$app->db->createCommand($add_s)->queryOne())? TRUE : FALSE;
					if($isExistAdd_b){
						$upadateBilling = "UPDATE zsp_addresses SET 
							addr1 = '".$model->b_address_line1 ."',
							addr2='".$model->b_address_line2 ."',
							city='".$model->b_city ."',
							pincode='".$model->b_pincode ."',
							state='".$model->b_state ."',
							country='".$model->b_country ."'
							WHERE user_id ='".$model->email ."' AND addr_type='b'";
						$isUpadatedBilling = Yii::$app->db->createCommand($upadateBilling)->execute();
					}else{
						$insertBilling = 'insert into zsp_addresses(addr_type,user_id,addr1,addr2,city,pincode,state,country,dt_created) values(
								"b",
								"'.$model->email .'",
								"'.$model->b_address_line1 .'",
								"'.$model->b_address_line2 .'",
								"'.$model->b_city .'",
								"'.$model->b_pincode .'",
								"'.$model->b_state .'",
								"'.$model->b_country .'",
								"'.date('Y-m-d H:i:s').'"
								)';
						$isInsertedBilling = Yii::$app->db->createCommand($insertBilling)->execute();
					}
					if($isExistAdd_s){
						$upadateShipping = "UPDATE zsp_addresses SET 
							addr1 = '".$model->s_address_line1 ."',
							addr2='".$model->s_address_line2 ."',
							city='".$model->s_city ."',
							pincode='".$model->s_pincode ."',
							state='".$model->s_state ."',
							country='".$model->s_country ."'
							WHERE user_id ='".$model->email ."' AND addr_type='s'";	
						$isUpadatedShipping = Yii::$app->db->createCommand($upadateShipping)->execute();
					}else{
						$insertShipping = 'insert into zsp_addresses(addr_type,user_id,addr1,addr2,city,pincode,state,country,dt_created) values(
								"s",
								"'.$model->email .'",
								"'.$model->s_address_line1 .'",
								"'.$model->s_address_line2 .'",
								"'.$model->s_city .'",
								"'.$model->s_pincode .'",
								"'.$model->s_state .'",
								"'.$model->s_country .'",
								"'.date('Y-m-d H:i:s').'"
								)';
						$isInsertedShipping = Yii::$app->db->createCommand($insertShipping)->execute();
					}
					Yii::$app->session->setFlash('success','Profile Updated Successfully.');
				}else if($model->hasErrors()){
					$arrErrors = $model->getErrors();
					echo '<pre>';print_r($model->getErrors());exit;
				}
			}
			if($loginUser['login_id']){
				$sql = "SELECT ua.inc_user_id,ua.fname,ua.lname,ua.company,ua.job,ua.phone,ua.login_id,ua.password,ua.status,za.addr_type,za.addr1,za.addr2,za.city,za.pincode,za.state,za.country FROM `zsp_user_accounts` ua  LEFT JOIN `zsp_addresses` za ON za.user_id=ua.login_id WHERE ua.login_id = '".$loginUser['login_id']."'";
				$arrUserInfo = Yii::$app->db->createCommand($sql)->queryAll();
			}
			return $this->render('myProfile',[
				'userInfo' => $arrUserInfo,
				//'error' => $arrErrors,
			]);
		}else{
			echo 'please Login First';exit;
		}
	}
}
