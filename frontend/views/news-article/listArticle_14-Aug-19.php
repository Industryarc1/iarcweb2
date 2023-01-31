 <?php
 use yii\helpers\Url;
 use yii\helpers\Html;
 use frontend\helper\CommonHelper;
 use yii\widgets\LinkPager;

 $this->title = 'IndustryARC™ - Articles';
 \Yii::$app->view->registerMetaTag(["name"=>"title","content"=>"B2B Market Research Articles, Published Industry Articles – IndustryARC™."]);
 \Yii::$app->view->registerMetaTag(["name"=>"description","content"=>"Read more about IndustryARC market research articles, newly published industry articles and other news."]);
 \Yii::$app->view->registerMetaTag(["name"=>"keywords","content"=>"b2b research articles, company updates, global market articles, international market articles, market research articles, published industry articles, research industry articles"]);
 $currentUrl = Yii::$app->request->url;
 if(strpos($currentUrl,'page=')){
 	\Yii::$app->view->registerMetaTag(["name"=>"ROBOTS","content"=>"NOINDEX, NOFOLLOW"]);
 }
 //echo '<pre>'; print_r($articles);exit;
 ?>
 <div class="row child-nav">
    <div class="breadcrumb col-9 ">
      <ul>
        <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
        <li>Articles</li>
      </ul>
    </div>
  </div>
<div class="main-content articles">
  <div class="content-area">
    <div class="articles-container">
     <div class="row">
      <div class="caterogy-list">
        <h2>Categories</h2>
          <div class="article-category-list">
			<div class="panel panel-info">
				<?php
				$arrCategories = CommonHelper::reportMenu();
				foreach ($arrCategories as $category) {
					$urlcat = Url::to(['Domain/' . $category['code'] . '/' . $category['seo_keyword']]);
					?>
					<div class="panel-heading collapsed" data-toggle="collapse" data-target="#<?= preg_replace('/\s+/', '_', $category['name']); ?>">
					<a href="<?=$urlcat?>" aria-label="<?=$urlcat?>"><?= $category['name'] ?></div>
				<?php } ?>
			</div>
        </div>
      </div>
<div class="article-list">
  <h1>Articles</h1>
      <ul class="row">
     <?php if($articles){
      	foreach ($articles as $article) {
      					$date = date("d-M-Y",strtotime($article['mnfctr']));
      					$contentTitle = !empty($article['title'])?$article['title']:NULL;
      					$pageUrl = !empty($article['custid'])?Url::to(['Article/'.$article['custid'].'/'.$article['seo_keyword']]):"javascript:void(0)";
      					$shortDesc = !empty($article['short_descr'])?base64_decode($article['short_descr']):NULL;
						$shortDesc = preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $shortDesc);
						$shortDesc = preg_replace('#style="[^"]*"#i','', $shortDesc);
						$shortDesc = preg_replace('#color="[^"]*"#i','', $shortDesc);
						$shortDesc = preg_replace('#size="[^"]*"#i','', $shortDesc);
						$shortDesc = preg_replace('#font="[^"]*"#i','', $shortDesc);
						$shortDesc = preg_replace('#face="[^"]*"#i','', $shortDesc);
						$shortDesc = str_replace('class="MsoNormal"', '', $shortDesc);

      			?>
        <li>
         <a href="<?=$pageUrl?>" target="_blank">
            <div class="article-item clearfix">
              <div class="article-info">
              <b><?=CommonHelper::sanitizeContent($contentTitle);?></b>
                <p class="rsp-hide"><?=$shortDesc?></p>
                <span class="publish-date">Published:<?=date('d F Y',strtotime($date))?></span>
                <div class="readarticle">Read Article</div>
                </div>
            </div>
            </a>
          </li>
        <?php
             	}
          }
         else{
           echo "No Articles Found";
          }?>
      </ul>
       <div class="row text-center">
            <?php
             // display pagination
             echo LinkPager::widget([
                'pagination' => $pagination,
                'maxButtonCount' => 5,

               'firstPageLabel' => '<< First ',

               'lastPageLabel' => '  Last >>'
             ]);
            ?>
        </div>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="fadeeffect"></div>
<a href="#" class="rsp-content close-category ">x</a>
<div class="rsp-content select-category"><a href="#">Categories</a></div>

