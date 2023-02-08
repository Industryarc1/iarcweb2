<?php
//use yii\helpers\Html;
use frontend\helper\CommonHelper;
use yii\helpers\Url;

$this->title = CommonHelper::sanitizeContent($reportDet['meta_title']);
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => $reportDet['meta_title']]);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => $reportDet['meta_keywords']]);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => $reportDet['meta_descr']]);

\Yii::$app->view->registerMetaTag(["name" => "og:title", "content" => $reportDet['meta_title']]);
\Yii::$app->view->registerMetaTag(["name" => "og:type", "content" => "website"]);
\Yii::$app->view->registerMetaTag(["name" => "og:description", "content" => $reportDet['meta_descr']]);

\Yii::$app->view->registerMetaTag(["name" => "twitter:card", "content" => "summary"]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:site", "content" => "@IndustryARC"]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:title", "content" => $reportDet['meta_title']]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:description", "content" => $reportDet['meta_descr']]);
\Yii::$app->view->registerMetaTag(["name" => "twitter:image:alt", "content" => $reportDet['meta_title']]);

$utmsrc = !empty($_GET['utm_source'])?$_GET['utm_source']:'';
$utmmed = !empty($_GET['utm_medium'])?$_GET['utm_medium']:'';
$utmcmp = !empty($_GET['utm_campaign'])?$_GET['utm_campaign']:'';	
$utmid = !empty($_GET['utm_id'])?$_GET['utm_id']:'';	
$utmterm = !empty($_GET['utm_term'])?$_GET['utm_term']:'';	
$utmcontent = !empty($_GET['utm_content'])?$_GET['utm_content']:'';	
//echo "<pre>";
//print_r($_GET);	
$utmParam = !empty($utmsrc)?'&utm_source='.$utmsrc.'&utm_medium='.$utmmed.'&utm_campaign='.$utmcmp.'&utm_id='.$utmid.'&utm_term='.$utmterm.'&utm_content='.$utmcontent.'':'';
?>
<style>
.close-category {
    top: inherit;
    bottom: 27%;

}

.reports-bg {
    margin-top: 20px;
    background: #f5f8fd;
}

.reports-header h3 {
  font-size: 26px;
  color: #413e66;
  text-align: center;
  font-weight: 700;
  position: relative;
  font-family: "Montserrat", sans-serif;
  margin-bottom: 30px;
}

.reports-header p {
  text-align: center;
  margin: auto;
  font-size: 15px;
  padding-bottom: 60px;
  color: #535074;
  width: 50%;
}

@media (max-width: 767px) {
  .reports-header p {
    width: 100%;
  }
}

#related-reports {
  padding: 40px 0 40px 0;
}

#related-reports .box {
  padding: 30px;
  position: relative;
  overflow: hidden;
  border-radius: 10px;
  margin: 0 10px 20px 10px;
  background: #fff;
  box-shadow: 0 10px 29px 0 rgba(68, 88, 144, 0.1);
  transition: all 0.3s ease-in-out;
  text-align: center;
  display: flex;
}
 
#related-reports .icon {
  margin: 0 auto 15px auto;
  padding-top: 12px;
  display: inline-block;
  text-align: center;
  border-radius: 50%;
  width: 60px;
  height: 60px;
}

#related-reports .icon .service-icon {
  font-size: 36px;
  line-height: 1;
}

#related-reports .title {
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 18px;
}

#related-reports .title a {
  color: #111;
}

#related-reports .box:hover .title a {
  color: #c59c35;
}
#related-reports .box:hover .title a:hover {
  text-decoration: none;
}
#related-reports .description {
  font-size: 14px;
    width: 70%;
    border-right: 1px solid #ccc;
    margin-right: 10px;
    margin-left: 10px;
    text-align: left;
   
}
.align{
   margin-bottom: 0.5rem !important;
}

.btn-style {
    color: #fff;
    background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
</style>

<?php
	$title = substr($reportDet['title'],0,strpos(strtolower($reportDet['title']),':'));
	if($reportDet['code']!='HCR 0091'){
		$title = (strlen($title)>0) ? $title.' - Forecast('.date('Y').' - '.date('Y', strtotime('+5 year')).')' : CommonHelper::sanitizeContent($reportDet['title']);
	}else{
		$title = (strlen($title)>0) ? $title.' - Forecast(2016 - 2022)': CommonHelper::sanitizeContent($reportDet['title']);
	}
?>

<script>
//window.onload = function () {
//    window.scrollTo(0,215);
//};
</script>

<script>
function windowprint(reportrd){
	alert(reportr);
 my_text = reportrd;
 newWin= window.open();
 newWin.document.write(my_text);
 newWin.document.close();
 newWin.focus();
 newWin.print();
 newWin.close();
}
</script>

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
	     "@id": "<?= Yii::$app->request->baseUrl ?>/Domain/<?= $reportDet['brport']['code'] . '/' . $reportDet['brport']['seo_keyword'] ?>",
         "name": "<?= (string)$reportDet['brport']['name'] ?>"
       }
      },
      {
       "@type": "ListItem",
      "position": 3,
      "item":
       {
         "type":"WebPage",
         "@id": "<?= $_SERVER['REQUEST_URI'] ?>",
         "name": "<?= CommonHelper::sanitizeContent($reportDet['cbreadcrumb']); ?>"
       }
	  }
	]
  }
</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Report",
  "mainEntityOfPage": {
   "@type": "WebPage",
    "@id": "https://www.industryarc.com<?= $_SERVER['REQUEST_URI'] ?>"
  },
  "headline": "<?= $title;?>",
   "copyrightHolder" :{
    "@type": "Organization",
    "name": "IndustryARC"
    },
  "publisher": {
    "@type": "Organization",
    "name": "IndustryARC"
  },
  "description": "<?= $reportDet['meta_descr'] ?>"
}
</script>

<div class="row child-nav">
    <div class="breadcrumb col-8 ">		
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><a href="<?= Yii::$app->request->baseUrl ?>/Domain/<?= $reportDet['brport']['code'] . '/' . $reportDet['brport']['seo_keyword'] ?>"><?= $reportDet['brport']['name'] ?></a></li>
            <li><?= CommonHelper::sanitizeContent($reportDet['cbreadcrumb']); ?></li>
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

<div class="main-content">

  <div class="content-area">

    <div class="content-box">
              <div class="report-title" id="report" itemscope itemtype="https://schema.org/WebPage">  				
                  <!--<p><?= CommonHelper::sanitizeContent($reportDet['title']) ?></p>-->
                  <h1 itemprop="name" class="headBanLHS"><p><?= $title;?></p>  </h1>
              </div>
              <div class="row">
                  <div class="report-info-bottom col-6">
                      <span class="r-code">Report Code: <?= $reportDet['code'] ?></span>
                      <span class="r-format">Report Format: PDF + Excel</span>
                  </div>
                  <div class="buy-licence col-6">
                      <div class="licence-content">
                          <ul>
                              <li>
                                  <label>
                                      <input type="radio" name="licence" class="filled-in" checked>
                                      $ <?= $reportDet['slp'] ?> <span title="Premium Section Included in Corporate License only">Single User License ?</span>
                                  </label>
                              </li>
                              <li>
                                  <label>
                                      <input type="radio" name="licence" class="filled-in" >
                                      $ <?= $reportDet['clp'] ?> <span title="Premium Section Included in Corporate License only">Corporate User License ?</span>
                                  </label>
                              </li>
							  <!--<li>
                                  <label>
                                      <input type="radio" name="licence" class="filled-in" >
                                      $ 7250 <span title="Premium Section Included in Corporate License only">Enterprise License ?</span>
                                  </label>
                              </li>-->
                          </ul>
						  <?php if($utmParam!=''){ ?>
							<!--<a href="<?= Url::to(['purchase/buy-report','id'=>$reportDet['dup_inc_id'].$utmParam])?>"><button>Buy Now</button></a>-->
							<a href="https://www.industryarc.com/purchasereport.php?id=<?php echo $reportDet['dup_inc_id'].$utmParam; ?>"><button>Buy Now</button></a>
						  <?php }else{ ?>
							<a href="<?= Url::to(['purchase/buy-report','id'=>$reportDet['dup_inc_id']])?>"><button>Buy Now</button></a>
						  <?php } ?>
                      </div>
                  </div>
              </div>

          </div>
    <div class="main-txt">
      <div class="row">
        <div class="left-column rsp-hide" id="leftNav">
        	<?php
        				if(strlen($reportDet['description'])>20){
        					$rdActive = "active";
        					$rdinactive ="in active";
             $tblActive = "";
             $tblinactive = "";
        				}else{
        					$tblActive = "active";
        					$tblinactive="in active";
        					$rdActive = "";
              $rdinactive="";
        				}
        			?>
          <div class="report-content-nav report-scroll brdr-right">
            <ul>
            <?php if(strlen($reportDet['description'])>20) { ?>
              <li class="report-disc"><a href="#" class="<?php echo $rdActive; ?>"  data-scroll="report1">Report Description</a></li>
              <?php } ?>
              <li class="tbl-cnt"><a href="#" class="<?php echo $tblActive; ?>" data-scroll="report2">Table of Contents</a></li>
	     <?php if(strlen($reportDet['taf'])>30 || strlen($reportDet['taf_new'])>30) { ?>
              <li class="tof"><a href="#"  data-scroll="report3">Tables and Figures</a></li>
	     <?php } ?>
            </ul>
          </div>
          <div class="left-contact">
            <ul>
              <!--<li><a href="<?= Url::to(['reports/request-quote','id'=>$reportDet['dup_inc_id']]);?>" target="_blank" class="quote">Inquiry Before Buying</a></li>-->
			  <?php if($utmParam!=''){ ?>
			  <li><a href="https://www.industryarc.com/reports/request-quote?id=<?= $reportDet['dup_inc_id'].$utmParam; ?>" target="_blank" class="quote">Inquiry Before Buying</a></li>
			  <li><a href="https://www.industryarc.com/pdfdownload.php?id=<?= $reportDet['dup_inc_id'].$utmParam;?>" target="_blank" class="data">Request Sample </a></li>
			  <?php }else{ ?>
			  <li><a href="https://www.industryarc.com/reports/request-quote?id=<?= $reportDet['dup_inc_id']; ?>" target="_blank" class="quote">Inquiry Before Buying</a></li>
			  <li><a href="https://www.industryarc.com/pdfdownload.php?id=<?= $reportDet['dup_inc_id'];?>" target="_blank" class="data">Request Sample </a></li>
			  <?php } ?>
              <!--<li><a href="<?= Url::to(['reports/sample-request','id'=>$reportDet['dup_inc_id']]);?>" target="_blank" class="data">Request Sample </a></li>-->
              <li><a href="https://connect.industryarc.com/lite/schedule-a-call-with-our-sales-expert" target="_blank" class="call">Schedule a Call</a>
				  <!-- Zoom.ai inline embed script begin -->
<!--<div class="zoomai-slideout-widget-url" data-url="https://meeting.zoom.ai/meeting/new/5fb78f7a1ad3c90020be5515/meeting"></div>
<script type="text/javascript" src="https://app.zoom.ai/assets/widget.js"></script>-->
<!-- Zoom.ai inline embed script end --></li>
            </ul>
          </div>
        </div>
        <div class="content-column">
            <div class="report-content" >
                  <?php if(strlen($reportDet['description'])>20) { ?>
                <section id="report1" data-anchor="report1" class="report-data-description">
                    <div class="report-description">
                        <?= CommonHelper::modifyContent(base64_decode($reportDet['description'])); ?>
                    </div>
                </section>
                <?php } ?>
                <section id="report2" data-anchor="report2" class="report-data-toc">
                    <div>
                        <?php
                        $strTOC = CommonHelper::modifyContent(base64_decode($reportDet['table_of_content']));
                        $keyword1 = "Startup companies Scenario";
                        $keyword2 = "Market Entry Scenario";
                        $keyword3 = "Competition landscape";
                        $keyword4 = "Company List by Country";
                        $keyword5 = "-Methodology";
                        $newToc = $strTOC;
                        $premium = ' <span style="background-color:#337ab7;color:#FFFFFF;" class="badge badge-success" title="Premium Section Included in Corporate License only"> Premium</span>';

                        if (strpos($newToc, $keyword1)) {
                            $pos = strpos($newToc, $keyword1) + strlen($keyword1);
                            $newToc = substr_replace($newToc, $premium, $pos, 0);
                        }
                        if (strpos($newToc, $keyword2)) {
                            $pos = strpos($newToc, $keyword2) + strlen($keyword2);
                            $newToc = substr_replace($newToc, $premium, $pos, 0);
                        }
                        if (strpos($newToc, $keyword3)) {
                            $pos = strpos($newToc, $keyword3) + strlen($keyword3);
                            $newToc = substr_replace($newToc, $premium, $pos, 0);
                        }
                        if (strpos($newToc, $keyword4)) {
                            $pos = strpos($newToc, $keyword4) + strlen($keyword4);
                            $newToc = substr_replace($newToc, $premium, $pos, 0);
                        }
                        if (strpos($newToc, $keyword5)) {
                            $pos = strpos($newToc, $keyword5) + strlen($keyword5);
                            $newToc = substr_replace($newToc, $premium, $pos, 0);
                        }
                        echo $newToc;
                        ?>
                    </div>
                </section>
				
				<?php if ($reportDet['dup_inc_id'] >= 500000 && $reportDet['dup_inc_id'] < 700000) { ?>
                                <?php //if (strlen($reportDet['taf_new']) > 30) { ?>
									<section id="report3" data-anchor="report3">
										<div  class="report-data-tf" >
											<div>
											<?= CommonHelper::modifyContent(base64_decode($reportDet['taf_new'])); ?>
											</div>
										</div>
									</section>
								<?php //} else { ?>
									<!--<section id="report3" data-anchor="report3">
										<div  class="report-data-tf" >
											<div>
												<?php
												$tafTitle = substr($reportDet['title'], 0, strpos(strtolower($reportDet['title']), 'market'));
												$lotLofLink = Url::to(['reports/sample-request', 'id' => $reportDet['dup_inc_id']]);
												echo Yii::$app->controller->renderPartial('lotLof', [
													'title' => $tafTitle,
													'hyperLink' => $lotLofLink,
												]);
												?>
											</div>
										</div>
									</section>-->
								<?php //} ?>
                            <?php } else { ?>
								<?php if (strlen($reportDet['taf']) > 30) { ?>
								<section id="report3" data-anchor="report3">
									<div  class="report-data-tf" >
										<div>
								<?= CommonHelper::modifyContent(base64_decode($reportDet['taf'])); ?>
										</div>
									</div>
								</section>
								<?php } ?>
							<?php } ?>

                <!--<section id="report3" data-anchor="report3">
                    <div  class="report-data-tf" >
                            <?php //if ($reportDet['dup_inc_id'] >= 500000) { ?>
                                <?php //if (strlen($reportDet['taf_new']) > 30) { ?>
                                <div>
                                <?= CommonHelper::modifyContent(base64_decode($reportDet['taf_new'])); ?>
                                </div>
                                <?php //} else { ?>
                                <div>
                                    <?php
                                    /* $tafTitle = substr($reportDet['title'], 0, strpos(strtolower($reportDet['title']), 'market'));
                                    $lotLofLink = Url::to(['reports/sample-request', 'id' => $reportDet['dup_inc_id']]);
                                    echo Yii::$app->controller->renderPartial('lotLof', [
                                        'title' => $tafTitle,
                                        'hyperLink' => $lotLofLink,
                                    ]); */
                                    ?>
                                </div>
                                <?php //} ?>
                            <?php //} else { ?>
                            <div>
                            <?= CommonHelper::modifyContent(base64_decode($reportDet['taf'])); ?>
                            </div>
                            <?php //} ?>
                    </div>
                </section>-->

                <!--<section id="report3" data-anchor="report3">
                    <div  class="report-data-tf" >
<h3>Related Reports</h3>
</div>
</section>-->


<?php
/*echo "<pre>";
print_r($relatedReport);
echo "</pre>";
*/
if(count($relatedReport) > 0){
?>
<section class="reports reports-bg" id="related-reports">
         <div class="container">
            <header class="reports-header">
               <h3>Related Reports</h3>
            </header>
            <div class="row">
               <?php
               $vrr = count($relatedReport);
               $vrr = $vrr%2!=0 && $vrr!=1 ? $vrr-1 : $vrr;

               foreach ($relatedReport as $key => $rr) {
                if($vrr>$key){
               ?>
                <div class="col-md-6 col-lg-6">
                  <div class="box">
                     <p class="description"><a href="/<?= $rr['curl']?>" target="_blank"><?= $rr["title"]?></a></p>
                     <div>
                        <p class="align"><?= $rr["pub_date_new"]?></p>
                        <a href="/pdfdownload.php?id=<?= $rr['dup_inc_id'];?>" target="_blank" class="btn btn-primary btn-sm btn-style">Get Sample</a>
                     </div>
                  </div>
               </div>
               <?php
                }
               }
               ?>                 
            </div>
         </div>
      </section>
<?php
}
?>


				
				
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!--- responsive model pop scroll up -->
<div class="report-content-nav-rsp rsp-content report-scroll">
    <ul>
     <?php if(strlen($reportDet['description'])>20) { ?>
       <li class="report-disc"><a href="#"  data-scroll="report1">Report Description</a></li>
     <?php } ?>
      <li class="tbl-cnt"><a href="#" data-scroll="report2">Table of Contents</a></li>
	<?php if(strlen($reportDet['taf'])>30 || strlen($reportDet['taf_new'])>30) { ?>
      <li class="tof"><a href="#" data-scroll="report3">Tables and Figures</a></li>
	<?php } ?>
    </ul>
 </div>
    <div class="rsp-bottom-nav rsp-content">
    <div class="report-content-nav">
    <a href="#" class="report report-pr-slideup">Report Options</a>
    <a href="<?= Url::to(['reports/sample-request','id'=>$reportDet['dup_inc_id']]);?>" class="data">Request Sample <span class="rsp-hide">Data</span></a>
     </div>
    </div>
  <div class="fadeeffect"></div>
  <a href="javasript:void();" class="rsp-content close-category ">x</a>
