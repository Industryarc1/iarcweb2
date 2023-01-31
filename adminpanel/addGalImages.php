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
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-pencil"></i>  Upload Documents to users </div>
			
		</div>
		<div class="width100 left border" >
			<div class="width50 left padding10 <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<div class="bgcolor2 padding40 " >
			<script>
	function validate(){
		
		var txtParent=document.uploadImages.txtParent.value;
		var txtParent1=document.uploadImages.txtParent1.value;
		
		if(trim(txtParent) == ""){
			alert("Category should not be empty.");
			document.uploadImages.txtParent.focus();
			return false;
		}
		if(trim(txtParent1) == ""){
			alert("Gallery  should not be empty.");
			document.uploadImages.txtParent1.focus();
			return false;
		}
		return true;
	}
	</script>
			<form name="uploadImages" method="post" action="actions.php" enctype="multipart/form-data" onSubmit="return validate()"  >
			<div class="padding10" >
								<div class="head4 width180px left">Category</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_user_id,login_id,fname,lname from zsp_user_accounts ")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_user_id, $login_id,$fname,$lname);
								}
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="window.location='addGalImages.php?id='+this.value" >
								<option value="" >Select</option>
								<?php while( $stmt->fetch() ) {  if($_REQUEST['id']==$inc_user_id){ $sel='selected="selected"';}else{ $sel=''; }
								?>
								<option value="<?=$inc_user_id?>" <?=$sel?> ><?=$login_id." - ".$fname." ".$lname?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>	
								
								<div class="head4 width150px left">Select Documents </div>
			
			<input  name="txtImage[]" type="file" class="forTextfield" multiple  />
			<input type="hidden" name="hidUID" value="<?=$_REQUEST['id']?>" >
			<input type="submit" name="uploadDocuments" value="Upload Documents" class="forButton" >
			
			</form>
			</div>
			
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Documents </div>
		</div>
		<div class="width100 left pb50" >
			<?php
			
			
			$desired_dir="../documents/";
			
			if($_REQUEST['action']=="unlink" && $_REQUEST['doc']!="" ){
				
				$sql="delete from zsp_user_documents where document=? ";
				$stmt = $mysqli->prepare($sql);
				$s='s';
				$stmt->bind_param($s,$_REQUEST['doc']);
				$flag=$stmt->execute();	
				
				if(file_exists($desired_dir.$_REQUEST['doc'])){
					unlink($desired_dir.$_REQUEST['doc']);
				}
			}
			if ($stmt1 = $mysqli->prepare("select inc_id,document,document_name from zsp_user_documents where user_id=?")) {
				$stmt1->bind_param('s',$_REQUEST['id']);
				$stmt1->execute();
				$stmt1->store_result();
				$stmt1->bind_result($inc_id1, $document,$doc_name);
				while($stmt1->fetch()){
					echo '<div style="float:left" class="width100 padding10 "><a href="../documents/'.$document.'" target="_blank" >'.$doc_name.'</a> &nbsp;&nbsp;
					<a href="addGalImages.php?id='.$_REQUEST['id'].'&action=unlink&doc='.$document.'"><i class="fa fa-trash"></i></a><br></div>';
					
				}
			}
			
			
			?>
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>