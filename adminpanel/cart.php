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
<link href="css/checkout.css" rel="stylesheet" type="text/css">
<link href="css/shopping.css" rel="stylesheet" type="text/css">
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
    	
        
        	<!--top_nav-->
       	  	<?php include_once "includes/ui_top.php"; ?>
            <!--top_nav_end-->
            
            
            
            
            <div class="container_inner">
            
            <!--box1-->
            <div class="box1">
			        <?php
					if($_SESSION['cart_prodList']>0){
					?>
            	<div class="shopping">
                	<div class="s_hd">
                    	Shopping Basket
                    </div>
					<div class="shop_row1" style="border-bottom:none">
                    	<div class="sh_left1">
                        	<div class="s_hd1">
                            	PRODUCT
                            </div>
                        </div>
                        <div class="sh_left2">
                        	<div class="s_hd1">
                            	LICENSE
                            </div>
                        </div>
                        <div class="sh_left3">
                        	<div class="s_hd1" style="text-align: right;">
                            	PRICE
                            </div>
                        </div>
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
                    <div class="shop_row1" style="border-top:none;">
                    	<div class="sh_left1">
                            <div class="img">
                            	<?php if($det3!="" && file_exists('articleImages/'.$det3)){ ?>
								<img src="<?=SITE_ART_PATH.$det3?>"  width="100%" >
								<?php }else{ ?>
								<img src="<?=SITE_ART_PATH?>industryarc.png"  width="100%" >
								<?php }?>
                            </div>
                            <div class="s_cont">
                            	<a class="s_con1" href="report.php?id=<?=$curl?>">
                                	<?=$det2?>
                                </a>
                                <div class="s_con2">
                                	Selected Licence : <?=$prod[0]=="SL"?'Sigle User':'Corporate Licence'?> / $<?=$_SESSION['cart_prodPrice'.$prodIds[$i-1]]?>
                                </div>
                                <a class="s_con3" href="javascript:void(0)" onClick="removeFromCart('<?=$prodIds[$i-1]?>')">
                                	REMOVE<i class="fa fa-times"></i>
                                </a>
                                <?php /*?><a class="s_con4" href="#">
                                	Apply Promo Code
                                </a><?php */?>
                            </div>
                        </div>
                        <div class="sh_left2">
                            <select class="form-control" >
                                <option <?php if($prod[1]=="SL"){ ?> selected="selected" <?php }?> value="SL">Single User License</option>
                                <option <?php if($prod[1]=="CL"){ ?> selected="selected" <?php }?> value="CL">Corporate Licence</option>
                            </select>
                        </div>
                        <div class="sh_left3">
                            <div class="price1">
                            	$<?=$_SESSION['cart_prodPrice'.$prodIds[$i-1]]?>
                            </div>
                        </div>
                    </div>
                    <?php } }?>
                    
                    <div class="shop_row1" style="margin-top: 15px;">
                        <div class="row2_left1">
                        	<label>
                            	<input id="pay_mode1" type="radio" value="payment" name="pay_mode" checked="checked">		
                                <img src="images/cards.jpg">
                            </label>                            
                        </div>
                        
                        <div class="row2_left1">
                        	<label>
                            	<input id="pay_mode2" type="radio" value="wiretransfer" name="pay_mode" onChange="gotoCheckout('<?=$_SESSION['user_id']?>')" >		
                                <img src="images/wire.jpg">
                            </label>    
                        </div>
                        
                        <div class="row2_left1 sty1" style="text-align: right;">
                        	Sub Total :<br>
							Grand Total : 
                        </div>
                        
                        <div class="row2_left1 sty1" style="text-align: right;">
                        	 $<?=$_SESSION['cart_totPrice']?><br>
							 <b>$<?=$_SESSION['cart_totPrice']?></b>
                        </div>
                    </div>
                    
                    <div class="shop_row1" style="margin-top: 15px;">
                    
                    	<div class="sh_sub1">
                        	<a class="rfp C_SHOP" href="index.php">                           
                           	   <i class="fa fa-chevron-left"></i>CONTINUE SHOPPING
                            </a>
                        </div>
                        
                    	<div class="ch_sub sh_sub" style="float: right;">
                            <div class="sub">
                                <a class="rfp C_SHOP" href="javascript:void(0)" onClick="gotoCheckout('<?=$_SESSION['user_id']?>');">                           
								  proceed to Checkout <i class="fa fa-chevron-right"></i>
								</a>
                                <script language="javascript" >
								function gotoCheckout(uid){
									if(uid!=""){
										var paymode;
										if(document.getElementById('pay_mode1').checked){
											paymode="payment";
										}
										if(document.getElementById('pay_mode2').checked){
											paymode="wiretransfer";
										}
										alert(paymode);
										if(paymode=="payment"){
											window.location='checkout.php';
										}
										if(paymode=="wiretransfer"){
											window.location='wireTransfer.php';
										}
									}else{
										alert("Please login to Continue");
										window.location="login.php";
									}
								}
								</script> 
                            </div>
                        </div>
                    </div>
                </div>
				<?php }else{ ?>
				<div class="shopping">
                	<div class="s_hd">
                    	Shopping Basket
                    </div>
					
                    <div class="shop_row1">
					<table width="100%" cellspacing="0" cellpadding="10px"  >
		<tr>
                        	<td width="100%" valign="top" style="padding:20px;color:#CC0000;font-family:Arial, Helvetica, sans-serif" >
							No Records Found.
							</td>
						</tr>
		</table>
					</div>

				<?php }?>
            </div>
            </div>
            <!--box1_end-->
        </div>
    </div>
    <script >
	function removeFromCart(reportid){
		if(reportid!=""){
			$.ajax({url:"ajax.php",type: 'POST',data: {'action': 'removeFromCart', 'reportid': reportid },success:function(result){
				 //alert(result);
				 window.location='cart.php';
			}});
		}
	}
	</script>
    
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
