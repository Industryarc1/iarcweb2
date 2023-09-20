<?php
if(isset($_POST['token']) && $_POST['token']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if($_POST['token']=="GetIarcReportData"){
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$limoff = " LIMIT $offset,$limit";
		$connection = "";
		
		if($_POST['status']!=""){
			$status = $_POST['status'];
			$connection .= "AND zp.status='$status' ";
		}
				
		if($_POST['lotlof']!=""){
			$lotlof = $_POST['lotlof'];
			$connection .= "AND IF((LENGTH(zp.taf)<=100 || zp.taf IS NULL),'NO','YES')='$lotlof' ";
		}
		
		if($_POST['toc']!=""){
			$toc = $_POST['toc'];
			$connection .= "AND IF((LENGTH(zp.table_of_content)<=100 || zp.table_of_content IS NULL),'NO','YES')='$toc' ";
		}
		
		if($_POST['rdesc']!=""){
			$rdesc = $_POST['rdesc'];
			$connection .= "AND IF((LENGTH(zp.description)<=100 || zp.description IS NULL),'NO','YES')='$rdesc' ";
		}
		
		if($_POST['title']!=""){
			$title = $_POST['title'];
			$connection .= "AND zp.title LIKE '%$title%' ";
		}
		
		if($_POST['department_id']!=""){
			$departmentid = $_POST['department_id'];
			$connection .= "AND zp.cat = '$departmentid' ";
		}
		
		if($_POST['fromdate']!=""){
			$fromdate = $_POST['fromdate'];
			$todate = $_POST['todate'];
			$connection .= "AND zp.dt_created BETWEEN '$fromdate' AND '$todate' ";
		}

		$connection= ltrim($connection,"AND");

		$query = "SELECT zp.dup_inc_id,zcc.name,zp.title,zp.code,zp.status,IF((LENGTH(description)<=100 || description IS NULL),'NO','YES') AS descp ,zp.pub_date , zp.dt_created AS updated_date,zp.pub_date_new AS old_date,
IF((LENGTH(table_of_content)<=100 || table_of_content IS NULL),'NO','YES') AS toc, IF((LENGTH(taf)<=100 || taf IS NULL),'NO','YES') AS table_and_figure,zp.meta_title,zp.meta_keywords,zp.meta_descr,zp.seo_keyword,zp.cbreadcrumb,
IF(zp.dup_inc_id<500000,CONCAT('https://www.industryarc.com/Report/',zp.dup_inc_id,'/',zp.curl),CONCAT('https://www.industryarc.com/Research/',zp.curl,'-',zp.dup_inc_id)) AS title_url
FROM zsp_posts zp LEFT JOIN zsp_catlog_categories zcc ON zp.cat=zcc.inc_id";

		if($connection!=""){
			$query=$query." WHERE ".$connection;
		}else{
			$query=$query;
		}		
		
		//$query = $query.$limoff;
		//echo $query;exit;

		$reportData = mysqli_query($con,$query);
		$array=array();
		while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $row);
			array_push($array,$row);
		}

		echo '{"data":'.json_encode($array).'}';
	}
	
	mysqli_close($con);
}else{
	echo '{"message":"Failed"}';
}
?>
