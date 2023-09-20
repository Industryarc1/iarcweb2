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
		
		if($_POST['prs']!=""){
			$press_release = $_POST['prs'];
			$connection .= "AND IF(z.report_code IS NULL,'NO','YES')='$press_release' ";
		}
		
		if($_POST['published']!=""){
			$published = $_POST['published'];
			$connection .= "AND IF(zpd.report_code IS NULL,'NO','YES')='$published' ";
		}
		
		if($_POST['lotlof']!=""){
			$lotlof = $_POST['lotlof'];
			$connection .= "AND IF((LENGTH(taf)<=100 || taf IS NULL),'NO','YES')='$lotlof' ";
		}
		
		if($_POST['toc']!=""){
			$toc = $_POST['toc'];
			$connection .= "AND IF((LENGTH(table_of_content)<=100 || table_of_content IS NULL),'NO','YES')='$toc' ";
		}
		
		if($_POST['rdesc']!=""){
			$rdesc = $_POST['rdesc'];
			$connection .= "AND IF((LENGTH(description)<=100 || description IS NULL),'NO','YES')='$rdesc' ";
		}
		
		if($_POST['title']!=""){
			$title = $_POST['title'];
			$connection .= "AND zp.title LIKE '$title%' ";
		}
		
		if($_POST['report_code']!=""){
			$reportcode = $_POST['report_code'];
			$connection .= "AND zp.code IN ('$reportcode') ";
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

		$query = "SELECT zp.dup_inc_id,zcc.name,zp.title,zp.code,IF(z.report_code IS NULL,'NO','YES') AS prs,IF(zpd.report_code IS NULL,'NO','YES') AS published,zp.status,zp.dt_created,zp.pub_date,IF((LENGTH(description)<=100 || description IS NULL),'NO','YES') AS descp ,
IF((LENGTH(table_of_content)<=100 || table_of_content IS NULL),'NO','YES') AS toc, 
IF((LENGTH(taf)<=100 || taf IS NULL),'NO','YES') AS table_and_figure,zp.dt_created,
IF(zp.dup_inc_id<500000,CONCAT('https://www.industryarc.com/Report/',zp.dup_inc_id,'/',zp.curl),CONCAT('https://www.industryarc.com/Research/',zp.curl,'-',zp.dup_inc_id)) AS title_url
FROM zsp_posts zp LEFT JOIN zsp_catlog_categories zcc ON zp.cat=zcc.inc_id LEFT JOIN zsp_post_dispatched zpd ON zpd.report_code=zp.code LEFT JOIN (SELECT DISTINCT report_code FROM zsp_prs WHERE `status`=1 ) AS z ON z.report_code=zp.code";

		$queryCount = "SELECT COUNT(*) as tot FROM zsp_posts zp LEFT JOIN zsp_catlog_categories zcc ON zp.cat=zcc.inc_id LEFT JOIN zsp_post_dispatched zpd ON zpd.report_code=zp.code LEFT JOIN (SELECT DISTINCT report_code FROM zsp_prs WHERE `status`=1 ) AS z ON z.report_code=zp.code";

		if($connection!=""){
			$query=$query." WHERE ".$connection;	
			$queryCount=$queryCount." WHERE ".$connection;	
		}else{
			$query=$query;	
			$queryCount=$queryCount;	
		}		
		
		$reportDataCount = mysqli_query($con,$queryCount);
		$reportDataCount = mysqli_fetch_assoc($reportDataCount);
		$count = $reportDataCount['tot'];

		$query = $query.$limoff;

		$reportData = mysqli_query($con,$query);
		$array=array();
		while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $row);
			array_push($array,$row);
		}

		echo '{"count":"'.$count.'","data":'.json_encode($array).'}';
	}
	
	if($_POST['token']=="GetIarcPressReleaseData"){
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$limoff = " LIMIT $offset,$limit";
		$connection = "";
		
		if($_POST['title']!=""){
			$title = $_POST['title'];
			$connection .= "AND z.title LIKE '$title%' ";
		}
		
		if($_POST['fromdate']!=""){
			$fromdate = $_POST['fromdate'];
			$todate = $_POST['todate'];
			$connection .= "AND z.mnfctr BETWEEN '$fromdate' AND '$todate' ";
		}
		
		if($_POST['report_code']!=""){
			$reportcode = $_POST['report_code'];
			$connection .= "AND z.report_code='$reportcode' ";
		}

		$connection= ltrim($connection,"AND");

		$query = "SELECT z.title AS pr_title,z.status,z.mnfctr,z.dt_created AS pr_createddate,zp.title AS report_title,z.report_code,z.related_report,CONCAT('https://www.industryarc.com/PressRelease/',z.prod_id,'/',z.seo_keyword) AS pr_url FROM 
zsp_prs z LEFT JOIN zsp_posts zp ON zp.code=z.report_code";

		$queryCount = "SELECT COUNT(*) as tot FROM zsp_prs z LEFT JOIN zsp_posts zp ON zp.code=z.report_code";

		if($connection!=""){
			$query=$query." WHERE ".$connection;	
			$queryCount=$queryCount." WHERE ".$connection;	
		}else{
			$query=$query;	
			$queryCount=$queryCount;	
		}
		
		$reportDataCount = mysqli_query($con,$queryCount);
		$reportDataCount = mysqli_fetch_assoc($reportDataCount);
		$count = $reportDataCount['tot'];

		$query = $query.$limoff;

		$reportData = mysqli_query($con,$query);
		$array=array();
		while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $row);
			array_push($array,$row);
		}
		echo '{"count":"'.$count.'","data":'.json_encode($array).'}';
	}
	
	mysqli_close($con);
}else{
	echo '{"message":"Failed"}';
}
?>
