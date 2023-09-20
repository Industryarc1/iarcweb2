<?php include_once "includes/config.php"; ?>
<?php
if($_REQUEST['title']!=""){
	$stmt1 = $mysqli->prepare("select inc_id,cat,subcat,title,curl from zsp_posts where curl=? ");
	$stmt1->bind_param('s',$_REQUEST['title']);
	$stmt1->execute();
	$stmt1->store_result();
	if($stmt1->num_rows>0){
		$stmt1->bind_result($rep1,$rep2,$rep3,$rep4,$rep19);
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
if($_POST['butSubmitRB']=="submit"){
	$type='RB';
	$query='insert into zsp_leads(rid,cid,scid,fname,lname,email,phone,job,company,pincode,comments,dt_created,type)values(?,?,?,?,?,?,?,?,?,?,?,now(),?)';
	$stmt=$mysqli->prepare($query);
	$stmt->bind_param('ssssssssssss',$_POST['hidReport'],$_POST['hidCat'],$_POST['hidSubCat'],$_POST['txtFName'],$_POST['txtLName'],$_POST['txtEmail'],$_POST['txtPhone'],$_POST['txtJTitle'],$_POST['txtCompany'],$_POST['txtPin'],$_POST['txtComments'],$type);
	$flag=$stmt->execute();
	if($flag){
		$message = 'Request for PDF Download : <br> <br> Report Details <br> <br> Report : '.$_POST['hidReportName'].'<br> Category :'.$_POST['hidCatName'].'<br> Sub Category '.$_POST['hidSubCatName'].'<br><br> Conatct Person Details<br><br>Name : '.$_POST['txtFName'].' '.$_POST['txtLName'].'<br>Email : '.$_POST['txtEmail'].'<br>Phone : '.$_POST['txtPhone'].'<br>Job Title : '.$_POST['txtJTitle'].'<br>Company : '.$_POST['txtCompany'].'<br> Pincode : '.$_POST['txtPin'].'<br>Requirement : <br>'.$_POST['txtComments'];
		$subject = "Request for PDF Download : In ".$_POST['hidCatName'];
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$_POST['txtFName'].' '.$_POST['txtLName'].'<'.$_POST['txtEmail'].'>'. "\r\n";
		// Mail it	
		@mail($adminMail, $subject, $message, $headers);
		$_SESSION['RSTAT']="SUCCESS";
	}else{
		$_SESSION['RSTAT']="FAIL";
	}
	$allClasses->forRedirect ($current_page);
	exit;
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
					<?php
					if($error==""){ 
					if($rcat_name!=""){ echo '<li><a href="reports.php?title='.$rcat_name.'">'.$rcat_name.'</a></li>'; }
					if($rsubcat_name!=""){ echo '<li><a href="reports.php?title='.$rsubcat_name.'">'.$rsubcat_name.'</a></li>'; }
					?>
					<li><a href="report.php?id=<?=$rep19?>"><?=implode(' ', array_slice(explode(' ', $rep4), 0, 12));?></a></li>   <?php } ?>
                    <li>Request For Brochure</li>                        
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
				<?php if($error==""){ ?>
                <div class="col2">
                	<div class="row1_1" style="margin-top: 0px;">
                    	<h1 class="hd1">
                        	Request For PDF Download
                        </h1>
                        
                        <div class="rfp_pg">
						<?php
						if($_SESSION['RSTAT']!=""){
							if($_SESSION['RSTAT']=="SUCCESS"){ echo '<p style="color:green;">Your request sent successfully. Thank you,  we will get back to you soon.</p>'; }
							if($_SESSION['RSTAT']=="FAIL"){ echo '<p style="color:red;">Unable to send request. Try again.</p>'; }
							unset($_SESSION['RSTAT']);
						}
						?>
						<p><u>REPORT</u> : <?=$rep4?></p>
                        <form action="" method="post" class="pop_form">
                  		
                              <div class="txt-fld">
                                <label for="">First Name</label>
                                	<div class="req_inp width100">
                                    	<input id="" class="good_input" name="txtFName" type="text" placeholder="Enter First Name" required>
                                        <div class="required-icon" data-original-title="" title="">
                                            <div class="text">*</div>
                                            <div class="tool-tip left">Required field</div>
                                          </div>
                                    </div>
                              </div>
                              <div class="txt-fld">
                                <label for="">Last Name</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtLName" placeholder="Enter Last Name" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld">
                                <label for="">Email</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtEmail" placeholder="Enter Email" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld">
                                <label for="">Job Title</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtJTitle" placeholder="Enter Job Title" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld">
                                <label for="">Company</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtCompany"  placeholder="Enter Company" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld">
                                <label for="">Pincode</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtPin" placeholder="Enter Pincode">
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld txt-fld2">
                                <label for="">Mobile Number</label>
                                
                                <div class="req_inp width100">
                                   <input id=""  type="text" name="txtPhone" placeholder="Enter Mobile Number" required>
                                    <div class="required-icon" data-original-title="" title="">
                                        <div class="text">*</div>
                                        <div class="tool-tip left">Required field</div>
                                      </div>
                                </div>
                              </div>
                              <div class="txt-fld txt-fld2">
                                <label for="">Your Requirements</label>
                                <textarea class="form-control" rows="6" name="txtComments" placeholder="Message..." style="height:90px;"></textarea>
                              </div>
                              <div class="btn-fld">
                              
							  <input type="hidden" name="hidReport" value="<?=$rep1?>" >
							  <input type="hidden" name="hidCat" value="<?=$rep2?>" >
							  <input type="hidden" name="hidSubCat" value="<?=$rep3?>" >
							   <input type="hidden" name="hidReportName" value="<?=$rep4?>" >
							   <input type="hidden" name="hidCatName" value="<?=$rcat_name?>" >
							  <input type="hidden" name="hidSubCatName" value="<?=$rsubcat_name?>" >
                              
                              	<img src="images/ch_arr.png">
                                <input type="submit" name="butSubmitRB" value="submit" class="pop_submit">
                                
                               
                              </div>
                     </form>                        
                     </div>
                        
                    </div>  
                                 
                </div>
				<?php }else{?>
				<div class="col2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    	<tr>
                        	<td width="100%" valign="top" style="padding:20px;color:#CC0000;font-family:Arial, Helvetica, sans-serif" >
							No Records Found.
							</td>
						</tr>
					</table>
				</div>
				<?php }?>
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
