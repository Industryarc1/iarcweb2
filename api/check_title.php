<?php
if(isset($_POST['token']) && $_POST['token']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if($_POST['token']=="checkTitle"){
		$title = $_POST['title'];
		$query = "SELECT * FROM zsp_posts WHERE title LIKE '".$title."%'";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		if(!empty($reportData)){
			echo '{"title":{"code":"'.$reportData['code'].'","title":"'.$reportData['title'].'","publish":"'.$reportData['pub_date'].'","url":"'.$reportData['curl'].'","id":"'.$reportData['dup_inc_id'].'"}}';
		}else{
			echo '{"title":"Not Exist"}';
		}		
	}
	if($_POST['token']=="checkPressRelease"){
		$prs = $_POST['article'];
		$query = "SELECT * FROM zsp_prs WHERE title LIKE '%".$prs."%'";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		if(!empty($reportData)){
			echo '{"article":{"id":"'.$reportData['prod_id'].'","title":"'.$reportData['title'].'","mnfctr":"'.$reportData['mnfctr'].'","created":"'.$reportData['dt_created'].'"}}';
		}else{
			echo '{"title":"Not Exist"}';
		}
	}
	
	if($_POST['token']=="GetReportByDomainCode"){
		$code = $_POST['code'];
		$query = "SELECT code FROM zsp_posts WHERE code LIKE '%".$code."%'";
		$reportData = mysqli_query($con,$query);
		//$reportData = mysqli_fetch_assoc($reportData);
		$array=array();
		while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $row);
			array_push($array,$row);
		}
		echo json_encode($array);
	}
	
	if($_POST['token']=="GetReportByReportCode"){
		$code = $_POST['code'];
		$query = "SELECT code,CONCAT(SUBSTRING_INDEX(title, 'Market', 1),'Market') as title,pub_date,IF(dup_inc_id<500000,CONCAT('https://www.industryarc.com/Report/',dup_inc_id,'/',curl),CONCAT('https://www.industryarc.com/Research/',curl,'-',dup_inc_id)) AS title_url FROM zsp_posts WHERE code = '".$code."'";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		//$array=array();
		//while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $reportData);
			//array_push($array,$row);
		//}
		echo json_encode($row);
	}
	
	if($_POST['token']=="GetPrsByReportCode"){
		$code = $_POST['code'];
		$query = "SELECT CONCAT(SUBSTRING_INDEX(z.title, 'Market', 1),'Market') AS pr_title,z.mnfctr,z.dt_created AS pr_createddate,CONCAT(SUBSTRING_INDEX(zp.title, 'Market', 1),'Market') AS report_title,z.report_code,CONCAT('https://www.industryarc.com/PressRelease/',z.prod_id,'/',z.seo_keyword) AS pr_url,z.related_report FROM 
zsp_prs z LEFT JOIN zsp_posts zp ON zp.code=z.report_code WHERE z.status=1 AND z.report_code='".$code."'";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		//$array=array();
		//while($row = mysqli_fetch_assoc($reportData)) {
			$row = array_map('utf8_encode', $reportData);
			//array_push($array,$row);
		//}
		echo json_encode($row);
	}
	
	if($_POST['token']=="GetReportByReportCodeForBackendUpdate"){
		$code = $_POST['code'];
		$query = "SELECT * FROM zsp_posts WHERE code LIKE '%".$code."%'";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		$row = array_map('utf8_encode', $reportData);
		echo json_encode($row);
	}
	
	mysqli_close($con);
}else{
	echo '{"title":"Failed"}';
}
?>
