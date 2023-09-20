<?php

use yii\helpers\Url;
?>
<style>
    .thankyou-hdr {
        background:#1b335f;
        color:#fff;
        padding:20px;
    }

    .thankyou-hdr h1{
        font-size:30px;
        padding:20px 0 0;}
    </style>
    <div class="row child-nav">
    <div class="breadcrumb col-9 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>Thank You</li>
        </ul>
    </div>
</div>
<div class="main-content articles">
    <div class="content-area">
        <div class="">
            <div class="thankyou-hdr"><h1 class="text-center">Thank You for contacting IndustryARC</h1>
                <div class="row">
                    <div class="content-column-full"><div class="basic-content">
                            <p>Please check your email.</strong> Our Support Team will contact you soon.</p>
                            <a href="<?= Url::to(['back']) ?>" class="btn btn-primary">Back</a>
                        </div></div>
                </div></div>
        </div>
        <div class="articles-container row">
            <div class=" bg-white content-column-full">
                <h1 class="title-brdr d-block">Related Reports </h1>
                <div class="press-release-list">

                    <div class=" related-report ">
                        <div class="tab-pane fade show active" id="all_content" role="tabpanel" aria-labelledby="all">
                            <ul class="row">
                                <?php
                                if (!empty($arrRelated)) {
                                    foreach ($arrRelated as $related) {
                                        if ($related['dup_inc_id'] < 500000) {
                                            $reportUrl = Url::to(['Report/' . $related['dup_inc_id'] . '/' . $related['curl']]);
                                        } else {
                                            $reportUrl = Url::to(['Research/' . $related['curl'] . '-' . $related['dup_inc_id']]);
                                        }
                                        ?>
                                        <li>
                                            <div class="article-item clearfix">
                                                <div class="artcl-img"><img src="<?= Yii::$app->request->baseUrl ?>/images/reports/<?= $related['image']; ?>" width="" height="" alt=""></div>
                                                <div class="article-info">
                                                    <a href="<?= $reportUrl ?>"><b><?= $related['title']; ?></b></a>
                                                    <p class="rsp-hide"><?= $related['short_descr']; ?></p>
                                                </div>
                                            </div>

                                        </li>
                                    <?php }
                                } else { ?>
                                    <li>
                                        <div class="article-item clearfix">
                                            <div><b>No Report Found</b></div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <!--<div class="btn-center text-center"><a href="#">Load More <img src="<?= Yii::$app->request->baseUrl ?>/images/down-arrow.png" width="15" height="" alt=""></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
