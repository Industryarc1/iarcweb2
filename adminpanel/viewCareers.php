<?php include_once "includes/config.php"; ?>
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
				<li><a href="addCareers.php" ><i class="fa fa-plus-square"></i></a></li>
				
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Careers</div>
		</div>
		
	<div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="width100 left border_bottom">
  <tr>
    <td align="left" valign="middle"><?php
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#F0F0F0" >
  <tr border_bottom bgcolor1" style="background-color:#EAEAEA">
  
   <?php /*?> <td width="3%" align="center" valign="middle" class="head3">S.No</td><?php */?>
	<td width="74%" align="center" valign="middle" class="head3" >Job Title</td>
  
	<td width="7%" align="center" valign="middle" class="head3">Status</td>
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
if(@$_REQUEST['act']=='changeStat' && is_numeric($_REQUEST['id']) ){
	$query = "update zsp_careers set stat='".$_REQUEST['stat']."' where inc_job_id=".$_REQUEST['id'];
	$result = @mysqli_query($mysqli,$query);
	$error = mysqli_error($mysqli);
	if($error == ""){
		$status = '<div class="greentext">Status has been changed successfully.</div>';
	}else{
		$status = '<div class="redtext">Error: Unable to change status.</div>';
	}
}




if(@$_REQUEST['act'] == "del" && is_numeric($_REQUEST['inc_prod_id'])){
	
	$query1="select * from zsp_careers where inc_job_id=".$_REQUEST['inc_prod_id'];
	$res=mysqli_query($mysqli,$query1);
	if(mysqli_num_rows($res)>0){
	    $rowdel=mysqli_fetch_array($res);
	}
		
	$query = "delete from zsp_careers where inc_job_id=".$_REQUEST['inc_prod_id'];
	$result = mysqli_query($mysqli,$query);
	$error = mysqli_error($mysqli);
	if($error == ""){
		
		$msg = '<div align="center" class="redtext">Record has been removed successfully.</div>';
	}else{
		$msg = '<div align="center" class="redtext">Error: Unable to remove record. Please try again.</div>';
	}
	
}


		$query = "select *,date_format(dt_created, '%d %M, %Y')as dt_created2  from zsp_careers order by dt_created desc ";
		
		$result = mysqli_query($mysqli,$query);
		$level="";
		if(mysqli_num_rows($result)>0){
			$level=$level+1;
		}
		$t=1;	
		while($row = mysqli_fetch_assoc($result)){
			
			?>
			<tr class="" style="font-family:Arial, Helvetica, sans-serif;font-size:12px">
				<?php /*?><td align="left" valign="middle"  style="padding:3px"> <?=$t?></td><?php */?>
				
				
				<td ><?=$row['job_title']?></td>
				
				<td>
				<?php
			if($row['stat'] == '0' || $row['stat'] == ''){        
		?>
		<a href="javascript:void(0)" onClick="window.location='<?=$_SERVER['PHP_SELF']."?act=changeStat&stat=1&id=".$row['inc_job_id']; ?>';return false;"><i class="fa fa-circle" style="color:#FF3300;font-size:24px;" title="Change Status"></i></a>
		<?php
			} if($row['stat'] == '1'){        
		?>		
			<a href="javascript:void(0)" onClick="window.location='<?=$_SERVER['PHP_SELF']."?act=changeStat&stat=0&id=".$row['inc_job_id'];?>';return false;"><i class="fa fa-circle" style="color:#367C29;font-size:24px;" title="Change Status"></i></a>
		<?php } ?>
				</td>
				
				<td >
			<table>
			  <tr>
				<td align="center" valign="middle"><a href="editCareers.php?act=edit&job_id=<?=$row['inc_job_id'];?> "><i class="fa fa-pencil-square" style="color:#167CAD; font-size:24px;"></i></a></td>
				<td align="center" valign="middle"><a href="javascript:void(0)" onClick="if(confirm('Do you want to remove?')){window.location.href='<?=$_SERVER['PHP_SELF']."?act=del&inc_prod_id=".$row['inc_job_id']?>';return false;}"><i class="fa fa-trash" style="color:#FF0000; font-size:24px;"></i></a></td>
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
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>