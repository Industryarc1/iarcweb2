<?php
namespace frontend\helper;
use Yii;
use yii\helpers\Url;

class PurchaseHelper{
	public static function generateCode($charLength){
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $charLength) { 
		  $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		  $i++;
		}
		return $code;
	}
	
}
?>