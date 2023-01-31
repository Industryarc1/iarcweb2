<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php");die(); } ?>
<?php
if(@$_REQUEST['act']=="delete" && $_REQUEST['pid']!=""){
//$sql="delete from zsp_posts where inc_id='".$_REQUEST['pid']."'";
//echo $sql;exit;
//mysqli_query($mysqli,$sql);
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
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul >
				<?php /*?><li ><a href="addPost.php" class="forButton" >Add List</a> &nbsp;</li><?php */?>
				<li ><a href="uploadImages.php" class="forButton" >Upload Images</a> &nbsp;</li>
				
				<?php /*?><li><a href="featured.php" class="forButton"  >Featured</a> &nbsp;</li><?php */?>
				<li><a href="addPost.php" ><i class="fa fa-plus-square"></i></a></li>
				<?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Reports Posted</div>
			<div class="left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?>
			<?php if(isset($_SESSION['status'])){ if($_SESSION['status']=="FDD"){echo "<font color='red'>Select Category/publisher </font>";}unset($_SESSION['status']);  }?>
			</div>
		</div><br/><br/><br/>
		
		<div class="width100 left border" >
			<div class="width100 left border_">
				<div class="width100 left ">
				<form method="get" action="">
				<input type="hidden" name="pageId" value="<?=@$_REQUEST['pageId']?>" >	
					<div class="head2 width10 left"> Category </div>
					<div class="head4 width30 left padding10 ">
					 <?php
					 if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and status=1")) {
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($inc_id, $name);
						}
					?>
					<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="" >
						<option value="" >Select</option>
						<?php while( $stmt->fetch() ) 
						{ 
							?>
							<option value="<?=$inc_id?>" <?php if(trim(@$_REQUEST['txtParent'])==$inc_id){echo "selected" ;} ?>><?=$name?></option>
						 <?php 
						}
						$stmt->close();
						$txt=@$_REQUEST['txtParent'];
						?>						
					</select>
				</div>				 
					<div class="head4 width30 left padding10 ">
					 <?php
					 if($txt!=""){
					 if ($stmt = $mysqli->prepare("select inc_id from zsp_catlog_categories where inc_id='$txt'"))
					 {
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($inc_id);
						$stmt->fetch();						
					 }
					 
					 if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=$inc_id and status=1")) {
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($inc_id1, $name1);
						}
					?>
					<select name="txtParent1" type="text" class="width280px" id="txtParent1" onChange="" >
						<option value="" >Select</option>
						<?php while( $stmt->fetch() ) 
						{ ?>
							<option value="<?=$inc_id1?>" <?php if(trim(@$_REQUEST['txtParent1'])==$inc_id1){echo "selected" ;} ?>><?=$name1?></option>
						 <?php 
						}
						$stmt->close();
						?>
					</select> 
					<?php }?>
					</div>
					
				</div>
				<div class="width100 left ">
					 			 
					<div class="head4 width50 left padding10 ">
					  <input type="text" name="searchName" value="<?=@$_REQUEST['searchName']?>" style="height:15px;width:200px">
					  <input type="submit" name="searchSubmit" value="Search">
					  <input type="submit" name="BtnNext" value="Download"/>							
					  <a href="postsData.php?id=All">Download All</a>
					</div>
					</form>
				</div>
			</div>
		</div> 
		<?php
		if(@$_GET['BtnNext'] == 'Download'){
				 $allClasses->forRedirect("postsData.php?txtPub=".$_REQUEST['txtPub']."&txtParent=".$_REQUEST['txtParent']."&txtParent1=".$_REQUEST['txtParent1']);
				 exit;
		}
			
		?>
		
		<form name="frmAddCategory" action="" method="post" >	
			<!--<ul style="list-style-type:none;width:100%;float:right">				 
				<li style="float:left;"><input type="submit" name="statusRepA" value="Active" class="forButton"> &nbsp;</li>
				<li style="float:left;"><input type="submit" name="statusRepD" value="In-Active" class="forButton"> &nbsp;</li>
				<li style="float:left;"><input type="submit" name="deleteRep" value="Delete" class="forButton" style=""> &nbsp;</li>			 	
			</ul>-->
						
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width60 left">Reports</div>
				<div class="head2 width20 left">Report Code </div>
				<div class="head2 width10 left">Action</div>
			</div>
			<?php 
				include_once "includes/pagination.php";
				$where="where";
				
				if(isSet($_REQUEST['txtParent']) && $_REQUEST['txtParent']!=""){
					$txtParent=$_REQUEST['txtParent'];
					$where.=" cat = '$txtParent' and ";
				}
				
				if(isSet($_REQUEST['txtParent1']) && $_REQUEST['txtParent1']!=""){
					$txtParent1=$_REQUEST['txtParent1'];
					$where.=" subcat = '$txtParent1' and ";
				} 
			 
				if(isSet($_REQUEST['searchName']) && $_REQUEST['searchName']!=""){
					$searchName=$_REQUEST['searchName'];
					$where.=" (title like '%$searchName%' OR code like '%$searchName%') and ";
				}
				$where.=" 1=1 and is_publish=0";
				$query = "SELECT * FROM zsp_posts $where order by dt_created desc ";

							$result = mysqli_query($mysqli,$query);
								$recsPerPage = 50; 	//how many records to display on a page.
				
//getting current page number(if there is no page number it could be 1)
if(is_numeric(@$_REQUEST['pageId'])){
$pageId = $_REQUEST['pageId'];
}else{
$pageId = 1;
}

$returnArray = getPaging($mysqli,$query, $recsPerPage, $pageId);
//echo mysqli_num_rows($result);
if($returnArray[2] >0 ){
							$level="";
							if(mysqli_num_rows($result)>0){
							$level=$level+1;
							}
							$pf=1;	
					
				while($row = mysqli_fetch_array($returnArray[0])){
				if($row['status']==0){ $inactve='inactive';}else{ $inactve=""; }
			?>
			<input type="hidden" name="hidID<?=$pf?>" value="<?=$row['inc_id']?>"  />
			<div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width60 left padding10 bdr_right"><?=$row['title']?></div>
				<div class="head4 width20 left padding10 bdr_right"><?=$row['code']?></div>
				<div class="head4 width10 left onoff"><a href="editPost.php?act=edit&id=<?=$row['inc_id']?>" ><i class="fa fa-pencil-square"></i></a>
				&nbsp;
				<?php if($row['status']==1){ ?>
				<a href="actions.php?act=editSatus&id=<?=$row['inc_id']?>&changePostStatus=0" ><i class="fa fa-check-circle"></i></a>
				<?php }else{?>
				<a href="actions.php?act=editSatus&id=<?=$row['inc_id']?>&changePostStatus=1" ><i class="fa fa-circle-thin"></i></a>
				<?php }?>
				&nbsp;
				<!--<a href="posts.php?id=<?=$_REQUEST['id']?>&act=delete&pid=<?=$row['inc_id']?>" ><i class="fa fa-trash"></i></a>-->
				</div>
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
		</form>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>
