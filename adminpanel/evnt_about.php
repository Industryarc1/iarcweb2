<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 
if(isset($_POST["updateContent"]) && $_POST["updateContent"]=="Save"){
	$txtTitle=trim($_POST['txtTitle']);
	$txtContent=trim($_POST['txtContent']);
	$txtMetaTitle=trim($_POST['txtMetaTitle']);
	$txtMetaKeywords=trim($_POST['txtMetaKeywords']);
	$txtMetaDesc=trim($_POST['txtMetaDesc']);
	$txtCURL=trim($_POST['txtCURL']);
	$txtLink="";
	$txtImage="";
	if($txtTitle!="" && $txtCURL!=""){
	if(@$_POST['hid_action']=="edit" && $_POST['hid_id']!=""){
		$query = "update zsp_events_welcome set title=?,content=?,curl=?,meta_title=?,meta_keywords=?,meta_descr=? where inc_cat_id=?";
		$stmt1 = $mysqli->prepare($query);
		$stmt1->bind_param('sssssss',$txtTitle,$txtContent,$txtCURL,$txtMetaTitle,$txtMetaKeywords,$txtMetaDesc,$_POST['hid_id']);
		$flag=$stmt1->execute();
		if($flag){
			$_SESSION['stat']="SE";
			}else{
			$_SESSION['stat']="FE";
			}
			$allClasses->forRedirect ("evnt_about.php?act=edit&id=".$_POST['hid_id']);
			exit;	
	}else{
		$query = "insert into zsp_events_welcome(title,link,image,content,curl,meta_title,meta_keywords,meta_descr,status,dt_created) value(?,?,?,?,?,?,?,?,'1',now())";
		$stmt1 = $mysqli->prepare($query);
		$stmt1->bind_param('ssssssss',$txtTitle,$txtLink,$txtImage,$txtContent,$txtCURL,$txtMetaTitle,$txtMetaKeywords,$txtMetaDesc);
		$flag=$stmt1->execute();
		if($flag){
			$_SESSION['stat']="SA";
		}else{
			$_SESSION['stat']="FA";
		}
		$allClasses->forRedirect ("evnt_about.php");
		exit;	
	}	
	}else{		
		$_SESSION['stat']="FA";
		$allClasses->forRedirect ("evnt_about.php");
		exit;	
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
	<?php include_once "includes/js.php"; ?>
	</head>
	<body>
		<div class="wrapper"><?php include_once "includes/ui_top.php"; ?></div>
		<div class="container">
			<div class="con_left"><?php include_once "includes/admin_menu.php"; ?></div>
			<div class="con_right">
				<form name="frmAddCategory" action="" method="post" onSubmit="return validate()" >
					<div class="width100">
						<div class="topright width100 left">			
							<ul>
								<li><input type="submit" name="updateContent" value="Save" class="forButton" ></li>
							</ul>
						</div>
						<div class="width100 left">
							<div class="width50 <?=$_SESSION['stat']?>">
								<?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']); }?>
							</div>
							<div class="head2"><i class="fa fa-pencil"></i> <?php if(@$_REQUEST['id']==""){echo "Add";}else {echo "Edit";}?> Content</div>
						</div>
						<div class="width100 border" >
							<div class='panel-container'>  
								<?php
								if(isSet($_REQUEST['act']) && $_REQUEST['act']=="edit" && is_numeric($_REQUEST['id'])){
									$cid=$_REQUEST['id'];
									$cat = $mysqli->prepare("SELECT inc_cat_id, title, link, image, content, meta_title, meta_keywords, meta_descr, curl FROM zsp_events_welcome WHERE inc_cat_id=?");								
									$cat->bind_param('s',$cid);
									$cat->execute();
									$cat->store_result();									
									$cat->bind_result($inc_cat_id, $title, $link, $image, $content, $meta_title, $meta_keywords, $meta_descr, $curl);
									$cat->fetch();									
									//$content = base64_decode(@$content);
									$content = str_replace('\"', '"', $content);
									$content = str_replace("\'", "'", $content);								
									echo '<input type="hidden" name="hid_id" value="'.$inc_cat_id.'" />';
									echo '<input type="hidden" name="hid_action" value="edit" />';
									$cat->close();
								}else{
									$cid=0;
								}
								?>   
								<div class="width100 padding10">
									<div class="head4 width15 left">Title *</div>
									<input class="width60" type="text" name="txtTitle" id="txtTitle" value="<?=@$title?>" required>
								</div>
								<div class="width100 padding10">
									<div class="head4 width180px">About Event</div>
									<textarea name="txtContent" type="text" class="width80" style="min-height:80px" id="txtContent"><?=@$content?></textarea>			
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">CURL *</div>
										<input name="txtCURL" type="text" class="width70" value="<?=@$curl?>" id="txtCURL" required>						
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Title</div>
										<input name="txtMetaTitle" type="text" class="width70" value="<?=@$meta_title?>" id="txtMetaTitle" >
								</div>
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Keywords</div>
										<textarea name="txtMetaKeywords" type="text" class="width70" id="txtMetaKeywords" style="height:40px" ><?=@$meta_keywords?></textarea>
								</div>	
								<div class="width100 padding10">
										<div class="head4 width15 left">Meta Desc.,</div>
										<textarea name="txtMetaDesc" type="text" class="width70" id="txtMetaDesc" style="height:60px"><?=@$meta_descr?></textarea>
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