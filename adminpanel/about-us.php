<?php include_once "includes/config.php";
	$stmt1 = $mysqli->prepare("select content from zsp_content where page_name='About Us' ");
	//$stmt1->bind_param('s',$_REQUEST['title']);
	$stmt1->execute();
	$stmt1->store_result();
	
	$stmt1->bind_result($c_content);
	$stmt1->fetch();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE7">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lte IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js&quot; type="text/javascript"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js&quot; type="text/javascript"></script>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="css/ie8.css" />
<![endif]-->

<script>
  "'article footer header nav section'".replace(/\w+/g,function(n){document.createElement(n)})
</script>
<title>Welcome to Industry Arc</title>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/anim.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,600italic,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
<link href="css/categories.css" rel="stylesheet" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<!--smooth scroll to top-->
<script type="text/javascript">
	$(document).ready(function(){ 
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	}); 
	
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

});
</script>
<style>
.scrollup{
	width: 40px;
	height: 40px;
	text-indent: -9999px;
	position: fixed;
	bottom: 60px;
	right: 17px;
	display: none;
	z-index: 2222222;
	background-image: url(images/icon_top.png);
	background-repeat: no-repeat;
	opacity: 0.7;
}
</style>
<!--smooth scroll to top-->

<!--Responsive_menu-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<link rel="stylesheet" href="js/dist/slicknav.css">
<!--Responsive_menu-->




<!-- bin/jquery.slider.min.css -->
<link rel="stylesheet" href="css/jslider.css" type="text/css">
<link rel="stylesheet" href="css/jslider.blue.css" type="text/css">
<link rel="stylesheet" href="css/jslider.plastic.css" type="text/css">
<link rel="stylesheet" href="css/jslider.round.css" type="text/css">
<link rel="stylesheet" href="css/jslider.round.plastic.css" type="text/css">
<!-- end -->

<script type="text/javascript" src="js/jquery-1.7.1.js"></script>

<!-- bin/jquery.slider.min.js -->
<script type="text/javascript" src="js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="js/tmpl.js"></script>
<script type="text/javascript" src="js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="js/draggable-0.1.js"></script>
<script type="text/javascript" src="js/jquery.slider.js"></script>
<!-- end -->

</head>

<body>
	<div class="container">
    	
        	
            <?php include_once "includes/ui_top.php";?>
            
            <div class="container_inner">
            <!--breadcrumbs-->
            <div class="breadcrumbs">
				<ul>
                    <li style="color: #2299e5; margin-right: 8px;">You are here:</li>
                    <li><a href="index.php">Home</a></li>
					 <li><a href="javascript:void(0)">About Us</a></li>
                </ul>
            </div>
            <!--breadcrumbs_end-->
            
            <!--box1-->
            <div class="box1" style="margin-top: 12px;">
            	<!--col1-->
            	<div class="col4">
                
                	<!--<div class="col1" style="margin-right: 0px; margin-bottom: 15px;">
                		<h1 class="hd">Pricing Range</h1>
                        
                        <div class="layout-slider" style="margin-top: 15px;">
                          <input id="Slider2" type="slider" name="price" value="30000;80000" />
                        </div>
                        <script type="text/javascript" charset="utf-8">
                          jQuery("#Slider2").slider({ from: 5000, to: 150000, heterogeneity: ['50/50000'], step: 1000, dimension: '&nbsp;$' });
                        </script>
                    
                	</div>-->
                
                
                	<?php include_once "includes/ui_cat.php"; ?>
                    
                    
                    <?php include_once "includes/ui_subscribe.php"; ?>
                </div>
                <!--col4_end-->
                
                <!--col5-->
                <div class="col5">
                	
					<?php if($error==""){ ?>
					<div class="col5_right">
					    <div style="float:left;color:#666666" class="td_txt1">About Us </div>
                    	
                    </div>
                	<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    	<tr>
                        	<td width="100%" valign="top">
                            	<table width="100%" cellspacing="0" cellpadding="10px"  >
                                    <tr style="background-color:<?=$col?>">                                        
                                        <td class="f_txt1 td1 tab_content" valign="middle">
                                        	<?php
											$rep7= base64_decode($c_content);
											  $rep7= str_replace('\"', '"', $rep7);
											  $rep7= str_replace("\'", "'", $rep7);
											  $rep7= str_replace('\n', "<br>", $rep7);
											  echo $rep7;
											?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table> 
					<?php }else{?>
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    	<tr>
                        	<td width="100%" valign="top" style="padding:20px;color:#CC0000;font-family:Arial, Helvetica, sans-serif" >
							No Records Found.
							</td>
						</tr>
					</table>
					<?php }?>
                </div>
                <!--col5_end-->
                
            </div>
            <!--box1_end-->
        </div>
    </div>
    
    
   <?php include_once "includes/ui_footer.php"; ?>
    
    <!--animate-->
	<script src="js/jquery-easing-1.js" type="text/javascript"></script>              
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script>new WOW().init();</script> 
    <!--animate_end-->
    
    <!--Responsive_menu-->
	<script src="js/dist/jquery.slicknav.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#menu').slicknav();
    });
    </script>
    <!--Responsive_menu_end-->
    
    <!--top_header_fixed-->
      
	<!--top_header_fixed_end-->
    
     <a href="#" class="scrollup" style="display: none; outline: 0px; border: 0px;">Scroll</a>
</body>
</html>
