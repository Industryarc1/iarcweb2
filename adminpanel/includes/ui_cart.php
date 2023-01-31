<div class="col3">
<div class="o_clients">
<h1 class="hd">ORDER SUMMARY</h1>

<?php
$prodIds = explode(',',$_SESSION['cart_prodList']);
$totalAmount="";
$stmt = $mysqli->prepare("select t1.inc_id,t1.title,t1.image,t1.slp,t1.clp,t1.curl from zsp_posts t1 where t1.inc_id=? ");
//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
for($i=count($prodIds); $i>0; $i--){
	$prod = explode('-',$prodIds[$i-1]);
	$stmt->bind_param('s',$prod[0]);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows>0){
		$stmt->bind_result($det1,$det2,$det3,$slp,$clp,$curl);
		$stmt->fetch();
	?>
	<h1 class="hd" style="text-transform:none;border:none;color:#336699"><?=$det2?><br /><span style="color:#666666;font-size:12px" ><?=$prod[0]=="SL"?'Sigle User':'Corporate Licence'?></span><br /><span style="color:#1E3A7D;font-size:20px" >$<?=$_SESSION['cart_prodPrice'.$prodIds[$i-1]]?></span></h1>
	<div style="border-bottom:1px dashed #7c7c7c; margin-top:5px;"></div>
	<?php
		
	}
}
	?>
	<div class="hd" >TOTAL  : $ <?=$_SESSION['cart_totPrice']?></div>
</div>

<?php include_once "includes/ui_twitter.php"; ?>
</div>