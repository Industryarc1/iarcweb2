<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>


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
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-pencil"></i>  Upload Images</div>
			
		</div>
		<div class="width100 left border" >
			<div class="width50 left padding10 <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<div class="bgcolor2 padding40 " >
			<div class="head4 width150px left">Select Images </div>
			<form name="uploadImages" method="post" action="actions.php" enctype="multipart/form-data" >
			<input  name="txtImage[]" type="file" class="forTextfield" multiple accept='image/*' />
			<input type="submit" name="uploadProductImages" value="Upload Images" class="forButton" >
			</form>
			</div>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Article Images</div>
		</div>
		<div class="width100 left pb50" >
			<?php
			if($_REQUEST['action']=="unlink" && $_REQUEST['img']!="" ){
				if(file_exists('../articleImages/'.$_REQUEST['img'])){
					unlink('../articleImages/'.$_REQUEST['img']);
				}
			}
			$folder = '../articleImages/';
			$filetype = '*.*';
			$files = glob($folder.$filetype);
			$count = count($files);
			for ($i = 1; $i < $count; $i++) {
				echo '<div style="float:left" class="padding10 border"><img src="'.$files[$i].'" height="80" width="80" /><br>';
				$f=explode("/",$files[$i]);
				echo $f[2].'<br><a href="uploadImages.php?action=unlink&img='.$f[2].'"><i class="fa fa-trash"></i></a></div>';
			}
			?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>