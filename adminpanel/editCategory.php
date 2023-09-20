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
		var txtName=document.frmAddCategory.txtName.value;
		if(trim(txtName) == ""){
			alert("Category name should not be empty.");
			document.frmAddCategory.txtName.focus();
			return false;
		}
		return true;
	}
	</script>
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" enctype="multipart/form-data" >
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="editCatalogcategory" value="Save Category"  class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Edit Category</div>
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
							if ($cat = $mysqli->prepare("select * from zsp_catlog_categories where inc_id=?")) {
									$cat->bind_param('i',$cid );
									$cat->execute();
									$cat->store_result();
									if($cat->num_rows>0){
										$cat->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7,$det8,$det9,$det10,$det11,$det12,$det13,$det14,$det15,$det16,$det17);
										$cat->fetch();
										
										$det8 = base64_decode($det8);
										$det8 = str_replace('\"', '"', $det8);
										$det8 = str_replace("\'", "'", $det8);
										
										$det9 = base64_decode($det9);
										$det9 = str_replace('\"', '"', $det9);
										$det9 = str_replace("\'", "'", $det9);
										echo '<input type="hidden" name="hid_cat_id" value="'.$det1.'" />';
										echo '<input type="hidden" name="hid_action" value="editcat" />';
										$cat->close();
									}
									
								}
						}else{
							$cid=0;
						}
						?>            
							  <div id="ctab1">
                              	<?php if($det3!=0){ ?>
								<div class="padding10" >
								<div class="head4 width180px left">Parent Category</div>
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
									<option value="<?=$inc_id?>" <?php if($det3==$inc_id){ echo 'selected="selected"'; } ?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>
								<?php }?>
								<div class="padding10" >
								<div class="head4 width180px left">Category Name</div><input name="txtName" type="text" value="<?=$det2?>" class="width220px" id="txtName" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Sales Email</div><input name="txtEmail" type="email" value="<?=$det4?>" class="width220px" id="txtEmail" required>
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Code</div><input name="txtSortOrder" type="text" value="<?=$det15?>" class="width220px" id="txtSortOrder" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Image</div><input name="txtImage" type="file"  class="width220px" id="txtImage" >
								<?php
								if($det16!=""){
									echo '<br><img src="../articleimages/'.$det16.'" width="100" ><input type="hidden" name="hidImage" value="'.$det16.'" >';
								}
								?>
								</div>								
								<div class="padding10" >
								<div class="head4 width180px left">Description.</div>
								<textarea name="txtMetaDesc" type="text" class="width95" id="txtMetaDesc" ><?=$det9?></textarea>
								
								<script src="editor/nicEdit.js" type="text/javascript"></script>
								<script>
								var area1 ;
								function toggleArea1() {
									if(!area1) {
										area1 = new nicEditor({fullPanel : true}).panelInstance('txtMetaDesc',{hasPanel : true});
									} else {
										area1.removeInstance('txtMetaDesc');
										area1 = null;
									}
								}
								bkLib.onDomLoaded(function() { toggleArea1();});
								</script> 
								</div>		
								<div class="padding10" >
								<div class="head4 width180px left">Active ?</div>
								<select name="txtActive" type="text" class="width180px" id="txtActive" >
									<option value="1" <?php if($cid!=0 && $det12==1){ echo 'selected="selected"'; }?>  >Enabled</option>
									<option value="0" <?php if($cid!=0 && $det12==0){ echo 'selected="selected"'; }?> >Disabled</option>
								</select>
								
								</div>						  
							  </div>
							  <div id="ctab2">
								<div class="padding10" >
								<div class="head4 width180px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width220px" value="<?=$det7?>" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Keywords</div><textarea name="txtMetaKeywords" type="text" class="width50" id="txtMetaKeywords" ><?=$det8?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Meta Description</div><textarea name="txtMetaDesc1" type="text" class="width50" id="txtMetaDesc1" ><?=$det17?></textarea>
								</div>	
								
								<div class="padding10" >
								<div class="head4 width180px left">Custom URL</div><input name="txtSEOKeyword" type="text" class="width220px" id="txtSEOKeyword" value="<?=$det10?>" >
								
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