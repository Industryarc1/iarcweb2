<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\helper\ReportHelper;
use frontend\helper\CommonHelper;
use yii\helpers\Url;
$this->title = 'IndustryARC - SALES QUERY';
\Yii::$app->view->registerMetaTag(["name" => "robots", "content" => "noindex"]);
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
            <?php if ($data['dup_inc_id'] >= 500000) { ?>
                <li><a href="<?= Yii::$app->request->baseUrl ?>/Domain/<?= $catlog['code'] ?>/<?= $catlog['seo_keyword'] ?>"><?= $catlog['name'] ?></a></li>
                <li><a href="<?= Yii::$app->request->baseUrl ?>/Research/<?= $data['curl'] ?>-<?= $data['dup_inc_id'] ?>"><?= $data['cbreadcrumb'] ?></a></li>
            <?php } else { ?>
                <li><a href="<?= Yii::$app->request->baseUrl ?>/Domain/<?= $catlog['code'] ?>/<?= $catlog['seo_keyword'] ?>"><?= $catlog['name'] ?></a></li>
                <li><a href="<?= Yii::$app->request->baseUrl ?>/Report/<?= $data['dup_inc_id'] ?>/<?= $data['curl'] ?>"><?= $data['cbreadcrumb'] ?></a></li>
            <?php } ?>
            <li>Inquiry Before Buying </li>
        </ul>
    </div>

</div>
<div class="form-header ">
    <?php
    $title = !empty($data['title']) ? CommonHelper::sanitizeContent($data['title']) : 'Request Quote';
    $title = substr($title, 0, strpos(strtolower($title), ':'));
    ?>
    <p><?= $title; ?></p>
</div>
<div class="main-content request-form">
    <div class="content-area">
        <div class="main-txt">
            <div class="clearfix">
                <div class="form-container">
                    <div class="col-md-5 req-data-form">
                        <div class="form form-bg-grey">
                                <h1 class="text-center rq-form-title">
                                <span>Inquiry Before Buying</span></h1>
                                <?php
                                $form = ActiveForm::begin([
                                            'id' => 'requestQuote',
                                            'action' => 'request-quote',
                                ]);
                                ?>
                                <?php
                                $arrCountry = ReportHelper::getCountryDtls();
                                ?>
								<div id="errorMessage"></div>
                                <div class="row row-mar">
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?= $form->field($model, 'txtFName')->textInput(['placeholder' => 'Enter First Name']) ?>
                                    </div>
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?= $form->field($model, 'txtLName')->textInput(['placeholder' => 'Enter First Name']) ?>
                                    </div>
                                </div>


                                <div class="row row-mar">
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?= $form->field($model, 'txtEmail')->textInput(['placeholder' => 'Enter Your Business Email', 'onblur' => 'validateDomain($(this))']) ?>
                                    </div>
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?= $form->field($model, 'txtJTitle')->textInput(['placeholder' => 'Enter Job Title']) ?>
                                    </div>
                                </div>
                                <div class="row row-mar">
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?=
                                        $form->field($model, 'txtCountry')->dropDownList($arrCountry['cnty_dropdown'], [
                                            'style' => 'padding-bottom: 0px;',
                                            'options' => [
                                                $arrCountry['selected_cnty'] => ["Selected" => true]
                                        ]]);
                                        ?>

                                    </div>
                                    <div class="col-md-6 mb-3 col-padding">
                                        <?=
                                        $form->field($model, 'txtPhone', [
                                            'template' => "{label}\n<div class='input-group'><div class='input-group-addon ph_extension'></div>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => ['class' => '']
                                        ])->textInput(['maxlength' => true, 'placeholder' => "Enter Contact Number"])
                                        ?>
                                    </div>
                                </div>
                                <div class="row row-mar">
                                    <div class="col-md-6 mb-3 col-padding">
                                        <label for="Contact">Select Priority</label>
                                        <select class="form-control" name="priority_range">
                                            <option value="0">0</option>
                                            <option value="20" selected>20</option>
                                            <option value="50">50</option>
                                            <option value="80">80</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row row-mar">
                                    <div class="col-md-12 mb-3 col-padding">
                                        <?= $form->field($model, 'txtComments')->textarea(['rows' => 4, 'placeholder' => 'Enter Your Message']) ?>
                                    </div>
                                </div>
                                <div class="row row-mar">
                                    <div class="col-md-12 mb-3 col-padding">
                                        <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                    </div>
                                </div>
                                <!--<div class="checkbox mar-top-20 mar-btm-30">
                                    <label><input type="checkbox" value="" checked required> I accept IndustryArc's <a href="<?=Url::to(['home/privacy'])?>">Privacy Policy</a></label>
                                </div>-->
                                <!-- Hidden Input field :: start -->
                                <?= $form->field($model, 'formId')->hiddenInput(['value' => $formId])->label(false); ?>
                                <?= $form->field($model, 'txtCompany')->hiddenInput(['value' => "NA"])->label(false); ?>
                                <?= $form->field($model, 'txtCheckboxName')->hiddenInput(['value' => "No"])->label(false); ?>
                                <?= $form->field($model, 'datetimepicker')->hiddenInput(['value' => "0000-00-00"])->label(false); ?>
                                <?= $form->field($model, 'timezonepicker')->hiddenInput(['value' => "NA"])->label(false); ?>
                                <?= $form->field($model, 'txtPhoneExt')->hiddenInput(['value' => ''])->label(false); ?>

                                <?= $form->field($model, 'hidReportCode')->hiddenInput(['value' => $data['code']])->label(false); ?>
                                <?= $form->field($model, 'hidReportIncId')->hiddenInput(['value' => $data['inc_id']])->label(false); ?>
                                <?= $form->field($model, 'hidCat')->hiddenInput(['value' => $data['cat']])->label(false); ?>
                                <?= $form->field($model, 'hidSubCat')->hiddenInput(['value' => $data['subcat']])->label(false); ?>
                                <?= $form->field($model, 'hidReportName')->hiddenInput(['value' => $data['title']])->label(false); ?>
                                <?= $form->field($model, 'hidCatName')->hiddenInput(['value' => $catlog['name']])->label(false); ?>
                                <?= $form->field($model, 'hidPName')->hiddenInput(['value' => $catlog['p_name']])->label(false); ?>

                                <?php
                                $scn = !empty($subcatlog['name']) ? $subcatlog['name'] : "";
                                $scpn = !empty($subcatlog['p_name']) ? $subcatlog['p_name'] : "";
                                ?>
                                <?= $form->field($model, 'hidSubCatName')->hiddenInput(['value' => $scn])->label(false); ?>
                                <?= $form->field($model, 'hidSubPName')->hiddenInput(['value' => $scpn])->label(false); ?>
                                <?= $form->field($model, 'pub_date')->hiddenInput(['value' => $data['pub_date']])->label(false); ?>
                                <?= $form->field($model, 'noofpages')->hiddenInput(['value' => $data['pages']])->label(false); ?>
                                <!-- Hidden Input field :: End -->

                                <div class="btn-center"><button type="submit" class="btn-block">Submit</button></div>
                                <p>&nbsp;</p>
                                <p align="center">Your Emails are secure with us, We will not include you in any subscriptions list</p>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    <div class="col-md-7 req-data-txt">
                        <div class="form-content">
                        <!--<b>What are the Contents of the sample?</b>
                        <p>The sample will give you a brief idea about the complete scope of the report, this will help you understand which countries, product types, services, applications and end use segments are covered in our complete premium report.
                        We highlight key trends, developments pertaining to the market, which have been thoroughly discussed and covered in the complete report. This includes drivers, challenges and the upcoming set of opportunities. Furthermore, there is also a Porter's five forces framework, which will help understand the market dynamics that were considered for analysing the market in terms of supply, demand and competition. The sample will also feature a company profile for one of your competitors which will give you an overview of competitor’s business segments, product line, financial strength and strategic initiatives.
                        </p>-->
                        <b>Who should buy this report?</b>
                        <p>All our reports are meant for raw material suppliers, manufacturers/ producers, traders, service provides, distributors and end-use customers, it helps them track supply, demand, trade, pricing and distribution scenario along with key customers.
                        1. Majority of business development teams, innovation teams, product directors, strategy directors and M&A teams buy our reports to plan their sales or marketing or product strategy.
                        2. Any start-ups pitching to investors or established company venturing into new markets can also use our data to showcase the potential of a market segment.
                        3. Education institutions can use our reports to get grants for carrying out their research activities, plan technology commercialization, assist students in their academic reports or thesis.
                        4. Government bodies can use our reports to discover new growth areas, best practises, market potential and complete competitive landscape.
                        </p>
                        <!--<b>What does the Full Report Deliver?</b>
                        <p>This market research report will help you in understanding the customer and supplier analysis, growth areas, market potential, application and product level demand and supply of product or service for the current year and forecast for next 5 years. The regional/country wise analysis will help you identify the regions which offer better opportunities of growth for your company. A well laid out set of drivers, constraints and opportunities will assist you in understanding the market dynamics and the pain points. The competitor profiling will help you plan your strategies that can help you gain competitive edge against the players operating in the market.</p>-->
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
<?php
$countryDet = json_encode($arrCountry['cnty_wise_det']);
$script = <<<JS
$(document).ready(function(e){

	/* Phone Extention script::Start */
	var country = $('#requestquoteform-txtcountry').val();
	var allCountryDet = $countryDet;
	if(country != ''){
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#requestquoteform-txtphoneext').val(allCountryDet[country]['prefix']);
	}
	$("#requestquoteform-txtcountry").change(function(){
		var country = $(this).val();
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#requestquoteform-txtphoneext').val(allCountryDet[country]['prefix']);
		//console.log($('#requestquoteform-txtphoneext').val());
	});
	/* Phone Extention script::End */

});
JS;
$this->registerJs($script);
?>

