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
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="updateContent" value="Save Page" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
	     	<div class="width50  <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<div class="head2"><i class="fa fa-pencil"></i> Upadte Content</div>
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
$pgId = @$_REQUEST['pgId'];
if($pgId <= count($pages)){
	echo $pages[$pgId];
	if ($cat = $mysqli->prepare("select content,meta_title,meta_keywords,meta_descr from zsp_content where page_name=?")) {
		$cat->bind_param('s',$pages[$pgId] );
		$cat->execute();
		$cat->store_result();
		if($cat->num_rows>0){
			$cat->bind_result($content,$meta_title,$meta_keywords,$meta_descr);
			$cat->fetch();
		}
	$content = base64_decode(@$content);
	$content = str_replace('\"', '"', $content);
	$content = str_replace("\'", "'", $content);
	}
?>	
 <?php
}else{
	$error= '<div class="redtext2"><br><br><b>Invalid Page Name</b></div>';
}        
?>         
							  <div id="ctab1">
                              	
								<div class="padding10" >
								<div class="head4 width180px left">Content page</div>
								
								<select name="cmbPGNames" type="text" class="width280px" id="cmbPGNames" onChange="javascript:window.location='<?=$_SERVER['PHP_SELF']."?pgId="?>'+this.value" >
								<option value="" selected="selected">--Select--</option>
								<?php
								if($_REQUEST['pgId']!="" && is_numeric($_REQUEST['pgId'])){
									$pgId = $_REQUEST['pgId'];
								}else{
									$pgId = 1;
								}
									foreach($pages as $key => $val){
										if($key != 0){
											$selected = '';
											if($pgId == $key){
												$selected = ' selected="selected"';
											}
											echo '<option value="'.$key.'"'.$selected.'>'.$val.'</option>';
										}
									}
								?>            
								</select>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px ">Content</div>
								<textarea name="txtContent" type="text" class="width80" style="height:180px" id="txtContent" ><?=$content?></textarea>
								<script src="editor/nicEdit.js" type="text/javascript"></script>
								<script>
								var area1, area2;
								function toggleArea1() {
									if(!area1) {
										area1 = new nicEditor({fullPanel : true}).panelInstance('txtContent',{hasPanel : true});
									} else {
										area1.removeInstance('txtContent');
										area1 = null;
									}
								}
								bkLib.onDomLoaded(function() { toggleArea1();});
								</script>
								
								
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Title</div><input name="txtMetaTitle" type="text" class="width50" value="<?=@$meta_title?>" id="txtMetaTitle" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Meta Keywords</div><textarea name="txtMetaKeywords" type="text" class="width50" id="txtMetaKeywords" ><?=@$meta_keywords?></textarea>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">meta Desc.</div><textarea name="txtMetaDesc" type="text" class="width50" id="txtMetaDesc" ><?=@$meta_descr?></textarea>
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