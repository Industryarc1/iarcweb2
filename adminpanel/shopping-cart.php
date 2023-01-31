<?php include_once "includes/config.php"; ?>
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
<script src="http://ie7-js.googlecod
e.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
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
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
<link href="css/categories.css" rel="stylesheet" type="text/css">

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



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(function() {
		$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });		
	});
</script>

<link href="css/checkout.css" rel="stylesheet" type="text/css">
<link href="css/shopping.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="container">
    	
        
        	<?php include_once "includes/ui_top.php"; ?>
            
            
            <div class="container_inner">
            
            <!--breadcrumbs-->
            <!--<div class="breadcrumbs">
                <ul>
                    <li style="color: #2299e5; margin-right: 8px;">You are here:</li>
                    <li><a href="#">Home</a></li>
                    <li>Checkout</li>                        
                </ul>
            </div>-->
            <!--breadcrumbs_end-->
            
            
            <!--box1-->
            <div class="box1">
            	<div class="shopping">
                	<div class="s_hd">
                    	Shopping Basket
                    </div>
                    <div class="shop_row1">
                    	<div class="sh_left1">
                        	<div class="s_hd1">
                            	PRODUCT
                            </div>
                            <div class="img">
                            	<a href="#"><img src="images/fert.jpg"></a>
                            </div>
                            <div class="s_cont">
                            	<a class="s_con1" href="#">
                                	Fertilizers Market 
                                </a>
                                <div class="s_con2">
                                	Selected Licence : Single User License / $4515 
                                </div>
                                <a class="s_con3" href="#">
                                	REMOVE<i class="fa fa-times"></i>
                                </a>
                                <a class="s_con4" href="#">
                                	Apply Promo Code
                                </a>
                            </div>
                        </div>
                        <div class="sh_left2">
                        	<div class="s_hd1">
                            	LICENSE
                            </div>
                            
                            <select class="form-control">
                                <option selected="selected" value="Single User License">Single User License</option>
                                <option value="Group User License">Group User License</option>
                                <option value="Site User License">Site User License</option>
                                <option value="Global User License">Global User License</option>
                            </select>
                        </div>
                        <div class="sh_left3">
                        	<div class="s_hd1" style="text-align: right;">
                            	PRICE
                            </div>
                            <div class="price1">
                            	$4515
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="shop_row1" style="margin-top: 15px;">
                        <div class="row2_left1">
                        	<label>
                            	<input id="pay_mode2" type="radio" value="paypal" name="pay_mode">		
                                <img src="images/cards.jpg">
                            </label>                            
                        </div>
                        
                        <div class="row2_left1">
                        	<label>
                            	<input id="pay_mode2" type="radio" value="paypal" name="pay_mode">		
                                <img src="images/wire.jpg">
                            </label>    
                        </div>
                        
                        <div class="row2_left1 sty1" style="text-align: right;">
                        	Sub Total :<br>
							Grand Total : 
                        </div>
                        
                        <div class="row2_left1 sty1" style="text-align: right;">
                        	 $4515<br>
							 <b>$4515</b>
                        </div>
                    </div>
                    
                    <div class="shop_row1" style="margin-top: 15px;">
                    
                    	<div class="sh_sub1">
                        	<a class="rfp C_SHOP" href="#">                           
                           	   <i class="fa fa-chevron-left"></i>CONTINUE SHOPPING
                            </a>
                        </div>
                        
                    	<div class="ch_sub sh_sub" style="float: right;">
                            <div class="sub">
                                
                                <input type="submit" value="PROCEED TO CHECKOUT">
                                <img src="images/ch_arr.png" style="float: right;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!--box1_end-->
        </div>
    </div>
    
    
    <!--footer-->
    <?php include_once "includes/ui_footer.php"; ?>
    <!--footer_end-->
    
   
    <!--clients1_caraousal-->
     <script src="js/clients.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript">
			$(function() {
				
				$('#clients1').carouFredSel({
					responsive: true,
					width: '100%',
					prev: '#prev1',
					next: '#next1',
					scroll: {
							items: 1,
							duration: 1250,
							timeoutDuration: 2500,
							easing: 'swing',
							/*pauseOnHover: 'immediate'*/
							pauseOnHover: true   
						},
					items: {
						
					visible: {
							min: 1,
							max: 1,
						}						
					}
					
									
				});
				
			});

		</script>
        <!--clients1_caraousal_end-->
        
        <script type="text/javascript" language="javascript">
			$(function() {
				
				$('#disc1').carouFredSel({
					responsive: true,
					width: '100%',
					scroll: {
							items: 1,
							duration: 1250,
							timeoutDuration: 4000,
							easing: 'swing',
							/*pauseOnHover: 'immediate'*/
							pauseOnHover: true   
						},
					items: {
						
					visible: {
							min: 1,
							max: 1,
						}						
					}
					
									
				});
				
			});

		</script>
        <!--clients1_caraousal_end-->
    
    
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
