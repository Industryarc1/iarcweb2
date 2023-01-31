<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Iarcfbase controller
 * Iarcfbase here ment for IARC Frontend Base controller
 * @Description: This controller will be main(parent) controller 
 * for all the controller which will be created for front-end website
 * @Use: if you want to perform some action, restrictions ,base setting changes etc... you can do it from this controller
 *  as this will be the parent controller for all the front-end websites
 */
class IarcfbaseController extends Controller
{

    public function actionIndex()
    {
		// $db = Yii::$app->getDb();
		// echo '<pre>';print_r($db);exit;
		echo '<h3>You are in </h3>'.__FILE__;
    }




}
