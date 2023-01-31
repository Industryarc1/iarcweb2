<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
<script>
  "'article footer header nav section'".replace(/\w+/g,function(n){document.createElement(n)})
</script>
<title>Welcome to True Telugu</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/tabs.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<?php
include_once "includes/js.php";
?>
</head>
<body>
	<div class="wrapper">
    	<?php include_once "includes/ui_top.php"; ?>
</div>
<div class="container">
    <div class="con_left">
		<!--<i class="fa fa-list" ></i>-->
		<?php include_once "includes/admin_menu.php"; ?>
	</div>
	<div class="con_right">
	<script>
	function validate(){
		var oldpass=document.frmAddCategory.txtOldPasswd.value;
		var newpass=document.frmAddCategory.txtNewPasswd.value;
		var conpass=document.frmAddCategory.txtConfPasswd.value;
		
		if(trim(oldpass) == ""){
			alert("Old Password should not be empty.");
			document.frmAddCategory.txtOldPasswd.focus();
			return false;
		}
		document.frmAddCategory.txtOldPasswd.value = trim(oldpass);
		if(trim(newpass) == ""){
			alert("New Password should not be empty.");
			document.frmAddCategory.txtNewPasswd.focus();
			return false;
		}
		document.frmAddCategory.txtNewPasswd.value = trim(newpass);
		if(trim(newpass) != (trim(conpass))){
			alert("Password doesnot match. Please check your password.");
			document.frmAddCategory.txtNewPasswd.focus();
			return false;
		}
		document.frmAddCategory.txtConfPasswd.value = trim(conpass);
		return true;
	}
	</script>
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="changePWD" value="Change Password" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Change Password</div>
		</div>
<div class="width100 left">
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>
		<div class="width100 left pb50" >
			<div class="events">
                	<script type="text/javascript">
						$(document).ready( function() {
						$('#tab-container').easytabs();
						});
					</script>        
					<div id="tab-container" class='tab-container'>
						<ul class='etabs'>
						   <li class='tab'><a href="#ctab1">Change Password</a></li>
						</ul>
						<div class='panel-container'>  
						<?php
						if($_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
							$cid=$_REQUEST['id'];
							if ($cat = $mysqli->prepare("select * from zsp_pincodes where pincode=?")) {
									$cat->bind_param('i',$cid );
									$cat->execute();
									$cat->store_result();
									if($cat->num_rows>0){
										$cat->bind_result($det1,$det2,$det3,$det4);
										$cat->fetch();
										echo '<input type="hidden" name="hid_pin" value="'.$det1.'" />';
										echo '<input type="hidden" name="hid_action" value="editpin" />';
										$cat->close();
									}
									
								}
						}else{
							$cid=0;
						}
						?>            
							  <div id="ctab1">
                              	<div class="padding10" >
								<div class="head4 width180px left">Old Password</div><input name="txtOldPasswd" type="password" value="" class="width220px" id="txtOldPasswd" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">New Password</div><input name="txtNewPasswd" type="password" class="width220px" id="txtNewPasswd" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Confirm Password</div><input name="txtConfPasswd" type="password" class="width220px" id="txtConfPasswd" >
								</div>						  
							  </div>
					  </div>
					</div> 
                </div>
		</div>
	</div>
	</form>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>