<?php
use yii\helpers\Url;
//echo 'u r In '. __FILE__;
$this->title = 'IndustryARC™ - Whitepapers';
\Yii::$app->view->registerMetaTag(["name"=>"title","content"=>$this->title]);
\Yii::$app->view->registerMetaTag(["name"=>"description","content"=>"Read more about latest WhitePapers from IndustryARC™, Latest News, and Company Updates."]);
\Yii::$app->view->registerMetaTag(["name"=>"keywords","content"=>"b2b whitePapers, company updates, global market updates, international market updates, market research news"]);
?>
  <div class="row child-nav">
    <div class="breadcrumb col-9 ">
      <ul>
        <li><a href="<?= Yii::$app->request->baseUrl;?>">Home</a></li>
        <li>White Papers</li>
      </ul>
    </div>
  </div>
  <div class="main-content articles">
    <div class="content-area">
      <div class="white-papers-main">
        <h1 class="text-center"><span class="title-brdr">White Papers</span></h1>
        <div class="white-papers-list row">
        <?php
        		$i=0;
        		$j=1;
        		if(isset($arrWhitePaper)){
        			foreach($arrWhitePaper as $whitePaper){
        				$mainImg= Yii::$app->request->baseUrl.'/images/img1.jpg';
        				$title = $whitePaper['title'];
        				//$title = substr($whitePaper['title'],0,54).' ...';
        				$date = date('d M y',strtotime($whitePaper['mnfctr']));
        			?>
       	<?php if($i%3 == 0){ ?><?php } ?>
          <div class="white-paper-item"><span class="wp-date-info"><?= $date?></span>
              <img class="card-img-top" src="<?= Yii::$app->request->baseUrl?>/images/whitepaper/<?= $whitePaper['image']; ?>" alt="">
              <div class="card-body">
                <h5 class="card-title"><?= $title?></h5>
              </div>
              <div class="card-links">
              <a href="<?=Url::to(['whitepaper/whitepaper-download','prod_id'=>$whitePaper['prod_id'],'seo_keyword'=>$whitePaper['seo_keyword']])?>" class="">Download Now</a>
              </div>
          </div>
          	<?php if($j == 3){ $j=0;?><?php } ?>
          			<?php
          				$i++;
          				$j++;
          			}
          		}else{
          			echo 'No Record Found';
          		}
          		?>
        </div>
      </div>
    </div>
  </div>
