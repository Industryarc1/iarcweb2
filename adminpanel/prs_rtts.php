<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>

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
    <div class="width100"  >
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width10 left">Rtts Status</div>
				<div class="head2 width40 left">Title </div>
				<div class="head2 width20 left">EDIT </div>
				<div class="head2 width20 left">Updated </div>
			</div>
			<?php 
				include_once "includes/pagination.php";
				$query = "SELECT * FROM zsp_prs_rtts order by created desc ";
							$result = mysqli_query($mysqli,$query);
								$recsPerPage = 50; 	//how many records to display on a page.
				
//getting current page number(if there is no page number it could be 1)
if(is_numeric(@$_REQUEST['pageId'])){
	$pageId = $_REQUEST['pageId'];
}else{
	$pageId = 1;
}

$returnArray = getPaging($mysqli,$query, $recsPerPage, $pageId);
if($returnArray[2] >0 ){
							$level="";
							if(mysqli_num_rows($result)>0){
							$level=$level+1;
							}
							$pf=1;	
					
				while($row = mysqli_fetch_array($returnArray[0])){
					$getStatus = "SELECT * FROM zsp_prs WHERE prod_id='".$row['pr_id']."'";
					$reportData = mysqli_query($mysqli,$getStatus);
					$reportData = mysqli_fetch_assoc($reportData);
				if($reportData['status']==0){ $inactve='inactive';}else{ $inactve=""; }
			?>
			<div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width10 left padding10 bdr_right"><?=$row['status']?></div>
				<div class="head4 width40 left padding10 bdr_right"><?=$row['title']?></div>
				<div class="head4 width20 left onoff"><a href="editprs.php?act=edit&id=<?=$row['pr_id']?>" target="_blank">EDIT</a>
				&nbsp;
				<?php if($reportData['status']==1){ echo "Published";}else{?> <a href="https://www.industryarc.com/adminpanel/actions.php?act=editSatus&id=<?=$row['pr_id']?>&changePRStatus=1" target="_blank">Not Published</a> <?php } ?>
				</div>
				<div class="head4 width20 left padding10 bdr_right"><?=$row['created']?></div>
			</div>
			<?php $pf++;
			}			
			?>
			<input type="hidden"  name="hidTotal" id="hidTotal" value="<?=$pf?>" />
							<?php
							$resss=(mysqli_num_rows($result));
					if($resss > 15){
			?>
			<div class="bold_txt width100 list_btns"><?=$allClasses->showParingLinks($returnArray[1], $pageId, 'pagin_btns')?>&nbsp;</div>
			<?php } else{ } 
							  
								
								}else{  ?>
		 * No Record Found 
		<?php } ?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>