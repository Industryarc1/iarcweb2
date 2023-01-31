<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 

//Table & Page Details
$tableName="zsp_events_videos";
$pageHeading="Event Videos";
$pageAdd="evnt_videos_add.php";
$pageList="evnt_videos.php";

/*********************** Add Banners ***************************/
if(isset($_POST["addBanner"]) && $_POST["addBanner"]=="Save"){
 
	$txtParent=$_POST['hid_pid'];
	$txtName=$_POST['txtName'];
	$txtCURL=trim($_POST['txtCURL']);
	$txtContent=trim($_POST['txtContent']);
	$txtMetaTitle=trim($_POST['txtMetaTitle']);
	$txtMetaKeywords=trim($_POST['txtMetaKeywords']);
	$txtMetaDesc=trim($_POST['txtMetaDesc']);	 
	$imgName="0";
	$imgName1="0";
	if(@$_POST['hid_action']=="editcat" && @$_POST['hid_cat_id']!=""){
		$sql = "update $tableName set title='".$txtName."',curl='".$txtCURL."',content='".$txtContent."',meta_title='".$txtMetaTitle."',meta_keywords='".$txtMetaKeywords."',meta_descr='".$txtMetaDesc."' where inc_cat_id=".$_POST['hid_cat_id'];
		
		if($sql != ""){
			$result = mysqli_query($mysqli,$sql);
			$error = mysqli_error($mysqli);
			if($error == ""){
				$_SESSION['stat']="SE";				
			}else{
				$_SESSION['stat']="FE";
			}
		}
	}else{
		$sql="insert into $tableName(title,link,content,curl,meta_title,meta_keywords,meta_descr,image,status,dt_created)values('".$txtName."','".$txtParent."','".$txtContent."','".$txtCURL."','".$txtMetaTitle."','".$txtMetaKeywords."','".$txtMetaDesc."','0','1',now())";
		if($sql != ""){
			$result = mysqli_query($mysqli,$sql);
			$error = mysqli_error($mysqli);
			if($error == ""){
				$_SESSION['stat']="SA";
			}else{
				$_SESSION['stat']="FA";
			}
		}
	}
	$allClasses->forRedirect ($pageList."?id=".$txtParent);
	exit;
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
								if ($cat = $mysqli->prepare("select inc_cat_id,title,curl,content,meta_title,meta_keywords,meta_descr from $tableName where inc_cat_id=?")) {
										$cat->bind_param('i',$cid );
										$cat->execute();
										$cat->store_result();
										if($cat->num_rows>0){
											$cat->bind_result($inc_cat_id,$title,$curl,$content,$meta_title,$meta_keywords,$meta_descr);
											$cat->fetch();
											
											//$det3 = base64_decode($det3);
											$content = str_replace('\"', '"', $content);
											$content = str_replace("\'", "'", $content);
											
											
											echo '<input type="hidden" name="hid_cat_id" value="'.$inc_cat_id.'" />';
											echo '<input type="hidden" name="hid_action" value="editcat" />';
											$cat->close();
										}
									}
							}else{
								$cid=0;
							}
							?> 						<input type="hidden" name="hid_pid" value="<?=$_REQUEST['pid']?>"> 
								<div class="padding10" >
									<div class="head4 width120px left">Title *</div>
									<input name="txtName" type="text" value="<?=@$title?>" class="width70" id="txtName" required>
								</div>
								<div class="width100 padding10">
									<div class="head4 width180px">Content</div>
									<textarea name="txtContent" type="text" class="width80" style="min-height:80px" id="txtContent" ><?=@$content?></textarea>			
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">CURL *</div>
										<input name="txtCURL" type="text" class="width70" value="<?=@$curl?>" id="txtCURL"required>
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Title</div>
										<input name="txtMetaTitle" type="text" class="width70" value="<?=@$meta_title?>" id="txtMetaTitle" >
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Keywords</div>
										<textarea name="txtMetaKeywords" type="text" class="width70" id="txtMetaKeywords" style="height:80px" ><?=@$meta_keywords?></textarea>
								</div>	
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Desc.,</div>
										<textarea name="txtMetaDesc" type="text" class="width70" id="txtMetaDesc" style="height:80px"><?=@$meta_descr?></textarea>
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