<?php include_once "includes/config.php"; ?>
<?php
if($_POST['addToCart']=="Procure Now"){
	if($_POST['radPrice']!="" && $_POST['hidReport']!=""){
		$stmt1 = $mysqli->prepare("select inc_id,slp,clp,cc from zsp_posts where inc_id=? ");
		$stmt1->bind_param('s',$_POST['hidReport']);
		$stmt1->execute();
		$stmt1->store_result();
		if($stmt1->num_rows>0){
			$stmt1->bind_result($inc_id,$slp,$clp,$cc);
			$stmt1->fetch();
			$prodId = $inc_id.'-'.$_POST['radPrice'];
			$prodQty =1;
			if($_POST['radPrice']=="SL"){ $prodPrice=$slp; }else{ $prodPrice=$clp; }
			if($cc>0){ $prodPrice=round($prodPrice-(($prodPrice/100)*$cc),2); }
			$existingQty=$_SESSION['cart_prodQty'.$prodId];
			if($_SESSION['cart_prodQty'.$prodId]>0){
				//$_SESSION['CSTAT']="empty";
				$allClasses->forRedirect ("cart.php");
				exit;
			}else{
				if($_SESSION['cart_prodList'] == ""){
					$_SESSION['cart_prodList'] = $prodId;
					$_SESSION['cart_totProds'] = 1;
				}else{
					$_SESSION['cart_prodList'] .= ",".$prodId;
					$_SESSION['cart_totProds'] ++;
				}
				//UPDATING PRODUCTS QUANTITY;
				$_SESSION['cart_prodQty'.$prodId] = $prodQty;
				
				//UPDATING PRODUCTS PRICE;
				$_SESSION['cart_prodPrice'.$prodId.'_totPrice'] = $prodQty*$prodPrice;
				$_SESSION['cart_prodPrice'.$prodId] = $prodPrice;
				
				//UPDATING TOTOL PRICE;
				$prodIds = explode(',',$_SESSION['cart_prodList']);
				$_SESSION['cart_totPrice'] = "";
				$prodFound = false;
				for($i=0; $i<count($prodIds); $i++){
					$_SESSION['cart_totPrice'] += ($_SESSION['cart_prodPrice'.$prodIds[$i]] * $_SESSION['cart_prodQty'.$prodIds[$i]]);
				}
				$allClasses->forRedirect ("cart.php");
				exit;
			}
			
		}
		
	}else{
		$_SESSION['CSTAT']="empty";
		$allClasses->forRedirect ($current_page);
		exit;
	}
}
if($_REQUEST['id']!=""){
	$stmt1 = $mysqli->prepare("select *,date_format(pub_date, '%d %M, %Y')as dt_created2 from zsp_posts where curl=? and pub_date < CURRENT_DATE()");
	$stmt1->bind_param('s',$_REQUEST['id']);
	$stmt1->execute();
	$stmt1->store_result();
	if($stmt1->num_rows>0){
		$stmt1->bind_result($rep1,$rep2,$rep3,$rep4,$rep5,$rep6,$rep7,$rep8,$rep9,$rep10,$rep11,$rep12,$rep13,$rep14,$rep15,$rep16,$rep17,$rep18,$rep19,$rep20,$rep21,$rep22,$rep23,$rep24,$rep25,$rep26,$rep27,$rep29,$rep30,$rep31,$rep32,$rep33,$rep34,$rep28);
		$stmt1->fetch();
		$rcat=$rep2;
		$rsubcat=$rep3;
		$ss1=mysqli_query($mysqli,"select * from zsp_catlog_categories where inc_id='".$rcat."'");
		$s1=mysqli_fetch_array($ss1);
		$rcat_name=$s1['name'];
		$ss2=mysqli_query($mysqli,"select * from zsp_catlog_categories where inc_id='".$rsubcat."'");
		$s2=mysqli_fetch_array($ss2);
		$rsubcat_name=$s2['name'];
	}else{
		$error="404";
	}
}else{
	$error="404";
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

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

<link href="css/categories.css" rel="stylesheet" type="text/css">
<link href="css/category.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

	$(".tab_content").hide();
	$(".tab_content:first").show(); 

	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	});
});

</script> 


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

</head>

<body>
	<div class="container">
    	        	
             <?php  include_once "includes/ui_top.php"; ?>
            
            
            <div class="container_inner">
            <!--breadcrumbs-->
            <div class="breadcrumbs">
                <ul>
                    <li style="color: #2299e5; margin-right: 8px;">You are here:</li>
                    <li><a href="index.php">Home</a></li>
                    <?php
					if($rcat_name!=""){ echo '<li><a href="reports.php?title='.$rcat_name.'">'.$rcat_name.'</a></li>'; }
					if($rsubcat_name!=""){ echo '<li><a href="reports.php?title='.$rsubcat_name.'">'.$rsubcat_name.'</a></li>'; }
					?>  
					<li><?=implode(' ', array_slice(explode(' ', $rep4), 0, 12));?></li>  
					
                </ul>
				
            </div>
            <!--breadcrumbs_end-->
            
            <!--box1-->
            <div class="box1" style="margin-top: 12px;">
            	<!--col4-->
            	<?php include_once "includes/ui_cat.php"; ?>
                <!--col4_end-->
               
                <!--col6-->
				<?php  if($error==""){ ?>
                <div class="col6">
                	 <h1 class="hd">
                     	<div class="img">
						<?php if($rep17!="" && file_exists('articleImages/'.$rep17)){ ?>
						<img src="<?=SITE_ART_PATH.$rep17?>" alt="<?=$rep33?>" >
						<?php }else{ ?>
						<img src="<?=SITE_ART_PATH?>industryarc.png" alt="<?=$rep33?>" >
						<?php }?>
						</div>
                        <div class="cont">
                        	<div class="para1">
							<?=$rep4?>
							<br>
							<span style="font-size:12px"> Report Code : <?=$rep5?></span>
							</div>
                            
                            <div class="para2">
                            <span class="pub">
                            	<i class="fa fa-book" style="margin-right: 5px; color: #888;"></i>Published: <?=$rep28?>  &nbsp;
                            </span>
							<span class="pub">
                            	<i class="fa fa-book" style="margin-right: 5px; color: #888;"></i>No. of pages: <?=$rep31?> 
                            </span>
                            <?php if($rep27>0){ ?>
                            <span class="disc1"><span class="arro"><img src="images/r_arr.png" width="49" height="49"></span><span style="color: #f8ef00;"><?=$rep27?>% </span> discount on this report</span>
							<?php }?>
                            </div>
                            
                        </div>
                     </h1>
                     
                     <!--multitabbed_menu-->
                     <div class="multi_tabs">
                        <ul class="tabs"> 
                            <li class="active" rel="tab1">Report Description</li>
                            <li rel="tab2">Table of Contents</li>
							<?php if($rep32==1){ ?>
                            <li rel="tab3">Tables And Figures</li>
							<?php }?>
                            <li rel="tab4">Customization Options</li>
                        </ul>
                    
                    <div class="tab_container"> 
                    
                         <div id="tab1" class="tab_content"> 
                          <?php
						  $rep7= base64_decode($rep7);
						  $rep7= str_replace('\"', '"', $rep7);
						  $rep7= str_replace("\'", "'", $rep7);
						  $rep7= str_replace('\n', "<br>", $rep7);
						  echo $rep7;
						  ?>
                         </div><!-- #tab1 -->
                         <div id="tab2" class="tab_content"> 
                          <?php
						  $rep8= base64_decode($rep8);
						  $rep8= str_replace('\"', '"', $rep8);
						  $rep8= str_replace("\'", "'", $rep8);
						  $rep8= str_replace('\n', "<br>", $rep8);
						  echo $rep8;
						  ?>
                         </div><!-- #tab2 -->
						 <?php if($rep32==1){ ?>
                         <div id="tab3" class="tab_content"> 
                         <?php
						  $rep26= base64_decode($rep26);
						  $rep26= str_replace('\"', '"', $rep26);
						  $rep26= str_replace("\'", "'", $rep26);
						  $rep26= str_replace('\n', "<br>", $rep26);
						  echo $rep26;
						  ?>
						 </div><!-- #tab3 -->   
                         <?php }?>
                         
                          <div id="tab4" class="tab_content"> 
                             <?php /*?><?php
						 $rep27= base64_decode($rep27);
						  $rep27= str_replace('\"', '"', $rep27);
						  $rep27= str_replace("\'", "'", $rep27);
						  $rep27= str_replace('\n', "<br>", $rep27);
						  echo $rep27;
						  ?><?php */?>
						  <script >
						  	function openTooltip(tip){
								$('#tip_'+tip).fadeIn();
							}
							function closeTip(){
								$('.tooltip').fadeOut();
							}
						  </script>
                          <form action="requestcustomization.php" method="post">
                          	<div class="tb_fm1">
                            	<input name="chkcust[]" value="Company Profile" type="checkbox">
								<label for="name1" onMouseOver="openTooltip('tip1')" onMouseOut="closeTip()" >Company Profile
								<div class="tooltip" id="tip_tip1">Company Profile</div>
								</label>
                            </div>
                            <div class="tb_fm1">
                            	<input name="chkcust[]" value="Analyst Briefing" type="checkbox">
								<label for="name2" onMouseOver="openTooltip('tip2')" onMouseOut="closeTip()">Analyst Briefing
								<div class="tooltip" id="tip_tip2">Analyst Briefing</div>
								</label>
                            </div>
                            <div class="tb_fm1">
                            	<input name="chkcust[]" value="Tables" type="checkbox">
								<label for="name3" onMouseOver="openTooltip('tip3')" onMouseOut="closeTip()">Tables
								<div class="tooltip" id="tip_tip3">Tables</div>
								</label>
                            </div>
                            <div class="tb_fm1">
                            	<input name="chkcust[]" value="Key Contacts" type="checkbox">
								<label for="name4" onMouseOver="openTooltip('tip4')" onMouseOut="closeTip()">Key Contacts
								<div class="tooltip" id="tip_tip4">Key Contacts</div>
								</label>
                            </div>
							 <div class="tb_fm1">
                            	<input name="chkcust[]" value="Free Customization" type="checkbox">
								<label for="name4" onMouseOver="openTooltip('tip5')" onMouseOut="closeTip()">Free Customization 
								<div class="tooltip" id="tip_tip5">Free Customization </div>
								</label>
                            </div>
                            <div class="btn-fld">
                                <img src="images/ch_arr.png">
								<input type="hidden" name="hidRepId" value="<?=$rep19?>" >
                                <input class="pop_submit" type="submit" value="submit" name="butSubmitRC">
                            </div>
                          </form>
                         </div><!-- #tab4 -->  
                         
                     </div> 
                     <!-- .tab_container --> 
                     </div>
                    <!--multitabbed_menu_end-->
                </div>
				
                <!--col6_end-->
                
                
                <!--col7-->
                <div class="col7">
                	<!--<ul class="categ_1">
                    	<li>
                        	<a href="#" class="enq_abt1">ENQUIRE ABOUT REPORT</a>
                        </li>
                        <li>
                        	<a href="#" class="enq_abt2">industry's standard</a>
                        </li>
                        <li>
                        	<a href="#" class="enq_abt3">Lorem Ipsum has been </a>
                        </li>
                    </ul>-->
                    
                    <div style="text-align:center;padding:8px " ><a href="javascript:history.go(-1)" class="button"  >BACK To RESULTS</a></div>
                    <form class="frm_reg1" action="" method="post" >
						
                    	<div class="hd">
                        	Please select License
                        </div>
                      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="td_left" valign="top"><input type="radio" name="radPrice"  value="SL"  checked></td><td width="230px">Single User License:<br> US $<?=$rep15?></td>
                          </tr>
                          <tr>
                            <td class="td_left" valign="top"><input type="radio" name="radPrice" value="CL" ></td><td>Corporate User License: <br>US $<?=$rep16?></td>
                          </tr>
                        </table>
						<div class="frm_sub1">
						<input type="hidden" name="hidReport" value="<?=$rep1?>" >
                        <input type="submit" name="addToCart" value="Procure Now" >
                        </div>
                    </form>
                    
                    <ul class="frm_reg">
                    	<li><a href="request-brochure.php?title=<?=$rep19?>" class="btn1">Download PDF Brochure</a></li>
                        <?php /*?><li><a href="request-customization.php?title=<?=$rep19?>" class="btn2">Request for Customization</a></li><?php */?>
                        <li><a href="inquiry-before-buying.php?title=<?=$rep19?>" class="btn3">Inquiry Before Buying</a></li>
                        <?php /*?><li style="margin-bottom: 0px;"><a href="request-discount.php?title=<?=$rep19?>" class="btn4">Request For Discount</a></li><?php */?>
                    </ul>
                    
                    <!--<form class="frm_reg1 frm_reg2">
                    	
                      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="#">Download PDF Brochure</a></td>
                          </tr>
                          <tr>
                            <td><a href="#" class="btn2">Request for Customization</a></td>
                          </tr>
                          <tr>
                            <td><a href="#" class="btn3">Inquiry Before Buying</a></td>
                          </tr>
                          <tr>
                            <td><a href="#" class="btn4">Request For Discount</a></td>
                          </tr>
                          
                        </table>
						
                    </form>-->
                </div>
				<?php }else{ ?>
				 <div class="col6">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    	<tr>
                        	<td width="100%" valign="top" style="padding:20px;color:#CC0000;font-family:Arial, Helvetica, sans-serif" >
							No Records Found.
							</td>
						</tr>
					</table>
					</div>
				<?php }?>
                <!--col7_end-->
                
            </div>
            
            
            
            <div class="rel_reports">
            	<div class="hd">
                	Related Reports
                </div>
                
                <div class="reports_1">
                	<div id="prev2" class="l_arrow"><img src="images/l_arrow3.png"></div>
     		    	<div id="next2" class="r_arrow"><img src="images/r_arrow3.png"></div>
                <ul id="reports1">
                	<?php
					$rr1=explode(';',$rep25);
					$rr2="'start',";
					for($m=0;$m<count($rr1);$m++){ $rr2.="'".$rr1[$m]."',"; }
					$rr2.="'End'";
					
					$rs2=mysqli_query($mysqli,"select * from zsp_posts where code in(".$rr2.") and pub_date < CURRENT_DATE()");
					$i=1;
					while($row1=mysqli_fetch_array($rs2)){
					if($i%2==0){ $col='#f8f8f8'; }else{ $col= '#e0eeef'; }
					?>
                	<li>
                    	<a href="report.php?id=<?=$row1['curl']?>" class="hd1"><?=$row1['title']?></a>
                        <div class="cont">
                        	<?=$row1['title']?>
                        </div>
                        <a  href="report.php?id=<?=$row1['curl']?>" class="r_report">+ Read Report</a>
                    </li>
                    <?php $i++;  }?>
                </ul>
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
				
				$('#reports1').carouFredSel({
					responsive: true,
					width: '100%',
					prev: '#prev2',
					next: '#next2',
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
							max: 4,
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

