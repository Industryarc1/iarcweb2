<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;

?>
<div class="item">
    <div class="head">
        <i class="icon-user-view"></i>
        <h4>Contact Us</h4>
    </div>
    <?php //$form = ActiveForm::begin(['id' => 'contact-form','method'=>'post','action'=>'index.php?r=site/save-contacts']); ?>
    <?php $form = ActiveForm::begin(['id' => 'contact-form','method'=>'post']); ?>

    <?= $form->field($contactModel, 'c_fname')->textInput(['placeholder' => 'Full Name','class' => 'form-control'])->label("Full Name") ?>
    <?= $form->field($contactModel, 'c_email')->textInput(['placeholder' => 'Email','class' => 'form-control'])->label("Email Address") ?>
    <?= $form->field($contactModel, 'c_phone')->textInput(['placeholder' => 'Contact No','class' => 'form-control'])->label("Phone No") ?>
    <?= $form->field($contactModel, 'c_message')->textArea(['placeholder' => 'Message','class' => 'form-control'])->label("Message") ?>
	<?= $form->field($contactModel, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12">{input}</div></div>',
                ])->label('Enter Verification Code') ?>

    <div class="form-group">
		<?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary']) ?>
        <!--<button type="submit">SUBMIT</button>-->
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!--
<script type="text/javascript">
$("#contact-form").submit(function(){
	alert($(this).serialize());return false;
	$.ajax({
            url:"index.php?r=site/save-contacts",
            type: "post", //request type,
            data: $(this).serialize(),
			success:function(result){
				if(result){
					//$('#contact-form').find('input:text').val('');
				}
			}
		});
});
</script>
-->
<?php
$script = <<<JS
$("#contact-form").submit(function(){
	//alert($(this).serialize());return false;
	$.ajax({
            url:"site/save-contacts",
            type: "post", //request type,
            data: $(this).serialize(),
			success:function(result){
				//alert(result);return false;
				if(result){
					//$('#contact-form').find('input:text').val('');
				}
			}
		});
});

JS;
$this->registerJs($script);
?>