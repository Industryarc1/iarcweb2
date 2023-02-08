<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\helper\ReportHelper;
use frontend\helper\CommonHelper;
$this->title = 'IndustryARC™ - Search Results';
//echo 'You Are in '.__FILE__;
?>

<div class="row child-nav">
    <div class="breadcrumb col-9 ">
      <ul>
       <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
        <li>Search Result</li>
      </ul>
    </div>
</div>
<div class="main-content search-result">
  <div class="content-area">

    <div class="articles-container row">
    <div class="caterogy-list">
        <h2>Categories</h2>
          <div class="article-category-list">
			  <div class="panel panel-info">
				<?php
								$arrCategories = CommonHelper::reportMenu();
								foreach ($arrCategories as $category) {
									$urlcat = Url::to(['Domain/' . $category['code'] . '/' . $category['seo_keyword']]);
									?>
									<div class="panel-heading collapsed" data-toggle="collapse" data-target="#<?= preg_replace('/\s+/', '_', $category['name']); ?>"><a href="<?=$urlcat?>" aria-label="<?=$urlcat?>"><?= $category['name'] ?></a></div>
								<?php } ?>
			 </div>
		  </div>
        </div>

<div class="article-list bg-white">
  <h1>Search Result </h1>
  <div class="press-release-list">
  <ul class="nav nav-tabs" id="filters" role="tablist">
    <li class="nav-item">
    <a class="nav-link " id="all" data-toggle="tab" href="#all_content" role="tab" aria-controls="all" aria-selected="true">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="reports" data-toggle="tab" href="#reports_content" role="tab" aria-controls="reports" aria-selected="false">Reports</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="press-releases" data-toggle="tab" href="#pr_content" role="tab" aria-controls="press-releases" aria-selected="false">Press Releases</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="articles" data-toggle="tab" href="#articles_content" role="tab" aria-controls="articles" aria-selected="false">Articles </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="whitepapers" data-toggle="tab" href="#wp_content" role="tab" aria-controls="whitepapers" aria-selected="false">White Papers</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade " id="all_content" role="tabpanel" aria-labelledby="all">
  <ul class="row">
        <li>
        <?php if(!empty($data)){
        						foreach($data as $result){ ?>
            <div class="article-item clearfix">
              <div class="article-info">
              <a href="<?= Url::to([$result['curl']])?>" title="<?=$result['meta_title']?>"><b><?=$result['title'].' | IndustryARC™'?></b></a>
                <p class="rsp-hide"><?=$result['short_descr']?></p>
                </div>
            </div>
            	<?php }
            						}else{
            						echo "<h3 align='center'>No Result Found !!</h3>";
            						} ?>
          </li>
      </ul>
   </div>
    <div class="tab-pane fade" id="reports_content" role="tabpanel" aria-labelledby="reports">
     <ul class="row">
            <li>
         <?php if(!empty($reportdata)){
           foreach($reportdata as $result){ ?>
             <div class="article-item clearfix">
               <div class="article-info">
               <a href="<?= Url::to([$result['curl']])?>" title="<?=$result['meta_title']?>"><b><?=$result['title'].' | IndustryARC™'?></b></a>
                 <p class="rsp-hide"><?=$result['short_descr']?></p>
                 </div>
             </div>
              <?php }
                }else{
               echo "<h3 align='center'>No Result Found !!</h3>";
               } ?>
              </li>
          </ul>
    </div>
     <div class="tab-pane fade" id="pr_content" role="tabpanel" aria-labelledby="year-2017">
      <ul class="row">
             <li>
              <?php if(!empty($pressdata)){
                 foreach($pressdata as $result){ ?>
                   <div class="article-item clearfix">
                     <div class="article-info">
                     <a href="<?= Url::to([$result['curl']])?>" title="<?=$result['meta_title']?>"><b><?=$result['title'].' | IndustryARC™'?></b></a>
                       <p class="rsp-hide"><?=$result['short_descr']?></p>
                       </div>
                   </div>
                    <?php }
                      }else{
                     echo "<h3 align='center'>No Result Found !!</h3>";
                     } ?>
               </li>
           </ul>
     </div>
     <div class="tab-pane fade show active" id="articles_content" role="tabpanel" aria-labelledby="year-2017">
           <ul class="row">
                  <li>
                   <?php if(!empty($articledata)){
                      foreach($articledata as $result){ ?>
                        <div class="article-item clearfix">
                          <div class="article-info">
                          <a href="<?= Url::to([$result['curl']])?>" title="<?=$result['meta_title']?>"><b><?=$result['title'].' | IndustryARC™'?></b></a>
                            <p class="rsp-hide"><?=$result['short_descr']?></p>
                            </div>
                        </div>
                         <?php }
                           }else{
                          echo "<h3 align='center'>No Result Found !!</h3>";
                          } ?>
                    </li>
                </ul>
          </div>
     <div class="tab-pane fade" id="wp_content" role="tabpanel" aria-labelledby="year-2017">
           <ul class="row">
                  <li>
                   <?php if(!empty($paperdata)){
                      foreach($paperdata as $result){ ?>
                        <div class="article-item clearfix">
                          <div class="article-info">
                          <a href="<?= Url::to([$result['curl']])?>" title="<?=$result['meta_title']?>"><b><?=$result['title'].' | IndustryARC™'?></b></a>
                            <p class="rsp-hide"><?=$result['short_descr']?></p>
                            </div>
                        </div>
                         <?php }
                           }else{
                          echo "<h3 align='center'>No Result Found !!</h3>";
                          } ?>
                    </li>
                </ul>
          </div>
      </div>
      </div>
    </div>
    </div>
  </div>
</div>

<div class="fadeeffect"></div>
<a href="#" class="rsp-content close-category ">x</a>
<div class="rsp-content select-category"><a href="#">Categories</a></div>
