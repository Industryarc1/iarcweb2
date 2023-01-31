<?php
use yii\helpers\Url;

$js = <<<JS
// get the form id and set the event
$('form.newsletter-form').submit(function(e) {
	 var form = $(this);
	 $('#news_letter').attr('disabled', 'disabled');
	 alert("Please wait!!!!");
	 $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
           console.log(response);
		   alert(response);
		   window.location.reload();
           }
     });
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;

$this->registerJs($js);
?>
<h3>News letter</h3>
<p>Type your email below and receive our daily news and updates for free</p>
<form method="post" action="<?=Url::to(['home/news-latter']);?>" class="newsletter-form">
<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
<label style="display:inline;">
<select id="nl_industry" class="form-control round" name="nl_industry" aria-invalid="false">
</label>
<option value="">--Select Industry--</option>
<?php
foreach($industry as $key=>$value){
	?>
<option value="<?=$key?>"><?=$value?></option>	
<?php
}
?>
</select>
<div class="newsletter">
<label for="nl_email" style="display:inline;">
<input type="email" id="nl_email" aria-label="nl_email"  name="nl_email" placeholder="Email Address..." aria-required="true" aria-invalid="false">
</label>
<button type="submit" id="news_letter">Go</button>
<input type="hidden" id="nl_subcribed_date" name="nl_subcribed_date" value="<?=date("Y-m-d H:i:s")?>">
</div>
</form>
