<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if(@$_REQUEST['act']=="delete" && $_REQUEST['id']!=""){
$sql="delete from zsp_officeaddresses where id='".$_REQUEST['id']."'";
mysqli_query($mysqli,$sql);
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
<script>
  "'article footer header nav section'".replace(/\w+/g,function(n){document.createElement(n)})
</script>
<title>IndustryARC</title>
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
    <div class="width100"  >
		<div class="topright width100 left">			
			<ul>
				<li><a href="addAddress.php" ><i class="fa fa-plus-square"></i></a></li>				
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Contact US - Office Address List</div>
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>		
		<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.1938838306187!2d78.37863741444912!3d17.450431905577894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb93ded1abed47%3A0xb3251ac5025b94b0!2sIndustryARC!5e0!3m2!1sen!2sin!4v1445413784107" width="500" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>-->
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width50 left">Address</div>
				<div class="head2 width20 left">Head Quarters/Regional</div>
				<div class="head2 width10 left">Action</div>
			</div>
			<?php 
			if ($stmt = $mysqli->prepare("SELECT id,address,country,type FROM zsp_officeaddresses WHERE type!='desc'")) {
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($id, $address, $country, $type);
			}
			while( $stmt->fetch() ) 
			{			
				?>
				<div class="width100 left border_bottom ">
					<div class="head4 width50 left padding10 bdr_right"><?=$address?></div>
					<div class="head4 width20 left padding10 bdr_right"><?=$type?></div>
					<div class="head4 width10 left onoff"><a href="addAddress.php?act=edit&id=<?=$id?>" ><i class="fa fa-pencil-square"></i></a>
						<a href="contactUs.php?act=delete&id=<?=$id?>" ><i class="fa fa-trash"></i></a>
					</div>
				</div>
				<?php 
			} 
			?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>