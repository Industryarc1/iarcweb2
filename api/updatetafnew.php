<?php
if(isset($_POST['token']) && $_POST['token']=="updatetafnew"){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$reportid = $_POST['reportid'];
	$date = date("Y-m-d");
	$taf = $_POST['taf'];
	$query = "UPDATE zsp_posts SET taf_new='".$taf."' WHERE dup_inc_id='".$reportid."'";
	//echo $query;exit;
	mysqli_query($con,$query);
	mysqli_close($con);
	echo "Updated";
}else{
	echo "failed";
}
?>
