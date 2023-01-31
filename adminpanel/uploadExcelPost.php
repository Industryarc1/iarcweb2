<?php
ini_set('max_execution_time', 0);
ini_get("max_execution_time");

include_once "includes/config.php";
if(@$_POST['hiddenExlEdit']!=""){
	$test1="uploadExcelPost2.php";
}else{
	$test1="uploadExcelPost1.php";
}
$target_dir = "excel/";
$target_file = $target_dir . basename($_FILES["excelfile"]["name"]);
$file=$_FILES["excelfile"]["name"];

if(move_uploaded_file($_FILES["excelfile"]["tmp_name"], $target_file))
{
	?>
	<a href="<?=$test1?>?add=<?=$_FILES["excelfile"]["name"]?>">Click to upload</a>
	<?php
}else {
	echo "Sorry, there was an error uploading your file.";
}
?>