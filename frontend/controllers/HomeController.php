<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ZspContact;

class HomeController extends IarcfbaseController {

    public function actionOurServices() {
        $title = Yii::$app->request->get('title');

        switch ($title) {
            case 'Analytics':
                return $this->render('analytics');
                break;
            case 'Research':
                return $this->render('research');
                break;
            case 'Consulting':
                return $this->render('consulting');
                break;
            case 'Customer Research':
                return $this->render('customerResearch');
                break;
            default:
                echo' Unable to find requested Content';
        }
    }

    public function actionNewPackage()
    {
        return $this->render('package');
    }

    public function actionNewCheckout()
    {
        return $this->render('newcheckout');
    }

    public function actionPrivacy() {
        return $this->render('privacy');
    }

    public function actionTerms() {
        return $this->render('terms');
    }

    public function actionPaymentProcess() {
        return $this->render('paymentProcess');
    }

    public function actionContactUs() {
        $model = new ZspContact();
        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == 'localhost') ? TRUE : $responseData->success;
        /* Capcha code End */
        $arrInputs = Yii::$app->request->post();
        if (isset($arrInputs['ZspContact']) && !empty($arrInputs['ZspContact'])) {
            $arrInputs['ZspContact']['c_phone'] = $arrInputs['ZspContact']['phoneExt'] . ' ' . $arrInputs['ZspContact']['c_phone'];

            if ($model->load($arrInputs)) {
                $model->c_ip = Yii::$app->getRequest()->getUserIP();
                $model->c_dt_created = date('Y-m-d H:i:s');
                $model->c_status = 1;

                if ($isValidCaptcha && $model->validate() && $model->save()) {

                    $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for contact.<br><br>
						<table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
						<tr style='border-bottom: 1px solid #ccc;'>
						<td width='20%'><b>First Name</b></td>
						<td width='1%'>:</td>
						<td width='78%'>$model->c_fname</td>
						</tr>
						<tr style='border-bottom: 1px solid #ccc;'>
						<td width='20%'><b>Last Name</b></td>
						<td width='1%'>:</td>
						<td width='78%'>$model->c_lname</td>
						</tr>
						<tr style='border-bottom: 1px solid #CCC;'>
						<td width='20%'><b>Email</b></td>
						<td width='1%'>:</td>
						<td width='78%'>$model->c_email</td>
						</tr>
						<tr style='border-bottom: 1px solid #CCC;'>
						<td width='20%'><b>Contact Number</b></td>
						<td width='1%'>:</td>
						<td width='78%'>$model->c_phone</td>
						</tr>
						<tr style='border: 0px'>
						<td width='20%'><b>Message</b></td>
						<td width='1%'>:</td>
						<td width='78%'>$model->c_message</td>
						</tr>
						</table><br><br>Thanks,<br>IndustryARC";
                    $subject = "Contact- From Contact-Us Page";

                    /* if saved in DB then send the mail */
                    Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                            ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                            ->setTo(\Yii::$app->params['salesEmail'])
                            ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                            //->setCc ()
                            ->setSubject($subject)
                            ->send();

                    Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                    return $this->redirect(['message/thanks', 'id'=>'' ,'page' => 'ContactUs'.$arrInputs['ZspContact']['utmParam']]);
                    //return $this->refresh();
                } else {
                    //echo '<pre>';print_r($model->getErrors());exit;
                    Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                    return $this->refresh();
                }
            }
        }

        return $this->render('contactUs', [
                    'model' => $model,
        ]);
    }

    public function actionNewsLatter() {
        $arrPost = Yii::$app->request->post();
        if (isset($arrPost) && !empty($arrPost)) {
            $industry = !empty($arrPost['nl_industry']) ? $arrPost['nl_industry'] : NULL;
            if (!empty($arrPost['nl_email'])) {
                // Validate e-mail
                if (!filter_var($arrPost['nl_email'], FILTER_VALIDATE_EMAIL) === false) {
                    $email = filter_var($arrPost['nl_email'], FILTER_SANITIZE_EMAIL);
                } else {
                    echo "email is not a valid email address";
                    exit;
                }
            } else {
                echo "email can not be blank";
                exit;
            }
            $isEmailExist = \common\models\ZspNewsletters::find()->where(['nl_email' => $email])->exists();
            if ($isEmailExist) {
                echo "email already subscribed";
                exit;
            } else {
                $sqlNewsletters = "insert into zsp_newsletters
				(nl_email,nl_subcribed_date,nl_unsubcribed_date,nl_status,nl_industry)
				values('" . $email . "',now(),now(),'1','" . $industry . "')";

                $isNewsInserted = Yii::$app->db->createCommand($sqlNewsletters)->execute();
                if ($isNewsInserted) {
                    /* Email Template preparation for internal sales team and subscriber Start */
                    $subscriberMsg = 'Thank you for subscription.';
                    $subscriberSub = "Thank you for subscription";
                    $emailMsg = "Dear Sales Team, <br> <br> Below are the details of client who has subscribed for newsletters.<br><br><table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
								  <tr style='border-bottom: 1px solid #ccc;'>
								  <td width='20%'><b>Email ID</b></td>
								  <td width='1%'>:</td>
								  <td width='78%'>$email</td>
								  </tr>
								  <tr style='border-bottom: 1px solid #ccc;'>
								  <td width='20%'><b>Category</b></td>
								  <td width='1%'>:</td>
								  <td width='78%'>$industry</td>
								  </tr> 
								  </table><br><br>Thanks,<br>IndustryARC";
                    $emailSub = "Subscription Entry";
                    /* mail to Subscriber */
                    Yii::$app->mailer2->compose(['html' => '@common/mail/layouts/html'], ['content' => $subscriberMsg])
                            ->setFrom([\Yii::$app->params['newsletterEmail'] => 'IndustryARC'])
                            ->setTo($email)
                            ->setSubject($subscriberSub)->send();
                    /* mail to Internal sales team */
                    Yii::$app->mailer2->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMsg])
                            ->setFrom([\Yii::$app->params['newsletterEmail'] => 'IndustryARC'])
                            ->setTo(\Yii::$app->params['communicationEmail'])
                            //->setBcc(\Yii::$app->params['testEmail'])
                            ->setSubject($emailSub)->send();
                    /* Email Template preparation for internal sales team and subscriber End */
                    return 'Thank you for subscription';
                } else {
                    return 'Something went wrong Unable to subscribed';
                }
            }
        }
    }

}
