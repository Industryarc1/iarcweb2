<?php

use yii\helpers\Url;
?>
<div class="row child-nav">
    <div class="breadcrumb col-9 ">
        <ul>
           <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>Sitemap</li>
        </ul>
    </div>
</div>


<div class="main-content articles">
    <div class="content-area">
        <div class="white-papers-main">
            <h1 class="text-center"><span class="title-brdr">Sitemap</span></h1>
            <div class="row">
                <div class="site-map-container">
                    <div class="basic-content sitemap">
                        <div class="site-map-column">
                            <h3>Company</h3>
                            <ul class="">
                                <li><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                                <li><a href="<?= Url::to(['site/about']) ?>">About Us</a></li>
                                <li><a href="<?= Url::to(['site/team']) ?>">Team</a></li>
                                <li><a href="<?= Url::to(['site/career']) ?>">Careers</a></li>
                                <li><a href="<?= Url::to(['home/contact-us']) ?>">Contact Us</a></li>
                            </ul>

                        </div>

                        <div class="site-map-column">

                            <h3>Knowledge Store</h3>
                            <ul class="">
                                <li><a href="<?= Url::to(['press-releases/list-press']) ?>">Press Releases</a></li>
                                <li><a href="<?= Url::to(['news-article/list-article']) ?>">Articles</a></li>
                                <li><a href="<?= Url::to(['webinar/list-webinar']) ?>">Webinars</a></li>
                                <li><a href="<?= Url::to(['whitepaper/list-whitepaper']) ?>">White Papers</a></li>
                            </ul>

                        </div>

                        <div class="site-map-column">

                            <h3>Legal</h3>
                            <ul class="">
                                <li><a href="<?= Url::to(['home/privacy']) ?>">Privacy Policy</a></li>
                                <li><a href="<?= Url::to(['home/terms']) ?>">Terms and Conditions</a></li>
                                <li><a href="<?= Url::to(['home/payment-process']) ?>">Payment Process</a></li>
                            </ul>
                        </div>

                        <div class="site-map-column">
                            <h3>Market Report</h3>
                            <?php
                            if (!empty($reports)) {
                                $strHtml = "";
                                $strHtml .= "<ul>";
                                foreach ($reports as $domain) {
                                    $domainUrl = Url::to(['Domain/' . $domain['code'] . '/' . $domain['seo_keyword']]);
                                    $domainName = $domain['name'];
                                    $strHtml .= '<li><a href="' . $domainUrl . '">' . $domainName . '</a>';
                                    if (!empty($domain['children'])) {
                                        $strHtml .= '<ul>';
                                        foreach ($domain['children'] as $subDomain) {
                                            $subDomainUrl = Url::to(['Domain/' . $subDomain['code'] . '/' . $subDomain['seo_keyword']]);
                                            $subDomainName = $subDomain['name'];
                                            $strHtml .= '<li><a href="' . $subDomainUrl . '">&nbsp-&nbsp' . preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', ' ', $subDomainName) . '</a></li>';
                                        }
                                        $strHtml .= '</ul>';
                                    }
                                    $strHtml .= "</li>";
                                }
                                $strHtml .= "</ul>";
                                echo $strHtml;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
