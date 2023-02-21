<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

.myaccordion {
  /*max-width: 800px;*/
  /*margin: 50px auto;*/
  box-shadow: 0 0 1px rgba(0,0,0,0.1);
}

.myaccordion .card,
.myaccordion .card:last-child .card-header {
  border: none;
}

.myaccordion .card .card-body{
    padding: 10px;
    color: #000;
}

.myaccordion .card-header {
  border-bottom-color: #dddddd;
  background: #f5f5f5;
  color: #0e5ca3;
}

.myaccordion .fa-stack {
  font-size: 12px;
}

.myaccordion .btn {
  width: 100%;
  font-weight: bold;
  color: #0e5ca3;
  padding: 0;
}

.myaccordion .btn-link:hover,
.myaccordion .btn-link:focus {
  text-decoration: none;
}

.myaccordion li + li {
  margin-top: 10px;
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

#related-reports .description a {
 color:#000 !important;
}
#related-reports .description a:hover{
 text-decoration: underline;
 color: #1d559a !important;
}

/*
#related-reports .title a {
  color: #111;
}

#related-reports .box:hover .title a {
  color: #c59c35;
}
#related-reports .box:hover .title a:hover {
  text-decoration: none;
}*/
#related-reports .description {
    font-size: 18px;
    width: 70%;
    /*line-height: 50px;*/
    border-right: 1px solid #ccc;
    margin-right: 18px;
    margin-left: 0px;
    margin-bottom: 0px;
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
.modal-dialog {
max-width: 100%;
top: 0%;
}
@media (min-width: 576px) {
.modal-dialog {
max-width: 530px;
}
.modal-dialog .modal-content {
padding: 1rem;
}
}
.modal-header .close {
margin-top: -1.5rem;
}.form-title {
margin: -2rem 0rem 2rem;
}.btn-round {
border-radius: 3rem;
}.delimiter {
padding: 1rem;
}.signup-section {
padding: 0.3rem 0rem;
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
							<a href="/purchasereport.php?id=<?php echo $reportDet['dup_inc_id'].$utmParam; ?>"><button>Buy Now</button></a>
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
              <li class="faqs"><a href="#"  data-scroll="report4">FAQ'S</a></li>
            </ul>
          </div>
          <div class="left-contact">
            <ul>
              <!--<li><a href="<?= Url::to(['reports/request-quote','id'=>$reportDet['dup_inc_id']]);?>" target="_blank" class="quote">Inquiry Before Buying</a></li>-->
			  <?php if($utmParam!=''){ ?>
			  <li><a href="/reports/request-quote?id=<?= $reportDet['dup_inc_id'].$utmParam; ?>" target="_blank" class="quote">Inquiry Before Buying</a></li>
			  <li><a href="/pdfdownload.php?id=<?= $reportDet['dup_inc_id'].$utmParam;?>" target="_blank" class="data">Request Sample </a></li>
			  <?php }else{ ?>
			  <li><a href="/reports/request-quote?id=<?= $reportDet['dup_inc_id']; ?>" target="_blank" class="quote">Inquiry Before Buying</a></li>
			  <li><a href="/pdfdownload.php?id=<?= $reportDet['dup_inc_id'];?>" target="_blank" class="data">Request Sample </a></li>
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

                <section id="report4" data-anchor="report4" class="report-data-faqs">
                    
                    <div id="accordion" class="myaccordion">
                    
                      <?php
                      if(isset($faqs)){
                    
                      
                        foreach ($faqs as $key => $k) {
                            $keyv = ++$key;
                            $expand = $keyv == 1 ? "true" : "false";
                            $shownow = $keyv == 1 ? "show" : "";
                            $buttonview = $keyv == 1 ? "fa-minus" : "fa-plus";
                      ?>
                      <div class="card">
                        <div class="card-header" id="heading<?= $key?>">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?= $key?>" aria-expanded="<?= $expand?>" aria-controls="collapse<?= $key?>"><?= $k["question"]?>
                              <span class="fa-stack fa-sm">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas <?= $buttonview?> fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapse<?= $key?>" class="collapse <?= $shownow?>" aria-labelledby="heading<?= $key?>" data-parent="#accordion">
                          <div class="card-body">
                            <p><?= $k["answer"]?></p>
                          </div>
                        </div>
                      </div>
                      <?php  
                      }
                      }      
                      ?>  
                    </div>
                    
                  </section>

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
       <li class="tof"><a href="#"  data-scroll="report4">FAQ'S</a></li> 
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

<script type="text/javascript">
$(document).ready(function() {
$("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
  $(e.target).
  prev().
  find("i:last-child").
  toggleClass("fa-minus fa-plus");
});


});
</script>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [<?php
if(isset($faqs)){
$cval = count($faqs);
foreach ($faqs as $key => $q) {
++$key;
?>
{
    "@type": "Question",
    "name": "<?= $q['question']?>",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "<?= $q['answer']?>"
    }
}<?php if($key < $cval){?>,
<?php
}
}
}
?>
]
}
</script>

<div class="modal fade" id="notiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background:url('/images/popup_bg2.jpg');background-size:cover;border:none">
      <div class="modal-header border-bottom-0">
        <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <div class="form-title">
          <h4>Not finding what you need?</h4>
          <p style="font-size:12px">Let us help with our market insights.</p>
        </div>
        <div class="d-flex flex-row">
          <form class="d-flex flex-column ">
          
            <a href="https://connect.industryarc.com/lite/schedule-a-call-with-our-sales-expert" target="_blank" class="btn btn-primary btn-block btn-round">Speak to Analyst</a>
            <a href="/pdfdownload.php?id=<?= $reportDet['dup_inc_id'];?>" target="_blank" class="btn btn-primary btn-block btn-round">Request a Sample PDF</a>
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function() {             
setTimeout( function(){ 
$('#notiModal').modal('show');
  }  , 10000 );
});

</script>
