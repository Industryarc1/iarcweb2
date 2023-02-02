<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\HomeAsset;
use frontend\assets\BaseAsset;

/* if currentUrl is null then its a home page in that case render required Css file only */
$currentUrl =\Yii::$app->request->url;
//AppAsset::register($this);
BaseAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--<html lang="<?= Yii::$app->language ?>">-->
<html lang="en">
<head>
    <meta name="robots" content="noindex">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>


<script> (function(ss,ex){ window.ldfdr=window.ldfdr||function(){(ldfdr._q=ldfdr._q||[]).push([].slice.call(arguments));}; (function(d,s){ fs=d.getElementsByTagName(s)[0]; function ce(src){ var cs=d.createElement(s); cs.src=src; cs.async=1; fs.parentNode.insertBefore(cs,fs); }; ce('https://sc.lfeeder.com/lftracker_v1_'+ss+(ex?'_'+ex:'')+'.js'); })(document,'script'); })('wVkO4XZb1wO8Z6Bj'); </script>

</head>
<body class="bg-white">
<?php $this->beginBody() ?>


<div class="wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
    </div>
  
	<?= $this->render('header.php')?>
	<?= $content ?>
	<?=$this->render('footer.php')?>

<?php
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
 
$script = <<<JS

	if(navigator.userAgent.indexOf("MSIE ") > -1 || navigator.userAgent.indexOf("Trident/") > -1) {
            let rd_nav = document.querySelector('.rd-page-navigation');
            let page_content = document.querySelector('.content-column');
            rd_nav.style.position = 'static';
            document.addEventListener('scroll',function() {
              if(window.pageYOffset > document.querySelector('.content-column').offsetTop) {
                //user has scrolled past top section, change nav position to fixed
                rd_nav.style.position = 'fixed';
                rd_nav.style.top = '70px';
                rd_nav.style.left = window.innerWidth > 1200 ? (window.innerWidth - 1200)/2 + 'px' : '0px' ;
                rd_nav.style.maxWidth = '240px';
                page_content.style.width = '100%';
                page_content.style.marginLeft = '20%';
              }
              else {
                //user is coming back up to the top section, change nav position to static
                rd_nav.style.position = 'static';
                page_content.style.width = '80%';
                page_content.style.marginLeft = '0';
              }
            });

          }

   window.is_custom_checkout = true;

$('.report-scroll a').click(function(){
     //console.log($(this));
     $('.report-scroll a').removeClass('active');
			 $(this).addClass('active');
				// $("li.tab").closest("a").css( "background-color", "red" );
	 });
$('.report-scroll a').on('click', function() {
    var scrollAnchor = $(this).attr('data-scroll'),
        scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 28;
    $('body,html').animate({
        scrollTop: scrollPoint
    }, 500);
    return false;
});
$('.report-pr-slideup a').on('click', function() {
    var scrollAnchor = $(this).attr('data-scroll'),
        scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 28;

    $('body,html').animate({
        scrollTop: scrollPoint
    }, 500);
    return false;
});

$(window).scroll(function() {
    var windscroll = $(window).scrollTop();
    if (windscroll >= 10) {

        $('.report-content section').each(function(i) {
            if ($(this).position().top <= windscroll ) {
                $('.report-content-nav a.active').removeClass('active');
                $('.report-content-nav a').eq(i).addClass('active');
            }
        });

    } else {


        $('.report-content-nav a.active').removeClass('active');
        $('.report-content-nav a:first').addClass('active');
    }

}).scroll();
$(window).resize(function() {
    if ($(window).width() < 960) {
    var p=$('#report p');
    var divh=$('#report').height();
    while ($(p).outerHeight()>divh) {
    $(p).text(function (index, text) {
        return text.replace(/\W*\s(\S)*$/, '123');
    });
}
}
});
 /* To change the side menu to button in mobile view */
 if(('$controller' =='reports' || '$controller' =='press-releases' || '$controller' =='news-article') && ('$action' == 'category-wise-report' || '$action' == 'list-press' || '$action' == 'list-article')){

	$('.select-category a').click(function(){
		$('.caterogy-list').addClass('slideup');
		$('body').toggleClass('no-scroll');
		$('.fadeeffect').toggleClass('show');
		$('.close-category').show();
	});

	$('.close-category').click(function(){
		$('.caterogy-list').removeClass('slideup');
		$('body').toggleClass('no-scroll');
		$('.fadeeffect').toggleClass('show');
		$(this).hide();
	});
}else if(('$controller' =='reports' && ('$action' =='report' || '$action' =='research')) ||
('$controller' == 'press-releases' && '$action' == 'press-report')){

	$('.report-pr-slideup').click(function(){
		$('.report-content-nav-rsp').addClass('slideup');
		$('body').toggleClass('no-scroll');
		$('.fadeeffect').toggleClass('show');
		$('.close-category').show();
	});

	$('.close-category').click(function(){
		$('.report-content-nav-rsp').removeClass('slideup');
		$('body').toggleClass('no-scroll');
		$('.fadeeffect').toggleClass('show');
		$(this).hide();
	});
}

/* to load data by view more button */
$('.some-list-report').simpleLoadMore({
      item: 'div',
      count: 70
    });
    $('.some-list-pr').simpleLoadMore({
          item: 'div',
          count: 30
        });

	/* to change the menu in Mobile view :: start */
	$( document ).ready(function() {
    $('.carousel').carousel({
 			interval: false
 			});
	$('[data-toggle="tooltip"]').tooltip();
 });
	$("#cssmenu").menumaker({
		title: "",
		format: "multitoggle"
	});
	/* to change the menu in Mobile view :: end */
JS;
$this->registerJs($script);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
