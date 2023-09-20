<?php
namespace frontend\widgets\Contact;
use yii\base\Widget;
use frontend\models\ZspContact;
use Yii;

class Contact extends Widget{
	
    public function run()
    { 
	$controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;

        $contactModel = new ZspContact();
        if ($contactModel->load(Yii::$app->request->post()) && $contactModel->validate()){
			if ($contactModel->contact(Yii::$app->params['adminEmail'])){
                Yii::$app->session->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
            }else{
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        }
       return $this->render('contact',['contactModel'=>$contactModel]);
    }
}
?>