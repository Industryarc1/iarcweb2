<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
  <div class="row child-nav">
    <div class="breadcrumb col-9 ">
      <ul>
        <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
        <li>Login</li>
      </ul>
    </div>
  </div>
  <div class="main-content login-page">
    <div class="content-area">
      <div class="main-txt">
      <div class="row">
      <div class="login-main">
      <div class="login-form" id="loginForm">
      <h2 class="text-center mar-btm-30">Login</h2>
      <div class="row">
          <?php $form = ActiveForm::begin([
               'id' =>'login-form',
               'action' => ['site/login'],
              ]); ?>
             <div class="col-md-12 mb-3">
               		<?= $form->field($model, 'username', [
               						'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
               						'labelOptions' => [ 'class' => '' ]
               					])->textInput(['maxlength' => true,'placeholder' => "Enter Email"])->label("Email")?>
              </div>
              <div class="col-md-12 mb-3">
               <?= $form->field($model, 'password', [
               						'template' => "{label}\n<div class='input-group'>{input}</div>\n{hint}\n{error}",
               						'labelOptions' => [ 'class' => '' ]
               					])->passwordInput(['maxlength' => true,'placeholder' => "Password"])?>
              </div>
            <div class="col-md-12">
                <div class="login-btn mar-top-20 mar-lr-auto">
                <button class="btn-block submitBtn" type="submit">Login</button></div>
              </div>
              <div class="col-md-12 mar-top-20 ">
                <div class="f-left " style="width:50%;">
                <div class="checkbox">
                   	<?= $form->field($model, 'rememberMe')->checkbox(['template' => "<label>{input} Remember me</label>\n<div class=\"col-lg-8\">{error}</div>"]) ?>
                </div>
                </div>
                <div class="f-left text-right" style="width:50%;"><a href="javascript:void(0)" id="forgotPwd">Forgot Your Password?</a></div>
              </div>
              <div class="col-md-12 mar-top-20 ">
                <div class="md-3 text-center">Not a member yet? <a href="<?=Url::to(['site/registration'])?>">Sign Up</a></div>
              </div>
       <?php ActiveForm::end();?>
      </div>
      </div>
      </div>
      </div>
      </div>
    </div>
  </div>
<?php
$url = Url::to(['site/forgot-password']);
$script = <<<JS
$("#forgotPwd").click(function(e){
	var login_id = $('#loginform-username').val();
	if(login_id !=""){
		$('html').fadeOut(10000);
		$.ajax({
			url: '$url',
			type: 'post',
			data: {'login_id':login_id},
			success: function (response) {
				console.log(response);
				//location.reload();
			}
		});
	}else{
		alert('Please Enter the Email ID');
	}
});
JS;
$this->registerJs($script);
?>
