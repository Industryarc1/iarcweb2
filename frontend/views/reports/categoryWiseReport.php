<?php
ini_set('memory_limit', '-1');

use frontend\helper\CommonHelper;
use frontend\widgets\Contact\Contact;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = !empty($categoryDet['title']) ? CommonHelper::sanitizeContent($categoryDet['title']) : 'IndustryARC�';
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => $this->title]);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => base64_decode($categoryDet['keywords'])]);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => $categoryDet['meta_desc']]);
$currentUrl = Yii::$app->request->url;
if (strpos($currentUrl, 'page=')) {
    \Yii::$app->view->registerMetaTag(["name" => "ROBOTS", "content" => "NOINDEX, NOFOLLOW"]);
}
//echo '<pre>'; print_r($pagination);exit;

\Yii::$app->view->registerMetaTag(["name" => "og:title", "content" => $this->title]);
\Yii::$app->view->registerMetaTag(["name" => "og:type", "content" => "website"]);
\Yii::$app->view->registerMetaTag(["name" => "og:description", "content" => $categoryDet['meta_desc']]);

\Yii::$app->view->registerMetaTag(["name" => "twitter:card", "content" => "summary"]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:site", "content" => "@IndustryARC"]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:title", "content" => $this->title]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:description", "content" => $categoryDet['meta_desc']]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:image:alt", "content" => $this->title]);

?>
<style>
.load-more__btn{
    margin: 5px 0;
    display: inline-block;
    background: white;
    width:100%;
    color:#0e5ca3;
    text-align:center;
    font-size:16px;
    padding: 6px 10px;
    font-weight:600;
    border-radius: 10px;
}
</style>

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
         "@id": "<?= $_SERVER['REQUEST_URI'] ?>",
         "name": "<?= CommonHelper::sanitizeContent($categoryDet['name']) ?>"
       }
      }
	]
  }
</script>

<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><?= CommonHelper::sanitizeContent($categoryDet['name']) ?></li>
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
<!--  social icons and breadcrums -->
<div class="main-content report-category">
    <div class="content-area">
        <div class="content-box">
            <div class="report-title" id="report">
                <div class="row">
                    <div class="img rsp-hide">
						<?php
							$imageFile = dirname(dirname(__DIR__)).'/web/images/reportDomainImg/'.$categoryDet['name'].'.jpg';
							$domainImg = (file_exists($imageFile))? $categoryDet['name'].'.jpg': "Agriculture.jpg";
						?>
						<img src="<?= Yii::$app->request->baseUrl ?>/images/reportDomainImg/<?=$domainImg;?>" alt="Market Research and Consulting Services">
					</div>
                    <div class="f-left p-relative">
						<div itemscope itemtype="https://schema.org/WebPage">
                        <h1 itemprop="name" class="headBanLHS"><?= CommonHelper::sanitizeContent($categoryDet['name']) ?> Market Research and Consulting Services</h1></div>
                        <?php if ($categoryDet['descr'] != "PGJyPg==") { ?>
                            <a href="#"  data-toggle="modal" data-target="#ReadMore" class="readmore rsp-hide">Read More</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-main">
            <div class="row">
                <div class="caterogy-list">
                    <h2>Categories</h2>
                    <div class="panel panel-info">
                        <?php
                        $arrCategories = CommonHelper::reportMenu();

                        foreach ($arrCategories as $category) {
                            $isChildExist = !empty($category['children']) ? $category['children'] : [];
                            $urlcat = Url::to(['Domain/' . $category['code'] . '/' . $category['seo_keyword']]);
                            ?>
                            <div class="panel-heading collapsed" data-toggle="collapse" data-target="#<?= preg_replace('/\s+/', '_', $category['name']); ?>"><?= $category['name'] ?></div>
                            <div class="panel-body">
                                <?php if ($isChildExist) { ?>
                                    <div class="collapse" id="<?= preg_replace('/\s+/', '_', $category['name']); ?>"> 
                                        <ul>
                                            <?php
                                            foreach ($category['children'] as $childCat) {
                                                $urlsubcat = Url::to(['Domain/' . $childCat['code'] . '/' . $childCat['seo_keyword']]);
                                                ?>
                                                <li><a href="<?= $urlsubcat ?>"><?= CommonHelper::sanitizeContent($childCat['name']) ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } ?>

                    </div>
                </div>

                <div class="category-item-container some-list-report" id="report">
                    <ul>
                        <?php
                        foreach ($models as $report) {
							if ($report['dup_inc_id'] < 500000) {
								$reportUrl = Url::to(['Report/' . $report['dup_inc_id'] . '/' . $report['curl']]);
							} else {
								$reportUrl = Url::to(['Research/' . $report['curl'] . '-' . $report['dup_inc_id']]);
							}
							//$reportUrl = Url::to(['market-research/' . $report['curl']]);
                            ?>
                            <li>
                                <div class="report-list-item">
                                    <div class="report-info-left">
                                        <div class="report-title"><a href="<?= $reportUrl ?>"><?= CommonHelper::sanitizeContent($report['title']) ?></a></div>
                                        <p class="report-by">By : IndustryARC</p>
                                        <b><a href="<?= $reportUrl ?>">Read More >></a></b>
                                    </div>
                                    <div class="report-info-right p-relative">
                                        <div class="p-relative">
											<div class="rp-price rsp-hide">$ <?=$report['slp']?></div>
                                                <div class="report-code">
													<b>Report Code:</b><span class="d-block"> <?= $report['code']; ?></span>
                                                </div>

                                                <button onclick="location.href = '<?= $reportUrl ?>'">Download Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                   <!-- <div class="row text-center">
                        <?php
                        // display pagination
                        echo LinkPager::widget([
                            'pagination' => $pagination,
                            'maxButtonCount' => 5,
                            'firstPageLabel' => '<< First ',
                            'lastPageLabel' => '  LAST >>'
                        ]);
                        ?>
                    </div>-->
                </div>


            </div>
        </div>
    </div>
</div>

<div class="rsp-content select-category"><a href="#">Categories</a></div>
<div class="fadeeffect"></div>
<a href="#" class="rsp-content close-category ">x</a>


<div id="ReadMore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body ">
                <div class="category-readmore" >
                    <?= base64_decode($categoryDet['descr']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
