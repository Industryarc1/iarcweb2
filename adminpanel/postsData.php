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
    
if(@$_REQUEST['txtParent'] != '' ){    
  $where="";
  if(@$_REQUEST['txtParent']!="")
   {
     @$txtParent=$_REQUEST['txtParent'];
     
      $where.="cat = '$txtParent' and ";
   }
    
   if(@$_REQUEST['txtParent1']!="")
   {
     @$txtParent1=$_REQUEST['txtParent1'];
     
      $where.="subcat = '$txtParent1' and ";
   } 
   $where.=" 1=1 and is_publish=0";
$select = "select c.name as Category, p.title as Title,p.no_pages as Publisher,p.pub_date as Published,p.slp as SULPrice, p.clp as CULPrice,p.pages as Pages,p.dup_inc_id as ReportCode,concat('http://industryarc.com/Report/',dup_inc_id,'/',curl) as url from zsp_posts p inner join zsp_catlog_categories c on c.inc_id=p.cat where $where order by p.inc_id asc";


//$select = "select title as Title,no_pages as Publisher,pub_date as Published,slp as SULPrice, clp as CULPrice,pages as Pages,dup_inc_id as ReportCode,concat('http://industryarc.com/Report/',dup_inc_id,'/',curl) as url from zsp_posts where $where order by inc_id asc";

//run mysql query and then count number of fields
$export = mysql_query ($select ) 
       or die ( "Sql error : " . mysql_error( ) );
$fields = mysql_num_fields ( $export );

//create csv header row, to contain table headers 
//with database field names
for ( $i = 0; $i < $fields; $i++ ) {
  @$header .= mysql_field_name( $export , $i ) . ",";
}

//this is where most of the work is done. 
//Loop through the query results, and create 
//a row for each
while( $row = mysql_fetch_row( $export ) ) {
  $line = '';
  //for each field in the row
  foreach( $row as $value ) {
    //if null, create blank field
    if ( ( !isset( $value ) ) || ( $value == "" ) ){
      $value = ",";
    }
    //else, assign field value to our data
    else {
      $value = str_replace( '"' , '""' , $value );
      $value = '"' . $value . '"' . ",";
    }
    //add this field value to our row
    $line .= $value;
  }
  //trim whitespace from each row
   @$data .= trim( $line ) . "\n";
} 
//remove all carriage returns from the data
@$data = str_replace( "\r" , "" , $data );
$file_name="Reports ".date('Y-m-d');

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
} else if($_REQUEST['id'] == 'All' ){    
  
$select = "select title as Title,no_pages as Publisher,pub_date as Published,slp as SULPrice, clp as CULPrice,pages as Pages,dup_inc_id as Code,concat('http://industryarc.com/Report/',dup_inc_id,'/',curl) as url from zsp_posts order by inc_id asc";
//exit;

//run mysql query and then count number of fields
$export = mysql_query ($select ) 
       or die ( "Sql error : " . mysql_error( ) );
$fields = mysql_num_fields ( $export );

//create csv header row, to contain table headers 
//with database field names
for ( $i = 0; $i < $fields; $i++ ) {
  @$header .= mysql_field_name( $export , $i ) . ",";
}

//this is where most of the work is done. 
//Loop through the query results, and create 
//a row for each
while( $row = mysql_fetch_row( $export ) ) {
  $line = '';
  //for each field in the row
  foreach( $row as $value ) {
    //if null, create blank field
    if ( ( !isset( $value ) ) || ( $value == "" ) ){
      $value = ",";
    }
    //else, assign field value to our data
    else {
      $value = str_replace( '"' , '""' , $value );
      $value = '"' . $value . '"' . ",";
    }
    //add this field value to our row
    $line .= $value;
  }
  //trim whitespace from each row
  @$data .= trim( $line ) . "\n";
}
//remove all carriage returns from the data
@$data = str_replace( "\r" , "" , $data );
$file_name="Reports ".date('Y-m-d');

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
}
else
{
  $_SESSION['status']="FDD";
  header('Location:posts.php');
}
?>
