<?php

use yii\helpers\Url;
use frontend\helper\ReportHelper;

//echo '<pre>';print_r($whitePaper);echo '</pre>';
?>
<?php
$this->title = $whitePaper['meta_title'];
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => $this->title]);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => base64_decode($whitePaper['meta_keywords'])]);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => base64_decode($whitePaper['meta_descr'])]);
?>
<?php
$arrLocDetails = ReportHelper::getUserLocInfo();
$ip_country = $arrLocDetails['name'];
$ip_country_code = $arrLocDetails['prefix'];
?>
<style>
    .error{
        color:red;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Yii::$app->request->baseUrl; ?>">Home</a></li>
            <li><a href="<?= Url::to(['whitepaper/list-whitepaper']) ?>">White Papers</a></li>
            <li><?= substr($whitePaper['meta_title'], 0, strpos($whitePaper['meta_title'], '|')) ?></li>
        </ul>
    </div>
</div>
<div class="form-header ">
    <p><?= $whitePaper['title'] ?> </p>
</div>
<div class="main-content request-form">

    <div class="content-area">

        <div class="main-txt">

            <div class="clearfix">
                <div class="form-container">
                    
                    <div class="col-md-5 req-data-form"><div class="form form-bg-grey">
                            <h1 class="text-center rq-form-title">Fill Out the Information Below to Download the Whitepaper.</h1>
                            <form action="<?= Url::to(['whitepaper/whitepaper-download']) ?>" method="post">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="address">First Name</label>
                                        <input  class="form-control" name="fname" type="text" placeholder="First Name" onblur="essentialChecks(this)" required>
                                        <div class='error fname_err'></div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Last Name</label>
                                        <input class="form-control" name="lname"  type="text" placeholder="Last Name" onblur="essentialChecks(this)">
                                        <div class='error lname_err'></div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Email</label>
                                        <input class="form-control" name="email" type="email" placeholder="Email Address" onblur="essentialChecks(this)" required>
                                        <div class='error email_err'></div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="col-md-3">
                                           <label>Code</label>
                                            <input class="form-control" name="phoneExt" value="<?= $ip_country_code ?>" type="text" placeholder="COUNTRY CODE" readonly="true">
                                            <div class='error phoneExt_err'></div>
                                        </div>
                                        <div class="col-md-9">
                                            <label>Phone Number</label>
                                            <input class="form-control" name="phone" type="text" placeholder="Phone Number" onblur="essentialChecks(this)" required>
                                            <div class='error phone_err'></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Comments</label>
                                        <textarea class="form-control" name="comments" type="text" rows="4"></textarea>
                                        <div class='error comments_err'></div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                    </div>
                                    <!--======== Hidden input start==========-->
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                                    <input type="hidden" name="prod_id" value="<?= $whitePaper['prod_id']; ?>">
                                    <!--======== Hidden input End==========-->
                                    <div class="col-md-6 mar-top-20 mar-lr-auto">
                                        <div class="md-3"><button class="btn-block">Submit</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
					
					<div class="col-md-7 req-data-txt">
                      <div class="form-content">
                           <b>What are the Contents of the sample?</b>
                          <p>The sample will give you a brief idea about the complete scope of the report, this will help you understand which countries, product types, services, applications and end use segments are covered in our complete premium report.
                          We highlight key trends, developments pertaining to the market, which have been thoroughly discussed and covered in the complete report. This includes drivers, challenges and the upcoming set of opportunities. Furthermore, there is also a Porter's five forces framework, which will help understand the market dynamics that were considered for analysing the market in terms of supply, demand and competition. The sample will also feature a company profile for one of your competitors which will give you an overview of competitor’s business segments, product line, financial strength and strategic initiatives.
                          </p>
                          <b>Who should buy this report?</b>
                          <p>All our reports are meant for raw material suppliers, manufacturers/ producers, traders, service provides, distributors and end-use customers, it helps them track supply, demand, trade, pricing and distribution scenario along with key customers.
                          1. Majority of business development teams, innovation teams, product directors, strategy directors and M&A teams buy our reports to plan their sales or marketing or product strategy.
                          2. Any start-ups pitching to investors or established company venturing into new markets can also use our data to showcase the potential of a market segment.
                          3. Education institutions can use our reports to get grants for carrying out their research activities, plan technology commercialization, assist students in their academic reports or thesis.
                          4. Government bodies can use our reports to discover new growth areas, best practises, market potential and complete competitive landscape.
                          </p>
                          <b>What does the Full Report Deliver?</b>
                          <p>This market research report will help you in understanding the customer and supplier analysis, growth areas, market potential, application and product level demand and supply of product or service for the current year and forecast for next 5 years. The regional/country wise analysis will help you identify the regions which offer better opportunities of growth for your company. A well laid out set of drivers, constraints and opportunities will assist you in understanding the market dynamics and the pain points. The competitor profiling will help you plan your strategies that can help you gain competitive edge against the players operating in the market.</p>
                          <b>Is Our Report Customizable?</b>
                          <p>Yes, most of our customers prefer buying off the shelf reports with some level of customization to tune it to their requirements. Your inputs in this form will help us understand your requirements in a clear and focused way so that we offer our solutions which suits you the best.
                          Laying out your requirements can help our designated research managers in connecting and defining the scope. Our team will support you to get the report customized as per your needs mentioned in the form here.
                          </p>
                          <b>IndustryARC Research Methodology</b>
                          <p>The data collected is a combination of secondary and primary sources. The primary sources include interviews with senior executive level professionals, who have contributed to the quantitative and qualitative aspects of the study such as operations, performance, strategies and views on the overall market, including key developments and technology trends. The inputs from these interviews are thoroughly verified for the accuracy and consistency and were again validated by IndustryARC consultants and experts. The secondary sources accessed include various directories, industry portals, articles, white papers, newsletters, annual reports and paid databases to identify and collect information for extensive technical and commercial study preparation. We also conduct targeted interviews, including Voice of Customer (VoC) studies based on your specific companies of interest.</p>
                      </div>
                  </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    function essentialChecks(field) {
        var fieldName = $(field).attr('name');
        //console.log($(field).val());
        if (fieldName == 'fname') {
            if ($(field).val() != '') {
                $(".fname_err").html('');
            } else {
                $(".fname_err").html('First Name Can`t be blank.');
            }
        }
        if (fieldName == 'email') {
            if ($(field).val() != '') {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test($(field).val())) {
                    $(".email_err").html('Invalid Email Address given');
                } else {
                    $(".email_err").html('');
                }
            } else {
                $(".email_err").html('Email Can`t be blank.');
            }
        }
        if (fieldName == 'phone') {
            if ($(field).val() != '') {
                $(".phone_err").html('');
            } else {
                $(".phone_err").html('Phone No Can`t be blank.');
            }
        }

    }
</script>
