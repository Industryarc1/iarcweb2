<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\helper\CommonHelper;
use yii\widgets\ActiveForm;

$this->title = CommonHelper::sanitizeContent($webinar['meta_title']);
\Yii::$app->view->registerMetaTag(["name" => "title", "content" => $this->title]);
\Yii::$app->view->registerMetaTag(["name" => "keywords", "content" => $webinar['meta_keywords']]);
\Yii::$app->view->registerMetaTag(["name" => "description", "content" => $webinar['meta_descr']]);
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Yii::$app->request->baseUrl; ?>">Home</a></li>
            <li><a href="<?= Url::to(['webinar/list-webinar']) ?>">Webinar</a></li>
            <li><?= substr($webinar['meta_title'], 0, strpos($webinar['meta_title'], '|')) ?></li>
        </ul>
    </div>
</div>
<div class="main-content webinar-full">
    <div class="content-area">

        <div class="main-txt">
            <div class="article-title-info">
                <h2><?= $webinar['title'] ?></h2>

            </div>
            <div class="clearfix">
                <div class="contact-left webinar-video">
                        <?php if (!empty($webinar['youtube'])) { ?>
                        <iframe class="webinar-video-frame" width="100%" height="315" src="https://www.youtube.com/embed/TiHn9l_x1sc"
                            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                        <?php } ?>
                    <div class="contact-form-page p-relative form-bg-grey">
                        <!--<div class="webinar-dt-dtl">
                            <span class="webinar-date"><b>From</b> <?= date('F d, Y', strtotime($webinar['pub_date'])) ?> </span>
                            <span class="webinar-date"><b>To</b> <?= date('F d, Y', strtotime($webinar['pub_date'])) ?> </span>
                            <span class="webinar-location"><b>Location</b> India, USA</span>
                        </div>-->
						<p>Download Webinar Documents</p>
                         <!--<?php if (!empty($webinar['youtube'])) { ?>
                            <p>Download Webinar Documents</p>
                        <?php } else { ?>
                            <p>Register</p>
                        <?php } ?>
						 <span class="register-details-txt">Please enter your details for registration:</span>-->

                       
                        <?php
                        $form = ActiveForm::begin([
                                    'id' => 'registration-form',
                                    'action' => Url::to(['webinar/registration']),
                                    'options' => [
                                    //'class' => 'form-horizontal',
                                    //'enctype' => 'multipart/form-data'
                                    ],
                        ]);
                        ?>
                        <div class="row row-mar">
                            <div class="col-md-6 mb-3 col-padding">
                                <?= $form->field($model, 'fname')->textInput(['autofocus' => true, 'maxlength' => true, 'placeholder' => "First Name"]) ?>
                            </div>
                            <div class="col-md-6 mb-3 col-padding">
                                <?= $form->field($model, 'lname')->textInput(['placeholder' => 'Last Name']) ?>
                            </div>
                            <div class="col-md-12 mb-3 col-padding">
                                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter Email']) ?>
                            </div>
                            <div class="col-md-12 mb-3 col-padding">
                                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Contact Number']) ?>
                            </div>
                            <div class="col-md-12 mb-3 col-padding">
                                <?= $form->field($model, 'company')->textInput(['placeholder' => 'Company Name']) ?>
                            </div>
                            <div class="col-md-12 mb-3 col-padding">
                                <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                            </div>
                            <!--Hidden Fields :: Start -->
                            <?= $form->field($model, 'type')->hiddenInput(['value' => 'Webinar'])->label(false); ?>
                            <?= $form->field($model, 'comments')->hiddenInput(['value' => $webinar['title']])->label(false); ?>
                            <!--Hidden Fields :: End -->
                            <div class="col-md-12 mar-top-20 col-padding">
                                <div class="md-3"><button class="btn btn-primary submitBtn" type="submit">Download Webinar Documents</button></div>
                                <!--  <?php if (!empty($webinar['youtube'])) { ?>
                                       <div class="md-3"><button class="btn-block submitBtn" type="submit">Download Webinar Documents</button></div>
                                <?php } else { ?>
                                      <div class="md-3"><button class="btn-block submitBtn" type="submit">Submit</button></div>
                            <?php } ?> -->
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
                <div class="content-column">
                    <div class="basic-content">
                        <div class="article-content">
                            <div><?= base64_decode($webinar['description']) ?></div>
                            <b>Table Of Content</b>
                            <div>
                            <?= base64_decode($webinar['table_of_content']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $js = <<<JS

$('form#registration-form').on('beforeSubmit', function(e) {
	var form = $(this);
	if (form.find('.has-error').length) {
	  return false;
	}
	$('.submitBtn').hide();//onec clicked the hide the submit button
	// submit form
	$.ajax({
		url: form.attr('action'),
		type: 'post',
		data: form.serialize(),
		success: function (response) {
			if(response != "SUCCESS"){
				console.log(response);
				return false;
			}
			alert('Registered Successfully.');
			location.reload();
		}
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});

JS;

    $this->registerJs($js);
    ?>


