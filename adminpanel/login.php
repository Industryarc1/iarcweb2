<?php include_once "includes/config.php"; ?>
<?php if(isset($_SESSION['user_id'])){ $allClasses->forRedirect ("index.php"); } ?>
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
                    <li>Login</li>                        
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
                    	<h1 class="hd1">
                        	Login
                        </h1>
                        
                        <div class="rfp_pg">
						
						<p>Please enter your login details :</p>
						
                        <form action="actions.php" method="post" class="pop_form">
							<?php
						if($_SESSION['stat']=="FAIL"){ echo '<span style="color:red;font-size:12px;" >Unable to register.Please try again.</span>'; $_SESSION['stat']="";}
						
						if($_SESSION['stat']=="EXIST"){ echo '<span style="color:red;font-size:12px;" >Already registered with this E mail. Try different E Mail.</span>'; $_SESSION['stat']="";}
						
						?>
							
							  	
                              <div class="txt-fld txt-fld2">
                                <label for="">User Name</label>
                                <div class="req_inp">
                                   <input id="" class="good_input" name="txtEmail" type="email" placeholder="Enter Username"  required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                          <div class="txt-fld txt-fld2">
                                <label for="">Password</label>
                                
                                <div class="req_inp">
                                    <input id="txtLName"  type="password" name="txtPassword" placeholder="Enter Password" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                               
                                
                              </div>
                              
                              <div class="btn-fld">
                              <img src="images/ch_arr.png">
                                <input type="submit" name="subLogin" value="Login" class="pop_submit">
								<br><br><br>
								New User! <a href="register.php" style="color:#1D6478" >Click Here to register</a>
                              </div>
                     </form>                        
                     </div>
                        
                    </div>  
                                 
                </div>
				
                <!--col2_end-->
                
                
                <!--col3-->
                <?php include_once "includes/ui_right.php";?>
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
