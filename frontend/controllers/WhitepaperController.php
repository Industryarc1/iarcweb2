<?php

namespace frontend\controllers;

use Yii;
use common\models\ZspLeadsEvents;

/**
 * SearchController
 */
class WhitepaperController extends IarcfbaseController {

    public function actionListWhitepaper() {
        $arrGet = Yii::$app->request->get();
        $sql = "select * from zsp_whitepapers where status=1 order by prod_id desc";
        $arrWhitePaper = Yii::$app->db->createCommand($sql)->queryAll();

        if (!empty($arrGet['prod_id']) && !empty($arrGet['document'])) {
            //echo '<pre>';print_r($arrGet);exit;
            $fileName = dirname(__DIR__) . '/web/documents/whitepapers/' . $arrGet['document'];
            if (file_exists($fileName)) {
                $downloadDoc = $fileName;
                $url = Yii::$app->request->baseUrl . '/documents/whitepapers/' . $arrGet['document'];
                //Yii::$app->session->setFlash('error','<a href="'.$url.'" download>Click Here</a> to Download the file');
            } else {
                //Yii::$app->session->setFlash('error','Something went wrong!, Please contact our <a href="mailto:sales@industryarc.com">Support Team</a>');
            }
        }

        return $this->render('listWhitepaper', [
                    'arrWhitePaper' => $arrWhitePaper,
                    'downloadDoc' => !empty($downloadDoc) ? $downloadDoc : NULL,
        ]);
    }

    public function actionWhitepaperDetail() {
        $arrGet = Yii::$app->request->get();
        $arrWhitePaper = [];
        $contactModel = new \frontend\models\ZspContact();
        if (!empty($arrGet['prod_id']) && !empty($arrGet['seo_keyword'])) {
            $sql = "select * from zsp_whitepapers where prod_id = '" . $arrGet['prod_id'] . "' and seo_keyword = '" . $arrGet['seo_keyword'] . "'";
            $arrWhitePaper = Yii::$app->db->createCommand($sql)->queryOne();
            //echo '<pre>';print_r($arrWhitePaper);exit;
        }
        return $this->render('whitepaperDetail', [
                    'whitePaper' => $arrWhitePaper,
                    'contactModel' => $contactModel,
        ]);
    }

    public function actionWhitepaperDownload() {
        $arrGet = Yii::$app->request->get();
        $arrPost = Yii::$app->request->post();
        $arrWhitePaper = [];

        if (!empty($arrGet['prod_id']) && !empty($arrGet['seo_keyword'])) {
            $sql = "select * from zsp_whitepapers where prod_id = '" . $arrGet['prod_id'] . "' and seo_keyword = '" . $arrGet['seo_keyword'] . "'";
            $arrWhitePaper = Yii::$app->db->createCommand($sql)->queryOne();
        }
        /* when form is submitted */
        if (isset($arrPost) && !empty($arrPost)) {
            if (!empty($arrPost['prod_id'])) {
                $sql = "select * from zsp_whitepapers where prod_id = '" . $arrPost['prod_id'] . "'";
                $arrWhitePaper = Yii::$app->db->createCommand($sql)->queryOne();
                if (!empty($arrWhitePaper)) {
                    $emailMsg = "Dear SEO/sales Team, <br> <br> Below are the details of Lead who has visited/downloaded our white papers.<br><br>
					<table border-collapse:collapse  width='100%' cellpadding='5' cellspacing='5' style='border-radius:0.4em;font-family:Arial;font-size:13px;background-color:#eee'>
					<tr style='border-bottom: 1px solid #ccc;'>
					<td width='20%'><b>Name</b></td>
					<td width='1%'>:</td>
					<td width='78%'>" . $arrPost['fname'] . "&nbsp" . $arrPost['lname'] . "</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Email</b></td>
					<td width='1%'>:</td>
					<td width='78%'>" . $arrPost['email'] . "</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Contact Number</b></td>
					<td width='1%'>:</td>
					<td width='78%'>" . $arrPost['phoneExt'] . "-" . $arrPost['phone'] . "</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Comments</b></td>
					<td width='1%'>:</td>
					<td width='78%'>" . $arrPost['comments'] . "</td>
					</tr>
					<tr style='border-bottom: 1px solid #CCC;'>
					<td width='20%'><b>Whitepaper Title</b></td>
					<td width='1%'>:</td>
					<td width='78%'>" . $arrWhitePaper['title'] . "</td>
					</tr>
					</table><br><br>Thanks,<br>IndustryARC";
                    $emailSub = "whitepaper Lead";

                    Yii::$app->mailer->compose(['html' => '@common/mail/layouts/html'], ['content' => $emailMsg])
                            ->setFrom([\Yii::$app->params['supportEmail'] => 'IndustryARC'])
                            ->setTo(\Yii::$app->params['salesEmail'])
                            ->setBcc(\Yii::$app->params['testEmail'])
                            ->setSubject($emailSub)
                            ->send();
                }

                if (!empty($arrWhitePaper['document']) && isset($arrWhitePaper['document'])) {
                    //return $this->redirect(['list-whitepaper','prod_id'=>$arrWhitePaper['prod_id'],'document'=>$arrWhitePaper['document']]);
                    $fileName = dirname(__DIR__) . '/web/documents/whitepapers/' . $arrWhitePaper['document'];
                    if (file_exists($fileName)) {
                        /* download file code :: start */
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename=' . basename($fileName));
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($fileName));
                        ob_clean();
                        flush();
                        readfile($fileName);
                        /* download file code :: end */
                    } else {
                        //Yii::$app->session->setFlash('error','Something went wrong!, Please contact our <a href="mailto:sales@industryarc.com">Support Team</a>');
                    }
                } else {
                    return $this->redirect(['whitepaper/whitepaper-detail', 'prod_id' => $arrWhitePaper['prod_id'], 'seo_keyword' => $arrWhitePaper['seo_keyword']]);
                }
            }
        }
        return $this->render('whitepaperDownload', ['whitePaper' => $arrWhitePaper,]);
    }

}
