<?php
use yii\helpers\Url;
use yii\helpers\Html;
//echo '<pre>';print_r($webinar);exit;
$this->title = 'IndustryARC™ - Webinars';
\Yii::$app->view->registerMetaTag(["name"=>"title","content"=>'IndustryARC™ - Webinars']);
\Yii::$app->view->registerMetaTag(["name"=>"description","content"=>"Read more about IndustryARC™ market research Webinars & news."]);
\Yii::$app->view->registerMetaTag(["name"=>"keywords","content"=>"market research releases, Webinars, company news"]);
?>
<div class="row child-nav">
    <div class="breadcrumb col-9 ">
      <ul>
        <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
        <li>Webinar</li>
      </ul>
    </div>
  </div>
<div class="main-content articles">
  <div class="content-area">
    <div class="white-papers-main">
      <h1 class="text-center"><span class="title-brdr">Webinar</span></h1>
      <div class="webinar-list">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="past" data-toggle="tab" href="#pastwebinars" role="tab" aria-controls="" aria-selected="true">Past Webinars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="upcome" data-toggle="tab" href="#upcomewebinars" role="tab" aria-controls="" aria-selected="false">Upcoming Webinars</a>
        </li>
      </ul>
   <div class="tab-content">
      <div class="tab-pane fade show active" id="pastwebinars" role="tabpanel" aria-labelledby="past">
    <div class="mar-top-20 row">
             <?php
          						$i = 1;
          						foreach($webinar as $webinar){
          							if($i%2 !=0){
          					?>
            <div class="webinar-item"> <img class="card-img-top" src="<?= Yii::$app->request->baseUrl?>/images/webinar/<?= $webinar['image']; ?>" alt="">
              <div class="card-body">
                <h5 class="card-title"><?= $webinar['title']?></h5>
                <div class="card-disc">
                  <div class="webinar-dtl-btm"><span class="webinar-date"><b>From</b> <?=date('F d, Y',strtotime($webinar['pub_date']))?> </span>
                  <span class="webinar-date"><b>To</b> <?=date('F d, Y',strtotime($webinar['pub_date']))?></span>
                <span class="webinar-location"><b>Location</b> India, USA</span></div>
                <p><?= nl2br($webinar['short_descr']).' ....'?> </p>
                </div>
              </div>
              <div class="card-links">
              	<a href="<?=Url::to(['Webinar/'.$webinar['inc_id'].'/'.$webinar['curl']])?>">Read More</a>
              </div>
            </div>
              <?php
                 }else{
               ?>
               <div class="webinar-item"> <img class="card-img-top" src="<?= Yii::$app->request->baseUrl?>/images/webinar/<?= $webinar['image']; ?>" alt="">
                 <div class="card-body">
                   <h5 class="card-title"><?= $webinar['title']?></h5>
                   <div class="card-disc">
                     <div class="webinar-dtl-btm"><span class="webinar-date"><b>From</b> <?=date('F d, Y',strtotime($webinar['pub_date']))?> </span>
                     <span class="webinar-date"><b>To</b> <?=date('F d, Y',strtotime($webinar['pub_date']))?></span>
                   <span class="webinar-location"><b>Location</b> India, USA</span></div>
                   <p><?= nl2br($webinar['short_descr']).' ....'?> </p>
                   </div>
                 </div>
                 <div class="card-links">
                   	<a href="<?=Url::to(['Webinar/'.$webinar['inc_id'].'/'.$webinar['curl']])?>">Read More</a>

                 </div>
               </div>
            <?php
            	}
          	$i++;
            	}
           ?>
           </div>
    </div>
   <div class="tab-pane fade" id="upcomewebinars" role="tabpanel" aria-labelledby="upcome">
         <br>
      <h4>Updating Soon....</h4>
    </div>
     </div>
      </div>
    </div>
  </div>
</div>
