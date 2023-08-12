<?php
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));
header('cache-control: public, max-age=3600');

use yii\helpers\Url;
\Yii::$app->view->registerMetaTag(["name"=>"msvalidate.01","content"=>"DE600F24FF49B6EBC8694125E73A3244"]);
\Yii::$app->view->registerMetaTag(["name"=>"yandex-verification","content"=>"6e3eb9fd42d70768"]);
\Yii::$app->view->registerMetaTag(["name"=>"p:domain_verify","content"=>"e5c3783b009ad8b5dbb96c1d19e4453e"]);
//\Yii::$app->view->registerMetaTag(["name"=>"google-site-verification","content"=>"sAQE8bkPtffaWmD0EUw_0hGeg0qpPyZ7S0hh0IUnFg4"]);
/* $this->registerCssFile("https://www.industryarc.com/", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'rel' => 'alternate',
    'hreflang' => 'x-default',
]); */
$currentUrl = \Yii::$app->request->url;
if($currentUrl=="/"){
	$this->registerCssFile("https://www.industryarc.com", ['rel' => 'canonical',]);
}else{
	$this->registerCssFile("https://www.industryarc.com".$currentUrl, ['rel' => 'canonical',]);
}

/*
//Add the canonical tag for specific pages which is specified in $arrMatchKeys
$arrMatchKeys = [
	'/Research/','/Report/','/PressRelease/','/Article/',
	'/Webinar/','/WhitePaperDownload/','/pdfdownload.php',
	'/quotation.php',
];

foreach($arrMatchKeys as $key){
	if(strpos($currentUrl,$key)){
		$this->registerCssFile($currentUrl, ['rel' => 'canonical',]);
		break;
	}
}
 */
?>

<header class="header-main"><div class="home-header-rsp-white "></div>
  <!--<ul class="nav-small" >
    <marquee><li color="red">Limited time discount of $1,000 on all report purchases | Use code: FLAT1000</li></marquee>
  </ul>-->
  <ul class="nav-small rsp-hide">
	<!--<li><marquee><h5><b style="color:white;">Limited time discount of $1,000 on all report purchases | Use code:</b> <b style="color:yellow;">FLAT1000</b></h5></marquee></li>-->
    <li ><a href="https://www.industryarc.com/contact-us.php">Contact Us</a></li>
    <li><span><i class="call"></i>IND: (+91) 40-485-49062</span></li>
    <li><span><i class="call"></i>USA: +1 518 282 4727</span></li>
  </ul>
  <?php include('headerMenu.php')?>

</header>

<script type="application/ld+json">
{
"@context" : "http://schema.org",
"@type" : "Organization",
"name" : "IndustryARC",
"description" : "IndustryARC™ is the Leading Provider of Market Research Reports, Custom Consulting Services, Data Analytics and Industry Analysis",
"image" : "/images/Arc_logo.png",
"alternateName" : "IARC",
"telephone" : "(+1) 518 282 4727",
"email" : "sales@industryarc.com",
"address" : {
"@type" : "PostalAddress",
"streetAddress" : "LP Towers, 4th & 5th Floor, Plot No. 56",
"addressLocality" : "HUDA Techno Enclave, Madhapur",
"addressRegion" : "Hyderabad",
"addressCountry" : "India",
"postalCode" : "500081"
},
"url" : "https://www.industryarc.com/",
"sameAs" : [
"https://twitter.com/IndustryARC",
"https://www.instagram.com/industry_arc/",
"https://www.linkedin.com/company/industryarc",
"https://www.youtube.com/channel/UCtxnPs5dltk0UNyiQBkLqHQ"
]
}
</script>


