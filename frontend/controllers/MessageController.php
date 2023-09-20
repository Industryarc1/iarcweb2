<?php

namespace frontend\controllers;

use Yii;

class MessageController extends IarcfbaseController {

    public function actionThanks() {
        $arrGet = Yii::$app->request->get();
        $ThanksId = !empty($arrGet) ? $arrGet['id'] : NULL;
        if (!empty($ThanksId)) {
            $sql = "SELECT inc_id,cat,subcat,title,code,short_descr,pub_date,image,curl,dup_inc_id FROM `zsp_posts` WHERE cat =(SELECT cat FROM `zsp_posts` WHERE dup_inc_id =$ThanksId) AND(LENGTH(TRIM(image)) > 0) ORDER BY pub_date DESC LIMIT 6";
            $arrRelated = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $this->render('thanks', [
                    'thanksId' => $ThanksId,
                    'arrRelated' => !empty($arrRelated) ? $arrRelated : [],
        ]);
    }

    public function actionBack() {
        return $this->goBack();
    }

}
