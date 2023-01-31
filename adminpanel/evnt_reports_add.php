<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 

//Table & Page Details
$tableName="zsp_events_reports";
$pageHeading="Event Report Links";
$pageAdd="evnt_reports_add.php";
$pageList="evnt_reports.php";

/*********************** Add Banners ***************************/
if(isset($_POST["addBanner"]) && $_POST["addBanner"]=="Save"){
 
	$name=$_POST['txtName'];
	$link=$_POST['txtLink'];
	//$content = base64_encode($_POST['txtContent']);
	 /* 
	if(@$_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(SITEDOC_ROOT_PATH."images/", 'txtImage');
		
		if($result){
			$imgName = $result;
			if(@$_POST['hid_image']!= ""){
				unlink(SITEDOC_ROOT_PATH."images/".$_POST['hid_image']);
			}
		}
	}else{
		$imgName = $_POST['hid_image'];
	}
	
	if(@$_FILES['txtImage1']['name'] != ""){
		$result1 = $allClasses->forFileUpload_ren(SITEDOC_ROOT_PATH."images/", 'txtImage1');
		
		if($result1){
			$imgName1 = $result1;
			if(@$_POST['hid_image1']!= ""){
				unlink(SITEDOC_ROOT_PATH."images/".$_POST['hid_image1']);
			}
		}
	}else{
		$imgName1 = $_POST['hid_image1'];
	} */
	
	$imgName="0";
	$imgName1="0";
	if(@$_POST['hid_action']=="editcat" && @$_POST['hid_cat_id']!=""){
		$sql = "update $tableName set title='".$name."',content='".$link."' where inc_cat_id=".$_POST['hid_cat_id'];
		
		if($sql != ""){
			$result = mysqli_query($mysqli,$sql);
			$error = mysqli_error($mysqli);
			if($error == ""){
				$_SESSION['stat']="SE";				
			}else{
				$_SESSION['stat']="FE";
			}
			$allClasses->forRedirect ($pageList."?id=".$_POST['hid_p_id']);
			exit;
		}
	}/* else{
		$sql="insert into $tableName(title,content,status,dt_created)values('".$name."','".$link."','1',now())";
		if($sql != ""){
			$result = mysqli_query($mysqli,$sql);
			$error = mysqli_error($mysqli);
			if($error == ""){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ($pg);
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ($pg);
				exit;
			}
		}
	} */
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
	<?php include_once "includes/js.php"; ?>
	</head>
	<body>
		<div class="wrapper"><?php include_once "includes/ui_top.php"; ?></div>
		<div class="container">
			<div class="con_left"><?php include_once "includes/admin_menu.php"; ?></div>
			<div class="con_right">
				<form name="frmAddCategory" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data" >
					<div class="width100"  >
					<div class="topright width100 left">
							<ul>
								<li><input type="submit" name="addBanner" value="Save" class="forButton" ></li>						
							</ul>
						</div>
						 <?php 
						if(@$_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
							$mainTitle = "Edit $pageHeading";
						}else{
							$mainTitle = "Add $pageHeading";
						}
					?>
					<div class="width100 left">
						<div class="head2"><i class="fa fa-newspaper-o"></i> <?=$mainTitle?></div>
					</div>
						<div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
				
					
					<div class="width100 left" >
						<div id="tab-container" class='tab-container'>					 
							<?php
							if(@$_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
								$cid=$_REQUEST['id'];
								if ($cat = $mysqli->prepare("select inc_cat_id,title,content from $tableName where inc_cat_id=?")) {
										$cat->bind_param('i',$cid );
										$cat->execute();
										$cat->store_result();
										if($cat->num_rows>0){
											$cat->bind_result($det1,$det2,$det3);
											$cat->fetch();
											
											//$det3 = base64_decode($det3);
											$det3 = str_replace('\"', '"', $det3);
											$det3 = str_replace("\'", "'", $det3);
											
											
											echo '<input type="hidden" name="hid_cat_id" value="'.$det1.'" />';
											echo '<input type="hidden" name="hid_p_id" value="'.$_REQUEST['pid'].'" />';
											echo '<input type="hidden" name="hid_action" value="editcat" />';
											$cat->close();
										}
									}
							}else{
								$cid=0;
							}
							?> 						 
								<div class="padding10" >
									<div class="head4 width120px left">Title *</div>
									<input name="txtName" type="text" value="<?=@$det2?>" class="width70" id="txtName" required>
								</div>
								<div class="padding10" >
									<div class="head4 width120px left">Report Code *</div>
									<input name="txtLink" type="text" value="<?=@$det3?>" class="width30" id="txtLink" required>
								</div>
						</div> 
					</div>
				</div>
				</form>
			</div>   	
		</div>
		<?php include_once "includes/ui_footer.php"; ?>
		<script src="editor/nicEdit.js" type="text/javascript"></script>
		<script>
		var area1
		function toggleArea1() {
		if(!area1) {
		area1 = new nicEditor({fullPanel : true}).panelInstance('txtContent',{hasPanel : true});
		} else {
		area1.removeInstance('txtContent');
		area1 = null;
		}
		}
		bkLib.onDomLoaded(function() { toggleArea1();});
		</script>
	</body>
</html>