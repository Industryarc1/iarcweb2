<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>

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
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<ul>
				<li><input type="submit" name="updateMenuItem" value="Save Menu Item" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Menu Item </div>
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
$id = $_REQUEST['id'];
if ($cat = $mysqli->prepare("select * from zsp_menu_items where inc_content_id=?")) {
		
		$cat->bind_param('s',$id );
		$cat->execute();
		$cat->store_result();
		if($cat->num_rows>0){
			$cat->bind_result($inc_id,$page_name,$title,$content,$dt,$status,$curl);
			$cat->fetch();
		}
	$content = base64_decode($content);
	$content = str_replace('\"', '"', $content);
	$content = str_replace("\'", "'", $content);
	echo '<input type="hidden" name="hid_inc_id" value="'.$inc_id.'" >';
	echo '<input type="hidden" name="hidAction" value="EditContent" >';
}
?>	
      
							  <div id="ctab1">
                              	
								<div class="padding10" >
								<div class="head4 width180px left">Menu Item</div>
								
								<select name="cmbPGNames" type="text" class="width280px" id="cmbPGNames"  >
								<option value="" selected="selected">--Select--</option>
								<?php
								
									foreach($menu as $key => $val){
										if($key != 0){
											$selected = '';
											if($page_name == $val){
												$selected = ' selected="selected"';
											}
											echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
										}
									}
								?>            
								</select>
								</div>	
								<div class="padding10" >
								<div class="head4 width180px left">Title</div>							
								<input type="text" name="txtTitle" class="width280px" value="<?=$title?>" >
								</div>
								<div class="padding10" >
								<div class="head4 width180px left">Custom URL</div>								
								<input type="text" name="txtCURL" class="width280px" value="<?=$curl?>" >
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