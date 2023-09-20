<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); }  ?>
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
<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/>
<script >
	function setCURL(title){
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
	<form name="frmAddCategory" action="updateeventList.php" method="post" enctype="multipart/form-data" onSubmit="return validate()" >
	
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="addArticle" value="Save Post" class="forButton fixedclass" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Event </div>
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
                          <!-- <li class='tab'><a href="#ctab2">Other Info.</a></li>-->
						   <li class='tab'><a href="#ctab3">SEO</a></li> 
						</ul>
						<div class='panel-container'>  
						      <?php
							  
							  ?>    
							  <div id="ctab1">
							 	
								<div class="padding10" >
								<!--<div class="head4 width180px left">Report ID <br>( Old Reports )</div><input name="txtRID" type="text"  class="width280px" id="txtRID"  >
								</div>-->
								
								<div class="padding10" >
								<div class="head4 width180px left">Category</div>
								<?php
								if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and inc_id not in (1,2)")) {
									$stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($inc_id, $name);
								}
								
								?>
								<select name="txtParent" type="text" class="width280px" id="txtParent" onChange="getSubCat(this.value)"  required>
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
								<div class="head4 width180px left">Sub Category</div>
								
								<select name="txtParent1" type="text" class="width280px" id="txtParent1" required>
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
								<div class="head4 width180px left">Conference Title</div><input name="txtName" type="text"  class="width60" id="txtName" onChange="setCURL(this.value)" required >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Conference Venue</div><input name="txtCode" type="text" class="width60" id="txtCode" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Conference Date</div>
								
								 <input type="text" id="datetimepicker" name="datetimepicker" placeholder="Select Date" class="width280px" required>
									 
								<!--<input name="txtPD" type="datetime-local" class="width280px" id="txtPD"  required>-->
								</div>
								<div class="padding10" >
								<div class="head4 width180px left ">Short Description</div>
								<textarea name="txtSDescr" type="text" class="width50" id="txtSDescr"  ></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Summary</div>
								<textarea name="txtDescr" type="text" class="width80" id="txtDescr"  ></textarea>
								
								</div>
								<div class="padding10" >
								<div class="head4 width180px left ">Agenda</div>
								<textarea name="txtTOC" type="text" class="width80" id="txtTOC"  ></textarea>
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Speakers</div>
								<input type="radio" name="radCatBut" value="1" > Yes &nbsp;&nbsp;
								<input type="radio" name="radCatBut" value="0" checked="checked" > No
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Speakers</div>
								<textarea name="txtTAF" type="text" class="width80" id="txtTAF"  ></textarea>
								<script src="editor/nicEdit.js" type="text/javascript"></script>
								<script>
								var area1, area2, area3;
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
									
								}
								bkLib.onDomLoaded(function() { toggleArea1();});
								</script> 
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Image </div>
								<input name="txtImage" type="file" class="width220px"  id="txtImage" value="" >
								<br>
								<input type="hidden" name="hidImage"  >
								</div>	 
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left height100px">Discount</div>
								<input name="txtCC" type="text" class="width280px" id="txtCC"  />
								
								</div><?php */?>
							  </div>
							  </div>
							  <div id="ctab2">
							  	
								
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">Single Licence Price</div><input name="txtSLP" type="text" value="<?=$det15?>" class="width280px" id="txtSLP" >
								</div>
										
								<div class="padding10" >
								<div class="head4 width180px left">Corporate  Price</div>
								<input name="txtCLP" type="text" value="<?=$det15?>" class="width280px" id="txtCLP" >
								</div>
									
								
								
								<div class="padding10" >
								<div class="head4 width180px left">Alt Tag</div>
								<input name="txtATag" type="text" value="" class="width280px" id="txtATag" >
								</div>
								
								
								
								<div class="padding10" >
								<div class="head4 width180px left">Report Type</div>
								<input type="radio" name="radType" value="S" checked="checked"> Stratagy  Report &nbsp;&nbsp;
								<input type="radio" name="radType" value="F" > Focussed  Report
								</div><?php */?>
								
							  	
								
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">Report Delivery</div><input name="txtRD" type="text" value="<?=$det11?>" class="width280px" id="txtRD" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">Delivery Time</div><input name="txtDT" type="text" value="<?=$det12?>" class="width280px" id="txtDT" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">File Format</div><input name="txtFF" type="text" value="<?=$det13?>" class="width280px" id="txtFF" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">Author</div><input name="txtNP" type="text"  class="width280px" id="txtNP" value="IndustryARC" >
								</div>
								
								<div class="padding10" >
								<div class="head4 width180px left">No. of Pages</div><input name="txtPages" type="text" value="" class="width280px" id="txtPages" >
								</div><?php */?>
								
							  </div>
							  <div id="ctab3">
							  
								<div class="padding10" >
								<div class="head4 width180px left">Custom URL</div><input name="txtCURL" type="text" class="width60" id="txtCURL" >
								</div>
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">Custom breadcrumb tag</div><input name="txtCBCT" type="text" class="width60" value="<?=$det34?>" id="txtCBCT" >
								</div><?php */?>	
                              	<div class="padding10" >
								<div class="head4 width180px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width220px" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Keywrds</div><textarea name="txtMetaKeywords" type="text" class="width50" id="txtMetaKeywords" ></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">meta Desc.</div><textarea name="txtMetaDesc" type="text" class="width50" id="txtMetaDesc" ></textarea>
								</div>	
								<?php /*?><div class="padding10" >
								<div class="head4 width180px left">SEO Keyword</div><input name="txtSEOKeyword" type="text" class="width220px" id="txtSEOKeyword" value="<?=$det21?>" >
								<span class="fs10" ></span>
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Related Reports </div><textarea name="txtRR" type="text" class="width50" id="txtRR" ><?=$det20?></textarea>
								
								Report Codes seperated By ','
								</div><?php */?>
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
<script src="../js/jquery.datetimepicker.full.js"></script>

<script>
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
defaultDate:0,
minDate:0
});  
</script>
</body>
</html>