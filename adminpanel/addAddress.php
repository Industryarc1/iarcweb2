<?php include_once "includes/config.php"; include "dbFunctions.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 
extract($_POST);

if(isset($addAddress))
{
        if($hid_user_id!=0)
	{  
                $query = "UPDATE zsp_officeaddresses SET address=?,country=?,map=?,type=? WHERE id=?";
		if ($stmt2 = $mysqli->prepare($query)) 
		{		
			$stmt2->bind_param('sssss', $txtDescr,$txtCountry, $txtMap,$txtType, $hid_user_id);
			$flag2=$stmt2->execute();
			if($flag2)
			{
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("contactUs.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("contactUs.php");
				exit;
			}
		}	 
	}else
	{	 
		if ($stmt1 = $mysqli->prepare("select address from zsp_officeaddresses where country=? and type=?")) 
		{
			$stmt1->bind_param('ss', $txtCountry, $txtType);
			$stmt1->execute();
			$stmt1->store_result();
 
			if($stmt1->num_rows>0)
			{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("contactUs.php");
				exit;
			}else
			{
				$sql="INSERT INTO zsp_officeaddresses(address, country, map, type) VALUES (?,?,?,?)"; 
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param('ssss', $txtDescr,$txtCountry,$txtMap,$txtType);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SA";
					$allClasses->forRedirect ("contactUs.php");
					exit;
				}else{
					$_SESSION['stat']="FA";
					$allClasses->forRedirect ("contactUs.php");
					exit;
				}
			}
		}
	}	 
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
	<script>
	function validate(){
		
		var txtName=document.frmAddCategory.txtName.value;
		/*var txtParent=document.frmAddCategory.txtParent.value;
		
		if(trim(txtParent) == ""){
			alert("Category should not be empty.");
			document.frmAddCategory.txtParent.focus();
			return false;
		}*/
		
		if(trim(txtName) == ""){
			alert("Title should not be empty.");
			document.frmAddCategory.txtName.focus();
			return false;
		}
		
		return true;
	}
	</script>
	<form name="frmAddCategory" action="" enctype="multipart/form-data" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left ">			
			<ul>
				<li><input type="submit" name="addAddress" value="Save Address" class="forButton fixedclass" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Address</div>
		</div>
		<div class="width100 left pb50" >
			<div class="events">
                	<script type="text/javascript">
						$(document).ready( function() {
						$('#tab-container').easytabs();
						});
					</script>  
					<?php 
					if ($stmt = $mysqli->prepare("SELECT id,address,country,map,type FROM zsp_officeaddresses WHERE type!='desc' and id=?")) 
					{
						$stmt->bind_param('s',$_REQUEST['id']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($id, $address, $country, $map, $type);					
						$stmt->fetch() ;
						echo '<input type="hidden" name="hid_user_id" value="'.@$id.'" />';		
					
					}
					?>
					<div id="tab-container" class='tab-container'>
						<ul class='etabs'>
						   <li class='tab'><a href="#ctab1">General</a></li>
						   
						   <!-- <li class='tab'><a href="#ctab4">SEO</a></li>  -->
						</ul>
						<div class='panel-container'>  						          
							<div id="ctab1">							 	
								<!-- <div class="padding10" >
									<div class="head4 width180px left">Short Description</div>
									<textarea name="txtShortDescr" type="text" class="width95" id="txtShortDescr"  ></textarea>								
								</div>	-->
								<div class="padding10">
									<div class="head4 width180px left">Select Country</div>
										<?php
										$countryObj=new country();
										$countryObjResult=$countryObj->getCountryList($mysqli);
										?>
										<select name="txtCountry" id="txtCountry">
											<option value="">Select Country</option>
											<?php 
											foreach($countryObjResult as $countryObjResultVal)
											{
												?>
												<option value="<?=$countryObjResultVal[1]?>" <?php if(@$country==$countryObjResultVal[1]){echo "selected"; } ?>><?=$countryObjResultVal[1]?></option>
												<?php 
											}																			
											?>
										</select>						
								</div>
								<div class="padding10">
									<div class="head4 width180px left">Select HQ/Distributors</div>
										<select name="txtType" id="txtType">
											<option value="">Select</option>											
											<option value="Headquarters" <?php if(@$type=="Headquarters"){echo "selected";} ?>>Headquarters</option>										
											<option value="Distributors Resellers Office" <?php if(@$type=="Distributors Resellers Office"){echo "selected";} ?>>Distributors Resellers Office</option>										
										</select>						
								</div>								
								<div class="padding10" >
									<div class="head4 width180px left">Map Src</div>
									<input name="txtMap" type="text" value="<?=@$map?>" class="width70" id="txtMap" maxLength="250">
								</div>																
								<div class="padding10">
									<div class="head4 width180px left ">Address</div>
									<textarea name="txtDescr" type="text" class="width80" id="txtDescr"><?=@$address?></textarea>
									<script src="editor/nicEdit.js" type="text/javascript"></script>
									<script>
										var area1, area2;
										function toggleArea1() {
											if(!area1) {
												area1 = new nicEditor({fullPanel : true}).panelInstance('txtDescr',{hasPanel : true});
											} else {
												area1.removeInstance('txtDescr');
												area1 = null;
											}
										}
										function toggleArea2() {
											if(!area2) {
												area2 = new nicEditor({fullPanel : true}).panelInstance('txtShortDescr',{hasPanel : true});
											} else {
												area2.removeInstance('txtShortDescr');
												area2 = null;
											}
										}
										bkLib.onDomLoaded(function() { toggleArea1();toggleArea2();});
									</script> 
								</div>	
									<!--
								<div class="padding10" >
									<div class="head4 width180px left">Image </div>
									<input name="txtImage" type="file" class="width220px" value="" id="txtImage" >									
								</div>	
										  -->
							  </div>
							  <!--
							  <div id="ctab4">
								<div class="padding10" >
								<div class="head4 width180px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width220px" value="" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Keywrds</div><textarea name="txtMetaKeywords" type="text" class="width50" id="txtMetaKeywords" ></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">meta Desc.</div><textarea name="txtMetaDesc" type="text" class="width50" id="txtMetaDesc" ></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Custom URL</div>
								<input name="txtSEOKeyword" type="text" class="width220px" id="txtSEOKeyword" value="" >
								<span class="fs10" ></span>								</div>
								<div class="height20px"></div>
							  </div>-->
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