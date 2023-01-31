<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>

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
	<script >
		function validate(){
			//var txtParent=document.frmAddCategory.txtParent.value;
			var txtName=document.frmAddCategory.txtName.value;
			var txtUID=document.frmAddCategory.txtUID.value;
			var txtPWD=document.frmAddCategory.txtPWD.value;
			/*
			if(trim(txtParent) == ""){
				alert("Plase select Publishers.");
				document.frmAddCategory.txtParent.focus();
				return false;
			}*/
			if(trim(txtName) == ""){
				alert("user name should noy be empty.");
				document.frmAddCategory.txtName.focus();
				return false;
			}
			if(trim(txtUID) == ""){
				alert("User ID should not be empty.");
				document.frmAddCategory.txtUID.focus();
				return false;
			}
			if(trim(txtPWD) == ""){
				alert("Password should not be empty.");
				document.frmAddCategory.txtPWD.focus();
				return false;
			}
			return true;
		}
	</script>
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="addUser" value="Save User" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Users</div>
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
						   <li class='tab'><a href="#ctab1">General</a></li>
						  
						</ul>
						<div class='panel-container'>  
						<?php
						if($_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
							$cid=$_REQUEST['id'];
							if ($cat = $mysqli->prepare("select * from zsp_users where inc_id=?")) {
									$cat->bind_param('i',$cid );
									$cat->execute();
									$cat->store_result();
									if($cat->num_rows>0){
										$cat->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7);
										$cat->fetch();
										
										
										echo '<input type="hidden" name="hid_user_id" value="'.$det1.'" />';
										echo '<input type="hidden" name="hid_action" value="edituser" />';
										$cat->close();
									}
									
								}
						}else{
							$cid=0;
						}
						?>            
							  <div id="ctab1">
                              	<!--<div class="padding10" >
								<div class="head4 width180px left">Publisher</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_publishers where status=1")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" >
								<option value="" >None</option>
								<?php while( $stmt->fetch() ) { ?>	
									<option value="<?=$inc_id?>" <?php if(@$det7==$inc_id){ echo 'selected="selected"'; } ?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select> 
								</div>-->
								<div class="padding10" >
								<div class="head4 width180px left"> Name</div><input name="txtName" type="text" value="<?=$det2?>" class="width220px" id="txtName" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">user ID</div><input name="txtUID" type="text" value="<?=$det3?>" class="width220px" id="txtUID" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">Password</div><input name="txtPWD" type="text" value="<?=$det4?>" class="width220px" id="txtPWD" >
								</div>
										
								<div class="padding10" >
								<div class="head4 width180px left">Active ?</div>
								<select name="txtActive" type="text" class="width180px" id="txtActive" >
									<option value="1" <?php if($cid!=0 && $det5==1){ echo 'selected="selected"'; }?>  >Enabled</option>
									<option value="0" <?php if($cid!=0 && $det5==0){ echo 'selected="selected"'; }?> >Disabled</option>
								</select>
								
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