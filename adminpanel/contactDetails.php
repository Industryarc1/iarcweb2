<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if(isset($_POST["updateContact"]) && $_POST["updateContact"]=="Save"){
	$id=0;
	$mail=$_POST['txtMail'];
	$phone=$_POST['txtPhone'];
	$facebook=$_POST['txtFace'];
	$linked=$_POST['txtLinked'];
	$twitter=$_POST['txtTwitter'];
	$gplus=$_POST['txtGPlus'];
	$youtube=$_POST['txtYT'];
	
	
	
	if($_POST['hid_action']=="editcat" && $_POST['hid_contact_id']!=""){
		$sql="update tbl_contact set mail =?,phone =?,face=?,linked=?,twitter=?,youtube=?,google_plus=? where cid=?";
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		
		if ($stmt = $mysqli->prepare($sql)){
			$bind='sssssssi';
			$stmt->bind_param($bind,$mail,$phone,$facebook,$linked,$twitter,$youtube,$gplus,$_POST['hid_contact_id']);
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ($pg);
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ($pg);
				exit;
			}
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
	<form name="frmAddCategory" action="" method="post" enctype="multipart/form-data" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<ul>
				<li><input type="submit" name="updateContact" value="Save" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-phone-square"></i> Update Contact Details</div>
		</div>
		<div class="width100 left">
			
		</div>
		
		<div class="width100 left pb50" >
			<div class="events">
                	<script type="text/javascript">
						$(document).ready( function() {
						$('#tab-container').easytabs();
						});
					</script>        
					
					<div id="tab-container" class='tab-container'>
						<ul class='etabs'>
						   <!--<li class='tab'><a href="#ctab1">General</a></li>
						   <li class='tab'><a href="#ctab2">SEO</a></li> -->
						</ul>
						
						<div class='panel-container'>  
							<?php
								$cid=777;
								if ($cat = $mysqli->prepare("select * from tbl_contact where cid =?")) {
										//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
										$cat->bind_param('i',$cid );
										$cat->execute();
										$cat->store_result();
										if($cat->num_rows>0){
											$cat->bind_result($cid,$mail,$phone,$facebook,$linked,$twitter,$youtube,$google_plus,$addr,$dt_created);
											$cat->fetch();
											
											echo '<input type="hidden" name="hid_contact_id" value="'.$cid.'" />';
											echo '<input type="hidden" name="hid_action" value="editcat" />';
											$cat->close();
										}
									}
							
							?>            
						  <div id="ctab1">
							<div class="padding10" >
								<div class="head4 width180px left">Admin Mail</div>
								<input name="txtMail" type="text" value="<?=$mail?>" class="width220px" id="txtMail" >
							</div>
							<div class="padding10" >
								<div class="head4 width180px left">Phone</div>
								<input name="txtPhone" type="text" value="<?=$phone?>" class="width220px" id="txtPhone" >
							</div>
							<div class="padding10" >
								<div class="head4 width180px left">Address</div>
								<input name="txtLinked" type="text" value="<?=$linked?>" class="width220px" id="txtLinked" >
							</div>
							<div class="padding10" >
								<div class="head4 width180px left">Facebook</div>
								<input name="txtFace" type="text" value="<?=$facebook?>" class="width220px" id="txtFace" >
							</div>
							
							<div class="padding10" >
								<div class="head4 width180px left">Twitter</div>
								<input name="txtTwitter" type="text" value="<?=$twitter?>" class="width220px" id="txtTwitter" >
							</div>
							<div class="padding10" >
								<div class="head4 width180px left">Google+</div>
								<input name="txtGPlus" type="text" value="<?=$google_plus?>" class="width220px" id="txtGPlus" >
							</div>
							<div class="padding10" >
								<div class="head4 width180px left">Linked in </div>
								<input name="txtYT" type="text" value="<?=$youtube?>" class="width220px" id="txtYT" >
							</div>
						  </div>
					  	</div>
					</div> 

                </div>
		</div>
	</div>
	</form>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>