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
		<div class="topright width100 left">
			
			<ul >
				<?php /*?><li ><a href="addProdList.php" class="forButton" >Add List</a> &nbsp;</li>
				<li ><a href="uploadImages.php" class="forButton" >Upload Images</a> &nbsp;</li>
				<li ><a href="popular.php" class="forButton" >Scr0lling & Highlights</a> &nbsp;</li><?php */?>
				<?php /*?><li><a href="featured.php" class="forButton"  >Featured</a> &nbsp;</li><?php */?>
				
				<?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> News Feed </div>
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		</div>
		
		<div class="width100 padding20" >
								<div class="head4 width10 left">Listed In</div>
								<?php
								if(@$_REQUEST['id']!=""){ 
									$parent=explode("@$@",$_REQUEST['id']);
									
								}
								if(@$parent[0]!=""){ 
									$cond=' feed_source_id=? and '; 
									$id=$parent[0];
								}
								
								
								if ($stmt = $mysqli->prepare("select inc_id,title from zsp_rss ")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<div class="width80 left">
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="window.location='feeds.php?id='+this.value+'@$@'" >
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
								
								</div>
								
								
								</div>						
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width80 left">Feeds</div>
				
				<div class="head2 width10 left">Action</div>
			</div>
			<?php 
				if ($stmt = $mysqli->prepare("select inc_id,title,link,status from zsp_rss_feed_items where ".@$cond." 1=1 order by dt_created desc")) {
					if(@$parent[0]!="" || @$parent[1]!=""){
					$stmt->bind_param('i',$id);
					}
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($prod_id,$title,$sort_order,$status);
				}
				
				while( $stmt->fetch() ) {
				if($status==0){ $inactve='inactive';}else{ $inactve=""; }
			?>
			<div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width80 left padding10 bdr_right"> <?=$title?><br/><?=$sort_order?> </div>
				
				<div class="head4 width10 left onoff">
				
				&nbsp;&nbsp;&nbsp;
				<?php if($status==1){ ?>
				<a href="actions.php?act=editSatus&id=<?=$prod_id?>&changeFeedStatus=0" ><i class="fa fa-check-circle"></i></a>
				<?php }?>
				<?php if($status==0){ ?>
				<a href="actions.php?act=editSatus&id=<?=$prod_id?>&changeFeedStatus=1" ><i class="fa fa-circle-thin"></i></a>
				<?php }?>
				
				</div>
			</div>
			<?php 
			} 
			?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>