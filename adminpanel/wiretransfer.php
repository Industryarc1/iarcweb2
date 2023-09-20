<?php include_once "includes/config.php";?>
<?php if(!isset($_SESSION['user_id'])){ $allClasses->forRedirect ("cart.php");exit; } ?>
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
<link href="css/checkout.css" rel="stylesheet" type="text/css">
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
    	
        	<div class="top_fix">
        	<!--top_nav-->
       	  	<?php include_once "includes/ui_top.php";?>
            <!--top_nav_end-->
            
            
            
            </div>
            <div class="m_bott"></div>
            <!--header_end-->
            
            
            <div class="container_inner">
            
            <!--breadcrumbs-->
            <div class="breadcrumbs">
                <ul>
                    <li style="color: #2299e5; margin-right: 8px;">You are here:</li>
                    <li><a href="#">Home</a></li>
                    <li>Wire Transfer</li>                        
                </ul>
            </div>
            <!--breadcrumbs_end-->
            
            
            <!--box1-->
            <div class="box1">
            	<div class="chck_pg">
                	<div class="chck_left">
                        <div class="ch_hd">
                            Billing Information
                        </div>
                        <div class="ch_form">
                        	<form>
                            	<div class="txt-fld ch-txt-fld">
                                    <label for="">Full Name </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="Full Name" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                              </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Email </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="Email" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Company Name </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="Company Name" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Contact No </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="Contact No" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Address </label>
                                    <div class="req_inp">
                                   	 	<input type="text" placeholder="Address" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">State </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="State" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">City </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="City" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Country </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="Country" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Zipcode </label>
                                    <div class="req_inp">
                                    	<input type="text" placeholder="City" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="txt-fld ch-txt-fld">
                                    <label for="">Security Code </label>
                                    <img src="images/captcha_code_file.php.jpg" style="float: left;">
                                    <div class="req_inp" style="width: 30%;">
                                    	<input type="text" placeholder="Security Code" name="" class="good_input" >
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  
                                  
                            </form>
                        </div>
                        <div class="ch_hd">
                               Payment Option
                      </div>                          
                      
                          
                          <div class="ch_form_fter">
                              <div class="ch_con">
                              By clicking on "continue to secure payment" you agree to our <a href="term-and-conditions.php" target="_blank">terms & condition</a> and <a href="privacy-policy.php" target="_blank">privacy policy</a>. </div>  
                              
                              <div class="ch_sub">
                              	<div class="sub"><img src="images/ch_arr.png"><input type="submit" value="Continue"></div>
                              </div>
                          </div>                       
                          
                  </div>
                    
                    <div class="chck_right">
                    	<div class="report_1">
                        	<div class="r_1">
                            	Selected Report(s):
                            </div>
							<?php
							$prodIds = explode(',',$_SESSION['cart_prodList']);
							$totalAmount="";
							$stmt = $mysqli->prepare("select t1.inc_id,t1.title,t1.image,t1.slp,t1.clp,t1.curl from zsp_posts t1 where t1.inc_id=? ");
							//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
							for($i=count($prodIds); $i>0; $i--){
								$prod = explode('-',$prodIds[$i-1]);
								$stmt->bind_param('s',$prod[0]);
								$stmt->execute();
								$stmt->store_result();
								if($stmt->num_rows>0){
									$stmt->bind_result($det1,$det2,$det3,$slp,$clp,$curl);
									$stmt->fetch();
								?>
                            <div class="r_2">
                            	<?=$det2?>
                            </div>
                            <div class="r_3">
                            	Price:   <span style="color: #dd4300">$<?=$_SESSION['cart_prodPrice'.$prodIds[$i-1]]?> </span>
                            </div>
                            <div class="r_4">
                            	Licence Type:  <?=$prod[1]=="SL"?'Sigle User':'Corporate Licence'?>
                            </div>
							<?php 
							}
							}?>
                        </div>
						
                        
                        <div class="tot_cost">
                        	<div class="c_left">
                            	Total Cost
                            </div>
                            <div class="c_right">
                            	$3930
                            </div>
                        </div>
                        
                        
                        <div class="report_1 report_2">
                        	<div class="assis">
                            	<div class="img">
                                	<img src="images/call.png">
                                </div>
                                <div class="ass_con">
                                	 <span style="font-family:Verdana, Geneva, sans-serif; color:#0584Ae; font-size:14px;">NEED ASSISTANCE?</span><br>
									 <span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold;">CALL US OR WRITE US</span>
                                </div>
                            </div>
                            
                            <div class="chec_cont">                            	
                                <span style="color: #e26d25; font-size: 14px;">Call Us</span><br>
                                (U.S. - Canada toll free )<br>
                                +1-234-567-8989<br>
                                Int'l : +1 (123) 456-7899
                                <img src="images/or_n.jpg">
                                <a href="#">sales@industryarc.com</a>
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
    <?php include_once "includes/ui_footer.php";?>
    <!--footer_end-->
    
   
    <!--popup-->

    <!--popup_end-->
    

    
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
