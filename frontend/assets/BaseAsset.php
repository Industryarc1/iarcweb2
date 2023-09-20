<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

class BaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		//'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap',
		'css/google-css.css',
		'css/bootstrap.css',
		//'css/style.css',
		//'css/carousel.css',
		//'css/menu.css',
		//'css/responsive.css',
		'css/iarc-style.css',
    ];
    public $js = [
		/*'js/jquery.min.js',*/
		'js/bootstrap.min.js',
		'js/jquery.simpleLoadMore.js',
		//'js/menumaker.js',
		//'js/custom.js',
		'js/iarc-script.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
    ];
}
