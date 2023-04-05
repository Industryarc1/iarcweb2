<?php

namespace frontend\controllers;

use Yii;
use common\models\ZspCatlogCategories;
use common\models\ZspPosts;
use common\models\ZspFaqs;
use common\models\ZspPostsQuery;
use frontend\controllers\IarcfbaseController;
use frontend\forms\SampleRequestForm;
use frontend\forms\AnalystQueryForm;
use frontend\forms\RequestQuoteForm;
use frontend\forms\SalesQueryForm;
use frontend\forms\InquiryForm;
use frontend\forms\ShareRequirementForm;
use yii\data\Pagination;
use frontend\helper\ReportHelper;

class ReportsController extends IarcfbaseController {
	
	public function beforeAction($action) {
          //if ($action->id == 'payment-status' || $action->id == 'hdfc-payment-status') {
			$this->enableCsrfValidation = false;
          //}
        return parent::beforeAction($action);
    }

    public function actionCategoryWiseReport() {
        $arrRequest = Yii::$app->request->get();
        if (isset($arrRequest) && !empty($arrRequest)) {
            $intReportsCount = ZspPostsQuery::getCategoryWiseReport(array_merge(['getCount' => TRUE], $arrRequest));
            $arrCategoryDetail = ZspCatlogCategories::find()
                            ->where(['code' => (int)$arrRequest['cat']])
                            ->andWhere(['seo_keyword' => (string)$arrRequest['curl']])
                            ->andWhere(['status' => 1])
                            ->asArray()->one();
            if (empty($arrCategoryDetail)) {
                return $this->goHome();
            }
            $objReportCatlog = ZspPostsQuery::getCategoryWiseReport(array_merge(['asObj' => TRUE], $arrRequest));
            $count = $intReportsCount;
            //creating the pagination object
            $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 3000]);
            //limit the query using the pagination and retrieve the users
            /*$models = $objReportCatlog->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();*/
			$models = $objReportCatlog->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
			//print_r($models);exit;			
        } else {
            echo 'Please select an report';
            exit;
        }

        return $this->render('categoryWiseReport', [
                    'categoryDet' => $arrCategoryDetail,
                    'models' => $models,
                    'pagination' => $pagination,
        ]);
    }
	
	public function actionMarketreport() {

        $arrRequest = Yii::$app->request->get();

        if (isset($arrRequest['curl']) && !empty($arrRequest['curl'])) {
            $reportDetail = ZspPosts::find()
                            ->where(['curl' => $arrRequest['curl']])
                            ->andWhere(['status' => 1])
                            ->asArray()->one();
            /* Below code is to featch the related report 	 */
            if (!empty($reportDetail['related'])) {
                $arrRelated = ZspPosts::find()
                                ->where(['IN', 'code', explode(',', $reportDetail['related'])])
                                ->andWhere(['status' => 1])
                                //->createCommand()->rawSql;echo $arrRelated;exit;
                                ->asArray()->All();
                foreach ($arrRelated as $related) {
                    $arrRelatedReport[] = [
                        'title' => substr($related['title'], 0, strpos(strtolower($related['title']), 'market') + 6), //strpos + 6 will give the position till market because characters in market =6
                        'code' => $related['code'],
                        'short_descr' => $related['short_descr'],
                        'curl' => 'market-research/' . $related['curl'],
                        'meta_title' => $related['meta_title'],
                        'dup_inc_id' => $related['dup_inc_id'],
                    ];
                }
            }
            if (empty($reportDetail)) {
                return $this->goHome();
            }

            $reportDetail['brport'] = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail['cat']])->asArray()->one();
        }

        /* remember the page url in order to check the user is Loged in or not 
          if not redirect the user to login page and after login come back to this action again */
        \yii\helpers\Url::remember();

        return $this->render('report', [
                    'reportDet' => !empty($reportDetail) ? $reportDetail : [],
                    'relatedReport' => !empty($arrRelatedReport) ? $arrRelatedReport : [],
        ]);
    }

    public function actionReport() {

        $arrRequest = Yii::$app->request->get();

        /* inc_Id grater then 500000 indicates its new report
          and it need to be redirected to actionResearch */
        if ($arrRequest['inc_id'] >= 500000) {
            return $this->redirect(['site/index']);
        }

		$reportDetail = array();

        if (isset($arrRequest['inc_id']) && !empty($arrRequest['inc_id'])) {
            $reportDetail = ZspPosts::find()
                            ->select(['inc_id', 'cat', 'title', 'code', 'description', 'table_of_content', 'slp', 'clp', 'meta_title', 'meta_keywords', 'meta_descr', 'taf', 'taf_new', 'dup_inc_id', 'cbreadcrumb' ])    
                            ->where(['dup_inc_id' => $arrRequest['inc_id']])
                            ->andWhere(['curl' => $arrRequest['curl']])
                            ->andWhere(['status' => 1])
                            ->asArray()->one();
            /* Below code is to featch the related report 	 */
            if (!empty($reportDetail['related'])) {
                $arrRelated = ZspPosts::find()
                                ->where(['IN', 'code', explode(',', $reportDetail['related'])])
                                ->andWhere(['status' => 1])
								->orderBy("RAND()")
								->limit(6)
                                //->createCommand()->rawSql;echo $arrRelated;exit;
                                ->asArray()->All();
                foreach ($arrRelated as $related) {
					$pub_date = $related["pub_date"];
					$str = $related['title'];
					$str = substr($str, strrpos($str, 'Forecast' ));
					$str = str_replace( array( '\'', '"',',' , ';', '(', ')' ), ' ', $str);
                    $arrRelatedReport[] = [
                        'title' => substr($related['title'], 0, strpos(strtolower($related['title']), 'market') + 6)." ".$str, //strpos + 6 will give the position till market because characters in market =6
                        'code' => $related['code'],
                        'short_descr' => $related['short_descr'],
                        'curl' => ($related['dup_inc_id'] < 500000) ? 'Report/' . $related['dup_inc_id'] . '/' . $related['curl'] : 'Research/' . $related['curl'] . '-' . $related['dup_inc_id'],
                        'meta_title' => $related['meta_title'],
                        'dup_inc_id' => $related['dup_inc_id'],
						'pub_date_new' => date("F Y", strtotime($pub_date)),
                    ];
                }
            }
            if (empty($reportDetail)) {
                return $this->goHome();
            }

            $reportDetail['brport'] = ZspCatlogCategories::find()
                ->select(['name', 'code', 'seo_keyword'])
                ->where(['inc_id' => $reportDetail['cat']])
                ->asArray()
                ->one();
        }

		$reportFaqs = ZspFaqs::find()->where(['inc_id' => $reportDetail['inc_id'],'status' =>1])->orderBy(['priority' => SORT_ASC])->asArray()->all();

        /* remember the page url in order to check the user is Loged in or not 
          if not redirect the user to login page and after login come back to this action again */
        \yii\helpers\Url::remember();

        return $this->render('report', [
                    'reportDet' => !empty($reportDetail) ? $reportDetail : [],
                    'relatedReport' => !empty($arrRelatedReport) ? $arrRelatedReport : [],
                    'faqs' => $reportFaqs
        ]);
    }

    public function actionResearch() {
        $arrRequest = Yii::$app->request->get();
        if ($arrRequest['inc_id'] < 500000) {
            return $this->redirect(['site/index']);
        }

        if (isset($arrRequest['inc_id']) && !empty($arrRequest['inc_id'])) {
            $reportDetail = ZspPosts::find()
                            ->select(['inc_id','cat','subcat','title','code','short_descr','description','table_of_content','report_type','pub_date','slp','clp','image','status','curl','meta_title','meta_keywords','meta_descr','seo_keyword','dt_created','related','taf','cc','pages','dup_inc_id','cbreadcrumb','pub_date_new','taf_new','region'])
                            ->where(['dup_inc_id' => $arrRequest['inc_id']])
                            ->andWhere(['curl' => $arrRequest['curl']])
                            ->andWhere(['status' => 1])
                            ->asArray()->one();
            if (!empty($reportDetail['related'])) {
                $arrRelated = ZspPosts::find()
                                ->select(['inc_id','cat','subcat','title','code','short_descr','description','table_of_content','report_type','pub_date','slp','clp','image','status','curl','meta_title','meta_keywords','meta_descr','seo_keyword','dt_created','related','taf','cc','pages','dup_inc_id','cbreadcrumb','pub_date_new','taf_new','region'])
                                ->where(['IN', 'code', explode(',', $reportDetail['related'])])
                                ->andWhere(['status' => 1])
								->orderBy("RAND()")
								->limit(6)
                                // ->createCommand()->rawSql;echo $arrRelated;exit;
                                ->asArray()->All();
                foreach ($arrRelated as $related) {
                    $pub_date = $related["pub_date"];
                    $arrRelatedReport[] = [
                        'title' => substr($related['title'], 0, strpos(strtolower($related['title']), 'market') + 6), //strpos + 6 will give the position till market because characters in market =6
                        'code' => $related['code'],
                        'short_descr' => $related['short_descr'],
                        'curl' => ($related['dup_inc_id'] < 500000) ? 'Report/' . $related['dup_inc_id'] . '/' . $related['curl'] : 'Research/' . $related['curl'] . '-' . $related['dup_inc_id'],
                        'meta_title' => $related['meta_title'],
                        'dup_inc_id' => $related['dup_inc_id'],
                        'pub_date_new' => date("F Y", strtotime($pub_date)),
                    ];
                }
            }
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            $reportDetail['brport'] = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail['cat']])->asArray()->one();
        }

		$reportFaqs = ZspFaqs::find()->where(['inc_id' => $reportDetail['inc_id'],'status' =>1])->orderBy(['priority' => SORT_ASC])->asArray()->all();

        /* remember the page url in order to check the user is Loged in or not 
          if not redirect the user to login page and after login come back to this action again */
        \yii\helpers\Url::remember();

        return $this->render('report', [
                    'reportDet' => !empty($reportDetail) ? $reportDetail : [],
                    'relatedReport' => !empty($arrRelatedReport) ? $arrRelatedReport : [],
					'faqs' => $reportFaqs
                        //	'catDet'=>!empty($arrCategoryDetail)?$arrCategoryDetail:[],
        ]);
    }

    public function actionReportsegment() {
        $arrRequest = Yii::$app->request->get();
        /* inc_Id grater then 500000 indicates its new report
          and it need to be redirected to actionResearch */
        if ($arrRequest['inc_id'] >= 500000) {
            return $this->redirect(['reports/research', 'inc_id' => $arrRequest['inc_id'], 'curl' => $arrRequest['curl']]);
        } else {
            return $this->redirect(['reports/report', 'inc_id' => $arrRequest['inc_id'], 'curl' => $arrRequest['curl']]);
        }
    }

    public function actionResearchsegment() {
        $arrRequest = Yii::$app->request->get();
        /* inc_Id grater then 500000 indicates its new report
          and it need to be redirected to actionResearch */
        if ($arrRequest['inc_id'] >= 500000) {
            return $this->redirect(['reports/research', 'inc_id' => $arrRequest['inc_id'], 'curl' => $arrRequest['curl']]);
        } else {
            return $this->redirect(['reports/report', 'inc_id' => $arrRequest['inc_id'], 'curl' => $arrRequest['curl']]);
        }
    }

    public function actionResearchMethodology() {
        $arrRequest = Yii::$app->request->get();
        $arrRequestPost = Yii::$app->request->post();
        if (empty($arrRequestPost)) {
            return $this->redirect(['site/index']);
        }

        if (isset($arrRequestPost['report_id']) && !empty($arrRequestPost['report_id'])) {
            $reportDetail = ZspPosts::find()
                            ->where(['dup_inc_id' => $arrRequestPost['report_id']])
                            ->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            $reportDetail['brport'] = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail['cat']])->asArray()->one();
        }

        \yii\helpers\Url::remember();

        return $this->render('researchMethodology', [
                    'reportDet' => !empty($reportDetail) ? $reportDetail : [],
        ]);
    }

    public function actionSampleRequest() {		
		$arrPost = Yii::$app->request->post();
        $dupIncId = filter_var(Yii::$app->request->get('id'), FILTER_VALIDATE_INT);		
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($dupIncId)) {
			
        }

        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == '34.90.23.238') ? TRUE : $responseData->success;
        /* Capcha code End */
        
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {			
            
            $priority = !empty($arrPost['priority_range']) ? $arrPost['priority_range'] : NULL;
            $type = 'RB';
            $ip = Yii::$app->getRequest()->getUserIP();
            $speak_to_alyst = "";
            $pin = "000000";
            $now = date("Y-m-d H:i:s");
            $industry = "Abc Company";
            $revenue = "1234";
            $phone = $arrPost["SampleRequestForm"]["txtPhoneExt"] . " " . $arrPost["SampleRequestForm"]["txtPhone"];
            $txtFName = $arrPost["SampleRequestForm"]["txtFName"];
            $txtLName = $arrPost["SampleRequestForm"]["txtLName"];
            $txtEmail = $arrPost["SampleRequestForm"]["txtEmail"];
            $txtJTitle = $arrPost["SampleRequestForm"]["txtJTitle"];
            $txtCompany = "NA";
            $txtCountry = $arrPost["SampleRequestForm"]["txtCountry"];
            $txtCheckboxName = "No";
            $hidReportCode = $arrPost["SampleRequestForm"]["hidReportCode"];
            $hidReportName = $arrPost["SampleRequestForm"]["hidReportName"];
            $hidCatName = $arrPost["SampleRequestForm"]["hidCatName"];
            $ip = Yii::$app->getRequest()->getUserIP();
            $txtCheckboxName1 = "";
            $txtComments = $arrPost["SampleRequestForm"]["txtComments"];
            $hidPName = $arrPost["SampleRequestForm"]["hidPName"];
            $hidCat = $arrPost["SampleRequestForm"]["hidCat"];
            $hidSubCat = $arrPost["SampleRequestForm"]["hidSubCat"];
            $hidSubCatName = $arrPost["SampleRequestForm"]["hidSubCatName"];
            $pub_date = $arrPost["SampleRequestForm"]["pub_date"];
            $noofpages = $arrPost["SampleRequestForm"]["noofpages"];
            $timezonepicker = $arrPost["SampleRequestForm"]["timezonepicker"];
            $hidReportIncId = $arrPost["SampleRequestForm"]["hidReportIncId"];
            $utmParam = $arrPost["SampleRequestForm"]["utmParam"];
			
			$checkDomain = $this->checkfakedomain($arrPost["SampleRequestForm"]["txtEmail"]);
			if($checkDomain == 'real'){
				$newpost = array('token' => 'deeptest',
					'f_name' => $txtFName,
					'l_name' => $txtLName,
					'company' => $txtCompany,
					'job_title' => $txtJTitle,
					'phonenumber' => $phone,
					'email' => $txtEmail,
					'txtComments' => $txtComments,
					'hidReportCode' => $hidReportCode,
					'hidReportName' => $hidReportName,
					'hidCatName' => $hidCatName,
					'hidSubCatName' => $hidSubCatName,
					'pub_date' => $pub_date,
					'noofpages' => $noofpages,
					'timezonepicker' => $timezonepicker,
					'entry_point' => 'Sample Brochrue',
					'lead_generation_channel' => 'IARC-Inbound',
					'lead_source' => $utmParam,
					'txtAddress' => '',
					'txtState' => '',
					'txtCity' => '',
					'txtCountry' => $txtCountry,
					'txtPincode' => '',
					'logo' => '',
					'speak_to_analyst' => '0000-00-00',
					'TitlesRelatedMyCompany' => $txtCheckboxName,
					'paymentOption' => '');

				 $ch2 = curl_init();
				 curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
				 curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				 curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($newpost));
				 $response1 = curl_exec($ch2);
				 curl_close($ch2);			 

            $sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
			values(
			"' . $hidReportIncId . '", "' . $hidCat . '", "' . $hidSubCat . '", "' . $txtFName . '",
			"' . $txtLName . '", "' . $txtEmail . '", "' . $phone . '", "' . $txtJTitle . '", "' . $txtCompany . '",
			"' . $pin . '", "' . $txtComments . '", "' . $now . '", "' . $type . '", "' . $txtCountry . '",
			"' . $ip . '", "' . $speak_to_alyst . '", "' . $txtCheckboxName . '", "' . $industry . '",
			"' . $revenue . '"
			)';

            $query = Yii::$app->db->createCommand($sql)->execute();

            if ($query) {
                $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Sample Data Request.<br><br>
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
					<td width='20%'><b>Priority</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$priority</td>
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
                $subject = "Sample Data Request";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo($hidPName)
                        ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest'.$arrPost['SampleRequestForm']['utmParam']]);
            }
			}else{
			
				$message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Sample Data Request.<br><br>
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
					<td width='20%'><b>Priority</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$priority</td>
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
				$subject = "Sample Data Request : Fake";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo('venkat@industryarc.com')
                        ->setBcc(['vinay@industryarc.com', 'vishwadeep.singh@industryarc.com'])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest']);			
			}
        }

        $model = new SampleRequestForm();
        $zspSubCatlog = "";
        if (isset($dupIncId) && !empty($dupIncId)) {
            $reportDetail = ZspPosts::find()->where(['dup_inc_id' => $dupIncId])->andWhere('status=1')->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            
            $zspCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["cat"]])->asArray()->one();
            $zspSubCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["subcat"]])->asArray()->one();
        }
        return $this->render('sampleRequest', [
                    'model' => $model,
                    'formId' => !empty($dupIncId) ? $dupIncId : NULL,
                    'data' => !empty($reportDetail) ? $reportDetail : [],
                    'catlog' => !empty($zspCatlog) ? $zspCatlog : [],
                    'subcatlog' => !empty($zspSubCatlog) ? $zspSubCatlog : [],
        ]);
    }

    public function actionAnalystQuery() {
        $arrPost = Yii::$app->request->post();
        $dupIncId = filter_var(Yii::$app->request->get('id'), FILTER_VALIDATE_INT);
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($dupIncId)) {
            return $this->redirect(['site/index']);
        }
        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == '34.90.23.238') ? TRUE : $responseData->success;
        /* Capcha code End */
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {

            //echo '<pre>';print_r($arrPost);exit;

            $type = 'AQ';
            $ip = Yii::$app->getRequest()->getUserIP();
            $speak_to_alyst = "";
            $pin = "000000";
            $now = date("Y-m-d H:i:s");
            $industry = "Abc Company";
            $revenue = "1234";
            $phone = $arrPost["AnalystQueryForm"]["txtPhoneExt"] . " " . $arrPost["AnalystQueryForm"]["txtPhone"];
            $txtFName = $arrPost["AnalystQueryForm"]["txtFName"];
            $txtLName = $arrPost["AnalystQueryForm"]["txtLName"];
            $txtEmail = $arrPost["AnalystQueryForm"]["txtEmail"];
            $txtJTitle = $arrPost["AnalystQueryForm"]["txtJTitle"];
            $txtCompany = "NA";
            $txtCountry = $arrPost["AnalystQueryForm"]["txtCountry"];
            $txtCheckboxName = "No";
            $hidReportCode = $arrPost["AnalystQueryForm"]["hidReportCode"];
            $hidReportName = $arrPost["AnalystQueryForm"]["hidReportName"];
            $hidCatName = $arrPost["AnalystQueryForm"]["hidCatName"];
            $ip = Yii::$app->getRequest()->getUserIP();
            $txtCheckboxName1 = "";
            $txtComments = $arrPost["AnalystQueryForm"]["txtComments"];
            $hidPName = $arrPost["AnalystQueryForm"]["hidPName"];
            $hidCat = $arrPost["AnalystQueryForm"]["hidCat"];
            $hidSubCat = $arrPost["AnalystQueryForm"]["hidSubCat"];
            $hidSubCatName = $arrPost["AnalystQueryForm"]["hidSubCatName"];
            $pub_date = $arrPost["AnalystQueryForm"]["pub_date"];
            $noofpages = $arrPost["AnalystQueryForm"]["noofpages"];
            $timezonepicker = $arrPost["AnalystQueryForm"]["timezonepicker"];
            $hidReportIncId = $arrPost["AnalystQueryForm"]["hidReportIncId"];
            $utmParam = $arrPost["AnalystQueryForm"]["utmParam"];

			$checkDomain = $this->checkfakedomain($arrPost["AnalystQueryForm"]["txtEmail"]);
			if($checkDomain == 'real'){
            $newpost = array('token' => 'deeptest',
                'f_name' => $txtFName,
                'l_name' => $txtLName,
                'company' => $txtCompany,
                'job_title' => $txtJTitle,
                'phonenumber' => $phone,
                'email' => $txtEmail,
                'txtComments' => $txtComments,
                'hidReportCode' => $hidReportCode,
                'hidReportName' => $hidReportName,
                'hidCatName' => $hidCatName,
                'hidSubCatName' => $hidSubCatName,
                'pub_date' => $pub_date,
                'noofpages' => $noofpages,
                'timezonepicker' => $timezonepicker,
                'entry_point' => 'Analyst Query',
                'lead_generation_channel' => 'IARC-Inbound',
                'lead_source' => $utmParam,
                'txtAddress' => '',
                'txtState' => '',
                'txtCity' => '',
                'txtCountry' => $txtCountry,
                'txtPincode' => '',
                'logo' => '',
                'speak_to_analyst' => '0000-00-00',
                'TitlesRelatedMyCompany' => $txtCheckboxName,
                'paymentOption' => '');

             $ch2 = curl_init();
             curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
             curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($newpost));
             $response1 = curl_exec($ch2);
             curl_close($ch2);

            $sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
			values(
			"' . $hidReportIncId . '", "' . $hidCat . '", "' . $hidSubCat . '", "' . $txtFName . '",
			"' . $txtLName . '", "' . $txtEmail . '", "' . $phone . '", "' . $txtJTitle . '", "' . $txtCompany . '",
			"' . $pin . '", "' . $txtComments . '", "' . $now . '", "' . $type . '", "' . $txtCountry . '",
			"' . $ip . '", "' . $speak_to_alyst . '", "' . $txtCheckboxName . '", "' . $industry . '",
			"' . $revenue . '"
			)';

            $query = Yii::$app->db->createCommand($sql)->execute();
            if ($query) {
                $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Analyst Query.<br><br>
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
                $subject = "Table of Content";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo($hidPName)
                        ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['AnalystQueryForm']['formId'], 'page' => 'analystQuery']);
            }
			}else{
				$message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Analyst Query.<br><br>
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
				$subject = "Sample Data Request : Fake";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo('venkat@industryarc.com')
                        ->setBcc(['vinay@industryarc.com', 'vishwadeep.singh@industryarc.com'])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest']);			
			}
        }
        $model = new AnalystQueryForm();
        if (isset($dupIncId) && !empty($dupIncId)) {
            $reportDetail = ZspPosts::find()->where(['dup_inc_id' => $dupIncId])->andWhere('status=1')->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            $zspCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["cat"]])->asArray()->one();
            $zspSubCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["subcat"]])->asArray()->one();
        }
        return $this->render('analystQuery', [
                    'model' => $model,
                    'formId' => !empty($dupIncId) ? $dupIncId : NULL,
                    'data' => !empty($reportDetail) ? $reportDetail : [],
                    'catlog' => !empty($zspCatlog) ? $zspCatlog : [],
                    'subcatlog' => !empty($zspSubCatlog) ? $zspSubCatlog : [],
        ]);
    }

    public function actionSalesQuery() {
        $arrPost = Yii::$app->request->post();
        $dupIncId = filter_var(Yii::$app->request->get('id'), FILTER_VALIDATE_INT);
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($dupIncId)) {
            return $this->redirect(['site/index']);
        }
        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == '34.90.23.238') ? TRUE : $responseData->success;
        /* Capcha code End */
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {

            $type = 'AQ';
            $ip = Yii::$app->getRequest()->getUserIP();
            $speak_to_alyst = "";
            $pin = "000000";
            $now = date("Y-m-d H:i:s");
            $industry = "Abc Company";
            $revenue = "1234";
            $phone = $arrPost["SalesQueryForm"]["txtPhoneExt"] . " " . $arrPost["SalesQueryForm"]["txtPhone"];
            $txtFName = $arrPost["SalesQueryForm"]["txtFName"];
            $txtLName = $arrPost["SalesQueryForm"]["txtLName"];
            $txtEmail = $arrPost["SalesQueryForm"]["txtEmail"];
            $txtJTitle = $arrPost["SalesQueryForm"]["txtJTitle"];
            $txtCompany = "NA";
            $txtCountry = $arrPost["SalesQueryForm"]["txtCountry"];
            $txtCheckboxName = "No";
            $hidReportCode = $arrPost["SalesQueryForm"]["hidReportCode"];
            $hidReportName = $arrPost["SalesQueryForm"]["hidReportName"];
            $hidCatName = $arrPost["SalesQueryForm"]["hidCatName"];
            $ip = Yii::$app->getRequest()->getUserIP();
            $txtCheckboxName1 = "";
            $txtComments = $arrPost["SalesQueryForm"]["txtComments"];
            $hidPName = $arrPost["SalesQueryForm"]["hidPName"];
            $hidCat = $arrPost["SalesQueryForm"]["hidCat"];
            $hidSubCat = $arrPost["SalesQueryForm"]["hidSubCat"];
            $hidSubCatName = $arrPost["SalesQueryForm"]["hidSubCatName"];
            $pub_date = $arrPost["SalesQueryForm"]["pub_date"];
            $noofpages = $arrPost["SalesQueryForm"]["noofpages"];
            $timezonepicker = $arrPost["SalesQueryForm"]["timezonepicker"];
            $hidReportIncId = $arrPost["SalesQueryForm"]["hidReportIncId"];
            $utmParam = $arrPost["SalesQueryForm"]["utmParam"];

			$checkDomain = $this->checkfakedomain($arrPost["SalesQueryForm"]["txtEmail"]);
			if($checkDomain == 'real'){
            $newpost = array('token' => 'deeptest',
                'f_name' => $txtFName,
                'l_name' => $txtLName,
                'company' => $txtCompany,
                'job_title' => $txtJTitle,
                'phonenumber' => $phone,
                'email' => $txtEmail,
                'txtComments' => $txtComments,
                'hidReportCode' => $hidReportCode,
                'hidReportName' => $hidReportName,
                'hidCatName' => $hidCatName,
                'hidSubCatName' => $hidSubCatName,
                'pub_date' => $pub_date,
                'noofpages' => $noofpages,
                'timezonepicker' => $timezonepicker,
                'entry_point' => 'Inbound SEO',
                'lead_generation_channel' => 'IARC-Inbound',
                'lead_source' => $utmParam,
                'txtAddress' => '',
                'txtState' => '',
                'txtCity' => '',
                'txtCountry' => $txtCountry,
                'txtPincode' => '',
                'logo' => '',
                'speak_to_analyst' => '0000-00-00',
                'TitlesRelatedMyCompany' => $txtCheckboxName,
                'paymentOption' => '');

             $ch2 = curl_init();
             curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
             curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($newpost));
             $response1 = curl_exec($ch2);
             curl_close($ch2);

            $sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
			values(
			"' . $hidReportIncId . '", "' . $hidCat . '", "' . $hidSubCat . '", "' . $txtFName . '",
			"' . $txtLName . '", "' . $txtEmail . '", "' . $phone . '", "' . $txtJTitle . '", "' . $txtCompany . '",
			"' . $pin . '", "' . $txtComments . '", "' . $now . '", "' . $type . '", "' . $txtCountry . '",
			"' . $ip . '", "' . $speak_to_alyst . '", "' . $txtCheckboxName . '", "' . $industry . '",
			"' . $revenue . '"
			)';

            $query = Yii::$app->db->createCommand($sql)->execute();
            if ($query) {
                $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Sales Query.<br><br>
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
                $subject = "Sales Query";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo($hidPName)
                        ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SalesQueryForm']['formId'], 'page' => 'salesQuery']);
            }
			}else{
			
				$message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Sales Query.<br><br>
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
				$subject = "Sample Data Request : Fake";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo('venkat@industryarc.com')
                        ->setBcc(['vinay@industryarc.com', 'vishwadeep.singh@industryarc.com'])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest']);			
			}
        }
        $model = new SalesQueryForm();
        if (isset($dupIncId) && !empty($dupIncId)) {
            $reportDetail = ZspPosts::find()->where(['dup_inc_id' => $dupIncId])->andWhere('status=1')->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            $zspCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["cat"]])->asArray()->one();
            $zspSubCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["subcat"]])->asArray()->one();
        }
        return $this->render('salesQuery', [
                    'model' => $model,
                    'formId' => !empty($dupIncId) ? $dupIncId : NULL,
                    'data' => !empty($reportDetail) ? $reportDetail : [],
                    'catlog' => !empty($zspCatlog) ? $zspCatlog : [],
                    'subcatlog' => !empty($zspSubCatlog) ? $zspSubCatlog : [],
        ]);
    }

    public function actionInquiry() {
        $arrPost = Yii::$app->request->post();
        $dupIncId = filter_var(Yii::$app->request->get('id'), FILTER_VALIDATE_INT);
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($dupIncId)) {
            return $this->redirect(['site/index']);
        }
        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == '34.90.23.238') ? TRUE : $responseData->success;
        /* Capcha code End */
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {

            //echo '<pre>';print_r($arrPost);exit;

            $type = 'IQ';
            $ip = Yii::$app->getRequest()->getUserIP();
            $speak_to_alyst = "";
            $pin = "000000";
            $now = date("Y-m-d H:i:s");
            $industry = "Abc Company";
            $revenue = "1234";
            $phone = $arrPost["InquiryForm"]["txtPhoneExt"] . " " . $arrPost["InquiryForm"]["txtPhone"];
            $txtFName = $arrPost["InquiryForm"]["txtFName"];
            $txtLName = $arrPost["InquiryForm"]["txtLName"];
            $txtEmail = $arrPost["InquiryForm"]["txtEmail"];
            $txtJTitle = $arrPost["InquiryForm"]["txtJTitle"];
            $txtCompany = "NA";
            $txtCountry = $arrPost["InquiryForm"]["txtCountry"];
            $txtCheckboxName = "No";
            $hidReportCode = $arrPost["InquiryForm"]["hidReportCode"];
            $hidReportName = $arrPost["InquiryForm"]["hidReportName"];
            $hidCatName = $arrPost["InquiryForm"]["hidCatName"];
            $ip = Yii::$app->getRequest()->getUserIP();
            $txtCheckboxName1 = "";
            $txtComments = $arrPost["InquiryForm"]["txtComments"];
            $hidPName = $arrPost["InquiryForm"]["hidPName"];
            $hidCat = $arrPost["InquiryForm"]["hidCat"];
            $hidSubCat = $arrPost["InquiryForm"]["hidSubCat"];
            $hidSubCatName = $arrPost["InquiryForm"]["hidSubCatName"];
            $pub_date = $arrPost["InquiryForm"]["pub_date"];
            $noofpages = $arrPost["InquiryForm"]["noofpages"];
            $timezonepicker = $arrPost["InquiryForm"]["timezonepicker"];
            $hidReportIncId = $arrPost["InquiryForm"]["hidReportIncId"];
            $utmParam = $arrPost["InquiryForm"]["utmParam"];

			$checkDomain = $this->checkfakedomain($arrPost["InquiryForm"]["txtEmail"]);
			if($checkDomain == 'real'){
            $newpost = array('token' => 'deeptest',
                'f_name' => $txtFName,
                'l_name' => $txtLName,
                'company' => $txtCompany,
                'job_title' => $txtJTitle,
                'phonenumber' => $phone,
                'email' => $txtEmail,
                'txtComments' => $txtComments,
                'hidReportCode' => $hidReportCode,
                'hidReportName' => $hidReportName,
                'hidCatName' => $hidCatName,
                'hidSubCatName' => $hidSubCatName,
                'pub_date' => $pub_date,
                'noofpages' => $noofpages,
                'timezonepicker' => $timezonepicker,
                'entry_point' => 'RBB',
                'lead_generation_channel' => 'IARC-Inbound',
                'lead_source' => $utmParam,
                'txtAddress' => '',
                'txtState' => '',
                'txtCity' => '',
                'txtCountry' => $txtCountry,
                'txtPincode' => '',
                'logo' => '',
                'speak_to_analyst' => '0000-00-00',
                'TitlesRelatedMyCompany' => $txtCheckboxName,
                'paymentOption' => '');

             $ch2 = curl_init();
             curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
             curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($newpost));
             $response1 = curl_exec($ch2);
             curl_close($ch2);

            $sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
			values(
			"' . $hidReportIncId . '", "' . $hidCat . '", "' . $hidSubCat . '", "' . $txtFName . '",
			"' . $txtLName . '", "' . $txtEmail . '", "' . $phone . '", "' . $txtJTitle . '", "' . $txtCompany . '",
			"' . $pin . '", "' . $txtComments . '", "' . $now . '", "' . $type . '", "' . $txtCountry . '",
			"' . $ip . '", "' . $speak_to_alyst . '", "' . $txtCheckboxName . '", "' . $industry . '",
			"' . $revenue . '"
			)';

            $query = Yii::$app->db->createCommand($sql)->execute();
            if ($query) {
                $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Table of Contents.<br><br>
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

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo($hidPName)
                        ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['InquiryForm']['formId'], 'page' => 'inquiryBeforeBuying']);
            }
			}else{
			
				$message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Table of Contents.<br><br>
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
				$subject = "Sample Data Request : Fake";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo('venkat@industryarc.com')
                        ->setBcc(['vinay@industryarc.com', 'vishwadeep.singh@industryarc.com'])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest']);			
			}
        }
        $model = new InquiryForm();
        if (isset($dupIncId) && !empty($dupIncId)) {
            $reportDetail = ZspPosts::find()->where(['dup_inc_id' => $dupIncId])->andWhere('status=1')->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
            $zspCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["cat"]])->asArray()->one();
            $zspSubCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["subcat"]])->asArray()->one();
        }
        return $this->render('inquiry', [
                    'model' => $model,
                    'formId' => !empty($dupIncId) ? $dupIncId : NULL,
                    'data' => !empty($reportDetail) ? $reportDetail : [],
                    'catlog' => !empty($zspCatlog) ? $zspCatlog : [],
                    'subcatlog' => !empty($zspSubCatlog) ? $zspSubCatlog : [],
        ]);
    }

    public function actionShareRequirement() {
        echo "<b>Location : </b>" . __FILE__;
        echo '<br>';
        echo "And U R at <b>" . __FUNCTION__ . "</b><br>";
        exit;
        return $this->render('shareRequirement', []);
        //echo '<pre>';print_r($reportDetail);exit;
    }

    public function actionPagination() {
        echo "<b>Location : </b>" . __FILE__;
        echo '<br>';
        echo "And U R at <b>" . __FUNCTION__ . "</b><br>";
        exit;
        return $this->render('paginationpage', []);
    }

    public function actionRequestQuote() {
        $dupIncId = filter_var(Yii::$app->request->get('id'), FILTER_VALIDATE_INT);
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($dupIncId)) {
            //return $this->redirect(['site/index']);
        }
        $arrPost = Yii::$app->request->post();
		//echo "<pre>";
		//print_r($arrPost);exit;
        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == '34.90.23.238') ? TRUE : $responseData->success;
        /* Capcha code End */
		
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {

            $priority = !empty($arrPost['priority_range']) ? $arrPost['priority_range'] : NULL;
            $type = 'RQ'; //request Quote
            $ip = Yii::$app->getRequest()->getUserIP();
            $speak_to_alyst = "";
            $pin = "000000";
            $now = date("Y-m-d H:i:s");
            $industry = "Abc Company";
            $revenue = "1234";
            $phone = $arrPost["RequestQuoteForm"]["txtPhoneExt"] . " " . $arrPost["RequestQuoteForm"]["txtPhone"];
            $txtFName = $arrPost["RequestQuoteForm"]["txtFName"];
            $txtLName = $arrPost["RequestQuoteForm"]["txtLName"];
            $txtEmail = $arrPost["RequestQuoteForm"]["txtEmail"];
            $txtJTitle = $arrPost["RequestQuoteForm"]["txtJTitle"];
            $txtCompany = "NA";
            $txtCountry = $arrPost["RequestQuoteForm"]["txtCountry"];
            $txtCheckboxName = "No";
            $hidReportCode = $arrPost["RequestQuoteForm"]["hidReportCode"];
            $hidReportName = $arrPost["RequestQuoteForm"]["hidReportName"];
            $hidReportIncId = $arrPost["RequestQuoteForm"]["hidReportIncId"];
            $hidCatName = $arrPost["RequestQuoteForm"]["hidCatName"];
            $txtComments = $arrPost["RequestQuoteForm"]["txtComments"];
            $hidPName = $arrPost["RequestQuoteForm"]["hidPName"];
            $hidCat = $arrPost["RequestQuoteForm"]["hidCat"];
            $hidSubCat = $arrPost["RequestQuoteForm"]["hidSubCat"];
            $hidSubCatName = $arrPost["RequestQuoteForm"]["hidSubCatName"];
            $pub_date = $arrPost["RequestQuoteForm"]["pub_date"];
            $noofpages = $arrPost["RequestQuoteForm"]["noofpages"];
            $timezonepicker = $arrPost["RequestQuoteForm"]["timezonepicker"];
            $utmParam = $arrPost["RequestQuoteForm"]["utmParam"];

            $sql = 'insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type,country,ip,speak_to_alyst,comp_titles,industry,revenue)
					values(
					"' . $hidReportIncId . '", "' . $hidCat . '", "' . $hidSubCat . '",
					"' . $txtFName . '", "' . $txtLName . '", "' . $txtEmail . '", "' . $phone . '",
					"' . $txtJTitle . '", "' . $txtCompany . '", "' . $pin . '", "' . $txtComments . '",
					"' . $now . '", "' . $type . '", "' . $txtCountry . '", "' . $ip . '", "' . $speak_to_alyst . '",
					"' . $txtCheckboxName . '", "' . $industry . '", "' . $revenue . '"
					)';
					
            $query = Yii::$app->db->createCommand($sql)->execute();

			$checkDomain = $this->checkfakedomain($arrPost["RequestQuoteForm"]["txtEmail"]);
			if($checkDomain == 'real'){
            $newpost = array('token' => 'deeptest',
                'f_name' => $txtFName,
                'l_name' => $txtLName,
                'company' => $txtCompany,
                'job_title' => $txtJTitle,
                'phonenumber' => $phone,
                'email' => $txtEmail,
                'txtComments' => $txtComments,
                'hidReportCode' => $hidReportCode,
                'hidReportName' => $hidReportName,
                'hidCatName' => $hidCatName,
                'hidSubCatName' => $hidSubCatName,
                'pub_date' => $pub_date,
                'noofpages' => $noofpages,
                'timezonepicker' => $timezonepicker,
                'entry_point' => 'Request Quote',
                'lead_generation_channel' => 'IARC-Inbound',
                'lead_source' => $utmParam,
                'txtAddress' => '',
                'txtState' => '',
                'txtCity' => '',
                'txtCountry' => $txtCountry,
                'txtPincode' => '',
                'logo' => '',
                'speak_to_analyst' => '0000-00-00',
                'TitlesRelatedMyCompany' => $txtCheckboxName,
                'paymentOption' => '');

             $ch2 = curl_init();
             curl_setopt($ch2, CURLOPT_URL, 'https://crm.industryarc.in/api/inbound-leads/inboundleads.php');
             curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($newpost));
             $response1 = curl_exec($ch2);
             curl_close($ch2);

            if ($query) {
                $message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Quotation.<br><br>
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
					<td width='20%'><b>Priority</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$priority</td>
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
					<tr style='border: 0px'>
					<td width='20%'><b>Requirements</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtComments</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";
                $subject = "Request Quotation";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo($hidPName)
                        ->setBcc([\Yii::$app->params['devManagerEmail'], \Yii::$app->params['testEmail']])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['RequestQuoteForm']['formId'], 'page' => 'requestQuote'.$arrPost['RequestQuoteForm']['utmParam']]);
            }
			}else{
				$message = "Dear Sales Team, <br> <br> Below are the details of client who has requested for Quotation.<br><br>
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
					<td width='20%'><b>Priority</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$priority</td>
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
					<tr style='border: 0px'>
					<td width='20%'><b>Requirements</b></td>
					<td width='1%'>:</td>
					<td width='78%'>$txtComments</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";
				$subject = "Sample Data Request : Fake";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $message])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo('venkat@industryarc.com')
                        ->setBcc(['vinay@industryarc.com', 'vishwadeep.singh@industryarc.com'])
                        ->setSubject($subject)
                        ->send();
                return $this->redirect(['message/thanks', 'id' => $arrPost['SampleRequestForm']['formId'], 'page' => 'sampleRequest']);			
			}
        }
        $model = new RequestQuoteForm();
        if (isset($dupIncId) && !empty($dupIncId)) {
            $reportDetail = ZspPosts::find()->where(['dup_inc_id' => $dupIncId])->andWhere('status=1')->asArray()->one();			
            $zspCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["cat"]])->asArray()->one();			
            $zspSubCatlog = ZspCatlogCategories::find()->where(['inc_id' => $reportDetail["subcat"]])->asArray()->one();
            if (empty($reportDetail)) {
                return $this->goHome();
            }
        }

        return $this->render('requestQuote', [
                    'model' => $model,
                    'formId' => !empty($dupIncId) ? $dupIncId : NULL,
                    'data' => !empty($reportDetail) ? $reportDetail : [],
                    'catlog' => !empty($zspCatlog) ? $zspCatlog : [],
                    'subcatlog' => !empty($zspSubCatlog) ? $zspSubCatlog : [],
        ]);
    }
	
	public function checkfakedomain($data){
		$edomain = array('craigs9.com','wrwint.com','greenmedia9.us','craigs9.com','greener9.us','wrwint.com');
		$remail = explode('@',$data);
		if(in_array($remail[1],$edomain)){
			return 'fake';
		}else{
			return 'real';
		}
	}

}
