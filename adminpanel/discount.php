<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 
if(isset($_POST["welcomeButton"]) && $_POST["welcomeButton"]=="Save"){
	
	$name = mysqli_real_escape_string($mysqli,stripslashes($_POST['txtName']));
	$link = mysqli_real_escape_string($mysqli,stripslashes($_POST['txtLink']));
	$content = mysqli_real_escape_string($mysqli,stripslashes($_POST['txtContent']));
	$imgName = mysqli_real_escape_string($mysqli,stripslashes($_POST['txtImage']));
	
	$sql="update tbl_welcome set image=?,title=?,link=?, content=?,image=? where inc_cat_id=1";
	if ($stmt = $mysqli->prepare($sql)){
		$si='sssss';
		$stmt->bind_param($si,$imgName,$name,$link,$content,$imgName);
		$flag=$stmt->execute();
	//	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error; exit;
		if($flag){
			$_SESSION['stat']="SE";
			$allClasses->forRedirect ("discount.php");
			exit;
		}else{
			$_SESSION['stat']="FE";
			$allClasses->forRedirect ("discount.php");
			exit;
		}
	}
}
?>
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
	<form name="frmAddCategory" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data" >
    <div class="width100"  >
		<div class="topright width100 left">			
			<ul>
				<li><input type="submit" name="welcomeButton" value="Save" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
	     	<div class="width50  <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<div class="head2"><i class="fa fa-pencil"></i> Update Discount</div>
		</div>
		<div class="width100 left pb50">
			<div class="events">
                     
					<div id="tab-container" class='tab-container'>
						
						<div class='panel-container'>  

							  <div id="ctab1">
                 
<?php
						$cid =1;
							if ($cat = $mysqli->prepare("select inc_cat_id,title,image,link,content,image from tbl_welcome where inc_cat_id=?")) {
									$cat->bind_param('i',$cid );
									$cat->execute();
									$cat->store_result();
									if($cat->num_rows>0){
										$cat->bind_result($det1,$det3,$det4,$det5,$det2,$det6);
										$cat->fetch();
										
										$det3 = trim($det3);
										$det3 = str_replace('\"', '"', $det3);
										$det3 = str_replace("\'", "'", $det3);
										
										$det2 = trim($det2);
										$det2 = str_replace('\"', '"', $det2);
										$det2 = str_replace("\'", "'", $det2);
										
										$det5 = trim($det5);
										$det5 = str_replace('\"', '"', $det5);
										$det5 = str_replace("\'", "'", $det5);
										
										$cat->close();
									}
								}						
						?>     
						<div class="padding10" >
							<div class="head4 width20 left">Discount Value</div>
							<input name="txtName" type="text" value="<?=$det3?>" class="width20" id="txtName" >
							Only numerics
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