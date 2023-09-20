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
echo "<pre>";
//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow ; $row++){  //$highestRow
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);								
	foreach($rowData as $rd)
	{		
		$filters = "";
		$ReportId = mysqli_real_escape_string($mysqli,$rd[0]);
		$cat = mysqli_real_escape_string($mysqli,$rd[1]);
		if($cat!=""){
			$filters .= "cat='$cat',";
		}
		$subcat = mysqli_real_escape_string($mysqli,$rd[2]);
		if($subcat!=""){
			$filters .= "subcat='$subcat',";
		}
		$title=str_replace('_x000D_','',$rd[3]);
		$title = mysqli_real_escape_string($mysqli,$title);	
		if($title!=""){
			$filters .= "title='$title',";
		}		
		$code = mysqli_real_escape_string($mysqli,$rd[4]);
		$code=strtolower($code);		
		$short_descr=str_replace('_x000D_',"<br>",$rd[5]);
		$short_descr = $mysqli->real_escape_string($short_descr);
		$short_descr=substr($short_descr,0,250);
		if($short_descr!=""){
			$filters .= "short_descr='$short_descr',";
		}		
		$description=str_replace('_x000D_',"<br>",$rd[6]);
		$description = $mysqli->real_escape_string($description);
		$description = base64_encode($description);
		if($description!=""){
			$filters .= "description='$description',";
		}
		$table_of_content = $mysqli->real_escape_string(trim($rd[7]));
		$table_of_content=str_replace('_x000D_',"<br>",$table_of_content);
		$table_of_content = base64_encode($table_of_content);
		if($table_of_content!=""){
			$filters .= "table_of_content='$table_of_content',";
		}
		$slp = mysqli_real_escape_string($mysqli,$rd[8]);
		$slp=str_replace("$","",$slp);$slp=str_replace(",","",$slp);
		if($slp!=""){
			$filters .= "slp='$slp',";
		}
		$clp = mysqli_real_escape_string($mysqli,$rd[9]);
		$clp=str_replace("$","",$clp);$clp=str_replace(",","",$clp);
		if($clp!=""){
			$filters .= "clp='$clp',";
		}
		$altTag = mysqli_real_escape_string($mysqli,$rd[10]);
		if($altTag!=""){
			$filters .= "atag='$altTag',";
		}
		$pub_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rd[11]));
		if($pub_date!=""){
			$filters .= "pub_date='$pub_date',";
		}
		$fileFormate = mysqli_real_escape_string($mysqli,$rd[12]);
		$pages = mysqli_real_escape_string($mysqli,$rd[13]);
		$pages=preg_replace("/[^0-9]/","",$pages);
		if($pages!=""){
			$filters .= "pages='$pages',";
		}
		$curl = mysqli_real_escape_string($mysqli,$rd[14]);
		if($curl!=""){
			$filters .= "curl='$curl',";
		}		
		$cbreadcrumtag = mysqli_real_escape_string($mysqli,$rd[15]);
		if($cbreadcrumtag!=""){
			$filters .= "cbreadcrumb='$cbreadcrumtag',";
		}
		$meta_title=str_replace('_x000D_','',$rd[16]);	
		$meta_title = mysqli_real_escape_string($mysqli,$meta_title);
		if($meta_title!=""){
			$filters .= "meta_title='$meta_title',";
		}		
		$meta_keywords=str_replace('_x000D_','',$rd[17]);
		$meta_keywords = mysqli_real_escape_string($mysqli,$meta_keywords);
		if($meta_keywords!=""){
			$filters .= "meta_keywords='$meta_keywords',";
		}
		$meta_descr = str_replace('_x000D_','',$rd[18]);
		$meta_descr = mysqli_real_escape_string($mysqli,$meta_descr);
		if($meta_descr!=""){
			$filters .= "meta_descr='$meta_descr',";
		}		
		$seo_keywords = mysqli_real_escape_string($mysqli,$rd[19]);	
		if($seo_keywords!=""){
			$filters .= "seo_keyword='$seo_keywords',";
		}
		$tableandfigure = $mysqli->real_escape_string(trim($rd[20]));
		$tableandfigure=str_replace('_x000D_',"<br>",$tableandfigure);
		$tableandfigure = base64_encode($tableandfigure);
		if($tableandfigure!=""){
			$filters .= "taf='$tableandfigure',";
			$filters .= "cat_but='1',";
		}		
		$date = date("Y-m-d H:i:s");
		
		if($table_of_content!=""){
			$pub_type = "0";
			$is_publish = "0";
			$filters .= "publish_type='0',is_publish='0',";
		}
		
		$filters = rtrim($filters,",");
		$query = "UPDATE zsp_posts SET  $filters, dt_created='$date' where code='$code' and dup_inc_id='$ReportId'";
		//echo $query;exit;
		//$query = "UPDATE zsp_posts SET cat='$cat',subcat='$subcat',title='$title', short_descr='$short_descr', description='$description', table_of_content='$table_of_content', pub_date='$pub_date', slp='$slp', clp='$clp', pages='$pages',atag='$altTag' ,curl='$curl', cbreadcrumb='$cbreadcrumtag', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_descr='$meta_descr', seo_keyword='$seo_keywords',dt_created='$date',publish_type='$pub_type',is_publish='$is_publish' where code='$code' and dup_inc_id='$ReportId'";
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