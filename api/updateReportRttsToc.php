<?php
if(isset($_POST['token']) && $_POST['token']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if($_POST['token']=="updatereporttoc"){
		$reportCode = $_POST['report_code'];
		$date = date("Y-m-d H:i:s");
		$toc = $_POST['toc'];
		$query = "UPDATE zsp_posts SET table_of_content='".$toc."',status=0,dt_created='".$date."' WHERE code='".$reportCode."'";
		mysqli_query($con,$query);
		
		$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','UPDATE','TOC','$date')";
		mysqli_query($con,$iquery);
		
		echo "Updated";
	}
	
	if($_POST['token']=="updatereportlotlof"){
		$reportCode = $_POST['report_code'];
		$date = date("Y-m-d H:i:s");
		$lotlof = $_POST['lotlof'];
		$query = "UPDATE zsp_posts SET taf='".$lotlof."',status=0,dt_created='".$date."' WHERE code='".$reportCode."'";
		mysqli_query($con,$query);
		
		$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','UPDATE','LOTLOF','$date')";
		mysqli_query($con,$iquery);
		
		echo "Updated";
	}
	
	mysqli_close($con);
}else{
	echo "failed";
}
?>
