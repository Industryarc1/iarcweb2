<?php

use frontend\widgets\Contact\Contact;
use frontend\widgets\Newsletters;
use frontend\helper\CommonHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;

?>
<style>
    .imagescenter  img{ 
        display: block;
  margin-left: auto;
  margin-right: auto;
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
         "@id": "<?= Url::to(['news-article/list-article']) ?>",
         "name": "Articles"
       }
      },
      {
       "@type": "ListItem",
      "position": 3,
      "item":
       {
         "type":"WebPage",
         "@id": "<?= $_SERVER['REQUEST_URI'] ?>",
         "name": "<?= substr($article['meta_title'], strpos($article['meta_title'], '-') + 1) ?>"
       }
	  }
	]
  }
</script>

<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><a href="<?= Url::to(['news-article/list-article']) ?>">Articles</a></li>
            <!--<li><?= substr($article['meta_title'], strpos($article['meta_title'], '-') + 1) ?></li>-->
            <li><?= $article['meta_title'] ?></li>
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
               <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $_SERVER['HTTP_HOST'].Yii::$app->request->url;?>" target="_blank" rel="noopener"><img src="<?= Yii::$app->request->baseUrl ?>/images/linkedin.png" width="" height="" alt="Linkedin"></a>
               <a href="https://twitter.com/IndustryARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/twitter.png" width="" height="" alt="Twitter" target="_blank" rel="noopener"></a>
               <a href="https://in.pinterest.com/Industry_ARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/pinterest.png" width="" height="" alt="Pinterest" target="_blank" rel="noopener"></a>
           </span>
       </div>
   </div>
</div>
<div class="main-content article-full artcl-content">
    <div class="content-area">
        <div class="main-txt">
            <div class="clearfix">
                <div class="content-column ">
                    <?php
                    if ($article) {
                        $this->title = $article['meta_title'];
                        \Yii::$app->view->registerMetaTag(["name" => "title", "content" => $this->title]);
                        \Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => base64_decode($article['meta_keywords'])]);
                        \Yii::$app->view->registerMetaTag(["name" => "description", "content" => base64_decode($article['meta_descr'])]);
						
						\Yii::$app->view->registerMetaTag(["name" => "og:title", "content" => $this->title]);
						\Yii::$app->view->registerMetaTag(["name" => "og:type", "content" => "website"]);
						\Yii::$app->view->registerMetaTag(["name" => "og:description", "content" => base64_decode($article['meta_descr'])]);

						\Yii::$app->view->registerMetaTag(["name" => "twitter:card", "content" => "summary"]);
						\Yii::$app->view->registerMetaTag(["name" => "twitter:site", "content" => "@IndustryARC"]);
						\Yii::$app->view->registerMetaTag(["name" => "twitter:title", "content" => $this->title]);
						\Yii::$app->view->registerMetaTag(["name" => "twitter:description", "content" => base64_decode($article['meta_descr'])]);
						\Yii::$app->view->registerMetaTag(["name" => "twitter:image:alt", "content" => $this->title]);

                        $titleName = !empty($article['title']) ? $article['title'] : NULL;
                        $releaseDate = !empty($article['mnfctr']) ? date("d-M-Y", strtotime($article['mnfctr'])) : NULL;
                        $reportDesc = !empty($article['descr']) ? base64_decode($article['descr']) : NULL;
						/*$reportDesc = preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $reportDesc);
						$reportDesc = preg_replace('#style="[^"]*"#i','', $reportDesc);
						$reportDesc = preg_replace('#color="[^"]*"#i','', $reportDesc);
						$reportDesc = preg_replace('#size="[^"]*"#i','', $reportDesc);
						$reportDesc = preg_replace('#font="[^"]*"#i','', $reportDesc);
						$reportDesc = str_replace('class="MsoNormal"', '', $reportDesc);*/
                        ?>
                        <div class="basic-content">
                            <div class="article-title-info">
                                <div itemscope itemtype="https://schema.org/WebPage">
                                <h1 itemprop="name" class="headBanLHS" style="font-size: 25px;font-weight: bold;"><?= CommonHelper::sanitizeContent($titleName); ?></h1>
								</div>
                                <div class="article-by"> <span>Published By: IndustryARC</span> <span>Published On : <?= $releaseDate ?></span> </div>
                            </div>
                            <div class="article-content">
                                <p><?php echo $reportDesc; ?></p>
                            </div>
                        </div>
					<?php } ?>
                </div>
                <div class="contact-left">
                    <div class="left-contact">
                        <ul>
                            <!--<li><a href="javascript:void(0);" data-toggle="tooltip" title="+1614-588-8538" class="call">Call Us</a></li>-->
							<li><a href="https://connect.industryarc.com/" target="_blank" class="call">Schedule a Call</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
