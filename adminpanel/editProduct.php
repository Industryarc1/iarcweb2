
<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>

<?php
if($_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
	$cid=$_REQUEST['id'];
	if ($cat = $mysqli->prepare("select * from zsp_news where prod_id=?")) {
			$cat->bind_param('i',$cid );
			$cat->execute();
			$cat->store_result();
			if($cat->num_rows>0){
				$cat->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7,$det8,$det9,$det10,$det11,$det12,$det13,$det14,$det15,$det16,$det17,$det18);
				$cat->fetch();
				$det7 = base64_decode($det7);
				$det7 = str_replace('\"', '"', $det7);
				$det7 = str_replace("\'", "'", $det7);
				
				$det11 = base64_decode($det11);
				$det11 = str_replace('\"', '"', $det11);
				$det11 = str_replace("\'", "'", $det11);
				
				$det12 = base64_decode($det12);
				$det12 = str_replace('\"', '"', $det12);
				$det12 = str_replace("\'", "'", $det12);
				
				$det17 = base64_decode($det17);
				$det17 = str_replace('\"', '"', $det17);
				$det17 = str_replace("\'", "'", $det17);
				
				
				$cat->close();
			}else{
				$_SESSION['stat']="NA";
				$allClasses->forRedirect ("addProduct.php");
			}
		}
}else{
	$allClasses->forRedirect ("products.php");
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
	<form name="frmAddCategory" action="actions.php" method="post" enctype="multipart/form-data" onSubmit="return validate()" >
	<?php
	echo '<input type="hidden" name="hid_article_id" value="'.$det1.'" />';
	echo '<input type="hidden" name="hid_action" value="editArticle" />';
	?>
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="eidtArticle" value="Save Article" class="forButton fixedclass" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Edit News</div>
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
						   
						   <li class='tab'><a href="#ctab4">SEO</a></li> 
						</ul>
						<div class='panel-container'>  
						      <?php
							  
							  ?>    
							  <div id="ctab1">
							 	<?php /*?><div class="padding10" >
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
								if($det3==$inc_id){ $sel='selected="selected"';}else{ $sel='';}
								?>
								<option value="<?=$inc_id?>" <?=$sel?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div><?php */?> 
                              	<div class="padding10" >
								<div class="head4 width180px left">Title</div><input name="txtName" type="text" value="<?=$det2?>" class="width60" id="txtName" >
								</div>
								
									
								
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">Sort Order</div><input name="txtSortOrder" type="text" value="<?=$det9?>" class="width220px" id="txtSortOrder" >
								</div><?php */?>
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">Popular ?</div>
								<select name="txtPPLR" type="text" class="width180px" id="txtPPLR" >
									<option value="0" <?php if($det8==0){ echo 'selected="selected"'; }?>  >No</option>
									<option value="1" <?php if($det8==1){ echo 'selected="selected"'; }?> >Yes</option>
								</select>
								
								</div><?php */?>		
								<div class="padding10" >
								<div class="head4 width180px left">Active ?</div>
								<select name="txtActive" type="text" class="width180px" id="txtActive" >
									<option value="1" <?php if($det14==1){ echo 'selected="selected"'; }?>  >Enabled</option>
									<option value="0" <?php if($det14==0){ echo 'selected="selected"'; }?> >Disabled</option>
								</select>
								
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Short Description</div>
								<textarea name="txtShortDescr" type="text" class="width95" id="txtShortDescr"  ><?=$det17?></textarea>
								
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left ">Description</div>
								<textarea name="txtDescr" type="text" class="width95" id="txtDescr"><?=$det7?></textarea>
								<!--<script src="editor/nicEdit.js" type="text/javascript"></script>-->

								<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<!--<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>-->

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
								<div class="padding10" >
								<div class="head4 width180px left">Image </div><input name="txtImage" type="file" class="width220px" value="" id="txtImage" >
								<br>
								<input type="hidden" name="hidImage" value="<?=$det6?>" >
								<img src="../articleImages/thumbs/<?=$det6?>" >
								
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Date</div>
								<input name="txtMnfctr" type="text" class="width60" value="<?=$det5?>" id="txtMnfctr" >
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Category</div>
								 <?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" >
								<option value="0" >None</option>
								<?php while( $stmt->fetch() ) { ?>	
									<option value="<?=$inc_id?>" <?php if(@$det3==$inc_id){ echo 'selected="selected"'; } ?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>						  
							  </div>
							  
							  <div id="ctab4">
                              	<div class="padding10" >
								<div class="head4 width180px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width220px" value="<?=$det10?>" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Keywrds</div><textarea name="txtMetaKeywords" type="text" class="width50" id="txtMetaKeywords" ><?=$det11?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">meta Desc.</div><textarea name="txtMetaDesc" type="text" class="width50" id="txtMetaDesc" ><?=$det12?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Custom URL</div><input name="txtSEOKeyword" type="text" class="width220px" id="txtSEOKeyword" value="<?=$det13?>" >
								<span class="fs10" ></span>
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Custom ID</div><input name="txtCustId" type="text" class="width220px" id="txtCustId" value="<?=$det18?>" >
								<span class="fs10" ></span>
								</div>
								<div class="height20px"></div>
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