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
	<script>
	function validate(){
		var txtParent=document.frmAddCategory.txtParent.value;
		var txtParent1=document.frmAddCategory.txtParent1.value;
		
		if(trim(txtParent) == ""){
			alert("Category should not be empty.");
			document.frmAddCategory.txtParent.focus();
			return false;
		}
		/*if(trim(txtParent1) == ""){
			alert("Listed in should not be empty.");
			document.frmAddCategory.txtParent1.focus();
			return false;
		} */
		return true;
	}
	</script>
	<form name="frmAddCategory" action="uploadExcelPost1.php" enctype="multipart/form-data" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left ">
			
			<ul>
				<li><input type="submit" name="addArticle" value="Save Posts" class="forButton fixedclass" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Report </div>
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
						   <li class='tab'><a href="#ctab1">Add reports</a></li>
						  <?php /*?> <li class='tab'><a href="#ctab3">Report Type Codes</a></li>
						   <li class='tab'><a href="#ctab4">Publisher Codes</a></li>
						   <li class='tab'><a href="#ctab5">Licence Codes</a></li><?php */?>
						</ul>
						<div class='panel-container'>  
						          
							  <div id="ctab1">
							 	 
                              	
								<!--<div class="padding10" >
								<div class="head4 width180px left">Category</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and inc_id not in (1,2)")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="getSubCat(this.value)" >
								<option value="" >Select</option>
								<?php while( $stmt->fetch() ) { 
								?>
								<option value="<?=$inc_id?>"  ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>	
								
								<div class="padding10" id="subCatAjax" >
								<div class="head4 width180px left">Sub Category</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and inc_id not in (1,2)")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<select name="txtParent1" type="text" class="width280px" id="txtParent1" >
								<option value="" >Select</option>
								</select>
								</div>-->
								
										
								<div class="padding10" >
								<div class="head4 width180px left">Excel File </div>
									<input class="forTextfield" type="file" name="excelfile" id="excelfile" />
								</div>	
						  </div>
						  
						  <?php /*?><div id="ctab3">
						  	<?php
							if ($stmt = $mysqli->prepare("select inc_id,name,code,status from zsp_reports where status=1 order by dt_created asc")) {
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($inc_id, $name,$code,$status);
								while( $stmt->fetch() ) {
									echo '<div class="head4 width220px left">'.$name.' - '.$code.' </div>';
								}
								$stmt->close();
							}
							?>
						  </div>
						  <div id="ctab4">
						  	<?php
							if ($stmt = $mysqli->prepare("select inc_id,name,code,status from zsp_publishers where status=1 order by dt_created asc")) {
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($inc_id, $name,$code,$status);
								while( $stmt->fetch() ) {
									echo '<div class="head4 width220px left">'.$name.' - '.$code.' </div>';
								}
								$stmt->close();
							}
							?>
						  </div>
						  <div id="ctab5">
						  	<?php
							if ($stmt = $mysqli->prepare("select inc_id,name,code,status from zsp_licences where status=1 order by dt_created asc")) {
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($inc_id, $name,$code,$status);
								while( $stmt->fetch() ) {
									echo '<div class="head4 width220px left">'.$name.' - '.$code.' </div>';
								}
								$stmt->close();
							}
							?>
						  </div><?php */?>
						</div>
					</div> 
                </div>
		</div>
	</div>
	</form>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
<script language="javascript" >
	function addProductSize(){
		var totalSizes=document.getElementById("totalSizes").value;
		var sid=parseInt(totalSizes)+1;
		document.getElementById("totalSizes").value=sid;
		var pid=document.getElementById("txtPCode").value;
		//alert(pid);
		var theDiv = document.getElementById("productSIZES");
		theDiv.innerHTML += '<div class="head3 width20 left"><input name="txtUPID'+sid+'" type="text" value="'+pid+sid+'" class="width120px" id="txtUPID'+sid+'" ></div><div class="head3 width20 left"><input name="txtSize'+sid+'" type="text" class="width120px" id="txtSize'+sid+'" ></div><div class="head3 width20 left"><input name="txtMRP'+sid+'" type="text" class="width120px" id="txtMRP'+sid+'" ></div><div class="head3 width20 left"><input name="txtSP'+sid+'" type="text" class="width120px" id="txtSP'+sid+'" ></div>'; 
	}
	function insertUPID(pid){
		document.getElementById("txtUPID1").value=pid+"1";
	}
</script>
</body>
</html>