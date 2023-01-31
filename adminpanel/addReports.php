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
	
	<form name="frmAddCategory" action="actions.php" method="post" onSubmit="return validate()" >
    <div class="width100"  >
		<div class="topright width100 left">
			
			<ul>
				<li><input type="submit" name="addReports" value="Save Reports" class="forButton" ></li>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"><i class="fa fa-pencil"></i> Add Reports</div>
		</div>
		<div class="width100 left pb50" >
			<div class="events">
                	<script type="text/javascript">
						$(document).ready( function() {
						$('#tab-container').easytabs();
						});
						var vldnum=/^[0-9]+$/;
						var i =0;	
						function displayChildInfo(caseimages){
							var txtImageDetails = "";
							match=vldnum.test(caseimages);
							if(!match){	  
								alert("Enter numbers only.");
								document.frmCase.txtCurecases.focus();
								return false;
							}else{
								if(caseimages >0){
									for(i=1;i<=caseimages;i++){
										txtImageDetails += '<div class="padding10" ><div class="head4 width180px left">Report Name</div><input name="txtName'+i+'" type="text"  class="width220px" id="txtName" ></div><div class="padding10" ><div class="head4 width180px left">Report Code </div><input name="txtCode'+i+'" type="text"  class="width220px" id="txtCode" ></div><div class="head4 width100">_________________________________________________________________</div>';	
										//document.getElementById('divImageInfo').innerHTML += txtImageDetails;
									}
								}else{
									document.getElementById('divImageInfo').innerHTML = '';
								}
							}
							if(txtImageDetails != ""){
								document.getElementById('divImageInfo').innerHTML = txtImageDetails;
							}
							}
					</script> 
					<script src="editor/nicEdit.js" type="text/javascript"></script>       
					<div id="tab-container" class='tab-container'>
						<ul class='etabs'>
						   <li class='tab'><a href="#ctab1">General</a></li>
						</ul>
						<div class='panel-container'>  
						       <div class="padding10" >
								<div class="head4 width180px left">No Of Reports</div><input name="txtCurecases" type="text" value="<?=$det2?>" class="width120px" id="txtCurecases" onKeyUp="displayChildInfo(this.value)" >
								</div>   
							  <div id="ctab1">
                              	<div id="divImageInfo">
								
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