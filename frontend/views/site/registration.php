<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'IndustryArc | New User Registration!';
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <div class="row child-nav">
      <div class="breadcrumb col-9 ">
        <ul>
          <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
          <li>Registration</li>
        </ul>
      </div>
    </div>
    <div class="main-content login-page">
      <div class="content-area">
        <div class="main-txt ">

        <div class="row">
        <div class="login-main">
        <div class="login-form" id="SignUpForm">
        <h2 class="text-center mar-btm-30">Sign Up</h2>
 	<?php $form = ActiveForm::begin([
 					'id' =>'registration-form',
 					'action' => ['site/registration'],
 				]); ?>
 				 <div class="row">
                 <div class="col-md-12 mb-3">
                  <?= $form->field($model, 'fname', [
                        'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => '' ]
                       ])->textInput(['maxlength' => true,'placeholder' => "First Name"])->label(False)?>
                 </div>
                 <div class="col-md-12 mb-3">
                   <?= $form->field($model, 'lname', [
                     'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                     'labelOptions' => [ 'class' => '' ]
                    ])->textInput(['maxlength' => true,'placeholder' => "Last Name"])->label(False)?>
                 </div>
                 <div class="col-md-12 mb-3">
                      <?= $form->field($model, 'phone', [
                         'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                         'labelOptions' => [ 'class' => '' ]
                        ])->textInput(['maxlength' => true,'placeholder' => "Contact Number"])->label(False)?>
                 </div>
                 <div class="col-md-12 mb-3">
                  <?= $form->field($model, 'email', [
                        //'enableAjaxValidation' => true,
                        'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => '' ]
                       ])->textInput(['maxlength' => true,'placeholder' => "Enter Email"])->label(False)?>
                 </div>
                 <div class="col-md-12 mb-3">
                      <?= $form->field($model, 'password', [
                         'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                         'labelOptions' => [ 'class' => '' ]
                        ])->passwordInput(['maxlength' => true,'placeholder' => "Password"])->label(False)?>
                 </div>

                 <div class="col-md-12 mb-3">
                       <?= $form->field($model, 'confirm_password', [
                         'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
                         'labelOptions' => [ 'class' => '' ]
                        ])->passwordInput(['maxlength' => true,'placeholder' => "Confirm Password"])->label(False)?>
                 </div>
                <div class="col-md-12 mb-3">
                    <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY"></div>
                </div>

                 <div class="col-md-6 mar-top-20 mar-lr-auto">
                   <div class="md-3"><button class="btn-block">Submit</button></div>
                 </div>

                 <div class="col-md-12 mar-top-20 ">

                   <div class="md-3 text-center">Already a member? <a href="<?=Url::to(['site/login'])?>">Login</a></div>
                 </div>
       </div>
  <?php ActiveForm::end();?>
        </div>
        </div>
        </div>
        </div>
      </div>
    </div>
