<?php include_once "../includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php 

if($_POST['butSubmit'] == "Submit"){
	if($_POST['act'] == "edit" && $_POST['cat_id'] != ""){
		$query = "update em_rss_feed_sources set name='".$_POST['txtCatName']."',xml_url='".$_POST['txtLink']."',keywords='".$_POST['txtKeywords']."' where id='".$_POST['cat_id']."'";
		$retUrl = $_POST['retPage']."?pageId=".$_REQUEST['pageId'];
	}else{
		if(mysqli_num_rows(mysqli_query($mysqli,"select * from em_rss_feed_sources where name='".$_POST['txtCatName']."'"))>0){
			$stat = "EXISTED";
		}else{
			$query = "insert into em_rss_feed_sources(name,description,xml_url,keywords,active_flag,date_created,date_last_updated) values('".$_POST['txtCatName']."', 'Deccription','".$_POST['txtLink']."','".$_POST['txtKeywords']."','Y',now(),now())";
			$retUrl = $_SERVER['PHP_SELF'];
		}
	}

	
	if($query != ""){
		$result = mysqli_query($mysqli,$query);
		$error = mysqli_error($mysqli);
		if($error == ""){
			$stat = "SUCCESS";
		}else{
			$stat = "FAIL";
		}
	}
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
<title><?=$pgTitle?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/tabs.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../js/general.js"></script>
<!-- menu and tabs -->
<!--<script src="js/jquery-1.11.1.min.js"></script> -->
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
	<form name="frmAddCategory" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data" >
    <div class="width100"  >
		<div class="topright width100 left">
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<ul>
				<li><input name="butSubmit" type="submit" class="forButton" id="butSubmit" value="Submit" tabindex="2" /></li>
			</ul>
		</div>
		
		
		<?php 
			if($_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
				$mainTitle = "Edit Category";
			}else{
				$mainTitle = "Add Category";
			}
		?>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-newspaper-o"></i> <?=$mainTitle?></div>
		</div>
		
	
		
		
		
		<div class="width100 left pb50" >
			<div class="events">
                	<script type="text/javascript">
						$(document).ready( function() {
						$('#tab-container').easytabs();
						});
					</script>        
					
					
					<div id="tab-container" class='tab-container'>
						<div class='panel-container'>  
					          
							  
					  
							  
							  <div id="ctab1">
                              	
								<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="" >
  			<tr>
    			<td align="left" valign="middle">&nbsp;</td>
  			</tr>
  			<tr>
   				<td align="left" valign="middle" class="subheading" style="padding-left:15px">
 
				</td>
		  	</tr>
  			<tr>
    			<td align="left" valign="middle">&nbsp;</td>
  			</tr>
  			<tr>
    			<td align="left" valign="middle">
<?php
if($stat != ""){

?>    
 					<table width="80%" border="0" align="center" cellpadding="0" cellspacing="6">
<?php
	if($stat == "SUCCESS"){     
?>	
					<tr>
    					<td width="22%" align="center" valign="middle" class="greentext">Category has been updated successfully.</td>
					</tr>
<?php
	}
	if($stat == "EXISTED"){     
?>	
					<tr>
    					<td width="22%" align="center" valign="middle" class="redtext">Category already existed.</td>
					</tr>
<?php
	}
	if($stat == "FAIL"){    
?>	
					<tr>
	 					<td align="center"valign="middle" class="redtext">Error: Unable to change category. Please try again.</td>
					</tr>
<?php
	}
?>	    
					<tr>
	 					 <td align="center" valign="middle" class="text1">&nbsp;</td>
	  				</tr>
					<tr>
	  					<td align="center" valign="middle"><a href="<?=$retUrl?>" class="text1_small" style="text-decoration:none;">Click here to go back.</a></td>
	  				</tr>
				</table>    
<?php
}else{
?>
<script language="javascript" type="text/javascript">
function validate(){

var name=document.frmCategory.txtCatName.value;
var elink=document.frmCategory.txtLink.value;
  
	if(trim(name) == ""){
		alert("Please enter category name.");
		document.frmCategory.txtCatName.focus();
		return false;
	}
	document.frmCategory.txtCatName.value = trim(name);
	
	if(trim(elink) == ""){
		alert("Please enter Link.");
		document.frmCategory.txtLink.focus();
		return false;
	}
	document.frmCategory.txtLink.value = trim(elink);
	return true;
}

function givefocus(){
document.getElementById("txtCatName").focus();
}
</script>    

<form name="frmCategory" enctype="multipart/form-data" method="post" action="" onSubmit="return validate()">    
<?php
if(is_numeric($_REQUEST['cat_id']) && $_REQUEST['act']=="edit"){
	$cat_id = $_REQUEST['cat_id'];
	$query = "select * from em_rss_feed_sources where id=".$cat_id;
	$result = mysqli_query($mysqli,$query);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		echo '<input type="hidden" name="act" value="edit">';
		echo '<input type="hidden" name="inc_cat_id" value="'.$row['id'].'">';
		$txtCatName = $row['name'];
		$link = $row['xml_url'];
		$keywords = $row['keywords'];
	}
}
?>
	
    		<table width="80%" border="0" align="center" cellpadding="0" cellspacing="6">
      			<tr>
        			<td width="22%" align="left" valign="middle" class="bold_txt"> Category:</td>
        			<td width="78%" align="left" valign="middle"><input name="txtCatName" type="text" class="forTextfield" maxlength="50" id="txtCatName" value="<?=$txtCatName?>" size="40" tabindex="1" ><?php
		
if($_REQUEST['act'] == "edit" && is_numeric($_REQUEST['cat_id'])){
	if($_REQUEST['retPage'] == 1){
		echo '<input type="hidden" name="retPage" value="viewFeedCategories.php">';	
	}else{
		echo '<input type="hidden" name="retPage" value="viewFeedCategories.php">';	
	}
	echo '<input type="hidden" name="act" value="edit"><input type="hidden" name="cat_id" value="'.$_REQUEST['cat_id'].'">';	
}         
	?>				</td>
     			 </tr>
        <tr>
        <td align="left" valign="middle" class="bold_txt">Link</td>
        <td align="left" valign="middle"><input name="txtLink" type="text" size="50" class="forTextfield" id="txtLink" value="<?=$link?>"/>
        
          </td>
      </tr>
	  
	  
	  <tr>
        <td align="left" valign="middle" class="bold_txt">Keywords</td>
        <td align="left" valign="middle"><textarea name="txtKeywords" type="text" size="50" class="forTextfield" id="txtKeywords"><?=$keywords?></textarea>
        
          </td>
      </tr>
	  
	  
	  
	  
	  
      			<tr>
        			<td height="1" colspan="2" align="left" valign="middle"></td>
        		</tr>
      			<tr>
       				<td align="left" valign="middle" class="text1">&nbsp;</td>
        			<td align="left" valign="middle"><input name="butSubmit" type="submit" class="forButton" id="butSubmit" value="Submit" tabindex="2" /></td>
     			 </tr>
    		</table>
</form> 
<?php
}
?>   
		</td>
  	</tr>
  	<tr>
    	<td align="left" valign="middle">&nbsp;</td>

  	</tr>
</table>
								
								
								
								
								
								
					
								
								
								
								
								
								
								
							  </div>
					  	</div>
					</div> 

                </div>
		</div>
	</div>
	</form>
	</div>    	
</div>
<?php include_once "../includes/ui_admin_footer.php"; ?>
</body>
</html>