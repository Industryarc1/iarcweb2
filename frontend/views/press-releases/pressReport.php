<?php

use frontend\widgets\Contact\Contact;
use frontend\widgets\Newsletters;
use frontend\helper\CommonHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>

<style>
.close-category {
    top: inherit;
    bottom: 27%;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script type="application/ld+json">
    {
     "@context": "http://schema.org",
     "@type": "BreadcrumbList",
     "itemListElement":
     [
      {
       "@type": "ListItem",
       "position": 1,
       "item":
       {
        "type":"Website",
        "@id": "/",
        "name": "Home"
        }
      },
      {
       "@type": "ListItem",
      "position": 2,
      "item":
       {
         "type":"WebPage",
         "@id": "<?= Url::to(['press-releases/list-press']) ?>",
         "name": "Press Releases"
       }
      },
      {
       "@type": "ListItem",
      "position": 3,
      "item":
       {
         "type":"WebPage",
         "@id": "<?= $_SERVER['REQUEST_URI'] ?>",
         "name": "<?= substr($pressReport['title'], 0, strpos(strtolower($pressReport['title']), 'market') + 6) ?>"
       }
	  }
	]
  }
</script>

<div class="row child-nav">
   <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><a href="<?= Url::to(['press-releases/list-press']) ?>">Press Releases</a></li>
            <!--<li><?= substr($pressReport['title'], 0, strpos(strtolower($pressReport['title']), 'market') + 6) ?></li>-->
			<li><?= str_replace("-"," ",ucwords($pressReport['seo_keyword'])) ?></li>
        </ul>
    </div>
    <div class="page-actions col-4 rsp-hide">
        <ul>
            <li><a href="mailto:<?=\Yii::$app->params['salesEmail']?>?subject=Share-<?=$this->title;?>&body=<?= $_SERVER['HTTP_HOST'].Yii::$app->request->url;?>">
            <img src="<?= Yii::$app->request->baseUrl ?>/images/mail.png" width="" height="" alt="Email"> Email</a></li>
            <li><a href="javascript:void(0);" onclick="window.print()"><img src="<?= Yii::$app->request->baseUrl ?>/images/printer.png" width="" height="" alt="Print"> Print</a></li>
        </ul>
        <div class="share">
            <p>Share</p>
            <span class="hover-options">
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $_SERVER['HTTP_HOST'].Yii::$app->request->url;?>" target='_blank'><img src="<?= Yii::$app->request->baseUrl ?>/images/linkedin.png" width="" height="" alt="Linkedin"></a>
                <a href="https://twitter.com/IndustryARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/twitter.png" width="" height="" alt="Twitter"></a>
                <a href="https://in.pinterest.com/Industry_ARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/pinterest.png" width="" height="" alt="Pinterest"></a>
            </span>
        </div>
    </div>
</div>
<?php
if ($pressReport) {
    $this->title = $pressReport['meta_title'];
    \Yii::$app->view->registerMetaTag(["name" => "title", "content" => $this->title]);
    \Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => base64_decode($pressReport['meta_keywords'])]);
    \Yii::$app->view->registerMetaTag(["name" => "description", "content" => base64_decode($pressReport['meta_descr'])]);
	
	\Yii::$app->view->registerMetaTag(["name" => "og:title", "content" => $this->title]);
	\Yii::$app->view->registerMetaTag(["name" => "og:type", "content" => "website"]);
	\Yii::$app->view->registerMetaTag(["name" => "og:description", "content" => base64_decode($pressReport['meta_descr'])]);

	\Yii::$app->view->registerMetaTag(["name" => "twitter:card", "content" => "summary"]);
	\Yii::$app->view->registerMetaTag(["name" => "twitter:site", "content" => "@IndustryARC"]);
	\Yii::$app->view->registerMetaTag(["name" => "twitter:title", "content" => $this->title]);
	\Yii::$app->view->registerMetaTag(["name" => "twitter:description", "content" => base64_decode($pressReport['meta_descr'])]);
	\Yii::$app->view->registerMetaTag(["name" => "twitter:image:alt", "content" => $this->title]);
	
    $titleName = !empty($pressReport['title']) ? $pressReport['title'] : NULL;
    $releaseDate = !empty($pressReport['mnfctr']) ? date("d-M-Y", strtotime($pressReport['mnfctr'])) : NULL;
    $reportDesc = !empty($pressReport['descr']) ? base64_decode($pressReport['descr']) : NULL;
   // $viewReport = !empty($pressReport['related_report']) ? $pressReport['related_report'] : 'javascript:void(0)';
    $requestQuote = ($_SERVER['HTTP_HOST'] != 'localhost') ? Url::to('https://www.industryarc.com/reports/request-quote?id=' . $relatedReport['dup_inc_id']) : Url::to(['reports/request-quote', 'id' => $relatedReport['dup_inc_id']]);
    if ($relatedReport['dup_inc_id'] < 500000) {
    								$viewReport = Url::to(['Report/' . $relatedReport['dup_inc_id'] . '/' . $relatedReport['curl']]);
    							} else {
    								$viewReport = Url::to(['Research/' . $relatedReport['curl'] . '-' . $relatedReport['dup_inc_id']]);
    							}
    ?>
    <div class="pr-title-banner p-relative">
        <div class="pr-banner-overlay">
            <div class="pr-top-bar">
				<div itemscope itemtype="https://schema.org/WebPage">
                <h1 itemprop="name" class="headBanLHS"><?= CommonHelper::sanitizeContent($titleName); ?></h1>
				</div>
                <div class="pr-info-small"> <span class="r-format"> Published On : <?= $releaseDate ?> </span></div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="content-area">
            <div class="main-txt">
                <div class="row">
                    <div class="left-column rsp-hide" id="leftNav">
                       <div class="report-content-nav report-scroll brdr-right">
                            <ul>
                                <li class="report-disc"><a href="#" class="active"  data-scroll="report1">Report Description</a></li>
                                <li class="tbl-cnt"><a href="<?= $viewReport; ?>" data-scroll="report2">Table of Contents</a></li>
                                <li class="tof"><a href="<?= $viewReport; ?>" data-scroll="report3">Tables and Figures</a></li>
                            </ul>
                        </div>
                        <div class="left-contact mar-top-100">
                            <ul>
                                <li><a href="<?= $requestQuote; ?>" class="data">Request Sample </a></li>
                                <!--<li><a href="javascript:void(0);" data-toggle="tooltip" title="+1614-588-8538" class="call">Call Us</a></li>-->
								<li><a href="https://connect.industryarc.com/" target="_blank" class="call">Schedule a Call</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pr-main-content p-relative">
                        <div class="report-content bg-white" >
                            <section id="report1" data-anchor="report1" class="">
                                <div><p><?php echo $reportDesc; ?></p>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
?>
<!--- responsive model pop scroll up -->
<div class="report-content-nav-rsp rsp-content report-scroll">
      <ul>
          <li class="report-disc"><a href="#" data-scroll="report1">Report Description</a></li>
          <li class="tbl-cnt"><a href="<?= $viewReport; ?>" data-scroll="report2">Table of Contents</a></li>
          <li class="tof"><a href="<?= $viewReport; ?>" data-scroll="report3">Tables and Figures</a></li>
      </ul>
  </div>
   <div class="rsp-bottom-nav rsp-content">
     <div class="report-content-nav">
          <a href="#" class="report report-pr-slideup">Report Options</a>
          <a href="#" class="data">Request Sample <span class="rsp-hide">Data</span></a>
      </div>
  </div>
  <div class="fadeeffect"></div>
  <a href="javasript:void();" class="rsp-content close-category ">x</a>
