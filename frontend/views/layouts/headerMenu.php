<?php

use yii\helpers\Url;
use frontend\helper\CommonHelper;

$arrReportMenu = CommonHelper::reportMenu();
//echo '<pre>';print_r($arrReportMenu);
//exit;

$utmsrch = !empty($_GET['utm_source'])?$_GET['utm_source']:'';
$utmmedh = !empty($_GET['utm_medium'])?$_GET['utm_medium']:'';
$utmcmph = !empty($_GET['utm_campaign'])?$_GET['utm_campaign']:'';	
$utmidh = !empty($_GET['utm_id'])?$_GET['utm_id']:'';	
$utmtermh = !empty($_GET['utm_term'])?$_GET['utm_term']:'';	
$utmcontenth = !empty($_GET['utm_content'])?$_GET['utm_content']:'';	
$utmParamh = !empty($utmsrch)?$utmsrch.'&utm_medium='.$utmmedh.'&utm_campaign='.$utmcmph.'&utm_id='.$utmidh.'&utm_term='.$utmtermh.'&utm_content='.$utmcontenth.'':'';
?>
<nav class="main-nav row">

    <div class=" logo-nav-button rsp-content"> <a href="<?= Url::to(['site/index']) ?>">
    <img src="<?= Yii::$app->request->baseUrl ?>/images/Arc_logo.png" alt="logo"></a> </div>
    <div class="logo col-3 rsp-hide"> <a href="<?= Url::to(['site/index']) ?>" class="">
    <img src="<?= Yii::$app->request->baseUrl ?>/images/Arc_logo.png" width="" height="" alt="IndustryARC" border="0"></a>
     </div>
    <div class="search">
    <?php
    						$searchKey = filter_var(Yii::$app->session->get('searchKey'), FILTER_SANITIZE_STRING);
    						unset($_SESSION['searchKey']);
    					?>
    				<form autocomplete="off" action="<?=Url::to(['search/search'])?>" method="get">
        	<!--<input type="search" placeholder="Search..." >-->
        <label for="search" style="display:inline;">
        <input type="text" name="searchKey" aria-label = "search" list="report-titles" value="<?=(!empty($searchKey))?$searchKey:NULL;?>" placeholder="Search..">
        </label>
          <datalist id="report-titles"> </datalist>
          <button type="submit" aria-label="submit"></button>
         </form>
    </div>
     <div class="main-menu col-9" id="cssmenu">
        <ul>
            <li><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
            <li class=""><a href="javascript:void(0)">About Us</a>
                <ul>
                    <li><a href="<?= Url::to(['site/about']) ?>">About Company</a></li>
                    <!--<li><a href="<?= Url::to(['site/team']) ?>">Team</a></li>-->
                </ul>
            </li>
            <li class=""><a href="javascript:void(0)">Market Reports</a>
                <ul>
                    <?php
                    $menu = '';
                    foreach ($arrReportMenu as $reportMenu) {
                        $catUrl = Url::to(['Domain/' . $reportMenu['code'] . '/' . $reportMenu['seo_keyword']]);
                        $menu .= '<li class=""><a href="' . $catUrl . '">' . $reportMenu['name'] . '</a>';
                        $arrChild = !empty($reportMenu['children']) ? $reportMenu['children'] : [];
                        if ($arrChild) {
                            $menu .= '<ul>';
                            foreach ($arrChild as $childMenu) {
                                $subCatUrl = Url::to(['Domain/' . $childMenu['code'] . '/' . $childMenu['seo_keyword']]);
                                $menu .= '<li><a href="' . $subCatUrl . '">' . preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', ' ', $childMenu['name']) . '</a></li>';
                            }
                            $menu .= '</ul>';
                        }
                        $menu .= '</li>';
                    }
                    echo $menu;
                    ?>
                </ul>

            </li>
            <li class=""><a href="javascript:void(0)">Knowledge Store</a>
                <ul>
                    <li><a href="<?= Url::to(['press-releases/list-press']) ?>">Press Releases</a></li>
                    <li><a href="<?= Url::to(['news-article/list-article']) ?>">Articles</a></li>
                    <li><a href="<?= Url::to(['webinar/list-webinar']) ?>">Webinars</a></li>
                    <li><a href="<?= Url::to(['whitepaper/list-whitepaper']) ?>">White Papers</a></li>
                </ul>
            </li>
			<?php if($utmParamh!=''){ ?>
				<li><a href="<?= Url::to(['home/contact-us','utm_source'=>$utmParamh]) ?>">Contact Us</a></li>
			<?php }else{ ?>
				<li><a href="<?= Url::to(['home/contact-us']) ?>">Contact Us</a></li>
			<?php } ?>	
            <!--<li><a href="<?= Url::to(['site/login']) ?>">Login</a></li>-->
        </ul>
    </div>
</nav>


<?php
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$serchUrl = Url::to(['search/search-options']);
$js = <<<JS

	/* auto suggestion for search:: start */
	$('[name="searchKey"]').keyup(function() {
		var searchKey = $(this).val();
		if(searchKey.length>3){
			$.ajax({
				url: '$serchUrl',
				type: 'post',
				data: {'searchKey':searchKey,'$csrfParam':'$csrfToken'},
				success: function (response) {
					console.log(response);
					if(response != ''){
						$('#report-titles').html(response);
					}else{ return false; }
				}
			});
		}else{
			$('#report-titles').html('');
		}
	});
	/* auto suggestion for search:: End */
JS;
$this->registerJs($js);
?>
