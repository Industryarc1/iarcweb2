<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if($_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
	$cid=$_REQUEST['id'];
	if ($cat = $mysqli->prepare("SELECT inc_id, cat, subcat, title, code, short_descr, description, table_of_content, report_type, pub_date, report_del, del_time, file_format, no_pages, slp, clp, image, status, curl, meta_title, meta_keywords, meta_descr, seo_keyword, dt_created, related, taf, cc, new, top, pages, cat_but, atag, dup_inc_id, cbreadcrumb, publish_type, is_publish, pub_date_new, copies_sold, rating, taf_new,region_type,region FROM zsp_posts WHERE inc_id=?")) {
			$cat->bind_param('i',$cid);
			$cat->execute();
			$cat->store_result();
			if($cat->num_rows>0){
				$cat->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7,$det8,$det9,$det10,$det11,$det12,$det13,$det14,$det15,$det16,$det17,$det18,$det19,$det20,$det21,$det22,$det23,$det24,$det25,$det26,$det27,$det28,$det29,$det30,$det31,$det32,$det33,$det34,$det35,$det36,$det37,$det38,$det39,$det40,$det41,$det42);
				$cat->fetch();
				$cat->close();
				
				$det6= str_replace('\"', '"', $det6);
				$det6= str_replace("\'", "'", $det6);
				
				
				$det7=base64_decode($det7);
				$det7= str_replace('\"', '"', $det7);
				$det7= str_replace("\'", "'", $det7);
				$det7= str_replace('\n', "<br>", $det7);
				
				$det8=base64_decode($det8);
				$det8= str_replace('\"', '"', $det8);
				$det8= str_replace("\'", "'", $det8);
				$det8= str_replace('\n', "<br>", $det8);
				
				$det26=base64_decode($det26);
				$det26= str_replace('\"', '"', $det26);
				$det26= str_replace("\'", "'", $det26);
				$det26= str_replace('\n', "<br>", $det26);
				
				$det27=($det27);
				$det27= str_replace('\"', '"', $det27);
				$det27= str_replace("\'", "'", $det27);
				$det27= str_replace('\n', "<br>", $det27);
				
				$det40=base64_decode($det40);
				$det40= str_replace('\"', '"', $det40);
				$det40= str_replace("\'", "'", $det40);
				$det40= str_replace('\n', "<br>", $det40);
			}else{
				$_SESSION['stat']="NA";
				$allClasses->forRedirect ("addPost.php");
			}
		}
}else{
	$allClasses->forRedirect ("posts.php");
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
<script >
	function setCURL11(title){
		var title=title+" market.html";
		var title1 = title.replace(/  +/g, ' ');
		title1 = title1.replace(/ /g, '-');
		document.getElementById('txtCURL').value=title1;
	}
</script>
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
	<form name="frmAddCategory" action="updateProdList.php" method="post" enctype="multipart/form-data" onSubmit="return validate()" >
	<?php
	echo '<input type="hidden" name="hid_article_id" value="'.$det1.'" />';
	echo '<input type="hidden" name="hid_action" value="editArticle" />';
	?>
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="eidtArticle" value="Save Post" class="forButton fixedclass" ></li>
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
						   <li class='tab'><a href="#ctab1">General</a></li>
                           <li class='tab'><a href="#ctab2">Other Info.</a></li>
						   <li class='tab'><a href="#ctab3">SEO</a></li>
						   <li class='tab'><a href="#ctab4">FAQ'S</a></li>  
						</ul>
						<div class='panel-container'>  
						      <?php
							  
							  ?>    
							  <div id="ctab1">
							 	
								<div class="padding10" >
								<div class="head4 width220px left">Report ID (Old Report)</div><input name="txtRID" type="text" value="<?=$det33?>"  class="width280px" id="txtRID"  >
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">Category</div>
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
								if($det2==$inc_id){ $sel='selected="selected"';}else{ $sel='';}
								?>
								<option value="<?=$inc_id?>" <?=$sel?> ><?=$name?></option>
								<?php
								}
								$stmt->close();
								?>
								</select>
								</div>
								<div class="padding10" id="subCatAjax" >
								<div class="head4 width220px left">Sub Category</div>
								
								<select name="txtParent1" type="text" class="width280px" id="txtParent1" >
								<option value="0" >Select</option>
								<?php 
									if ($stmt1 = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=?")) {
										$stmt1->bind_param('i',$det2);
										$stmt1->execute();
										$stmt1->store_result();
										$stmt1->bind_result($inc_id1, $name1);
									}
									?>
									<?php while( $stmt1->fetch() ) { 
									if($det3==$inc_id1){ $sel='selected="selected"';}else{ $sel='';}
									?>	
									<option value="<?=$inc_id1?>" <?=$sel?>  ><?=$name1?></option>
									
									<?php 
									
									}
									$stmt1->close();
								
								?>
								</select>
								</div>	 
                              	<div class="padding10" >
								<div class="head4 width180px left">Title</div><input name="txtName" type="text" value="<?=$det4?>" class="width70" id="txtName" onChange="setCURL(this.value)" >
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">Report Code</div><input name="txtCode" type="text" value="<?=$det5?>" class="width220px" id="txtCode" >
								</div>
								<div class="padding10" >
								<div class="head4 width220px left ">Short Description</div>
								<textarea name="txtSDescr" type="text" class="width80" id="txtSDescr"  ><?=$det6?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width220px left ">Description</div>
								<textarea name="txtDescr" type="text" class="width80" id="txtDescr"  ><?=$det7?></textarea>							
								</div>
								<div class="padding10" >
								<div class="head4 width220px left ">Table of Contents</div>
								<textarea name="txtTOC" type="text" class="width80" id="txtTOC"  ><?=$det8?></textarea>
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">Tables and Figures</div>
								<input type="radio" name="radCatBut" value="1" <?php if($det31=="1"){ echo 'checked="checked"'; }?> > Yes &nbsp;&nbsp;
								<input type="radio" name="radCatBut" value="0" <?php if($det31=="0"){ echo 'checked="checked"'; }?> > No
								</div>
								<div class="padding10" >
								<div class="head4 width220px left ">Tables and Figures</div>
								<textarea name="txtTAF" type="text" class="width80" id="txtTAF"  ><?=$det26?></textarea>
								<div class="padding10" >
								<div class="head4 width220px left ">Tables and Figures New</div>
								<textarea name="txtTAFNew" type="text" class="width80" id="txtTAFNew"  ><?=$det40?></textarea>
								<script src="editor/nicEdit_new.js" type="text/javascript"></script>
								<script>
								var area1, area2, area3, area4;
								function toggleArea1() {
									if(!area1) {
										area1 = new nicEditor({fullPanel : true}).panelInstance('txtDescr',{hasPanel : true});
									} else {
										area1.removeInstance('txtDescr');
										area1 = null;
									}
									if(!area2) {
										area2 = new nicEditor({fullPanel : true}).panelInstance('txtTOC',{hasPanel : true});
									} else {
										area2.removeInstance('txtTOC');
										area2 = null;
									}
									if(!area3) {
										area3 = new nicEditor({fullPanel : true}).panelInstance('txtTAF',{hasPanel : true});
									} else {
										area3.removeInstance('txtTAF');
										area3 = null;
									}
									if(!area4) {
										area4 = new nicEditor({fullPanel : true}).panelInstance('txtTAFNew',{hasPanel : true});
									} else {
										area4.removeInstance('txtTAFNew');
										area4 = null;
									}
									
								}
								bkLib.onDomLoaded(function() { toggleArea1();});
								</script>
								</div>
								
								<div class="padding10" >
									<div class="head4 width220px left">Discount</div>
									<input name="txtCC" type="text" value="0" class="width280px" id="txtCC" value="<?=$det27?>" />
								</div>
								
								<div class="padding10">
									<div class="head4 width220px left">Copies</div>
									<input name="txtCopies" type="text" value="0" class="width280px" id="txtCopies" value="<?=$det38?>" />
									Add only numeric value
								</div>
								
								<div class="padding10">
									<div class="head4 width220px left">Rating</div>
									<input name="txtRating" type="text" value="4.5" class="width280px" id="txtRating" value="<?=$det39?>" />
									Add only numeric value
								</div>
								
								<div class="padding10" >
									<div class="head4 width220px left">Region Type(Global/Country)</div>
									<!--<input name="txtRegionType" type="text" class="width280px" id="txtRegionType" value="<?=$det41?>" required />-->
									
									<select name="txtRegionType" class="width280px" id="txtRegionType">						  
									  <option value="Global" <?php if($det41=="Global"){echo "selected";} ?>>Global</option>
									  <option value="Country" <?php if($det41=="Country"){echo "selected";} ?>>Country</option>
									  <option value="Regional" <?php if($det41=="Regional"){echo "selected";} ?>>Regional</option>
									  <option value="State" <?php if($det41=="State"){echo "selected";} ?>>State</option>
									</select>
								</div>
								
								<div class="padding10" >
									<div class="head4 width220px left">Region (Not Required for Global)</div>
									<input name="txtRegion" type="text" class="width280px" id="txtRegion" value="<?=$det42?>" />
								</div>
								
							</div>
						</div>
							  <div id="ctab2">
							  	
								
								<div class="padding10" >
								<div class="head4 width220px left">Single Licence Price</div><input name="txtSLP" type="text" value="<?=$det15?>" class="width280px" id="txtSLP" >
								</div>
										
								<div class="padding10" >
								<div class="head4 width220px left">Corporate  Price</div>
								<input name="txtCLP" type="text" value="<?=$det16?>" class="width280px" id="txtCLP" >
								</div>
									
								<div class="padding10" >
								<div class="head4 width220px left">Image </div><input name="txtImage" type="file" class="width220px"  id="txtImage"  >
								<br>
								<?php
								if($det17!=""){
								?>
								<!--<img src="../articleImages/<?=$det17?>" width="100" >-->
								<img src="../frontend/web/images/reports/<?=$det17?>" width="100" >
								<input type="hidden" name="hidImage" value="<?=$det17?>"  >
								<?php } ?>
								</div>	
								
								<div class="padding10" >
								<div class="head4 width220px left">Alt Tag</div>
								<input name="txtATag" type="text" value="<?=$det32?>" class="width280px" id="txtATag" >
								</div>
								
								
								
								<div class="padding10" >
								<div class="head4 width220px left">Report Type</div>
								
								<input type="radio" name="radType" value="S" <?php if($det9=="S"){ echo 'checked="checked"'; }?> > Stratagy  Report &nbsp;&nbsp;
								<input type="radio" name="radType" value="F" <?php if($det9=="F"){ echo 'checked="checked"'; }?>> Focussed  Report
								</div>
								
							  	<div class="padding10" >
								<div class="head4 width220px left">Updated Date</div><input name="txtPD" type="text" placeholder="YYYY-MM-DD" value="<?=$det10?>" class="width280px" id="txtPD" > (Existing published date)
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">Published Date</div><input name="txtPDN" type="text" placeholder="YYYY-MM-DD" value="<?=$det37?>" class="width280px" id="txtPDN" > (Default old pub date, changing this will reflect as published date)
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">Report Delivery</div><input name="txtRD" type="text" value="<?=$det11?>" class="width280px" id="txtRD" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">Delivery Time</div><input name="txtDT" type="text" value="<?=$det12?>" class="width280px" id="txtDT" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">File Format</div><input name="txtFF" type="text" value="<?=$det13?>" class="width280px" id="txtFF" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width220px left">Author</div><input name="txtNP" type="text" value="<?=$det14?>" class="width280px" id="txtNP" >
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">No. of Pages</div><input name="txtPages" type="text" value="<?=$det30?>" class="width280px" id="txtPages" >
								</div>
							  </div>
							  <div id="ctab3">
							  
								<div class="padding10" >
								<div class="head4 width220px left">Custom URL</div><input name="txtCURL" type="text" class="width60" value="<?=$det19?>" id="txtCURL" >
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">Custom breadcrumb tag</div><input name="txtCBCT" type="text" class="width60" value="<?=$det34?>" id="txtCBCT" >
								</div>								
								<div class="padding10" >
								<div class="head4 width220px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width220px" value="<?=$det20?>" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">Meta Keywrds</div><textarea name="txtMetaKeywords" type="text" class="width70" id="txtMetaKeywords" ><?=$det21?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width220px left">meta Desc.</div><textarea name="txtMetaDesc" type="text" class="width70" id="txtMetaDesc" ><?=$det22?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width220px left">SEO Keyword</div><input name="txtSEOKeyword" type="text" class="width220px" id="txtSEOKeyword" value="<?=$det23?>" >
								<span class="fs10" ></span>
								</div>
								<div class="padding10" >
								<div class="head4 width220px left">Related Reports </div><textarea name="txtRR" type="text" class="width70" id="txtRR" ><?=$det25?></textarea>Codes seperated by ','
								</div>
								<div class="height20px"></div>
							  </div>

							  <div id="ctab4">
								<div class="padding10">
									
									<div class="head4 left">Commercial Refrigeration Equipment Market growth?</div>
									<br>
									<textarea name="faq1" type="text" class="width70" id="faq1"></textarea>

									<div class="head4 left">Commercial Refrigeration Equipment Market CAGR value?</div>
									<br>
									<textarea name="faq2" type="text" class="width70" id="faq2"></textarea>

									<div class="head4 left">Which is the leading segment in this market?</div>
									<br>
									<textarea name="faq3" type="text" class="width70" id="faq3"></textarea>

									<div class="head4 left">What is the key factor driving of this market?</div>
									<br>
									<textarea name="faq4" type="text" class="width70" id="faq4"></textarea>

									<div class="head4 left">Who are the leading players of the market?</div>
									<br>
									<textarea name="faq5" type="text" class="width70" id="faq5"></textarea>


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