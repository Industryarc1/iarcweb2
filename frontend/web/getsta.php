<?php
//$conn = mysqli_connect("34.67.44.136","")

$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{


		$query = "SELECT * FROM zsp_posts WHERE inc_id=2479";
		$reportData = mysqli_query($con,$query);
		$reportData = mysqli_fetch_assoc($reportData);
		echo "<pre>";
		print_r($reportData);
		echo "</pre>";
		
		foreach ($reportData as $key => $rd) {
			echo "<br>".$rd["title"];
		}

		
		echo "connected!";
	}



?>