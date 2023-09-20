<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if($_REQUEST['act']=="delete" && $_REQUEST['cid']!=""){
//$sql="delete from zsp_catlog_categories where inc_id='".$_REQUEST['cid']."'";
//mysqli_query($mysqli,$sql);
echo "Delete not allowed";
}
?>

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
				<li><a href="addCategory.php" ><i class="fa fa-plus-square"></i></a></li>
				<?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Category List</div>
			<div class="left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>
		<div class="width100 left">
			<div class="padding10" >
								<div class="head4 width180px left">Parent Category</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="window.location='categories.php?id='+this.value" >
								<option value="0" >Categories</option>
								<?php while( $stmt->fetch() ) { ?>	
									<option value="<?=$inc_id?>" <?php if($_REQUEST['id']==$inc_id){ echo 'selected="selected"'; } ?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>
		</div>
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width60 left">Category</div>
				<?php /*?><div class="head2 width10 left">Sort</div><?php */?>
				<div class="head2 width10 left">Home</div>
				<div class="head2 width10 left">Action</div>
			</div>
			<?php 
				if($_REQUEST['id']!=""){ $parent= $_REQUEST['id']; }else{ $parent=0; }
				if ($stmt = $mysqli->prepare("select inc_id,name,sort_order,status,home from zsp_catlog_categories where p_id='".$parent."' order by sort_order asc")) {
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($inc_id, $name,$sort_order,$status,$home);
				}
				while( $stmt->fetch() ) {
				if($status==0){ $inactve='inactive';}else{ $inactve=""; }
			?>
			<div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width60 left padding10 bdr_right"><?=$name?></div>
				<?php /*?><div class="head4 width10 left padding10 "><?=$sort_order?></div><?php */?>
				<div class="head4 width8 left padding10 bdr_right onoff">
				<?php /*?><?php if($home==1){ ?>
				<a href="actions.php?act=editHome&id=<?=$inc_id?>&changeCatHome=0" ><i class="fa fa-check-circle"></i></a>
				<?php }?>
				<?php if($home==0){ ?>
				<a href="actions.php?act=editHome&id=<?=$inc_id?>&changeCatHome=1" ><i class="fa fa-circle-thin"></i></a>
				<?php }?><?php */?>
				</div>
				<div class="head4  left onoff">
				<a href="editCategory.php?act=edit&id=<?=$inc_id?>" ><i class="fa fa-pencil-square"></i></a>
				&nbsp;&nbsp;&nbsp;
				<?php if($status==1){ ?>
				<a href="actions.php?act=editSatus&id=<?=$inc_id?>&changeCatStatus=0" ><i class="fa fa-check-circle"></i></a>
				<?php }?>
				<?php if($status==0){ ?>
				<a href="actions.php?act=editSatus&id=<?=$inc_id?>&changeCatStatus=1" ><i class="fa fa-circle-thin"></i></a>
				<?php }?>
				&nbsp;&nbsp;&nbsp;
				<!-- <a href="categories.php?act=delete&cid=<?=$inc_id?>" ><i class="fa fa-trash"></i></a> -->
				
				
				
				</div>
			</div>
			<?php 
				
			} ?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>
