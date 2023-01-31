<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\helper\ReportHelper;
use yii\helpers\Url;

$this->title = 'IndustryARC™ - CONTACT US';
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => 'Contact Us – Best B2B Market Research Agency - IndustryARC ']);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => 'analytics service providing agency,b2b Market Research Agency, best b2b Market Research Agency, consulting agency']);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => 'Contact IndustryARC, the best B2B market research agency which provides research, consulting and analytics services to its global customers.']);
?>
<?php
$arrCountry = ReportHelper::getCountryDtls();

$utmsrc = !empty($_GET['utm_source'])?$_GET['utm_source']:'';
$utmmed = !empty($_GET['utm_medium'])?$_GET['utm_medium']:'';
$utmcmp = !empty($_GET['utm_campaign'])?$_GET['utm_campaign']:'';	
$utmid = !empty($_GET['utm_id'])?$_GET['utm_id']:'';	
$utmterm = !empty($_GET['utm_term'])?$_GET['utm_term']:'';	
$utmcontent = !empty($_GET['utm_content'])?$_GET['utm_content']:'';	
$utmParam = !empty($utmsrc)?'&utm_source='.$utmsrc.'&utm_medium='.$utmmed.'&utm_campaign='.$utmcmp.'&utm_id='.$utmid.'&utm_term='.$utmterm.'&utm_content='.$utmcontent.'':'';
?>	
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="row child-nav">
    <div class="breadcrumb col-9 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>Contact Us </li>
        </ul>
    </div>
</div>
<div class="main-content payment-page">
    <div class="content-area">
        <div class="main-txt bg-none">
            <div class="row">
                <div class="contact-main">
                    <div class="contact-form">
                        <h2 class="rq-form-title">Send Us a Message</h2>
                        <div class="row">
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'contact-us',
                                        'action' => Url::to(['home/contact-us']),
                                        //'action' => 'contact-us',
                            ]);
                            ?>

                            <div class="col-md-12 mb-3">
								<?= $form->field($model, 'c_fname')->textInput(['placeholder' => 'First Name', 'class' => 'form-control'])->label("First Name") ?>
                            </div>
                            <div class="col-md-12 mb-3">
								<?= $form->field($model, 'c_lname')->textInput(['placeholder' => 'Last Name', 'class' => 'form-control'])->label("Last Name") ?>
                            </div>
                            <div class="col-md-12 mb-3">
								<?= $form->field($model, 'c_email')->textInput(['placeholder' => 'Email', 'class' => 'form-control'])->label("Email Address") ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <?=
                                $form->field($model, 'txtCountry')->dropDownList($arrCountry['cnty_dropdown'], [
                                    'style' => 'padding-bottom: 0px;',
                                    'options' => [
                                        $arrCountry['selected_cnty'] => ["Selected" => true]
                                ]])->label("Country");
                                ?>
                            </div>	
                            <div class="col-md-12 mb-3">
                                <?=
                                $form->field($model, 'c_phone', [
                                    'template' => "{label}\n<div class='input-group'><div class='input-group-addon ph_extension'></div>{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => ['class' => '']
                                ])->textInput(['maxlength' => true, 'placeholder' => "ENTER CONTACT NUMBER"])->label("Phone No")
                                ?>
                            </div>
                            <div class="col-md-12 mb-3">
								<?= $form->field($model, 'c_message')->textArea(['placeholder' => 'Message', 'class' => 'form-control'])->label("Message") ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                            </div>
                            <!-- Hidden Input field :: start -->
							<?= $form->field($model, 'phoneExt')->hiddenInput(['value' => ''])->label(false); ?>
							<?= $form->field($model, 'utmParam')->hiddenInput(['value' => $utmParam])->label(false); ?>
                            <!-- Hidden Input field :: end -->
                            <div class="col-md-12 mar-top-20">
                                <div class="md-3">
                                    <button class="btn-block" type="submit">SUBMIT</button>
                                </div>
                            </div>
							<?php ActiveForm::end(); ?>

                        </div>
                    </div>
                    <!------end of from divs-------------------------------->
                    <div class="contact-more flex-col-c-m">
                        <div class="flex-w size1 p-b-47">
                            <div class="txt1 p-r-25">
                                <span class="lnr lnr-map-marker"></span>
                            </div>
                            <div class="flex-col size2">
                                <span class="txt1 p-b-20">
                                    Address
                                </span>
                                <span class="txt2">
                                    Headquarters
                                    IndustryARC<sup>&trade;</sup><br/>
                                    <!--4th & 5th Floor, LP Towers, Plot No. 56,<br/>
                                    Huda Techno Enclave, Madhapur,<br/>
                                    Hyderabad, Telangana, India - 500081.-->
                                    CYBER PEARL BLOCK-A, Cyber Pearl Driveway, Phase 2, HITEC City, Hyderabad, Telangana 500081
                                </span>
                            </div>
                        </div>
                        <div class="dis-flex size1 p-b-47">
                            <div class="txt1 p-r-25">
                                <span class="lnr lnr-phone-handset"></span>
                            </div>
                            <div class="flex-col size2">
                                <span class="txt1 p-b-20">
                                    Lets Talk
                                </span>
                                <span class="txt3">
                                    Tel: (+91) 040-48549062 / 040-48549063<br>
                                    US Contact: (+1) 970-236-3677
                                </span>
                            </div>
                        </div>
                        <div class="dis-flex size1 p-b-47">
                            <div class="txt1 p-r-25">
                                <span class="lnr lnr-envelope"></span>
                            </div>
                            <div class="flex-col size2">
                                <span class="txt1 p-b-20">
                                    General Support
                                </span>
                                <span class="txt3">
                                    sales@industryarc.com
                                </span>
                            </div>
                        </div>
                    </div>

                    <!------end of main divs-------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$countryDet = json_encode($arrCountry['cnty_wise_det']);

//echo '<pre>';print_r($arrCountry['cnty_wise_det']);exit;

$script = <<<JS
$(document).ready(function(e){
	/* Phone Extention script::Start */
	var country = $('#zspcontact-txtcountry').val();
	var allCountryDet = $countryDet;
	if(country != ''){
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#zspcontact-phoneext').val(allCountryDet[country]['prefix']);
	}
	$("#zspcontact-txtcountry").change(function(){
		var country = $(this).val();
		$('.ph_extension').html(allCountryDet[country]['prefix']);
		$('#zspcontact-phoneext').val(allCountryDet[country]['prefix']);
		console.log($('#zspcontact-phoneext').val());
	});
	/* Phone Extention script::End */

});
JS;
$this->registerJs($script);
?>
