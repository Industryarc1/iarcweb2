<?php
//$conn = mysqli_connect("34.67.44.136","")

$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{


		$query = "SELECT * FROM zsp_posts WHERE inc_id=2478";
		$reportData = mysqli_query($con,$query);
		//$reportData = mysqli_fetch_assoc($reportData);
		
		while($rows = mysqli_fetch_assoc($reportData)){
			echo $rows["title"]."<br>";
			$regularString = base64_decode($rows["taf"]);			
		}	

			
		//2479	
		$modifiedString = str_replace("<div>", "<li>", $regularString);
		$modifiedString = str_replace("</div>", "</li>", $modifiedString);	

		$modifiedBase64 = base64_encode("<ul>".$modifiedString."</ul>");
		

		/*$modifiedString = str_replace("<br>", "</p><p>", $regularString);
		//$modifiedString = str_replace("</div>", "</p>", $modifiedString);	

		$modifiedBase64 = base64_encode("<p>".$modifiedString."</p>");	
*/
		echo $modifiedBase64;


		/*echo "<pre>";
		print_r($reportData);
		echo "</pre>";*/
		
		/*foreach ($reportData as $key => $rd) {
			echo "<br>".$rd["title"];
		}*/

		
		echo "connected!";
	}



?>