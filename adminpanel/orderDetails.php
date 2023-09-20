<?php include_once "includes/config.php"; 
if ($stmt = $mysqli->prepare("select inc_id,name,code,status from zsp_licences where status=1 order by dt_created asc")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($inc_id, $name,$code,$status);
	while( $stmt->fetch() ) {
		$lic_array[$code]=$name;
	}
	$stmt->close();
}
?>
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
			<div class="width50 left <?=$_SESSION['stat']?>"><?php if($_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
			<ul >
				<?php /*?><li ><a href="ordersList.php?stat=IP" class="forButton" >In Process</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=OP" class="forButton" >Opened</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=SHIP" class="forButton" >Shipped</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=DELV" class="forButton" >Delivered</a> &nbsp;</li>
				<li ><a href="ordersList.php?stat=CANC" class="forButton" >Canceled</a> &nbsp;</li>
				<li ><a href="ordersList.php" class="forButton" >ALL</a> &nbsp;</li><?php */?>
				
			</ul>
		</div>
		<?php
		$query = "select *,date_format(dt_created, '%d %M, %Y %h:%i %p')as dt_created2  from zsp_order_hdrs where order_num=?  order by dt_created desc";
		$stmt1 = $mysqli->prepare($query);
		
		$stmt1->bind_param('s',$_REQUEST['id']);
		$flag=$stmt1->execute();
		$stmt1->store_result();
		$stmt1->bind_result($det1,$det2,$det3,$det4,$det5,$det6,$det7,$det8,$det9,$det10,$det11,$det12,$det13,$det14,$det15);
		$stmt1->fetch();
		?>
		<div class="width100 left">
			<div class="head2"> <i class="fa fa-list"></i> Orders Details of Order ID : <?=$det3?></div>
		</div>
		
		<div class="width100 left padding10 border">
			<div class="width50 left bdr_right" >
			<div class="head4 width100px left">User ID : </div> <div class="head4 width40 left"><?=$det2?></div>
			<div class="head4 width100 left">Shipping Address :<br>
			<?=$det4?><br><?=$det7?><br> Phone : <?=$det5?>
			</div>
			
			</div>
			
			<div class="width40 bdr_left right" >
			<div class="head4 width150px left">Order Amount : </div> <div class="head4 width150px left">Rs. <?=$det10?></div>
			<div class="head4 width150px left">Ordered Date: </div> <div class="head4 width220px left"><?=$det14?></div>
			<div class="head4 width150px left">Billing Address :</div> <div class="head4 width220px left"></div>
			<div class="head4 width100 left"><?=$det8?> </div> 
			</div>
		</div>
		<div class="width100 left">
			
			
		</div>
								
		<div class="width100 left border" >
			<div class="width100 left border_bottom bgcolor1">
				<div class="head2 width50 left">Report</div>
				<div class="head2 width20 left"></div>
				<div class="head2 width20 left">Price</div>
			</div>
			<div class="width100 left border" >
                            
                            
							  <?php
							  	$stmt2 = $mysqli->prepare("select t1.post_id,t1.licence,t1.price,t2.title from zsp_order_dtls t1,zsp_posts t2 where t1.post_id=t2.inc_id and order_hdr_num=?  order by t1.dt_created asc");
								  $stmt2->bind_param('s',$det3);
								  $flag=$stmt2->execute();
								  $stmt2->store_result();
								  $stmt2->bind_result($det1,$det2,$det3,$det4);
								  while($stmt2->fetch()){
								  ?>
							  <div class="width100 left border_bottom bgcolor1">
                                <div class="head2 width50 left"><b><?=$det4?></b> <br><span style="font-size:10px"><?=$lic_array[$det2]?></span></div>
								<div class="head2 width20 left"></div>
								<div class="head2 width20 left onoff"> <i class="fa fa-inr"></i>  <?=$det3?>
								
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