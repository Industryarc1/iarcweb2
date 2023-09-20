<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php 
if($_POST['action']=="getSubCat" ){
?>
<div class="head4 width180px left">Sub Category</div>
<select name="txtParent1" type="text" class="width280px" id="txtParent1" >
<option value="" >Select</option>
<?php
if($_POST['catid']!=""){
	if ($stmt1 = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=?")) {
		$stmt1->bind_param('i',$_POST['catid']);
		$stmt1->execute();
		$stmt1->store_result();
		$stmt1->bind_result($inc_id1, $name1);
	}
	 while( $stmt1->fetch() ) { ?>	
	<option value="<?=$inc_id1?>" <?=@$sel?>  ><?=$name1?></option>
	<?php 
	}
	$stmt1->close();
}
?>
</select>
<?php }
?>