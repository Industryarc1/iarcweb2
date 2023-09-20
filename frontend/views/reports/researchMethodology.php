<?php
use yii\helpers\Html;
use frontend\helper\CommonHelper;
use yii\helpers\Url;

\Yii::$app->view->registerMetaTag(["name"=>"robots","content"=>"noindex"]);

//echo '<pre>';print_r($reportDet);
?>
 <div class="row child-nav">
    <div class="breadcrumb col-8 ">
      <ul>
       <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
        <li>Research Methodology</li>
      </ul>
    </div>

  </div>
<div class="main-content articles">
  <div class="content-area">
    <div class="white-papers-main">
      <h1 class="text-center"><span class="title-brdr">Research</span></h1>
      <div class="row">
      <div class="content-column-full">
      <div class="basic-content">
      <?php
      	$contentTitle = substr($reportDet['title'],0,strpos(strtolower($reportDet['title']),'market'));
      	$contentLink = Url::to(['reports/share-requirement','id'=>$reportDet['dup_inc_id']]);
      	echo Yii::$app->controller->renderPartial('researchMethod',[
      		'title'=>$contentTitle,
      		'hyperLink'=>$contentLink,
      	]);
      ?>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
