<?php include_once "../includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>


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
<title><?=$pgTitle?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/tabs.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../js/general.js"></script>
<script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script> 
<script src="../js/jquery.easytabs.min.js" type="text/javascript"></script>
<!-- menu and tabs -->


</head>
<body>
	<div class="wrapper">
    	<?php include_once "../includes/ui_admin_top.php"; ?>
</div>
<div class="container">
    <div class="con_left">
		<!--<i class="fa fa-list" ></i>-->
		<?php include_once "../includes/admin_menu.php"; ?>
	</div>
	<div class="con_right">
    <div class="width100"  >
		<div class="topright width100 left">
			<ul >
				<li><a href="addCategories.php" ><i class="fa fa-plus-square"></i></a></li>
				
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Categories</div>
		</div>
		
		<div class="width100 left">
			<div class="bread"><a href="index.php">Home</a> <i class="fa fa-angle-double-right"></i> Categories</div>
		</div>
		
		
		<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
		
		
		<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="width100 left border_bottom">
  <tr>
    <td align="left" valign="middle"><?php




	
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#F0F0F0" >
  <tr class="width100  border_bottom bgcolor1" style="background-color:#EAEAEA">
  
   <?php /*?> <td width="3%" align="center" valign="middle" class="head3">S.No</td><?php */?>
	<td width="74%" align="center" valign="middle" class="head3" >Category Name</td>
  
	
    <td width="12%" align="center" valign="middle" class="head3">Actions
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="center" valign="middle" class="head3">Edit</td>
    <td width="50%" align="center" valign="middle" class="head3">Delete</td>
  </tr>
</table>
</td>
    </tr>
	<form name="frmPri" action="" method="post"  >
	
	<?php



if($_REQUEST['act'] == "del" && is_numeric($_REQUEST['cat_id'])){
 $query_nws="select * from em_rss_feed_sources where id=".$_REQUEST['cat_id'];
	$res_nws=mysqli_query($mysqli,$query_nws);
	if(mysqli_num_rows($res_nws)>0){
	    $row_nws=mysqli_fetch_array($res_nws);
	$query = "delete from em_rss_feed_sources where id=".$_REQUEST['cat_id'];
	
	$result = mysqli_query($mysqli,$query);
	//$result = mysqli_query($mysqli,$query1);
	$error = mysqli_error($mysqli);

	if($error == ""){
		$msg = '<div align="center" class="redtext">Record has been removed successfully.</div>';
	}else{
		$msg = '<div align="center" class="redtext">Error: Unable to remove record. Please try again.</div>';
	}
	}
}


		$query = "select *,date_format(date_created, '%d %M, %Y')as dt_created2  from em_rss_feed_sources order by date_created desc ";
		
		$result = mysqli_query($mysqli,$query);
		if(mysqli_num_rows($result)>0){
			$level=$level+1;
		}
		$t=1;	
		while($row = mysqli_fetch_assoc($result)){
			
			?>
			<tr class="level1" style="font-family:Arial, Helvetica, sans-serif;font-size:12px">
				
				
				
				<td align="" valign="middle"  style="padding:5px"><?=$row['name']?></td>
				
				
				
				<td align="left" valign="middle" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="center" valign="middle"><a href="addFeedCategories.php?act=edit&cat_id=<?=$row['id']."&pageId=".$pageId?>&retPage=1"><i class="fa fa-pencil-square" style="color:#167CAD; font-size:24px;"></i></a></td>
				<td align="center" valign="middle"><a href="javascript:void(0)" onClick="if(confirm('Do you want to remove?')){window.location.href='<?=$_SERVER['PHP_SELF']."?act=del&cat_id=".$row['id']?>';return false;}"><i class="fa fa-trash" style="color:#FF0000; font-size:24px;"></i></a></td>
			  </tr>
			</table></td>
			  </tr>
			<?php
			
			$t++;
		}
		

?>
	

<!--<tr style="background-color:#E6E6E6"><td height="40" colspan="4" align="center"><input type="submit" name="butSubmit" value="Submit Priority" class="forButton" /> </td></tr>-->
</form>

</table>

  
    
    
    </td>
  </tr>
</table>
		
		
		
		
	</div>
	</div>    	
</div>
<?php include_once "../includes/ui_admin_footer.php"; ?>
</body>
</html>