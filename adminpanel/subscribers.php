<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>


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
			
			<ul >
				<?php /*?><li><a href="addCategory.php" ><i class="fa fa-plus-square"></i></a></li><?php */?>
				<?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Subscribers List</div>
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width35 left">Email</div>
				<div class="head2 width15 left">Subscribed On</div>
				<div class="head2 width10 left">Status</div>
				<div class="head2 width20 left">Industry</div>
				<!--<div class="head2 width10 left">Action</div>-->
			</div>
			<?php 
				if ($stmt = $mysqli->prepare("select nl_id, nl_email, nl_subcribed_date, nl_unsubcribed_date, nl_status, nl_industry FROM zsp_newsletters order by nl_subcribed_date desc")) {
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($nl_id, $nl_email, $nl_subcribed_date, $nl_unsubcribed_date, $nl_status, $nl_industry);
				}
				while( $stmt->fetch() ) 
				{				
					$res=mysqli_query($mysqli,"select name from zsp_catlog_categories where inc_id='".$nl_industry."' and status='1' order by sort_order asc");
					$row=mysqli_fetch_row($res);
					?>
					<div class="width100 left border_bottom ">
						<div class="head4 width35 left padding10 bdr_right"><?=$nl_email?> </div>
						<div class="head4 width15 left padding10 bdr_right"><?php echo date("d-m-Y",strtotime($nl_subcribed_date)); ?>	</div>
						<div class="head4 width10 left padding10 bdr_right"><?php if($nl_status==1){echo "Subscribed";}else{echo "Unsubscribed"; } ?>	</div>
						<div class="head4 width20 left padding10">	<?php   echo $row[0];   ?>	</div>
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