<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\controllers\IarcfbaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\ZspContact;
use frontend\forms\RegistrationForm;
use common\models\ZspUserAccounts;
use common\models\ZspPrsQuery;

/**
 * Site controller
 */
class SiteController extends IarcfbaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'httpCache' => [
            'class' => \yii\filters\HttpCache::className(),
            'only' => ['list'],
            'lastModified' => function ($action, $params) {
                $q = new Query();
                return strtotime($q->from('users')->max('updated_timestamp'));
            },
            // 'etagSeed' => function ($action, $params) {
                // return // generate etag seed here
            //}
        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            /* 'error' => [
                'class' => 'yii\web\ErrorAction',
            ], */
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		//$arrEmergingTrend = ZspPrsQuery::getListPress(['limit'=>4]);
		$sql = "SELECT * FROM `zsp_prs` WHERE (`status`=1) AND (mnfctr <= CURRENT_DATE()) AND(LENGTH(TRIM(image)) > 0) ORDER BY `prod_id` DESC LIMIT 4";
		$arrEmergingTrend = Yii::$app->db->createCommand($sql)->queryAll();
		// echo '<pre>';print_r($arrEmergingTrend);exit;
		return $this->render('index',[
			'emergingTrend'=>$arrEmergingTrend,
		]);
    }
	
	public function actionError()
    {
		$exception = Yii::$app->errorHandler->exception;
		if($exception->statusCode == 404){
			return $this->goHome();
		}else{
			//echo '<pre>';print_r($exception);exit;
			echo '<h1>'.$exception->statusCode .'-'.$exception->getMessage().'</h1>';exit;
		}
	}
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionTeam()
    {
        return $this->render('team');
    }
    public function actionCareer()
    {
        return $this->render('career');
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will 
                respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
	public function actionLogin()
    {
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//echo Yii::$app->getRequest()->getUserIP();exit;
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
	public function actionRegistration(){
		$arrInputs = Yii::$app->request->post();
	//	echo '<pre>';print_r($arrInputs);exit;
  $model = new RegistrationForm();
		$userModel = new ZspUserAccounts();
		/* Capcha code start */
		$secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
		$captcha = !empty($_POST['g-recaptcha-response'])?$_POST['g-recaptcha-response']:NULL;
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
		$responseData = json_decode($verifyResponse);
		$isValidCaptcha = (Yii::$app->request->hostName =='localhost')?TRUE:$responseData->success;
		/* Capcha code End */
		
		/* if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return \yii\widgets\ActiveForm::validate($model);
		} */
 if ($model->load($arrInputs)) {

			$arrUser['ZspUserAccounts'] = [
				'fname'=>$arrInputs['RegistrationForm']['fname'],
				'lname'=>$arrInputs['RegistrationForm']['lname'],
				'phone'=>$arrInputs['RegistrationForm']['phone'],
				'login_id'=>$arrInputs['RegistrationForm']['email'],
				'password'=>$arrInputs['RegistrationForm']['password'],
				'dt_created'=> date('Y-m-d H:i:s'),
				'status'=> 1,
			];
			if($isValidCaptcha && $userModel->load($arrUser) && $userModel->validate()){
				if($userModel->save()){
					$loginModel = new LoginForm();
					$loginModel->username = $userModel->login_id;
					$loginModel->password = $userModel->password;
					$loginModel->login();
					$loginModel->setSession($userModel->login_id);
					return $this->goBack();
					// return $this->redirect('login');
				}else{Yii::$app->session->setFlash('error', 'Something went wrong.'); }
			}else{
				$errors='';$i=1;
				foreach($userModel->getErrors() as $arrErrors){
					$errors .= '&nbsp&nbsp&nbsp'.$i.'.&nbsp'.$arrErrors[0].'<br>';
					$i++;
				}
				Yii::$app->session->setFlash('error', 'Something went wrong while processing your request.<br>'.$errors);
				//echo '<pre>';print_r($userModel->getErrors());exit; 
			}
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

	public function actionSaveContacts()
    {
		$model = new ZspContact();
		$secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
		$captcha = !empty($_POST['g-recaptcha-response'])?$_POST['g-recaptcha-response']:NULL;
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
		$responseData = json_decode($verifyResponse);
		
		if ($model->load(Yii::$app->request->post())) {
			//echo '<pre>';print_r(Yii::$app->request->post());exit;
			$model->c_ip =Yii::$app->getRequest()->getUserIP();
			//$model->c_ip =Yii::$app->request->getRemoteIP();
			$model->c_dt_created =date("Y-m-d H:i:s");
			$model->c_status = 1;//1=Active,0=InActive
			
			$title=$_POST['ZspContact']['title'];
			$subject= 'Contact - '.$title;
			/* Email Templat :: Start */
			$message="Dear Sales Team, <br> <br> Below are the details of client who has requested for $title.<br><br>
					<table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->c_fname .$model->c_lname</td>
					</tr>
					
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Email</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->c_email</td>
					</tr>
					
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Message</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->c_message</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Contact Number</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$model->c_phone</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";	
			/* Email Templat :: End */
			$isValidCaptcha = (Yii::$app->request->hostName =='localhost')?TRUE:$responseData->success;
			if($isValidCaptcha && $model->validate() && $model->save()){
				/* if saved in DB then send the mail */
				Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
					->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
					->setTo(\Yii::$app->params['salesEmail'])
					->setBcc ([\Yii::$app->params['devManagerEmail'],\Yii::$app->params['testEmail']])
					->setSubject($subject)
					->send();
					
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
				return $this->redirect('index');
			}else{
				//echo '<pre>';print_r($model->getErrors());exit;
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
				return $this->redirect('index');
			}
        }
    }
	
	public function actionForgotPassword(){
		$loginId = !empty($_POST['login_id'])?$_POST['login_id']:NULL;
		
		if($loginId){
			$isUserExist = ZspUserAccounts::find()->where(['login_id'=>$loginId,'status'=>1])->exists();
			if($isUserExist){
				$newPass = \frontend\helper\PurchaseHelper::generateCode(8);
				$upadatePwd = "UPDATE zsp_user_accounts SET 
								password = '".$newPass."'
								WHERE login_id ='".$loginId ."' AND status='1'";	
				$isUpadatedPwd = Yii::$app->db->createCommand($upadatePwd)->execute();
				if($isUpadatedPwd){
					$userEmail = "Dear Customer,<br> Please login with below password. once it's logged-in you can reset your password.<br>
									Your new password is <b>$newPass</b><br><br>
									Thanks,<br>IndustryARC™";
					
					Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $userEmail])
						->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
						->setTo($loginId)
						->setBcc ('amit.kumar@industryarc.com')
						->setSubject('IndustryARC™- Reset password')
						->send();
					Yii::$app->session->setFlash('success','Request has been send.Please check your email.');
				}else{
					Yii::$app->session->setFlash('error','Something went wrong please contact us.');
				}
			}else{
				Yii::$app->session->setFlash('error','Email Id does not exist. Please Register First!');
			}
		}
		return 'SUCCESS';
	}
	
}
