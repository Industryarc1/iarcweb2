<?php

$post = array('token'=>'GetReportByReportCode','code' => $_POST['id']); 
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://industryarc.com/api/check_title.php');
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($post));
echo $response = curl_exec($ch1);
curl_close($ch1);

?>