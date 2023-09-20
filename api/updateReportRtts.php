<?php
if(isset($_POST['token']) && $_POST['token']=="updatereport"){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$reportCode = $_POST['report_code'];
	$date = date("Y-m-d H:i:s");
	$description = $_POST['description'];
	$query = "UPDATE zsp_posts SET description='".$description."',status=0,dt_created='".$date."' WHERE code='".$reportCode."'";
	//echo $query;exit;
	mysqli_query($con,$query);
	
	$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','UPDATE','RD','$date')";
	mysqli_query($con,$iquery);
	
	mysqli_close($con);
	echo "Updated";
}else{
	echo "failed";
}
?>
