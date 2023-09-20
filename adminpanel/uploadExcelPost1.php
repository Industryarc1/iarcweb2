<?php
include "PHPExcel/IOFactory.php";
include_once "includes/config.php";

//$inputFileName = "excel/" .$_REQUEST["add"];

$target_dir = "excel/";
$target_file = $target_dir . basename($_FILES["excelfile"]["name"]);
$file=$_FILES["excelfile"]["name"];

if(!move_uploaded_file($_FILES["excelfile"]["tmp_name"], $target_file))
{
	echo "Sorry, there was an error uploading your file.";
	exit;
}

$inputFileName = $target_file;
//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow ; $row++){  //$highestRow
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
	//print_r($rowData);exit;								
	foreach($rowData as $rd)
	{		
		$ReportId = mysqli_real_escape_string($mysqli,$rd[0]);
		$cat = mysqli_real_escape_string($mysqli,$rd[1]);
		$subcat = mysqli_real_escape_string($mysqli,$rd[2]);
		$title=str_replace('_x000D_','',$rd[3]);
		$title = mysqli_real_escape_string($mysqli,$title);		
		$code = mysqli_real_escape_string($mysqli,$rd[4]);
		//$code=strtolower($code);		
		$short_descr=str_replace('_x000D_',"<br>",$rd[5]);
		$short_descr = $mysqli->real_escape_string($short_descr);
		$short_descr=substr($short_descr,0,250);		
		$description=str_replace('_x000D_',"<br>",$rd[6]);
		$description = $mysqli->real_escape_string($description);
		$description = base64_encode($description);
		$table_of_content = $mysqli->real_escape_string(trim($rd[7]));
		$table_of_content=str_replace('_x000D_',"<br>",$table_of_content);
		$table_of_content = base64_encode($table_of_content);
		$slp = mysqli_real_escape_string($mysqli,$rd[8]);
		$slp=str_replace("$","",$slp);$slp=str_replace(",","",$slp);
		$clp = mysqli_real_escape_string($mysqli,$rd[9]);
		$clp=str_replace("$","",$clp);$clp=str_replace(",","",$clp);
		$altTag = mysqli_real_escape_string($mysqli,$rd[10]);
		$pub_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rd[11]));
		$fileFormate = mysqli_real_escape_string($mysqli,$rd[12]);
		$pages = mysqli_real_escape_string($mysqli,$rd[13]);
		$pages=preg_replace("/[^0-9]/","",$pages);
		$curl = mysqli_real_escape_string($mysqli,$rd[14]);	
		$cbreadcrumtag = mysqli_real_escape_string($mysqli,$rd[15]);
		$meta_title=str_replace('_x000D_','',$rd[16]);	
		$meta_title = mysqli_real_escape_string($mysqli,$meta_title);		
		$meta_keywords=str_replace('_x000D_','',$rd[17]);
		$meta_keywords = mysqli_real_escape_string($mysqli,$meta_keywords);
		$meta_descr = str_replace('_x000D_','',$rd[18]);
		$meta_descr = mysqli_real_escape_string($mysqli,$meta_descr);	
		$seo_keywords = mysqli_real_escape_string($mysqli,$rd[19]);	
		$tableandfigure = $mysqli->real_escape_string(trim($rd[20]));
		$tableandfigure=str_replace('_x000D_',"<br>",$tableandfigure);
		$tableandfigure = base64_encode($tableandfigure);		
		$date = date("Y-m-d H:i:s");
		
		if($tableandfigure!=""){
			$cat_but = "1";
		}else{
			$cat_but = "0";
		}
		
		if($table_of_content!=""){
			$pub_type = "0";
			$is_publish = "0";
		}else{
			$pub_type = "1";
			$is_publish = "1";
		}
		
		$query = "INSERT INTO zsp_posts(cat,subcat,title,code, short_descr, description, table_of_content, report_type, pub_date, slp, clp,no_pages, pages,cat_but,atag,file_format,curl,cbreadcrumb, meta_title, meta_keywords, meta_descr, seo_keyword,dt_created,taf,status,dup_inc_id,publish_type,is_publish) VALUES ('$cat','$subcat','$title','$code','$short_descr','$description','$table_of_content','S','$pub_date','$slp','$clp','IndustryARC','$pages','$cat_but','$altTag','PDF','$curl','$cbreadcrumtag','$meta_title','$meta_keywords','$meta_descr','$seo_keywords','$date','$tableandfigure','1','$ReportId','$pub_type','$is_publish')";
		$result=mysqli_query($mysqli,$query);	
	}	
	
}
 if (!$result) {	 
	$_SESSION['stat']="FE";
	$allClasses->forRedirect ("posts.php");
	exit;
}else
{
	$_SESSION['stat']="SE";
	$allClasses->forRedirect ("posts.php");
	exit;		
} 


?>
