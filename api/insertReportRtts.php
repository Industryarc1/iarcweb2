<?php
if(isset($_POST['token']) && $_POST['token']=="insertreport" && $_POST['title']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$reportCode = $_POST['report_code'];
	$date = date("Y-m-d");
	$date1 = date("Y-m-d H:i:s");
	$cateID = $_POST['category_id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$slp = "5250";
	$clp = "7250";
	$reportId = $_POST['report_id'];
	$query = "INSERT INTO zsp_posts(code,cat,title,description,report_type, pub_date, slp, clp,no_pages,cat_but,file_format,dt_created,status,dup_inc_id,publish_type,is_publish) VALUES ('$reportCode','$cateID','$title','$description','S','$date','$slp','$clp','IndustryARC','0','PDF','$date','0','$reportId','0','0')";
	//echo $query;exit;
	mysqli_query($con,$query);
	
	$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','INSERT','RD','$date1')";
	mysqli_query($con,$iquery);	
	
	mysqli_close($con);
	echo "Inserted";
}else{
	echo "failed";
}
?>
