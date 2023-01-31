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
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js&quot; type="text/javascript"></script>
<![endif]-->
<script>
  "'article footer header nav section'".replace(/\w+/g,function(n){document.createElement(n)})
</script>
<title>IndustryArc</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
		<?php if(isset($_SESSION['admin_id']) || @$_SESSION['admin_user_id']!=""){ include_once "includes/admin_menu.php"; } ?>
	</div>
	<div class="con_right">
	<?php if(isset($_SESSION['admin_id']) || @$_SESSION['admin_user_id']!=""){
		echo "<div class='head10' > IndustryARC <br> Administration </div>";
	}else{
	?>
    <div class="width60 margin20 border"  >
		<div class="head2 border_bottom" ><i class="fa fa-lock"></i> Administrator Login</div>
		<div class="padding40">
			<script language="javascript" type="text/javascript">
function validate(){

	var txtUser=document.frmAdminLogin.txtUser.value;
	var txtPassword=document.frmAdminLogin.txtPassword.value;
	
	if(trim(txtUser) == ""){
		alert("Please enter the Username");
		document.frmAdminLogin.txtUser.focus();
		return false;
	}
	
	document.frmAdminLogin.txtUser.value=trim(txtUser);
	if(trim(txtPassword) == ""){
		alert("Password should not be Empty");
		document.frmAdminLogin.txtPassword.focus();
		return false;
	}
	document.frmAdminLogin.txtPassword.value=trim(txtPassword);
	
	return true;
}
</script>
			<form name="frmAdminLogin" method="post" action="actions.php" onSubmit="return validate()">
			<div class="padding10" >
			<div class="head3 width120px left">Username</div><input name="txtUser" type="text" class="width180px" id="txtUser" >
			</div>
			<div class="padding10" >
			<div class="head3 width120px left">Password</div><input name="txtPassword" type="password" class="width180px" id="txtPassword" >
			</div>
			<div class="<?=$_SESSION['stat']?>">
			<?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?>
			</div>
			<div class="padding10" >
			<div class="head3 width120px left"></div><input name="logintoadmin" type="submit" class="forButton" id="button" value="Submit">
			</div>
			</form>
		</div>
	</div>
    <?php }?>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>