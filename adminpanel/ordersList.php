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
    <div class="width100"  >
		<div class="topright width100 left">
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<ul >
				<?php /*?><li ><a href="ordersList.php?stat=IP" class="forButton" >In Process</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=OP" class="forButton" >Opened</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=SHIP" class="forButton" >Shipped</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=DELV" class="forButton" >Delivered</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=CANC" class="forButton" >Canceled</a> &nbsp;</li>
				<li ><a href="ordersList.php" class="forButton" >ALL</a> &nbsp;</li><?php */?>
			</ul>
		</div>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Orders List</div>
		</div>
		<div class="width100 padding20" >
								<div class="head4 width180px left">Enter Date</div>
								
								<form name="frmSel" action="" method="GET"  >
								<div class="width180px left">
								<input type="text" name="txtDate"  style="padding-bottom:10px;" value="<?=@$_GET['txtDate']?>" placeholder="YYYY-MM-DD" class="width180px" id="txtDate" >
								
								</div>
								<div class="left">
								<input type="submit"  class="forButton" name="getOrders" value="GET ORDERS" />
								
								</div>
								</form>
								</div>
								
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width50 left">Order ID - Date</div>
				<div class="head2 width10 left">Amount</div>
				<div class="head2 width20 left">Status</div>
				<div class="head2 width10 left">Action</div>
			</div>
			<div class="width100 left border" >
                            
                            
							  <?php
							  
								if(@$_REQUEST['txtDate']!=""){
									$cond2= ' dt_created like "%'.$_REQUEST['txtDate'].'%"';
								}else{
									$cond2=" 1=1 ";
								}
								$query = "select *,date_format(dt_created, '%d %M, %Y %h:%i %p')as dt_created2  from zsp_order_hdrs where ".@$cond1.$cond2."  order by dt_created desc";
								//echo $query;
								$stmt1 = $mysqli->prepare($query);
								
								$flag=$stmt1->execute();
								$stmt1->store_result();
								$stmt1->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7,$det8,$det9,$det10,$det11,$det12,$det13,$det14,$det15);
								
								while($stmt1->fetch()){
								?>
							  <div class="width100 left border_bottom bgcolor1">
                                <div class="head2 width50 left"><b><?=$det3?></b> -<?=$det2?> <br><span style="font-size:10px"> <?=$det14?></span></div>
								<div class="head2 width10 left"><i class="fa fa-inr"></i> <?=$det10?></div>
								<div class="head2 width20 left"><?=$order_stat[$det13]?></div>
								<div class="head2 width10 left onoff"><a href="orderDetails.php?id=<?=$det3?>" style="color:#333333">View</a>
								</div>
                              </div>
							   <?php }?>
                           
                       </div>
			
			
		</div>
	</div>
	</div>    	
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>