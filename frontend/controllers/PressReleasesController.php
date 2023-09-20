<?php

namespace frontend\controllers;

use Yii;
use common\models\ZspPrs;
use common\models\ZspPrsQuery;
use yii\data\Pagination;
use frontend\controllers\IarcfbaseController;

class PressReleasesController extends IarcfbaseController {

public function actionIndex() {
        return $this->render('index');
    }

    public function actionListPress() {
        $arrGet = Yii::$app->request->get();
        $arrPressReleas = ZspPrsQuery::getListPress($arrGet);
        $objPressReleas = ZspPrsQuery::getListPress(array_merge(['asObj' => TRUE], $arrGet));
        $count = count($arrPressReleas);
        //creating the pagination object
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 3000]);
        //limit the query using the pagination and retrieve the users
        $models = $objPressReleas->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        //echo '<pre>'; print_r($models);exit;
        return $this->render('listPress', ['pressData' => $models, 'pagination' => $pagination]);
    }

    public function actionPressReport() {
        $arrPressReport = [];
        $urlParam = Yii::$app->request->get();
        $contactModel = new \frontend\models\ZspContact();
        if (!empty($urlParam['prod_id']) && !empty($urlParam['seo_keyword'])) {
            $arrPressReport = ZspPrs::find()
                            ->where([
                                'prod_id' => $urlParam['prod_id'],
                                'seo_keyword' => $urlParam['seo_keyword'],
                            ])
                            ->asArray()->one();
             if(!empty($arrPressReport['report_code'])){
                 $relatedReport = \common\models\ZspPosts::find()
                            ->where(['code' => $arrPressReport['report_code']])
                            ->andWhere(['status' => 1])
                            ->asArray()->one();
               }
            if (empty($arrPressReport)) {
                return $this->goHome();
            }
        }
        //echo '<pre>'; print_r($arrPressReport);exit;
        return $this->render('pressReport', [
                    'pressReport' => $arrPressReport,
                    'relatedReport' => $relatedReport,
                    'contactModel' => $contactModel]);
    }

    public function actionSampleForm() {
        
    }

}
