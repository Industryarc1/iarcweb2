<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
echo "hi..<br>";

$target_dir = $_SERVER["DOCUMENT_ROOT"]."/frontend/web/assets/report-images/Automotive-Valves-Market-AM-782131.webp";
echo $target_dir;

if(unlink($target_dir)){
echo "<br>ok";
}
else{
echo "<br>no";
}
?>