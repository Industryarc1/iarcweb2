<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json; charset=utf-8');

//ini_set('memory_limit' '-1')
$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$title_name = "Automotive Valves Market";

$cc = 1;
//$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title_name."%'";
$query = "SELECT * FROM zsp_posts ";
		$reportData = mysqli_query($con,$query);
		$data=array();
		//$data = 0;
		while($row = mysqli_fetch_assoc($reportData)) {
			$str = base64_decode($row["description"]);
			$find = "Report Coverage";
if (strpos($str, $find) !== false) {
    $data[] = array("count"=>$cc++,"title"=>$row["title"]);
}

			
		}

/*
//total number of report having RD less than 4000 chars.

//$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title_name."%'";
$query = "SELECT * FROM zsp_posts ";
		$reportData = mysqli_query($con,$query);
		$data=array();
		//$data = 0;
		$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
			$str = base64_decode($row["description"]);

$strln = strlen($str);
			if($strln >= 100 && $strln <=4000){
				//$count++;

				$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
				
			}

			
		}*/


/*
//total number of report having RD > than 4000 chars and < 7000.

//$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title_name."%'";
$query = "SELECT * FROM zsp_posts ";
		$reportData = mysqli_query($con,$query);
		$data=array();
		//$data = 0;
		$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
			$str = base64_decode($row["description"]);

$strln = strlen($str);
			if($strln >= 4000 && $strln <=7000){
				

				$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}

				/*
				$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>$row["curl"]."-".$row["dup_inc_id"]);*/
				//$count++;
			/*}

		//$data = 

			
		}

*/
//total number of reports
/*
$query = "SELECT * FROM zsp_posts ";
$reportData = mysqli_query($con,$query);
$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
$count++;
		}*/

/*
//total number of report having RD > than 7000 chars.

//$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title_name."%'";
$query = "SELECT * FROM zsp_posts ";
		$reportData = mysqli_query($con,$query);
		$data=array();
		//$data = 0;
		$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
			$str = base64_decode($row["description"]);

$strln = strlen($str);
			if($strln >7000){
				//$count++;

				$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
				
			}

			
		}*/


/*
//total number of reports with no rd & redirecting to home page

$query = "SELECT * FROM zsp_posts where description=''";
$reportData = mysqli_query($con,$query);
$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
//$count++;
			$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
		}*/

/*
//total number of report having RD > than 7000 chars.

//$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title_name."%'";
$query = "SELECT * FROM zsp_posts ";
		$reportData = mysqli_query($con,$query);
		$data=array();
		//$data = 0;
		$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
			$str = base64_decode($row["description"]);

$strln = strlen($str);
			if($strln >1 && $strln<100){
				//$count++;

				$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
				
			}

			
		}*/



/*
//total number of reports with no rd & redirecting to home page

$query = "SELECT * FROM zsp_posts WHERE description IS NULL";
$reportData = mysqli_query($con,$query);
$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
//$count++;
			$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
		}*/



//total number of reports with no rd & redirecting to home page
// description IS NULL  || description IS empty || TOC - count(10)
/*
$query = "SELECT * FROM zsp_posts WHERE description IS NULL or description=''";
$reportData = mysqli_query($con,$query);
$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
//$count++;



			$str = base64_decode($row["table_of_content"]);

$strln = strlen($str);
			if($strln >10){

			$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
		}


}*/


/*
// RD (50) || TOC - NO
$query = "SELECT * FROM zsp_posts WHERE table_of_content IS NULL or table_of_content=''";
$reportData = mysqli_query($con,$query);
$count=1;
		while($row = mysqli_fetch_assoc($reportData)) {
//$count++;



			$str = base64_decode($row["description"]);

$strln = strlen($str);
			if($strln >50){

			$str = $row["curl"];
				$find = ".html";

				

				if (strpos($str, $find) !== false) {
					//https://www.industryarc.com/Report/15106/aerospace-material-market.html
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Report/".$row["dup_inc_id"]."/".$row["curl"]);
				}
				else{
					//https://www.industryarc.com/Research/china-maize-oil-market-report-700732
					$data[] = array("count"=>$count++,"title"=>$row["title"],"report_code"=>$row["code"],"url"=>"https://www.industryarc.com/Research/".$row["curl"]."-".$row["dup_inc_id"]);
				}
		}


}
*/		

		


		echo json_encode($data);
?>