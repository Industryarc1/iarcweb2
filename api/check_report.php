<?php
if(isset($_POST['token']) && $_POST['token']=="checkReport"){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$title = $_POST['title'];
	$query = "SELECT * FROM zsp_posts WHERE title LIKE '%".$title."%'";
	$reportData = mysqli_query($con,$query);
	$reportData = mysqli_fetch_assoc($reportData);
	if(!empty($reportData)){
		echo "Exist";
	}else{
		echo "Not Exist";
	}
	mysqli_close($con);
}else{
	echo "failed";
}
?>
