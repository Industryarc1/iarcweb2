<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if($_REQUEST['act']=="delete" && $_REQUEST['pid']!=""){
$sql="delete from zsp_posts where inc_id='".$_REQUEST['pid']."'";
mysqli_query($mysqli,$sql);
}
if(isset($_POST["savePF"]) && $_POST["savePF"]=="Save" && $_POST['hidTotal']!=""){
	$query = "update zsp_posts set new=?,top=? where inc_id=?";
	$stmt = $mysqli->prepare($query);
	for($k=1;$k<=$_POST['hidTotal'];$k++){
		if($_POST['txtP'.$k]=='on'){ $p=1; }else{ $p=0; }
		if($_POST['txtB'.$k]=='on'){ $b=1; }else{ $b=0; }
		$prod_id=$_POST['hidID'.$k];
		$iis='iis';
		
		$stmt->bind_param($iis, $p,$b,$prod_id);
		$flag=$stmt->execute();
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	if($flag){
		$_SESSION['stat']="SE";
	}else{
		$_SESSION['stat']="FE";
	}
	$allClasses->forRedirect ("filter.php?id=".$_REQUEST['id']);
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
	<form name="frmAddCategory" action="" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<?php if(isSet($_REQUEST['id']) && $_REQUEST['id']!=''){?>			
		<div class="topright width100 left">
			
			<ul >
				<?php /*?><li ><a href="addPost.php" class="forButton" >Add List</a> &nbsp;</li><?php */?>
				<?php /*?><li ><a href="uploadImages.php" class="forButton" >Upload Images</a> &nbsp;</li><?php */?>
				<input type="submit" name="savePF" value="Save" class="forButton" >
				<?php /*?><li><a href="featured.php" class="forButton"  >Featured</a> &nbsp;</li><?php */?>
				<?php /*?><li><a href="addPost.php" ><i class="fa fa-plus-square"></i></a></li><?php */?>
				<?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
			</ul>
		</div>
		<?php } ?>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Reports Posted</div>
			<div class="left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>
		<div class="width100 padding20" >
								<div class="head4 width10 left">Listed In</div>
								<?php
								if($_REQUEST['id']!=""){ 
									$parent=explode("@$@",$_REQUEST['id']);
									
								}
								if($parent[0]!=""){ 
									$cond=' cat=? and '; 
									$id=$parent[0];
								}
								if($parent[1]!=""){ 
									$cond=' subcat=? and '; 
									$id=$parent[1];
								}
									
								
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and inc_id not in (1,2)")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<div class="width80 left">
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="window.location='filter.php?id='+this.value+'@$@'" >
								<option value="" >Select</option>
								<?php while( $stmt->fetch() ) { 
								if( $parent[0]==$inc_id){ $sel='selected="selected"'; }else{ $sel=''; }
								?>
								<option value="<?=$inc_id?>" <?=$sel?> ><?=$name?></option>
								<?php 
								}
								$stmt->close();
								?>
								</select>
								<?php if($parent[0]!=""){?>
								<select name="txtParent1" type="text" class="width280px" id="txtParent1" onChange="window.location='filter.php?id=<?=$parent[0]?>@$@'+this.value" >
								<option value="" >Select</option>
								<?php
									if ($stmt1 = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=?")) {
										$stmt1->bind_param('i',$parent[0]);
										$stmt1->execute();
										$stmt1->store_result();
										$stmt1->bind_result($inc_id1, $name1);
									}
									?>
									<?php while( $stmt1->fetch() ) { 
									?>
									<?php  if( $parent[1]==$inc_id1){ $sel='selected="selected"'; }else{ $sel=''; } ?>	
									<option value="<?=$inc_id1?>" <?=$sel?> ><?=$name1?></option>
									<?php 
									}
									$stmt1->close();
								
								?>
								</select>
								<?php }?>
								</div>
								
								
								</div>
					<?php if(isSet($_REQUEST['id']) && $_REQUEST['id']!=''){?>			
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width60 left">Reports</div>
				<div class="head2 width10 left">Code </div>
				<div class="head2 width10 left">New</div>
				<div class="head2 width10 left">Top</div>
			</div>
			<?php 
				if ($stmt = $mysqli->prepare("select inc_id,title,code,status,new,top from zsp_posts where ".$cond." 1=1 order by dt_created desc ")) {
					if($parent[0]!="" || $parent[1]!=""){
					$stmt->bind_param('i',$id);
					}
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($inc_id,$title,$sort_order,$status,$new,$top);
				}
				$pf=1;
				while( $stmt->fetch() ) {
				if($status==0){ $inactve='inactive';}else{ $inactve=""; }
			?>
			<div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width60 left padding10 bdr_right"><?=$title?><input type="hidden" name="hidID<?=$pf?>" value="<?=$inc_id?>"  /></div>
				<div class="head4 width10 left padding10 bdr_right"><?=$sort_order?></div>
				<div class="head4 width10 left padding10 bdr_right">
				<input type="checkbox" name="txtP<?=$pf?>" id="txtP" <?php if($new==1){ echo 'checked="checked"';  }?>   />
				</div>
				<div class="head4 width10 left padding10 bdr_right">
				<input type="checkbox" name="txtB<?=$pf?>" id="txtB" <?php if($top==1){ echo 'checked="checked"';  }?>   />
				</div>
			</div>
			<?php 
			$pf++;
			} 
			?>
			<input type="hidden"  name="hidTotal" id="hidTotal" value="<?=$pf?>" />
		</div>
					<?php }else{
						?>
						<div class='width100'><h3 class="head2">Select Category & Sub Category to modify reports modification</h3></div>
						<?php
						
					} ?>
	</div>
	</form>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>