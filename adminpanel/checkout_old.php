<?php include_once "includes/config.php"; 
if(!$_SESSION['cart_prodList']>0){
$allClasses->forRedirect ("cart.php");
}
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

</head>

<body>
	<div class="container">
    	
        	<?php include_once "includes/ui_top.php"; ?>
            
            
            <div class="container_inner">
            
            <!--breadcrumbs-->
            <div class="breadcrumbs">
                <ul>
                    <li style="color: #2299e5; margin-right: 8px;">You are here:</li>
                    <li><a href="index.php">Home</a></li>
                    <li>Checkout</li>                        
                </ul>
            </div>
            <!--breadcrumbs_end-->
            
            
            <!--box1-->
            <div class="box1">
            	
                <div class="col4">
            	<!--col1-->
            	<?php include_once "includes/ui_cat.php"; ?>
				
				
                <!--col1_end-->
                
                <?php include_once "includes/ui_subscribe.php"; ?>
                
                 <?php include_once "includes/ui_articles.php"; ?>
                
                
                </div>
                
                <!--col2-->
				
                <div class="col2">
                	<div class="row1_1" style="margin-top: 0px;">
                    	<h1 class="hd1 main_hd">
							<div class="design1">
								<div class="r_posts_hd">
								<a href="cart.php">My Cart</a>
								</div>
								<div id="right-triangle"></div>
							</div>
							<div class="design2">
								<div class="r_posts_hd">
								<a href="checkout.php">Billing Address</a> 
								</div>
								<div id="right-triangle"></div>
							</div>
							<div class="design3"> 
								<div class="r_posts_hd">
								<a href="#">PAY WITH PAYPAL</a>
								</div>
								<div id="right-triangle"></div>
							</div>
                        </h1>
                       
<div class="rfp_pg">
						
						
                        <div style="padding:10px">
						<?php /*?><p><u>REPORT</u> : <?=$rep4?></p><?php */?>
                        <form action="gotopayment.php" method="post" class="pop_form">
                  		
                              <div class="txt-fld">
                                <label for="">First Name <span>*</span></label>
                                <input id="" class="good_input" name="txtFName" type="text" placeholder="Enter First Name" required>
                              </div>
                              <div class="txt-fld">
                                <label for="">Last Name <span>*</span></label>
                                <input id=""  type="text" name="txtLName" placeholder="Enter Last Name" required>
                              </div>
                              <div class="txt-fld">
                                <label for="">Email <span>*</span></label>
                                <input id=""  type="text" name="txtEmail" placeholder="Enter Email" required>
                              </div>
                              <div class="txt-fld">
                                <label for="">Phone <span>*</span></label>
                                <input id=""  type="text" name="txtPhone" placeholder="Enter Phone Number" required>
                              </div>
							  <div class="txt-fld txt-fld2">
                                <label for="">Address 1 <span>*</span></label>
                                <input id=""  type="text" name="txtAddr1" placeholder="Enter Address" required>
                              </div>
							   <div class="txt-fld txt-fld2">
                                <label for="">Address 2 <span>*</span></label>
                                <input id=""  type="text" name="txtAddr2" placeholder="Enter Address" required>
                              </div>
                              <div class="txt-fld">
                                <label for="">City <span>*</span></label>
                                <input id=""  type="text" name="txtCity"  placeholder="Enter City" required>
                              </div>
                              <div class="txt-fld">
                                <label for="">Pincode</label>
                                <input id=""  type="text" name="txtPin" placeholder="Enter Pincode">
                              </div>
                              <div class="txt-fld txt-fld2">
                                <label for="">Country<span>*</span></label>
                                <!--<input id=""  type="text" name="txtAddr1" placeholder="Enter Address" required>-->
								<select name="txtCountry" style="width:100%" required  >
									<option value="" >Country</option>
									<?php
									$cs=mysqli_query($mysqli,"select * from tbl_countries order by countries_name ");
									while($c=mysqli_fetch_array($cs)){
									?>
									<option value="<?=$c['countries_name']?>" style="padding:5px;" ><?=$c['countries_name']?></option>
									<?php }?>
								</select>
                              </div>
                              
                              <div class="btn-fld">
							  
                                <input type="submit" name="butCheckout" value="Pay with Paypal" class="pop_submit">
                              </div>
                     </form>
	
	
	</div>                        
                     </div>
					 
                        
                        
                    </div>  
                                 
                </div>
				
                <!--col2_end-->
                
                
                <!--col3-->
                <?php include_once "includes/ui_cart.php";?>
                <!--col3_end-->
                
            </div>
            </div>
            <!--box1_end-->
        </div>
    </div>
    
    
    <?php include_once "includes/ui_footer.php"; ?>
    
    
    
    
    
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
