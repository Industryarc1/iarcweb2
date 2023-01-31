<?php   
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "192.168.1.9" || $_SERVER['HTTP_HOST'] == "172.16.0.2") {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "db_industryarc";
} else {
    //SERVER CONFIGURATION
    $host = "mysql.marketintelreports.com";
  $user = "dbindustryarc1";
  $password = "Reset!2345";
  $db = "dbindustryarc";   
}
global $con;
$con = @mysql_connect($host, $user, $password) or die("Unable to connect with DB Server. " . mysql_error());
if ($con) {
    mysql_select_db($db) or die("Unable to connect with DB Server. " . mysql_error());
}

$cat = $_GET['txtParent'];
$subcat = $_GET['txtParent1'];

$select = "select cat as Category,subcat as SubCategory,title as Title,code as ReportCode,pub_date as Published,description as Description,table_of_content as TOC,taf as TOF,no_pages as Publisher,slp as SULPrice, clp as CULPrice,pages as Pages,concat('http://industryarc.com/Report/',dup_inc_id,'/',curl) as url,related as RelatedReports from zsp_posts where ";
	
if($cat != "") {
	$select.=" cat = '$cat' and";
}

if($subcat != "") {
	$select.=" subcat = '$subcat' and";
}

$select.=" 1";
$select .=" order by inc_id DESC"; 

//run mysql query and then count number of fields
$export = mysql_query ( $select ) 
       or die ( "Sql error : " . mysql_error( ) );
$fields = mysql_num_fields ( $export );

//create csv header row, to contain table headers 
//with database field names
for ( $i = 0; $i < $fields; $i++ ) {
	$header .= mysql_field_name( $export , $i ) . ",";
}
$header .= "Category" . ",";
$header .= "SubCategory" . ",";
//this is where most of the work is done. 
//Loop through the query results, and create 
//a row for each
while( $row = mysql_fetch_row( $export ) ) {
	$line = '';
	//for each field in the row
	$i=1;
	foreach( $row as $value ) {
		//if null, create blank field
		if ( ( !isset( $value ) ) || ( $value == "" ) ){
			$value = ",";
		}
		//else, assign field value to our data
		else {	
		if($i==1){$cat=$value;}
		if($i==2){$subcat=$value;}
		    if($i==8 || $i==6 || $i==7 ){ $value=nl2br(base64_decode($value)); }
			$value = str_replace( '"' , '""' , $value );
			$value = '"' . $value . '"' . ",";
		}
		//add this field value to our row
		$line .= $value;
		$i++;
	}
	
	$evs=mysql_query("select * from zsp_catlog_categories where inc_id='".$cat."' ");
	if(mysql_num_rows($evs)>0){ $ev=mysql_fetch_array($evs); $result=$ev[1];  } 

	$evs1=mysql_query("select * from zsp_catlog_categories where inc_id='".$subcat."' ");
	if(mysql_num_rows($evs1)>0){ $ev1=mysql_fetch_array($evs1); $result1=$ev1[1];  } 
	
	$line .= '"' . $result . '"' . ",";
	$line .= '"' . $result1 . '"' . ",";
	//trim whitespace from each row
	$data .= trim( $line ) . "\n";
}
//remove all carriage returns from the data
$data = str_replace( "\r" , "" , $data );
$file_name="Reports ".date('Y-m-d');

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
?>  