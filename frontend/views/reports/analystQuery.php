<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\helper\ReportHelper;
use frontend\helper\CommonHelper;
use yii\helpers\Url;
$this->title = 'IndustryARC - ANALYST QUERY';
\Yii::$app->view->registerMetaTag(["name" => "robots", "content" => "noindex"]);

$utmsrc = !empty($_GET['utm_source'])?$_GET['utm_source']:'';
$utmmed = !empty($_GET['utm_medium'])?$_GET['utm_medium']:'';
$utmcmp = !empty($_GET['utm_campaign'])?$_GET['utm_campaign']:'';		
$utmParam = !empty($utmsrc)?'UTM Source: '.$utmsrc.', UTM Medium: '.$utmmed.', UTM Campaign: '.$utmcmp:'';
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
            <li>ANALYST QUERY</li>
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
                    <div class="col-md-7">
                        <div class="form-content">
                            <p>The global agricultural sector has witnessed significant changes in the past couple of years. According to the FAO and OECD, the agricultural production is likely to witness slow growth or an increase of 1.5% on an annual basis in the next ten years as compared to the 2.1% growth registered between 2003 and 2012 annually. This slow growth is due to the rising costs of production, increasing resources constraints as well as rising pressures from the environment.</p>
                            <p>As per experts, the agricultural sector is increasingly being driven by market instead of policy. This is providing developing nations with increased opportunities to invest in the sector and benefit economically. However, experts also feel that, shortfall in production and trade related disruptions and volatility in price are some of the concerns related to global food security.</p>
                            <p>Thus, the global agricultural sector is poised for a bright future in view of the strong and increased demand, high food prices and growth and expansion in trade. Experts are also of the opinion that China will have a major impact on the global agricultural scenario.</p>
                            <p>Appropriate and accurate market research can be extremely helpful for the agricultural sector be it agricultural food products manufacturing and food processing companies and suppliers. Market research reports can help them analyse their requirements as well as important elements required for managing their business. It can help policy makers and experts develop a well-designed plan for expanding the sector further. Market related research helps in assessing profitability, customer behavior and identifying the food products that needs</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form form-bg-grey">
                            <p class="text-center rq-form-title"><strong>ANALYST QUERY</strong></p>

                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'analystQuery',
                                        'action' => 'analystcall.php',
                            ]);
                            $arrCountry = ReportHelper::getCountryDtls();
                            ?>
							<div class="row row-mar">
                                <div class="col-md-6 mb-3 col-padding">
                                    <?= $form->field($model, 'txtFName')->textInput(['autofocus' => true, 'placeholder' => 'FIRST NAME']) ?>
                                </div>
                                <div class="col-md-6 mb-3 col-padding">
                                    <?= $form->field($model, 'txtLName')->textInput(['placeholder' => 'LAST NAME']) ?>
                                </div>
                            </div>
                            <div class="row row-mar">
                                <div class="col-md-6 mb-3 col-padding">
                                    <?= $form->field($model, 'txtEmail')->textInput(['placeholder' => 'YOUR BUSINESS EMAIL', 'onblur' => 'validateDomain($(this))']) ?>
                                </div>
                                <div class="col-md-6 mb-3 col-padding">
                                    <?= $form->field($model, 'txtJTitle')->textInput(['placeholder' => 'JOB TITLE']) ?>
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
                                    ])->textInput(['maxlength' => true, 'placeholder' => "CONTACT NUMBER"])
                                    ?>
                                </div>
                            </div>
                            <div class="row row-mar">
                                <div class="col-md-12 mb-3 col-padding">
                                    <?= $form->field($model, 'txtComments')->textarea(['rows' => 4, 'placeholder' => 'ENTER YOUR MESSAGE']) ?>
                                </div>
                            </div>
                            <div class="row row-mar">
                                <div class="col-md-12 mb-3 col-padding">
                                    <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY"></div>
                                </div>
                            </div>
                            <div class="checkbox mar-top-20 mar-btm-30">
                                <label><input type="checkbox" value="" checked required> I accept IndustryArc's <a href="<?=Url::to(['home/privacy'])?>">Privacy Policy</a></label>
                            </div>
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
							<?= $form->field($model, 'utmParam')->hiddenInput(['value' => $utmParam])->label(false); ?>
                            <!-- Hidden Input field :: End -->
                            <div class="btn-center"><button type="submit" class="btn-block">Submit</button></div>
                            <p align="center">Your Emails are secure with us, We will not include you in any subscriptions list</p>
                            <?php ActiveForm::end(); ?>
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
	var country = $('#analystqueryform-txtcountry').val();
	var allCountryDet = $countryDet;
	if(country != ''){
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#analystqueryform-txtphoneext').val(allCountryDet[country]['prefix']);
	}
	$("#analystqueryform-txtcountry").change(function(){
		var country = $(this).val();
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#analystqueryform-txtphoneext').val(allCountryDet[country]['prefix']);
		//console.log($('#analystqueryform-txtphoneext').val());
	});
	/* Phone Extention script::End */

});
JS;
$this->registerJs($script);
?>
