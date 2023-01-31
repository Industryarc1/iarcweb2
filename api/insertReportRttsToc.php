<?php
if(isset($_POST['token']) && $_POST['token']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if($_POST['token']=="insertreporttoc"){
		$reportCode = $_POST['report_code'];
		$date = date("Y-m-d");
		$date1 = date("Y-m-d H:i:s");
		$cateID = $_POST['category_id'];
		$title = $_POST['title'];
		$toc = $_POST['toc'];
		$slp = "5250";
		$clp = "7250";
		$reportId = $_POST['report_id'];
		$query = "INSERT INTO zsp_posts(code,cat,title,table_of_content,report_type, pub_date, slp, clp,no_pages,cat_but,file_format,dt_created,status,dup_inc_id,publish_type,is_publish) VALUES ('$reportCode','$cateID','$title','$toc','S','$date','$slp','$clp','IndustryARC','0','PDF','$date','0','$reportId','0','0')";
		//echo $query;exit;
		mysqli_query($con,$query);
		
		$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','INSERT','TOC','$date1')";
		mysqli_query($con,$iquery);
		
		echo "Inserted";
	}
	
	if($_POST['token']=="insertreportlotlof"){
		$reportCode = $_POST['report_code'];
		$date = date("Y-m-d");
		$date1 = date("Y-m-d H:i:s");
		$cateID = $_POST['category_id'];
		$title = $_POST['title'];
		$lotlof = $_POST['lotlof'];
		$slp = "5250";
		$clp = "7250";
		$reportId = $_POST['report_id'];
		$query = "INSERT INTO zsp_posts(code,cat,title,taf,report_type, pub_date, slp, clp,no_pages,cat_but,file_format,dt_created,status,dup_inc_id,publish_type,is_publish) VALUES ('$reportCode','$cateID','$title','$lotlof','S','$date','$slp','$clp','IndustryARC','0','PDF','$date','0','$reportId','0','0')";
		//echo $query;exit;
		mysqli_query($con,$query);
		
		$iquery = "INSERT INTO zsp_post_rtts(code,status,type,created) VALUES ('$reportCode','INSERT','LOTLOF','$date1')";
		mysqli_query($con,$iquery);
		
		echo "Inserted";
	}
	
	mysqli_close($con);
}else{
	echo "failed";
}
?>
