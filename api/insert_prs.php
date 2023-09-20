<?php
if(isset($_POST['token']) && $_POST['token']=="insertprs" && $_POST['title']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$date = date("Y-m-d");
	$date1 = date("Y-m-d H:i:s");
	$descr = $_POST['descr'];
	$title = $_POST['title'];
	$relatedReport = $_POST['related_report'];
	$reportCode = $_POST['report_code'];
	$query = "INSERT INTO zsp_prs(title,mnfctr,descr,status,dt_created,related_report,report_code) VALUES ('$title','$date','$descr',0,'$date','$relatedReport','$reportCode')";
	//echo $query;exit;
	mysqli_query($con,$query);
	$pr_id = mysqli_insert_id($con);
	
	$queryrtts = "INSERT INTO zsp_prs_rtts(pr_id, title, status, created) VALUES ('$pr_id','$title','INSERT','$date1')";
	//echo $query;exit;
	mysqli_query($con,$queryrtts);
	
	mysqli_close($con);
	echo "Inserted";
}else{
	echo "failed";
}
?>
