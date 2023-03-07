<?php

namespace frontend\controllers;

use Yii;
use common\models\ZspPosts;
use common\models\ZspPostsQuery;
use frontend\forms\BuyReportForm;
use common\models\ZspUserAccounts;
use frontend\helper\PurchaseHelper;

class PurchaseController extends IarcfbaseController {

    public function beforeAction($action) {
        if ($action->id == 'payment-status' || $action->id == 'hdfc-payment-status') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

     public function actionViewLicenses(){
        $arrReportDetail = [];
        $arrGet = Yii::$app->request->get();
        $strReportId = !empty($arrGet['id']) ? $arrGet['id'] : NULL;
        $arrReportDetail = ZspPosts::find()->where(['dup_inc_id' => $strReportId])->asArray()->one();
        return $this->render('viewLicenses',['report' => $arrReportDetail,'reportId' => $strReportId]);
    }

    public function actionBuyReport() {
        $arrReportDetail = [];
        $arrPost = Yii::$app->request->post();
        $arrGet = Yii::$app->request->get();
        $session = Yii::$app->session;
        $arrSessionUser = Yii::$app->session->get('user');
		//$arrGet['id'] = filter_var($arrGet['id'], FILTER_VALIDATE_INT);

        /* Capcha code start */
        $secret = '6LfezHYUAAAAAG98xgwe0N1MC8_7LjnPAL84NzSi';
        $captcha = !empty($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        $isValidCaptcha = (Yii::$app->request->hostName == 'localhost') ? TRUE : $responseData->success;
        /* Capcha code End */
        $model = new BuyReportForm();
        $strReportId = !empty($arrGet['id']) ? $arrGet['id'] : NULL;
        $strLicenceAmount = NULL;
        if ($strReportId) {
            $arrReportDetail = ZspPosts::find()->where(['dup_inc_id' => $strReportId])->asArray()->one();

            $session->set('order', [
                'inc_id' => !empty($arrReportDetail['inc_id']) ? $arrReportDetail['inc_id'] : NULL,
                'reportPrice' => !empty($strLicenceAmount) ? $strLicenceAmount : $arrReportDetail['slp'],
                'title' => !empty($arrReportDetail['title']) ? $arrReportDetail['title'] : NULL,
                'report_code' => !empty($arrReportDetail['code']) ? $arrReportDetail['code'] : NULL,
                'dup_inc_id' => !empty($arrReportDetail['dup_inc_id']) ? $arrReportDetail['dup_inc_id'] : NULL,
                'slp' => !empty($arrReportDetail['slp']) ? $arrReportDetail['slp'] : NULL, //single use licence price
                'clp' => !empty($arrReportDetail['clp']) ? $arrReportDetail['clp'] : NULL, //corporate use licence price
            ]);
        }
        /* if date exist in the session then set the value in the form field */
        if (isset($arrSessionUser) && !empty($arrSessionUser)) {
            $model->f_name = !empty($arrSessionUser['fname']) ? $arrSessionUser['fname'] : NULL;
            $model->l_name = !empty($arrSessionUser['lname']) ? $arrSessionUser['lname'] : NULL;
            $model->email = !empty($arrSessionUser['login_id']) ? $arrSessionUser['login_id'] : NULL;
            $model->company_name = !empty($arrSessionUser['company']) ? $arrSessionUser['company'] : NULL;
            $model->address = !empty($arrSessionUser['address']) ? $arrSessionUser['address'] : NULL;
            $model->country = !empty($arrSessionUser['country']) ? $arrSessionUser['country'] : NULL;
        }
        if ($isValidCaptcha && isset($arrPost) && !empty($arrPost)) {
			//echo "<pre>";
			//print_r($arrPost);exit;
            $arrSessionOrder = Yii::$app->session->get('order');
            $email = !empty($arrPost['email']) ? $arrPost['email'] : NULL;
            $isEmailExist = ZspUserAccounts::find()->where(['login_id' => $email])->exists();
            $orderId = PurchaseHelper::generateCode(8);
            $reportId = $arrSessionOrder['dup_inc_id'];
            $discount = !empty($arrPost['discount']) ? $arrPost['discount'] : 0;
            $amount = !empty($arrPost['licence_price']) ? $arrPost['licence_price']-$discount : 0;
            $title = $arrSessionOrder['title'];
            $couponCode = !empty($arrPost['coupon_code']) ? $arrPost['coupon_code'] : NULL;
            //$discount = !empty($arrPost['discount']) ? $arrPost['discount'] : NULL;
            $fname = !empty($arrPost['f_name']) ? $arrPost['f_name'] : NULL;
            $lname = !empty($arrPost['l_name']) ? $arrPost['l_name'] : NULL;
            $company = !empty($arrPost['company_name']) ? $arrPost['company_name'] : NULL;
            $phone = !empty($arrPost['contact_number']) ? $arrPost['contact_number'] : NULL;
            $pay_mode = !empty($arrPost['payment_mode']) ? $arrPost['payment_mode'] : NULL;
            $order_status = 'IP'; //in pending
            $address = !empty($arrPost['address']) ? $arrPost['address'] : NULL;
            $licenceType = "";

            if ($arrSessionOrder['slp'] == $amount) {
                $licenceType = 'SL';
            } elseif ($arrSessionOrder['clp'] == $amount) {
                $licenceType = 'CL';
            }

            if (empty($arrSessionUser) && $isEmailExist == false) {
                $sqlUserAccounts = "insert into zsp_user_accounts
				(title,fname,lname,company,job,phone,inds,login_id,password,dt_created)
				values('','" . $fname . "','" . $lname . "','" . $company . "','','" . $phone . "',
				'','" . $email . "','" . $orderId . "',now())";

                $isUserInserted = Yii::$app->db->createCommand($sqlUserAccounts)->execute();
                $isUserInserted = false;
                if ($isUserInserted) {
                    $fullName = $fname . ' ' . $lname;
                    $msgNewUser = "Hi " . $fullName . " <br>You have successfully registerd into IndustryARC.<br> Your login details <br><br>User ID : " . $email . "<br>Password : " . $orderId;
                    $subject = "Welcome to IndustryARC : Registration Confirmation ";
                    Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $msgNewUser])
                            ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                            ->setTo($email)
                            ->setBcc(\Yii::$app->params['testEmail'])
                            ->setSubject($subject)
                            ->send();
                }
            }

            $sqlOrderHdrs = "insert into zsp_order_hdrs
			(login_id,order_num,cust_name,cust_po_num,cust_email,cust_s_addr,cust_b_addr,pincode,order_amt,dt_created,dt_modified,order_status,pay_mode)
			values(
			'" . $email . "','" . $orderId . "','" . $fname . "','" . $phone . "','" . $email . "','" . $address . "',
			'','000000','" . $amount . "',now(),now(),'" . $order_status . "','" . $pay_mode . "'
			)";
            $isOrderHdrsInserted = Yii::$app->db->createCommand($sqlOrderHdrs)->execute();
            if ($isOrderHdrsInserted) {
                $sqlOrderDtls = "insert into zsp_order_dtls
				(order_hdr_num,post_id,licence,qty,price,coupon,discount,dt_created)
				values(
				'" . $orderId . "','" . $arrSessionOrder['inc_id'] . "','" . $licenceType . "','1',
				'" . $amount . "','" . $couponCode . "','" . $discount . "',now()
				)";
                $isOrderDtlsInserted = Yii::$app->db->createCommand($sqlOrderDtls)->execute();
            }
            /* set order related data in session::start */
            $orderSession = $session->get('order');
            $session->set('order', array_merge($orderSession, [
                'user_id' => $email,
                'order_id' => $orderId,
                'report_id' => $reportId,
                'licence_amount' => $amount,
                'f_name' => $fname,
                'l_name' => $lname,
                'contact_number' => $phone,
                'address' => $address,
                'payment_mode' => $pay_mode,
            ]));
            /* set order related data in session::End */

            //return $this->redirect(['confirm-buy-report', 'id' => $orderId.$arrPost['utmParam']]);
            return $this->redirect(['confirm-buy-report', 'id' => $orderId,'utm_source' =>$arrPost['utmParam']]);
        }

        return $this->render('buyReport', [
                    'model' => $model,
                    'user' => $arrSessionUser,
                    'report' => $arrReportDetail,
                    'reportId' => $strReportId,
                    'licenceAmount' => $strLicenceAmount,
        ]);
    }

    public function actionConfirmBuyReport() {
        $arrPost = Yii::$app->request->post();
        $orderId = Yii::$app->request->get('id');
        $orderSession = Yii::$app->session->get('order');
        $userId = $orderSession['user_id'];
        if (($_SERVER["REQUEST_METHOD"] == "GET") && (empty($orderId) || $orderId != $orderSession['order_id'])) {
            echo '<h3> Invalid Request Found !!!!!!!!</h3>';
            exit;
        }
        if (isset($arrPost) && !empty($arrPost)) {

            if (isset($arrPost['submitPayment']) && $arrPost['submitPayment'] == 'HDFC_Payment') {
                //$MERCHANT_KEY = "3552054";
                $MERCHANT_KEY = "VWFiSz";
                $SALT = "2VZlJHZ6";
                //$PAYU_BASE_URL = "https://test.payu.in"; //Test Url
                $PAYU_BASE_URL = "https://secure.payu.in";//Produvction Url

                $surl = $furl = $curl = $returnUrl = ($_SERVER['HTTP_HOST'] == 'localhost') ? 'http://localhost/stagging_industryarc/purchase/hdfc-payment-status' : 'https://www.industryarc.com/purchase/hdfc-payment-status';
                
                $hidReportName = $orderSession['title'];
                $hidReportName = str_replace('&', 'and', $hidReportName);
                $hidReportName = str_replace('-', ' ', $hidReportName);
                $txnid = $orderSession['order_id'];
                $txtAmount = $orderSession['licence_amount'];
                $txtFName = $orderSession['f_name'];
                $txtEmail = $orderSession['user_id'];
                $phone = $orderSession['contact_number'];
                $txtAddress = $orderSession['address'];

                $udf1 = $hidReportName;
                $udf2 = $orderSession['user_id'];
                $udf3 = $orderSession['contact_number'];
                $udf4 = $orderSession['address'];
                $udf5 = $orderSession['order_id'];

                //$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
                $hashSequence = "$MERCHANT_KEY|$txnid|$txtAmount|$hidReportName|$txtFName|$txtEmail|$udf1|$udf2|$udf3|$udf4|$udf5||||||";

                $hash_string = $hashSequence . $SALT;

                $hash = strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL . '/_payment';

                if (!empty($action)) {

                    $formHtml = '';
                    $formHtml .= '<html><body onload="document.payuForm.submit()">';
                    $formHtml .= '<form action="' . $action . '" method="post" name="payuForm">';
                    $formHtml .= '<input type="hidden" name="key" value="' . $MERCHANT_KEY . '">';
                    $formHtml .= '<input type="hidden" name="hash" value="' . $hash . '">';
                    $formHtml .= '<input type="hidden" name="txnid" value="' . $txnid . '">';
                    $formHtml .= '<input type="hidden" name="amount" value="' . $txtAmount . '">';
                    $formHtml .= '<input type="hidden" name="firstname" value="' . $txtFName . '">';
                    $formHtml .= '<input type="hidden" name="email" value="' . $txtEmail . '">';
                    $formHtml .= '<input type="hidden" name="phone" value="' . $phone . '">';
                    $formHtml .= '<input type="hidden" name="productinfo" value="' . $hidReportName . '">';
                    $formHtml .= '<input type="hidden" name="surl" value="' . $surl . '" size="64">';
                    $formHtml .= '<input type="hidden" name="furl" value="' . $furl . '" size="64">';
                    $formHtml .= '<input type="hidden" name="curl" value="' . $curl . '">';
                    $formHtml .= '<input type="hidden" name="address1" value="' . $txtAddress . '">';
                    $formHtml .= '<input type="hidden" name="udf1" value="' . $udf1 . '">';
                    $formHtml .= '<input type="hidden" name="udf2" value="' . $udf2 . '">';
                    $formHtml .= '<input type="hidden" name="udf3" value="' . $udf3 . '">';
                    $formHtml .= '<input type="hidden" name="udf4" value="' . $udf4 . '">';
                    $formHtml .= '<input type="hidden" name="udf5" value="' . $udf5 . '">';
                    $formHtml .= '<input type="hidden" name="pg" value="cc">';
                    $formHtml .= '</form></body></html>';
                    echo $formHtml;
                }

                exit;
            }
        }
        return $this->render('confirmBuyReport', [
                    'orderInfo' => !empty($orderSession) ? $orderSession : [],
        ]);
    }

    public function actionPaymentResponce() {
        $session = Yii::$app->session;
        $orderSession = $session->get('order');
        if (!empty($_POST)) {
            $session->set('order', array_merge($orderSession, [
                'paypall_orderID' => $_POST['orderID'],
            ]));
        }
        return TRUE;
    }

    public function actionPaymentStatus() {
        $arrOrderDtls = $arrOrderHdrs = [];
        $paymentStatus = NULL;
        $orderDet = Yii::$app->session->get('order');
        $orderId = (!empty($orderDet['order_id'])) ? $orderDet['order_id'] : NULL;
		//echo '<pre>';print_r($_REQUEST);exit;
        if (!empty($orderDet['paypall_orderID']) || !empty($_REQUEST["razor_payId"])) {
            $paymentStatus = 'SUCCESS';
            /* STATUS OP = Order Placed */
            $updateOrderHdrs = "update zsp_order_hdrs set order_status='OP' where order_num='$orderId'";
            $isUpdatedOrderHdrs = Yii::$app->db->createCommand($updateOrderHdrs)->execute();
            $arrOrderHdrs = \common\models\ZspOrderHdrs::find()
                            ->where(['order_num' => $orderId])
                            ->asArray()->one();

            $mailmsg = '
					  <table width="100%" cellspacing="0" cellpadding="0" border="0">
					  <tr>
					  <td width="100%" valign="top" align="center">
					  <table width="100%" cellpadding="0" cellspacing="0" >
					  <tr>
					  <td width="49%" valign="top" style="border-right:thin dotted #7D7D7D">
					  <table width="100%" cellpadding="0" cellspacing="0">
					  <tr>
					  <td class="labelTab" >
					  User ID : ' . $arrOrderHdrs['login_id'] . '<br>
					  Address : ' . $arrOrderHdrs['cust_name'] . '' . $arrOrderHdrs['cust_s_addr'] . '<br>' . $arrOrderHdrs['pincode'] . '<br> Phone : ' . $arrOrderHdrs['cust_po_num'] . '
					  </td>
					  </tr>
					  </table>
					  </td>
					  <td width="49%" valign="top" style="padding-left:8px">
					  <table width="100%" cellpadding="0" cellspacing="0" class="labelTab">
					  <tr>
					  <td width="28%" >Order Amount </td> 
					  <td width="72%" > : $ ' . $arrOrderHdrs['order_amt'] . '</td>
					  </tr>  
					  <tr>
					  <td>Ordered Date</td> 
					  <td> : ' . date('d M Y H:i:s', strtotime($arrOrderHdrs['dt_created'])) . '</td></tr>
					  <tr>
					  <td>Order Status </td> 
					  <td> : Order Placed</td>
					  </tr>
					  <tr>
					  <td>Payment Mode </td> 
					  <td> :' . $arrOrderHdrs['pay_mode'] . ' </td>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  <tr><td height="20px" colspan="2"></td></tr>
					  <tr>
					  <td colspan="2">
					  <table width="100%" cellspacing="0" cellpadding="10px" bordercolor="#f0dfd3" border="1" style="border-collapse:collapse">
					  <tr style="background-color:#a14b2a">

					  <td width="42%" height="30" align="center" valign="middle" class="td_txt1">Item</td>                      
					  <td width="25%" height="30" align="center" valign="middle" class="td_txt1">Quantity</td>
					  <td width="33%" height="30" align="center" valign="middle" class="td_txt1">Price</td>
					  </tr>';
            $arrOrderDtls = \common\models\ZspOrderDtls::find()
                            ->where(['order_hdr_num' => $orderId])
                            ->asArray()->all();

            if (count($arrOrderDtls) > 0) {
                // for multiple order
                foreach ($arrOrderDtls as $ordDtls) {
                    $arrReportDet = ZspPosts::find()->where(['inc_id' => $ordDtls['post_id']])->asArray()->one();
                    $mailmsg = $mailmsg . '<tr style="background-color:#fff"  >
								<td align="left" style="padding:5px" class="f_text" height="25" valign="middle">' . $arrReportDet['title'] . ' <br><span style="font-size:10px"> ' . $ordDtls['licence'] . '</span></td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" >' . $ordDtls['qty'] . ' X  ' . $ordDtls['price'] . ' $</td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" > ' . $ordDtls['qty'] * $ordDtls['price'] . ' $</td>
							</tr>';
                }
                $mailmsg = $mailmsg . '</table></td></tr></table></td></tr></table>';

                $emailMessage = $mailmsg;
                $subject = "Industryarc : Order Confirmation ";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMessage])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo(\Yii::$app->params['salesEmail'])
                        ->setBcc(\Yii::$app->params['testEmail'])
                        ->setSubject($subject)
                        ->send();
            }
        }else{
            $arrOrderHdrs = \common\models\ZspOrderHdrs::find()
                            ->where(['order_num' => $orderId])
                            ->asArray()->one();

            $mailmsg = '
					  <table width="100%" cellspacing="0" cellpadding="0" border="0">
					  <tr>
					  <td width="100%" valign="top" align="center">
					  <table width="100%" cellpadding="0" cellspacing="0" >
					  <tr>
					  <td width="49%" valign="top" style="border-right:thin dotted #7D7D7D">
					  <table width="100%" cellpadding="0" cellspacing="0">
					  <tr>
					  <td class="labelTab" >
					  User ID : ' . $arrOrderHdrs['login_id'] . '<br>
					  Address : ' . $arrOrderHdrs['cust_name'] . '' . $arrOrderHdrs['cust_s_addr'] . '<br>' . $arrOrderHdrs['pincode'] . '<br> Phone : ' . $arrOrderHdrs['cust_po_num'] . '
					  </td>
					  </tr>
					  </table>
					  </td>
					  <td width="49%" valign="top" style="padding-left:8px">
					  <table width="100%" cellpadding="0" cellspacing="0" class="labelTab">
					  <tr>
					  <td width="28%" >Order Amount </td> 
					  <td width="72%" > : $ ' . $arrOrderHdrs['order_amt'] . '</td>
					  </tr>  
					  <tr>
					  <td>Ordered Date</td> 
					  <td> : ' . date('d M Y H:i:s', strtotime($arrOrderHdrs['dt_created'])) . '</td></tr>
					  <tr>
					  <td>Order Status </td> 
					  <td> : Order Placed</td>
					  </tr>
					  <tr>
					  <td>Payment Mode </td> 
					  <td> :' . $arrOrderHdrs['pay_mode'] . ' </td>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  <tr><td height="20px" colspan="2"></td></tr>
					  <tr>
					  <td colspan="2">
					  <table width="100%" cellspacing="0" cellpadding="10px" bordercolor="#f0dfd3" border="1" style="border-collapse:collapse">
					  <tr style="background-color:#a14b2a">

					  <td width="42%" height="30" align="center" valign="middle" class="td_txt1">Item</td>                      
					  <td width="25%" height="30" align="center" valign="middle" class="td_txt1">Quantity</td>
					  <td width="33%" height="30" align="center" valign="middle" class="td_txt1">Price</td>
					  </tr>';
            $arrOrderDtls = \common\models\ZspOrderDtls::find()
                            ->where(['order_hdr_num' => $orderId])
                            ->asArray()->all();

            if (count($arrOrderDtls) > 0) {
                // for multiple order
                foreach ($arrOrderDtls as $ordDtls) {
                    $arrReportDet = ZspPosts::find()->where(['inc_id' => $ordDtls['post_id']])->asArray()->one();
                    $mailmsg = $mailmsg . '<tr style="background-color:#fff"  >
								<td align="left" style="padding:5px" class="f_text" height="25" valign="middle">' . $arrReportDet['title'] . ' <br><span style="font-size:10px"> ' . $ordDtls['licence'] . '</span></td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" >' . $ordDtls['qty'] . ' X  ' . $ordDtls['price'] . ' $</td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" > ' . $ordDtls['qty'] * $ordDtls['price'] . ' $</td>
							</tr>';
                }
                $mailmsg = $mailmsg . '</table></td></tr></table></td></tr></table>';

                $emailMessage = $mailmsg;
                $subject = "Industryarc : Order Payment Failed ";

                Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMessage])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                        ->setTo(\Yii::$app->params['salesEmail'])
                        ->setBcc(\Yii::$app->params['testEmail'])
                        ->setSubject($subject)
                        ->send();
            }
		}
        unset($_SESSION['order']);
        return $this->render('paymentStatus', [
                    'payStatus' => $paymentStatus,
                    'arrOrderDtls' => $orderDet,
        ]);
    }

    public function actionHdfcPaymentStatus() {
        $arrOrderDtls = $arrOrderHdrs = [];
        $paymentStatus = NULL;
        $salt = "2VZlJHZ6";
        $orderDet = Yii::$app->session->get('order');
        $orderId = (!empty($orderDet['order_id'])) ? $orderDet['order_id'] : NULL;
        //echo "<pre>";print_r($_REQUEST);exit;
        if (!empty($_REQUEST)) {
            if ($_REQUEST['status'] == "success") {
                $status = $_REQUEST["status"];
                $firstname = $_REQUEST["firstname"];
                $amount = $_REQUEST["amount"]; //Please use the amount value from database
                $txnid = $_REQUEST["txnid"];
                $posted_hash = $_REQUEST["hash"];
                $key = $_REQUEST["key"];
                $productinfo = $_REQUEST["productinfo"];
                $email = $_REQUEST["email"];
                $udf1 = $_POST['udf1'];
                $udf2 = $_POST['udf2'];
                $udf3 = $_POST['udf3'];
                $udf4 = $_POST['udf4'];
                $udf5 = $_POST['udf5'];
                $mihpayid = $_REQUEST['mihpayid'];
                //Validating the reverse hash
                if (isset($_REQUEST["additionalCharges"])) {
                    $additionalCharges = $_REQUEST["additionalCharges"];
                    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
                } else {
                    $retHashSeq = $salt . '|' . $status . '||||||' . $udf5 . '|' . $udf4 . '|' . $udf3 . '|' . $udf2 . '|' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
                }
                $hash = hash("sha512", $retHashSeq);

                $selectOrderHdrs = "SELECT * FROM `zsp_order_hdrs` WHERE order_num='$txnid' AND mihpayid='$mihpayid'";
                $isSelectedOrderHdrs = Yii::$app->db->createCommand($selectOrderHdrs)->queryOne();

                if (empty($isSelectedOrderHdrs) && $txnid == $orderDet['order_id']) {
                    if ($hash == $posted_hash) {
                        $paymentStatus = 'SUCCESS';
                        /* STATUS OP = Order Placed */
                        $updateOrderHdrs = "update zsp_order_hdrs set order_status='OP',mihpayid='$mihpayid' where order_num='$orderId'";
                        $isUpdatedOrderHdrs = Yii::$app->db->createCommand($updateOrderHdrs)->execute();

                        $arrOrderHdrs = \common\models\ZspOrderHdrs::find()
                                        ->where(['order_num' => $orderId])
                                        ->asArray()->one();

                        $mailmsg = '
					  <table width="100%" cellspacing="0" cellpadding="0" border="0">
					  <tr>
					  <td width="100%" valign="top" align="center">
					  <table width="100%" cellpadding="0" cellspacing="0" >
					  <tr>
					  <td width="49%" valign="top" style="border-right:thin dotted #7D7D7D">
					  <table width="100%" cellpadding="0" cellspacing="0">
					  <tr>
					  <td class="labelTab" >
					  User ID : ' . $arrOrderHdrs['login_id'] . '<br>
					  Address : ' . $arrOrderHdrs['cust_name'] . '' . $arrOrderHdrs['cust_s_addr'] . '<br>' . $arrOrderHdrs['pincode'] . '<br> Phone : ' . $arrOrderHdrs['cust_po_num'] . '
					  </td>
					  </tr>
					  </table>
					  </td>
					  <td width="49%" valign="top" style="padding-left:8px">
					  <table width="100%" cellpadding="0" cellspacing="0" class="labelTab">
					  <tr>
					  <td width="28%" >Order Amount </td> 
					  <td width="72%" > : $ ' . $arrOrderHdrs['order_amt'] . '</td>
					  </tr>  
					  <tr>
					  <td>Ordered Date</td> 
					  <td> : ' . date('d M Y H:i:s', strtotime($arrOrderHdrs['dt_created'])) . '</td></tr>
					  <tr>
					  <td>Order Status </td> 
					  <td> : Order Placed</td>
					  </tr>
					  <tr>
					  <td>Payment Mode </td> 
					  <td> :' . $arrOrderHdrs['pay_mode'] . ' </td>
					  </tr>
					  </table>
					  </td>
					  </tr>
					  <tr><td height="20px" colspan="2"></td></tr>
					  <tr>
					  <td colspan="2">
					  <table width="100%" cellspacing="0" cellpadding="10px" bordercolor="#f0dfd3" border="1" style="border-collapse:collapse">
					  <tr style="background-color:#a14b2a">

					  <td width="42%" height="30" align="center" valign="middle" class="td_txt1">Item</td>                      
					  <td width="25%" height="30" align="center" valign="middle" class="td_txt1">Quantity</td>
					  <td width="33%" height="30" align="center" valign="middle" class="td_txt1">Price</td>
					  </tr>';
                        $arrOrderDtls = \common\models\ZspOrderDtls::find()
                                        ->where(['order_hdr_num' => $orderId])
                                        ->asArray()->all();

                        if (count($arrOrderDtls) > 0) {
                            // for multiple order
                            foreach ($arrOrderDtls as $ordDtls) {
                                $arrReportDet = ZspPosts::find()->where(['inc_id' => $ordDtls['post_id']])->asArray()->one();
                                $mailmsg = $mailmsg . '<tr style="background-color:#fff"  >
								<td align="left" style="padding:5px" class="f_text" height="25" valign="middle">' . $arrReportDet['title'] . ' <br><span style="font-size:10px"> ' . $ordDtls['licence'] . '</span></td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" >' . $ordDtls['qty'] . ' X  ' . $ordDtls['price'] . ' $</td>
								<td align="center" class="f_text" height="25" valign="middle" style="padding:4px" > ' . $ordDtls['qty'] * $ordDtls['price'] . ' $</td>
							</tr>';
                            }
                            $mailmsg = $mailmsg . '</table></td></tr></table></td></tr></table>';

                            $emailMessage = $mailmsg;
                            $subject = "Industryarc : Order Confirmation ";

                            Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMessage])
                                    ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                                    ->setTo(\Yii::$app->params['salesEmail'])
                                    ->setBcc(\Yii::$app->params['testEmail'])
                                    ->setSubject($subject)
                                    ->send();
                        }
                    } else {
                        $paymentStatus = NULL;
                    }
                } else {
                    $paymentStatus = NULL;
                }
            }
        }
        unset($_SESSION['order']);
        return $this->render('paymentStatus', [
                    'payStatus' => $paymentStatus,
                    'arrOrderDtls' => $orderDet,
        ]);
    }
	
	public function actionApplyCoupon(){
		//echo $_GET['coupon_code'];exit;
		$Response = NULL;
		if(!empty($_POST['coupon_code'])){
			$couponCode = \Yii::$app->db->quoteValue($_POST['coupon_code']);
			$sql= "SELECT * FROM zsp_coupons WHERE coupon_code = ".$couponCode." AND STATUS = 1";
			$query = Yii::$app->db->createCommand($sql)->queryOne();
			if(!empty($query)){
				$validFrom = strtotime($query['validity_from']);
				$validTill = strtotime($query['validity_till']);
				$currentDT = date('Y-m-d H:i:s');
				//$currentDT = strtotime("2018-02-06 11:09:35");
				$currentDT = strtotime(date('Y-m-d H:i:s'));
				/* current date and Time */
				if ((($currentDT < $validFrom) && ($currentDT > $validTill)) || (($currentDT > $validFrom) && ($currentDT < $validTill)) ){
					$discountDetail = $this->getDiscount($_POST['price'],$query['discount'],$query['type']);
					$Response['success'] = $discountDetail;
				}else{
					$Response['error'] = 'Coupon Code is expired.';
				}
			}else{
				$Response['error'] = 'Invalid Coupon Code.';
			}
		}
		return json_encode($Response);
	}
	
	public function getDiscount($price,$discount,$type){
		//echo $price.' AND '.$discount;
		$response = NULL;
		if(!empty($price) && !empty($discount)){
			if($type=="PERCENTAGE"){
				$discountAmount = ($price*($discount/100));
				$discountAmount = round($discountAmount,2);
				$response = [
					'actual_price'=>$price,
					'discount_price'=>$discountAmount,
					'sale_price'=>$price - $discountAmount,
				];
			}else{
				$discountAmount = $discount;
				$response = [
					'actual_price'=>$price,
					'discount_price'=>$discountAmount,
					'sale_price'=>$price - $discountAmount,
				];
			}			
		}
		return $response;
	}

}
