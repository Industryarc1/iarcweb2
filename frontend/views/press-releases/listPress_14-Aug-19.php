<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\helper\CommonHelper;
use yii\widgets\LinkPager;

$this->title = 'IndustryARC™ - Press Release';
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => "B2B Market Research Press Releases, Latest News, Company Updates- IndustryARC™."]);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => "Read more about latest press releases from IndustryARC™, Latest News, and Company Updates."]);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => "b2b press releases, company updates, global market press releases, international market press releases, market research news, market research press releases"]);
$currentUrl = Yii::$app->request->url;
if (strpos($currentUrl, 'page=')) {
    \Yii::$app->view->registerMetaTag(["name" => "ROBOTS", "content" => "NOINDEX, NOFOLLOW"]);
}
//echo '<pre>'; print_r($pagination);exit;
?>
<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>Press Releases</li>
        </ul>
    </div>
</div>
  <!--  social icons and breadcrums -->
<div class="main-content pr-list">
    <div class="content-area">

        <div class="articles-container row">
            <div class="caterogy-list rsp-content">
                <h2>Press Released Year</h2>
                <div class="pr-years">
                    <p><a href="#">2019</a> </p>
                    <p><a href="#">2018</a> </p>
                    <p><a href="#">2017</a> </p>
                    <p><a href="#">2016</a> </p>
                    <p><a href="#">2015</a> </p>

                </div>
            </div>
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
            <div class="article-list bg-white">
                <h1>Press Releases </h1>
                <div class="press-release-list">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php
                        $y = !empty(Yii::$app->getRequest()->getQueryParam('y')) ? Yii::$app->getRequest()->getQueryParam('y') : date('Y');
                        $start_year = 2015;
                        $current_year = date('Y');
                        $filter = NULL;
                        for ($i = $start_year; $i <= $current_year; $i++) {
                            //echo Html::a($i, Url::to(['','y'=>$i]), ['data-method' => 'POST']);
                            $filter .= '<li class="nav-item">';
                            if ($i == $y) {
                                $filter .= Html::a($i, Url::to(['', 'y' => $i]), ['data-method' => 'POST', 'class' => "nav-link active", 'id' => "year-" . $i, 'data-toggle' => "tab", 'role' => "tab", 'aria-controls' => $i]);
                            } else {
                                $filter .= Html::a($i, Url::to(['', 'y' => $i]), ['data-method' => 'POST', 'class' => "nav-link", 'id' => "year-" . $i, 'data-toggle' => "tab", 'role' => "tab", 'aria-controls' => $i]);
                            }
                            $filter .= '</li>';
                        }
                        echo $filter;
                        ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="2019" role="tabpanel" aria-labelledby="year-2019">
                            <ul class="row">
                                <?php
                                if ($pressData) {
                                    //echo '<pre>'; print_r($pressData);exit;
                                    foreach ($pressData as $press) {
                                        $date = date("d-M-Y", strtotime($press['mnfctr']));
                                        $contentTitle = !empty($press['title']) ? $press['title'] : NULL;
                                        $pageUrl = !empty($press['prod_id']) ? Url::to(['PressRelease/' . $press['prod_id'] . '/' . $press['seo_keyword']]) : "javascript:void(0)";
                                        $shortDesc = !empty($press['short_descr']) ? base64_decode($press['short_descr']) : NULL;
                                        ?>
                                        <li>
                                            <a href="<?= $pageUrl ?>" target="_blank">
                                                <div class="article-item clearfix">
                                                    <div class="article-info">
                                                        <b><?= CommonHelper::sanitizeContent($contentTitle) ?></b>
                                                        <p class="rsp-hide"><?= $shortDesc ?></p>
                                                        <span class="publish-date">Published:<?= date('d F Y', strtotime($date)) ?></span>
                                                        <div class="readarticle">Read More</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    echo "No PressRelease Found";
                                }
                                ?>
                            </ul>

                        </div>
                        <div class="tab-pane fade" id="2018" role="tabpanel" aria-labelledby="year-2018">2018</div>
                        <div class="tab-pane fade" id="2017" role="tabpanel" aria-labelledby="year-2017">2017</div>
                    </div>
                </div>
                <div class="row text-center">
                    <?php
                    // display pagination
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                        'maxButtonCount' => 5,
                        'firstPageLabel' => 'First ',
                        'lastPageLabel' => '  Last'
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fadeeffect"></div>
<a href="#" class="rsp-content close-category ">x</a>
<div class="rsp-content select-category"><a href="#">Categories</a></div>
