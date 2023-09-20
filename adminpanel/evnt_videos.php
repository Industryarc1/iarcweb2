<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 

//Table & Page Details
$tableName="zsp_events_videos";
$pageHeading="Event Videos";
$pageAdd="evnt_videos_add.php";
$pageList="evnt_videos.php";

/*********************** Add Banners ***************************/
if(isset($_POST["addBanner"]) && $_POST["addBanner"]=="Save"){
 
	$txtParent=$_POST['txtParent'];
	$txtName=trim($_POST['txtName']);
	$txtContent=trim($_POST['txtContent']);
	
	//$cats=$_POST['txtCurecases'];
	
	if($txtParent!=""){		
	
		if(@$_POST['hid_action']=="edit" && $_POST['hid_id']!=""){
			$stmt_1 = $mysqli->prepare("update $tableName set title=?,content=? where image=1 and link=?");
			$stmt_1->bind_param("sss",$txtName,$txtContent,$_POST['hid_id']);					
			$flag_1=$stmt_1->execute();			
			$_SESSION['stat']="SE";
			$link=$_POST['hid_id'];
		}else{
			$link=$txtParent;
			$stmt_1 = $mysqli->prepare("insert into $tableName(title,link,content,image,status,priority,dt_created)values(?,?,?,'1','1','1',now())");
			$stmt_1->bind_param("sss",$txtName,$txtParent,$txtContent);					
			$flag_1=$stmt_1->execute();			
			$_SESSION['stat']="SA";
		}
		/* $sql1="insert into $tableName(title,link,content,image,status,priority,dt_created)values(?,?,?,'0','1','1',now())";
		$stmt = $mysqli->prepare($sql1);		
		if ($stmt && $cats>0){
			for($i=1;$i<=$cats;$i++){
				$name=$_POST['txtName'.$i];
				$sort=$_POST['txtSortOrder'.$i];
				$ss='sss';
				$stmt->bind_param($ss,$name,$link,$sort);					
				$flag=$stmt->execute();					
			}				 
		} */		
		$allClasses->forRedirect ($pageList."?id=".$link);
		exit;
	}else{
		$_SESSION['stat']="FE";
		$allClasses->forRedirect ($pg);
		exit;
	}
	
	/* 
	$sql = "update $tableName set title='".$txtName."',content='".$txtContent."' where inc_cat_id=1";	
	if($sql != ""){
		$result = mysqli_query($mysqli,$sql);
		$error = mysqli_error($mysqli);
		if($error == ""){
			$sql1="insert into zsp_events_reports(title,link,status,priority,dt_created)values(?,?,'1','1',now())";
			$stmt = $mysqli->prepare($sql1);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			if ($stmt && $cats>0){
				for($i=1;$i<=$cats;$i++){
					$name=$_POST['txtName'.$i];
					$sort=$_POST['txtSortOrder'.$i];
					$ss='ss';
					$stmt->bind_param($ss,$name,$sort);					
					$flag=$stmt->execute();					
				}				 
			}			
			$_SESSION['stat']="SE";
			$allClasses->forRedirect ($pageList);
			exit;
		}else{
			$_SESSION['stat']="FE";
			$allClasses->forRedirect ($pg);
			exit;
		}
	}	 */
}

if(@$_REQUEST['act']=="delete" && @$_REQUEST['cid']!=""){
$sql="delete from $tableName where inc_cat_id='".$_REQUEST['cid']."'";
mysqli_query($mysqli,$sql);
$_SESSION['stat']="SD";
$allClasses->forRedirect ($pageList."?id=".$_REQUEST['pid']);
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
	<style>
    .bld {font-weight:bold;}
   </style>
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
								if(isSet($_REQUEST['id']) && @$_REQUEST['id']!="" && is_numeric($_REQUEST['id'])){
									$cid=$_REQUEST['id'];
								if ($cat = $mysqli->prepare("select inc_cat_id,title,link,content from $tableName where link=?")) {
										$cat->bind_param('i',$cid );
										$cat->execute();
										$cat->store_result();
										if($cat->num_rows>0){
											$cat->bind_result($det1,$det2,$det3,$det4);
											$cat->fetch();
											
											//$det3 = base64_decode($det3);
											$det4 = str_replace('\"', '"', $det4);
											$det4 = str_replace("\'", "'", $det4);
											
											echo '<input type="hidden" name="hid_id" value="'.$cid.'" />';
											echo '<input type="hidden" name="hid_action" value="edit" />';
											$cat->close();
										}
									}
								}else{
									$cid=0;
								}
							?> 						 
								<div class="width100 padding10" >
									<div class="head4 width120px left">Select Event *</div>
									<select name="txtParent" id="txtParent" class="width70" style="height:30px;" required onChange="window.location='<?=$pageList?>?id='+this.value">
										<option value="">Select</option>
										<?php 
									$stmt1=$mysqli->prepare("SELECT inc_cat_id,title,link FROM zsp_events_welcome WHERE status=1 ORDER BY inc_cat_id DESC");
									$stmt1->execute();
									$stmt1->store_result();
									if($stmt1->num_rows>0){
											$stmt1->bind_result($det1_1,$det2_1,$det3_1);
											while($stmt1->fetch()){
												?>
												<option value="<?=$det1_1?>" <?php if(isSet($_REQUEST['id']) && $_REQUEST['id']==$det1_1){echo "selected";} ?> <?php if($det3_1=="LP") { ?> class = "bld" <?php } ?> ><?=$det2_1?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="width100 padding10" >
									<div class="head4 width120px left">Title *</div>
									<input name="txtName" type="text" value="<?=@$det2?>" class="width70" id="txtName" required>
								</div>
								<div class="width100 padding10">
									<div class="head4 width180px">Content</div>
									<textarea name="txtContent" type="text" class="width80" style="min-height:80px" id="txtContent" ><?=@$det4?></textarea>			
								</div>
								<!--<div class="width100 padding10" >
									<div class="head4 width180px left">No Of Whitepapers</div>
									<input name="txtCurecases" type="text" class="width120px" id="txtCurecases" onKeyUp="displayChildInfo(this.value)" >
								</div>   
							  <div id="ctab1"><div id="divImageInfo"></div></div>-->
								<?php 
								if(isSet($_REQUEST['id']) && $_REQUEST['id']!=""){
									?>
									<div class="width100 padding10" >
										<div class="head4 width220px left">
											<a href="<?=$pageAdd?>?pid=<?=$_REQUEST['id']?>" class="forButton">Add Video</a>
										</div>
									</div>
									<?php
								}
								?>
								<hr/>
								<div class="width100 left">
								<?php							
								if ($cat1 = $mysqli->prepare("select inc_cat_id,title,link,content,status from $tableName where status=1 and image='0' and link=?")) 
								{
									$cat1->bind_param('i',$_REQUEST['id']);
									$cat1->execute();
									$cat1->store_result();
									if($cat1->num_rows>0){
										$cat1->bind_result($det11,$det21,$det31,$det41,$det51);
										?>
										<div class="width100 padding10">
												<div class="head2 width80 left bgcolor1">Title</div>																					
												<div class="head2 width10 left bgcolor1 onoff">Action</div>
										<?php
										while($cat1->fetch()){
											?>
											
												<div class="head4 width80 left "><?=@$det21?></div>									
												<div class="head4 width10 left onoff">
													&nbsp;&nbsp;
													<a href="<?=$pageAdd?>?act=edit&id=<?=$det11?>&pid=<?=$_REQUEST['id']?>" ><i class="fa fa-pencil-square"></i></a>
													
													&nbsp;&nbsp;
													<a href="javascript:void(0)" onClick="if(confirm('Do you want to remove?')){window.location.href='<?=$_SERVER['PHP_SELF']."?act=delete&cid=".$det11."&pid=".$_REQUEST['id']?>';return false;}"><i class="fa fa-trash"></i></a>
													</div>											
											<?php
										}
										?>
										</div>
										<?php
										$cat1->close();
									}
								}
								?>
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
		<script type="text/javascript">
						 
						var vldnum=/^[0-9]+$/;
						var i =0;	
						function displayChildInfo(caseimages){
							var txtImageDetails = "";
							match=vldnum.test(caseimages);
							if(!match){	  
								alert("Enter numbers only.");
								document.frmCase.txtCurecases.focus();
								return false;
							}else{
								if(caseimages >0){
									for(i=1;i<=caseimages;i++){
										txtImageDetails += '<div class="padding10" ><div class="head4 width180px left">Report Title</div><input name="txtName'+i+'" type="text"  class="width70" id="txtName'+i+'" ></div><div class="padding10" ><div class="head4 width180px left">Report ID</div><input name="txtSortOrder'+i+'" type="text" class="width220px" id="txtSortOrder'+i+'" ></div><div class="head4 width100">_________________________________________________________________</div>';	
										//document.getElementById('divImageInfo').innerHTML += txtImageDetails;
									}
								}else{
									document.getElementById('divImageInfo').innerHTML = '';
								}
							}
							if(txtImageDetails != ""){
								document.getElementById('divImageInfo').innerHTML = txtImageDetails;
							}
							}
					</script> 
	</body>
</html>