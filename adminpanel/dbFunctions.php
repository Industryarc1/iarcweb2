<?php include_once "includes/config.php";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
class country
{
	function getCountryList($mysqli)
	{
		$stmtgCL=$mysqli->prepare("SELECT location_id,name FROM zsp_location WHERE is_visible=0 and location_type=0 ORDER BY name ASC");
		$stmtgCL->execute();
		$stmtgCL->store_result();
		$stmtgCL->bind_result($location_id,$countryName);
        
		while($stmtgCL->fetch())
		{
			$array[]=array($location_id,$countryName);		
		}
		return $array;
	}
}
?>